@extends('adminlte::page')

@section('title', 'Справочник пакетов')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4>Справочник пакетов</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Главная</a></li>
                    <li class="breadcrumb-item active">Справочник пакетов</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@php
    use App\Enums\Status;
@endphp

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
                                    <th>Пакет</th>
                                    <th>Дополнительная информация</th>
                                    <th>Отображать на главной</th>
                                    <th>
                                        <a href="{{ route('packages.create') }}" class="btn btn-outline-success"><i class="fa-solid fa-plus"></i> Добавить</a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($packages as $package)
                                    <tr>
                                        <td>{{ $package->id }}</td>
                                        <td>{{ $package->name }}</td>
                                        <td>{{ $package->description }}</td>
                                        <td>{{ $package->active == 1 ? Status::Yes->value : Status::No->value  }}</td>
                                        <td>
                                            <a href="{{ route('packages.edit', $package->id) }}"><i class="fa-regular fa-pen-to-square text-green mr-5" title="Редактировать"></i></a>
                                            <a href="#" data-toggle="modal" data-target="#modal-delete" data-package-id="{{ $package->id }}">
                                                <i class="fa-solid fa-trash-can text-danger" title="Удалить"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        <div class="float-right">
                            {{ $packages->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa-solid fa-trash-can"></i> Удаление</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Вы уверены что хотите удалить данную запись</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Нет</button>
                    <form method="post" class="delete-form" action="">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Да</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#modal-delete').on('show.bs.modal', function(event) {
                const button = $(event.relatedTarget);
                const packageId = button.data('package-id');
                const modal = $(this);
                const url = "{{ route('packages.delete', ':id') }}".replace(':id', packageId);
                modal.find('.delete-form').attr('action', url);
            });

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
