@extends('adminlte::page')

@section('title', 'Справочник валют')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4>Справочник валют</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Главная</a></li>
                    <li class="breadcrumb-item active">Справочник валют</li>
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
                        @if(session('success'))
                            @section('js')
                                <script>
                                    $(document).Toasts('create', {
                                        class: 'bg-success',
                                        title: 'Уведомление',
                                        body: `{!! session('success') !!}`
                                    })
                                </script>
                            @stop
                        @endif
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Валюта</th>
                                    <th>Период</th>
                                    <th>Курс на начала периода</th>
                                    <th>Курс на конец периода</th>
                                    <th>
                                        <a href="{{ route('currency.create') }}" class="btn btn-outline-success"><i class="fa-solid fa-plus"></i> Добавить</a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($currencies as $currency)
                                    <tr>
                                        <td>{{ $currency->id }}</td>
                                        <td>{{ $currency->v_name }}</td>
                                        <td>{{ $currency->period->v_name }}</td>
                                        <td>{{ $currency->n_exchange_start }}</td>
                                        <td>{{ $currency->n_exchange_stop }}</td>
                                        <td>
                                            <a href="{{ route('currency.edit', $currency->id) }}"><i class="fa-regular fa-pen-to-square text-green mr-5" title="Редактировать"></i></a>
                                            <a href="#" data-toggle="modal" data-target="#modal-delete" data-currency-id="{{ $currency->id }}">
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
                            {{ $currencies->links('vendor.pagination.bootstrap-4') }}
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
                    <form method="post" class="delete-form">
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
                var button = $(event.relatedTarget);
                const currencyId = button.data('currency-id');
                const modal = $(this);
                const url = "{{ route('currency.delete', ':id') }}".replace(':id', currencyId);
                modal.find('.delete-form').attr('action', url);
            });
        });
    </script>
@stop
