<?php

namespace App\Repositories;

use App\Models\Department;

class DepartmentRepository
{
    private TownRepository $townRepository;

    public function __construct(TownRepository $townRepository)
    {
        $this->townRepository = $townRepository;
    }

    public function all()
    {
        return Department::orderBy('name')->get();
    }

    public function getAll($request)
    {
        $perPage = $request->input('per_page', 20);

        return Department::with('towns')->orderBy('name')->paginate($perPage);
    }

    public function getId(string $name)
    {
        return Department::where('name', $name)->first()->id;
    }

}
