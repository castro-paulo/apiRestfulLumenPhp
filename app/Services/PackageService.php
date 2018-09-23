<?php

namespace App\Services;

use App\Repositories\PackageRepositoryInterface;
use App\Models\ValidationPackage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class PackageService
{
	private $packageRepository;

	public function __construct(PackageRepositoryInterface $packageRepository)
	{
		$this->packageRepository = $packageRepository;
	}

	public function getPackages()
	{        
        try {
            $packages = $this->packageRepository->getPackages();
    
            if (count($packages) > 0) {
                return response()->json($packages, Response::HTTP_OK);			    
            } else {
                return response()->json([], Response::HTTP_OK);			
            } 
        } catch(QueryException $e) {
            return response()->json(['error'=> 'Connection database error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    public function getPackage($id)
	{       
        try {
            $package = $this->packageRepository->getPackage($id);
            
            if (count($package) > 0) {
                return response()->json($package, Response::HTTP_OK);          
            } else {
                return response()->json(null, Response::HTTP_NOT_FOUND);
            }       
        } catch(QueryException $e) {
            return response()->json(['error'=> 'Connection database error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    public function getPackageDetails($id)
    {
        try {
            $package = $this->packageRepository->getPackageDetails($id);
		
            if (is_null($package)) {
                return response()->json([], Response::HTTP_NOT_FOUND);
            } else {
                return response()->json([
                    'id'          => $package->id,
                    'description'   => $package->description,
                    'urlImage'   => $package->urlImage,
                    'site'        => $package->site,
                    'phone'    => $package->phone,
                    'package'      => [
                        'id'         => $package->id,
                        'name'       => $package->name,
                        'beginDate' => $package->beginDate,
                        'endDate'    => $package->endDate,
                        'value'      => $package->value
                    ]
                ], Response::HTTP_OK);  
            }
        } catch(QueryException $e) {
            return response()->json(['error'=> 'Connection database error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }        
    }

    public function createPackage(Request $request)
	{	
        $validacao = Validator::make(
            $request->all(),
            ValidacaoPackage::RULE_NEW_PACKAGE,
            ValidacaoPackage::ERROR_MESSAGES              
        );

        if($validacao->fails()) {
            return response()->json($validacao->errors(), Response::HTTP_BAD_REQUEST); 
        } else {
            try {
                $package = $this->packageRepository->createPackage($request);
                return response()->json($package, Response::HTTP_CREATED);
            } catch(QueryException $e) {
                return response()->json(['error'=> 'Connection database error'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }       
        
    }
    
    public function editPackage(int $id, Request $request)
	{     
        $validacao = Validator::make(
            $request->all(),
            ValidacaoPackage::RULE_NEW_PACKAGE,
            ValidacaoPackage::ERROR_MESSAGES              
        );

        if($validacao->fails()) {
            return response()->json($validacao->errors(), Response::HTTP_BAD_REQUEST); 
        } else {
            try {
                $package = $this->packageRepository->editPackage($id, $request);            
                return response()->json($package, Response::HTTP_OK);
            } catch(QueryException $e) {
                return response()->json(['error'=> 'Connection database error'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }
    
    public function deletePackage($id)
	{        
        try {
            $package = $this->packageRepository->deletePackage($id);           
            return response()->json(null, Response::HTTP_OK);
        } catch(QueryException $e) {
            return response()->json(['error'=> 'Connection database error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
	}
}