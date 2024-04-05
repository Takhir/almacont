@php
    use App\Enums\Resident;
@endphp

@extends('adminlte::page')

@section('title', 'Справочник Контрагентов')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4>Справочник Контрагентов</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Главная</a></li>
                    <li class="breadcrumb-item active">Справочник Контрагентов</li>
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
                        @if($errors->any())
                            @php
                                $errorMessage = '';
                                foreach($errors->all() as $error) {
                                    $errorMessage .= '<p>' . $error . '</p>';
                                }
                            @endphp
                            <input id="error-message" type="hidden" value="{{ $errorMessage }}">
                        @endif
                        <form method="POST" action="{{ route('counterparties.import') }}" class="form-inline mb-2 float-right" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input name="counterparties_import" type="file" class="custom-file-input" id="exampleInputFile" accept=".xlsx, .xls" required>
                                        <label class="custom-file-label" for="exampleInputFile" id="fileInputLabel">Выберите файл</label>
                                    </div>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-success"><i class="fa-regular fa-file-excel"></i> Загрузить</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <a href="{{ route('counterparties.export') }}" class="btn btn-outline-success mr-2 float-right"><i class="fa-regular fa-file-excel"></i> Выгрузить</a>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Наименование</th>
                                    <th>БИН</th>
                                    <th>Резидент РК</th>
                                    <th>
                                        <a href="{{ route('counterparties.create') }}" class="btn btn-outline-success"><i class="fa-solid fa-plus"></i> Добавить</a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($counterparties as $counterparty)
                                    <tr>
                                        <td>{{ $counterparty->id }}</td>
                                        <td>{{ $counterparty->name }}</td>
                                        <td>{{ $counterparty->bin }}</td>
                                        <td>{{ $counterparty->resident == 1 ? Resident::Yes->value : Resident::No->value  }}</td>
                                        <td>
                                            <a href="{{ route('counterparties.edit', $counterparty->id) }}"><i class="fa-regular fa-pen-to-square text-green mr-5" title="Редактировать"></i></a>
                                            <a href="#" data-toggle="modal" data-target="#modal-delete" data-route="{{ route('counterparties.delete', $counterparty->id) }}">
                                                <i class="fa-solid fa-trash-can text-danger" title="Удалить"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        <label>Общее количество:</label> {{ $counterparties->total() }}
                        <div class="float-right">
                            {{ $counterparties->links('vendor.pagination.bootstrap-4') }}
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

            @if(session('error'))
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'Ошибка',
                body: `{!! session('error') !!}`
            });
            @endif

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
