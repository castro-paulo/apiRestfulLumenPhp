<?php

namespace App\Repositories;

use App\Models\Package;
use App\Repositories\PackageRepositoryInterface;
use Illuminate\Http\Request;

class PackageRepositoryEloquent implements PackageRepositoryInterface 
{
    private $package;

    public function __construct(Package $package) 
    {
        $this->package = $package;
    }

    public function getPackages() 
    {
        return $this->package
        ->select(
            'id',
            'name',
            'value',
            'beginDate',
            'endDate',
            'urlImagem'
        )->get();
    }
    
    public function getPackage(int $id) 
    {     
        return $this->package
        ->select(
            'id',
            'name',
            'value',
            'beginDate',
            'endDate',
            'urlImage'
        )
        ->where('id',$id)
        ->get();
    }

    public function getPackageDetails(int $id) 
    {
        return $this->package->find($id);      
    }

    public function createPackage(Request $request) 
    {        
        return $this->package->create($request->all());
    }

    public function editPackage(int $id, Request $request) 
    {        
        return $this->package
        ->where('id', $id)
        ->update($request->all());
    }

    public function deletePackage(int $id)
    {
        $package = $this->package->find($id);
        return $package->delete();
    }

}