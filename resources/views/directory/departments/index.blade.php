@extends('adminlte::page')

@section('title', 'Справочник филиалов')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4>Справочник филиалов</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Главная</a></li>
                    <li class="breadcrumb-item active">Справочник филиалов</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID Филиала</th>
                                    <th>Филиал</th>
                                    <th>ID Города</th>
                                    <th>Город</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($departments as $department)
                                <tr>
                                    <td>{{ $department->id }}</td>
                                    <td>{{ $department->name }}</td>
                                    @foreach($department->towns as $k => $town)
                                        @if($k === 0)
                                            <td>{{ $town->id }}</td>
                                            <td>{{ $town->name }}</td>
                                        @else
                                            <tr>
                                                <td>{{ $department->id }}</td>
                                                <td>{{ $department->name }}</td>
                                                <td>{{ $town->id }}</td>
                                                <td>{{ $town->name }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        <label>Общее количество:</label> {{ $departments->total() }}
                        <div class="float-right">
                            {{ $departments->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
