<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface PackageRepositoryInterface 
{
	public function getPackages();
	public function getPackage(int $id);
	public function getPackageDetails(int $id);
	public function createPackage(Request $request);
	public function editPackage(int $id, Request $request);
	public function deletePackage(int $id);
}