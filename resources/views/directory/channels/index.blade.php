@extends('adminlte::page')

@section('title', 'Справочник каналов')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4>Справочник каналов</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Главная</a></li>
                    <li class="breadcrumb-item active">Справочник каналов</li>
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
                        <form method="POST" action="{{ route('channels.import') }}" class="form-inline mb-2 float-right" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input name="channels_import" type="file" class="custom-file-input" id="exampleInputFile" accept=".xlsx, .xls" required>
                                        <label class="custom-file-label" for="exampleInputFile" id="fileInputLabel">Выберите файл</label>
                                    </div>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-success"><i class="fa-regular fa-file-excel"></i> Загрузить</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <a href="{{ route('channels.export') }}" class="btn btn-outline-success mr-2 float-right"><i class="fa-regular fa-file-excel"></i> Выгрузить</a>
                        <div class="clearfix"></div>
                        <form method="GET" action="{{ route('channels.index') }}" class="form-inline mb-2 float-right">
                            <div class="form-group mr-2">
                                <label class="mr-2" for="period_id">Наименование:</label>
                                <select class="form-control" name="channel_id">
                                    <option></option>
                                    @foreach($channelsFilter as $channel)
                                        <option value="{{ $channel->id }}" @if(request('channel_id') == $channel->id) selected @endif>{{ $channel->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="text-right">
                                    <a href="{{ route('channels.index') }}" class="btn btn-secondary mr-2"><i class="fa-solid fa-rotate-right"></i> Сбросить</a>
                                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-magnifying-glass"></i> Поиск</button>
                                </div>
                            </div>
                        </form>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Канал</th>
                                    <th>Дополнительная информация</th>
                                    <th>Тематика канала</th>
                                    <th>
                                        <a href="{{ route('channels.create') }}" class="btn btn-outline-success"><i class="fa-solid fa-plus"></i> Добавить</a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($channels as $channel)
                                    <tr>
                                        <td>{{ $channel->id }}</td>
                                        <td>{{ $channel->name }}</td>
                                        <td>{{ $channel->description }}</td>
                                        <td>{{  $channel->category?->name }}</td>
                                        <td>
                                            <a href="{{ route('channels.edit', $channel->id) }}"><i class="fa-regular fa-pen-to-square text-green mr-5" title="Редактировать"></i></a>
                                            <a href="#" data-toggle="modal" data-target="#modal-delete" data-route="{{ route('channels.delete', $channel->id) }}">
                                                <i class="fa-solid fa-trash-can text-danger" title="Удалить"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        <label>Общее количество:</label> {{ $channels->total() }}
                        <div class="float-right">
                            {{ $channels->links('vendor.pagination.bootstrap-4') }}
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

            @if(session('error'))
                $(document).Toasts('create', {
                    class: 'bg-danger',
                    title: 'Ошибка',
                    body: `{!! session('error') !!}`
                });
            @endif

        });
    </script>
@stop
