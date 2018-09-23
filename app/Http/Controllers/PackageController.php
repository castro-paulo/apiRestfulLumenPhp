<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Services\PackageService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PackageController extends Controller
{
    private $packageService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(PackageService $packageService)
    {
        $this->packageService = $packageService;
    }

    public function getPackages()
	{
		return $this->packageService->getPackages();
	}

    public function getPackage(int $id) 
    {
        return $this->packageService->getPackage($id);
    }

    public function getPackageDetails(int $id) 
    {
        return $this->packageService->getPackageDetails($id); 
    }

    public function createPackage(Request $request) 
    {                      
        return $this->packageService->createPackage($request); 
    } 

    public function editPackage(int $id, Request $request)
    {
        return $this->packageService->editPackage($id, $request);  
    }
    
    public function deletePackage(int $id)
    {
        return $this->packageService->deletePackage($id);
    }
}
