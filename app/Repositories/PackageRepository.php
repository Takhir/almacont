<?php

namespace App\Repositories;

use App\Dto\PackageDTO;
use App\Models\Package;
use Illuminate\Support\Carbon;

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
}
