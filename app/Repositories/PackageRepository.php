<?php

namespace App\Repositories;

use App\DTO\PackageDTO;
use App\Models\Package;
use Illuminate\Support\Carbon;

class PackageRepository
{
    public function getAll($perPage)
    {
        return Package::where('deleted', 0)->orderBy('id', 'desc')->paginate($perPage);
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

        $package->dt_start = Carbon::now();
        $package->dt_stop = Carbon::createFromDate(2500, 1, 1, 0, 0, 0);

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

        $package->dt_start = Carbon::now();
        $package->dt_stop = Carbon::createFromDate(2500, 1, 1, 0, 0, 0);

        return $package->save();
    }

    public function delete($package)
    {
        $package = Package::findOrFail($package->id);
        $package->deleted = 1;

        return $package->save();
    }
}
