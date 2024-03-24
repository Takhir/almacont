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

@php
    use App\Enums\Exchanges;
@endphp

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
                                    @foreach($periods as $k => $period)
                                        <option value="{{ $period->id }}" @if(request('period_id') == $period->id) selected @endif>{{ $period->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mr-2">
                                <label class="mr-2" for="town_id">Город:</label>
                                <select class="form-control" name="town_id">
                                    <option></option>
                                    @foreach($towns as $k => $town)
                                        <option value="{{ $k }}" @if(request('town_id') == $k) selected @endif>{{ $town }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mr-2">
                                <label class="mr-2" for="package_name">Пакет:</label>
                                <select class="form-control" name="package_name">
                                    <option></option>
                                    @foreach($packages as $k => $package)
                                        <option value="{{ $k }}" @if(request('package_name') == $k) selected @endif>{{ $package }}</option>
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
                                    <td>{{ $subscriber->department->town }}</td>
                                    <td>{{ is_null($subscriber->package_name) ? $subscriber->package?->name : $subscriber->package_name }}</td>
                                    <td>{{ $subscriber->quantity }}</td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#modal-delete" data-subscriber-id="{{ $subscriber->id }}">
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
                            {{ $subscribers->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
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
                const subscriberId = button.data('subscriber-id');
                const modal = $(this);
                const url = "{{ route('subscribers.delete', ':id') }}".replace(':id', subscriberId);
                modal.find('.delete-form').attr('action', url);
            });

            @if(session('success'))
            $(document).Toasts('create', {
                class: 'bg-success',
                title: 'Уведомление',
                body: `{!! session('success') !!}`
            });
            @endif

            const errorMessage = $("#error-message").val();
            if(errorMessage !== undefined && errorMessage !== "") {
                $(document).Toasts('create', {
                    class: 'bg-danger',
                    title: 'Ошибка',
                    body: errorMessage,
                });
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('exampleInputFile').addEventListener('change', function() {
                document.getElementById('fileInputLabel').textContent = this.files[0].name;
            });
        });
    </script>
@stop
