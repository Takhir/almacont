<?php

namespace App\Repositories;

use App\Dto\PackageDTO;
use App\Exports\PackagesExport;
use App\Imports\PackagesImport;
use App\Models\Package;
use Maatwebsite\Excel\Facades\Excel;

class PackageRepository
{
    public function all()
    {
        return Package::all();
    }

    public function getAll($perPage)
    {
        return Package::orderBy('id', 'desc')->paginate($perPage);
    }

    public function store($request)
    {
        $packageDTO = new PackageDTO(
            $request->input('name'),
            $request->input('description'),
            $request->input('active')
        );

        $package = new Package();
        $package->name = $packageDTO->name;
        $package->description = $packageDTO->description;
        $package->active = $packageDTO->active;

        return $package->save();
    }

    public function update($request, $package)
    {
        $packageDTO = new PackageDTO(
            $request->input('name'),
            $request->input('description'),
            $request->input('active'),
        );

        $package->name = $packageDTO->name;
        $package->description = $packageDTO->description;
        $package->active = $packageDTO->active;

        return $package->save();
    }

    public function delete($package)
    {
        return $package->delete();
    }

    public function getIdByName(string $name)
    {
        return Package::getIdByName($name);
    }

    public function import($request)
    {
        return Excel::import(new PackagesImport, $request->file('packages_import'));
    }

    public function export()
    {
        $export = new PackagesExport;
        $fileName = 'packages.xlsx';
        $filePath = 'public/' . $fileName;

        Excel::store($export, $filePath);

        return $fileName;
    }
}
