@extends('adminlte::page')

@section('title', 'Абоненты по пакетам')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4>Абоненты по пакетам</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Главная</a></li>
                    <li class="breadcrumb-item active">Абоненты по пакетам</li>
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
                        <form method="POST" action="{{ route('subscribers.import') }}" class="form-inline mb-2 float-right" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input name="subscribers_import" type="file" class="custom-file-input" id="exampleInputFile" accept=".xlsx, .xls" required>
                                        <label class="custom-file-label" for="exampleInputFile" id="fileInputLabel">Выберите файл</label>
                                    </div>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-success"><i class="fa-regular fa-file-excel"></i> Загрузить</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="clearfix"></div>
                        <form method="GET" action="{{ route('subscribers.index') }}" class="form-inline mb-2 float-right">
                            <div class="form-group mr-2">
                                <label class="mr-2" for="period_id">Период:</label>
                                <select class="form-control" name="period_id">
                                    <option></option>
                                    @foreach($periods as $period)
                                        <option value="{{ $period->id }}" @if(request('period_id') == $period->id) selected @endif>{{ $period->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mr-2">
                                <label class="mr-2" for="town_id">Город:</label>
                                <select class="form-control" name="town_id">
                                    <option></option>
                                    @foreach($towns as $town)
                                        <option value="{{ $town->id }}" @if(request('town_id') == $town->id) selected @endif>{{ $town->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mr-2">
                                <label class="mr-2" for="package_name">Пакет:</label>
                                <select class="form-control" name="package_id">
                                    <option></option>
                                    @foreach($packages as $package)
                                        <option value="{{ $package->id }}" @if(request('package_id') == $package->id) selected @endif>{{ $package->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="text-right">
                                    <a href="{{ route('subscribers.index') }}" class="btn btn-secondary mr-2"><i class="fa-solid fa-rotate-right"></i> Сбросить</a>
                                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-magnifying-glass"></i> Поиск</button>
                                </div>
                            </div>
                        </form>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Период</th>
                                    <th>Город</th>
                                    <th>Пакет</th>
                                    <th>Количество подкл. або-в</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($subscribers as $k => $subscriber)
                                <tr>
                                    <td>{{ $k + 1 }}</td>
                                    <td>{{ $subscriber->period->name }}</td>
                                    <td>{{ $subscriber->town }}</td>
                                    <td>{{ is_null($subscriber->package_name) ? $subscriber->package?->name : $subscriber->package_name }}</td>
                                    <td>{{ $subscriber->quantity }}</td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#modal-delete" data-route="{{ route('subscribers.delete', $subscriber->id) }}">
                                            <i class="fa-solid fa-trash-can text-danger" title="Удалить"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        <label>Общее количество:</label> {{ $subscribers->total() }}
                        <div class="float-right">
                            {{ $subscribers->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
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
