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
        return Package::orderBy('name')->get();
    }

    public function getAll($perPage)
    {
        return Package::orderBy('name')->paginate($perPage);
    }

    public function store(PackageDTO $packageDTO)
    {
        $package = new Package();
        $package->name = $packageDTO->name;
        $package->description = empty($packageDTO->description) ? null : $packageDTO->description;
        $package->active = $packageDTO->active;

        return $package->save();
    }

    public function update(PackageDTO $packageDTO, Package $package)
    {
        $package->name = $packageDTO->name;
        $package->description = empty($packageDTO->description) ? null : $packageDTO->description;
        $package->active = $packageDTO->active;

        return $package->save();
    }

    public function delete(Package $package)
    {
        return $package->delete();
    }

    public function getIdByName(string $name)
    {
        return Package::getIdByName($name);
    }

    public function import($file)
    {
        return Excel::import(new PackagesImport, $file);
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
