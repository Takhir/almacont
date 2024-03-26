@extends('adminlte::page')

@section('title', 'Карточки договоров контрагентов')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4>Карточки договоров контрагентов</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Главная</a></li>
                    <li class="breadcrumb-item active">Карточки договоров контрагентов</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@php
use App\Enums\Exchanges;
@endphp

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="GET" action="{{ route('agreements-cards.index') }}" class="form-inline mb-2 float-right">
                            <div class="form-group mr-2">
                                <label class="mr-2" for="period_id">Период:</label>
                                <select class="form-control" name="period_id">
                                    <option></option>
                                    @foreach($periods as $k => $period)
                                        <option value="{{ $period->id }}" @if(request('period_id') == $period->id) selected @endif>{{ $period->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="text-right">
                                    <a href="{{ route('agreements-cards.index') }}" class="btn btn-secondary mr-2"><i class="fa-solid fa-rotate-right"></i> Сбросить</a>
                                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-magnifying-glass"></i> Поиск</button>
                                </div>
                            </div>
                        </form>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>№</th>
                                <th>Контрагент</th>
                                <th>Канал</th>
                                <th>ID канала</th>
                                <th>Сумма в Валюте</th>
                                <th>Валюта</th>
                                <th>Сумма в Тенге</th>
                                <th>Период</th>
                                <th>Признак курса</th>
                                <th>
                                    <a href="{{ route('agreements-cards.create') }}" class="btn btn-outline-success"><i class="fa-solid fa-plus"></i> Добавить</a>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($agreements as $k => $agreement)
                                <tr>
                                    <td>{{ $k + 1 }}</td>
                                    <td>{{ $agreement->counterparty->name }}</td>
                                    <td>{{ $agreement->channel->name }}</td>
                                    <td>{{ $agreement->channel_id }}</td>
                                    <td>{{ $agreement->sum }}</td>
                                    <td>{{ $agreement->currency->type->name }}</td>
                                    <td>{{ $agreement->sum_tenge }}</td>
                                    <td>{{ $agreement->period->name }}</td>
                                    <td>{{ $agreement->currency_persence == 0 ? Exchanges::Start : Exchanges::Stop }}</td>
                                    <td>
                                        <a href="{{ route('agreements-cards.edit', $agreement->id) }}"><i class="fa-regular fa-pen-to-square text-green mr-5" title="Редактировать"></i></a>
                                        <a href="#" data-toggle="modal" data-target="#modal-delete" data-agreement-id="{{ $agreement->id }}">
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
                            {{ $agreements->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
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
                const agreementId = button.data('agreement-id');
                const modal = $(this);
                const url = "{{ route('agreements-cards.delete', ':id') }}".replace(':id', agreementId);
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
