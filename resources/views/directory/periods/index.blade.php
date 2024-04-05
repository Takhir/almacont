@extends('adminlte::page')

@section('title', 'Справочник периодов')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4>Справочник периодов</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Главная</a></li>
                    <li class="breadcrumb-item active">Справочник периодов</li>
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
                                    <th>ID</th>
                                    <th>Период</th>
                                    <th>
                                        <a href="{{ route('periods.create') }}" class="btn btn-outline-success"><i class="fa-solid fa-plus"></i> Добавить</a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($periods as $period)
                                    <tr>
                                        <td>{{ $period->id }}</td>
                                        <td>{{ $period->name }}</td>
                                        <td>
                                            <a href="{{ route('periods.edit', $period->id) }}"><i class="fa-regular fa-pen-to-square text-green mr-5" title="Редактировать"></i></a>
                                            <a href="#" data-toggle="modal" data-target="#modal-delete" data-route="{{ route('periods.delete', $period->id) }}">
                                                <i class="fa-solid fa-trash-can text-danger" title="Удалить"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        <label>Общее количество:</label> {{ $periods->total() }}
                        <div class="float-right">
                            {{ $periods->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.modal-delete')
@stop

@section('js')
    <script>
        $(document).ready(function() {
            @if(session('success'))
                $(document).Toasts('create', {
                    class: 'bg-success',
                    title: 'Уведомление',
                    body: `{!! session('success') !!}`
                });
            @endif
        });
    </script>
@stop
