@extends('adminlte::page')

@section('title', 'Наполнения пакетов')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4>Наполнения пакетов</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Главная</a></li>
                    <li class="breadcrumb-item active">Наполнения пакетов</li>
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
                        <table class="table table-bordered table-hover">
                            <thead>
                                <form method="GET" action="{{ route('filling-packages.index') }}" class="form-inline mb-2 float-right">
                                    <tr>
                                        <th></th>
                                        <th colspan="2">
                                            <label for="channel_id">* Канал:</label>
                                            <select class="form-control select2" name="channel_id[]" id="channel_id">
                                                <option></option>
                                                @foreach($channels as $channel)
                                                    <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                                                @endforeach
                                            </select>
                                        </th>
                                        <th>
                                            <label for="category_id">* Тематика канала:</label>
                                            <select class="form-control select2" name="category_id[]" id="category_id">
                                                <option></option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </th>
                                        <th>
                                            <label for="package_id">* Пакет:</label>
                                            <select class="form-control select2" name="package_id[]" id="package_id">
                                                <option></option>
                                                @foreach($packages as $package)
                                                    <option value="{{ $package->id }}">{{ $package->name }}</option>
                                                @endforeach
                                            </select>
                                        </th>
                                        <th>
                                            <label for="department_id"><span class="text-danger">*</span> Филиал:</label>
                                            <select class="form-control select2" name="department_id[]" id="department_id" required>
                                                <option></option>
                                                @foreach($departments as $department)
                                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                                @endforeach
                                            </select>
                                        </th>
                                        <th>
                                            <label for="town_id"><span class="text-danger">*</span> Город:</label>
                                            <i id="spinner" class="fa-solid fa-spinner" style="display: none;"></i>
                                            <select class="form-control select2" name="town_id[]" id="town_id" required>
                                                <option></option>
                                            </select>
                                        </th>
                                        <th>
                                            <a href="{{ route('filling-packages.index') }}" class="btn btn-secondary mb-2"><i class="fa-solid fa-rotate-right"></i> Сбросить</a>
                                            <button id="search" type="submit" class="btn btn-success mb-2" style="width: 111px;"><i class="fa-solid fa-magnifying-glass"></i> Поиск</button>
                                        </th>
                                    </tr>
                                </form>
                                <tr>
                                    <th>№</th>
                                    <th>Канал</th>
                                    <th>Дополнительная информация</th>
                                    <th>Тематика канала</th>
                                    <th>Пакет</th>
                                    <th>Филиал</th>
                                    <th>Город</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($channelsPackages as $k => $channelsPackage)
                                <tr>
                                    <td>{{ $k + 1 }}</td>
                                    <td>{{ $channelsPackage->channel?->name }}</td>
                                    <td>{{ $channelsPackage->channel?->description }}</td>
                                    <td>{{ $channelsPackage->channel?->category?->name }}</td>
                                    <td>{{ $channelsPackage->package->name }}</td>
                                    <td>{{ $channelsPackage->departmentName }}</td>
                                    <td>{{ $channelsPackage->townName }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        <label>Общее количество:</label> {{ count($channelsPackages) > 0 ? $channelsPackages->total() : 0 }}
                        <div class="float-right">
                            {{ count($channelsPackages) > 0 ? $channelsPackages->appends(request()->query())->links('vendor.pagination.bootstrap-4') : '' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

            $('#department_id').change(function() {
                $('#town_id').empty();
                $('#spinner').show();
                $.ajax({
                    url: '/directory/towns/' + $(this).val(),
                    method: 'GET',
                    success: function(response) {
                        response.forEach(function(town) {
                            $('#town_id').append('<option value="'+town.id+'">'+town.name+'</option>')
                        })
                    },
                    error: function(error) {
                        console.error('Произошла ошибка при запросе:', error);
                    },
                    complete: function() {
                        $('#spinner').hide();
                    }
                });
            });

            if ($('#channel_id').val() === '' && $('#category_id').val() === '' && $('#package_id').val() === '')  {
                $('#search').prop('disabled', true);
            }

            $('#channel_id').change(function() {
                if ($('#department_id').val() !== '' && $('#town_id').val() !== '' && ($('#channel_id').val() !== '' || $('#category_id').val() !== '' || $('#package_id').val() !== ''))  {
                    $('#search').prop('disabled', false);
                } else {
                    $('#search').prop('disabled', true);
                }
            });

            $('#category_id').change(function() {
                if ($('#department_id').val() !== '' && $('#town_id').val() !== '' && ($('#channel_id').val() !== '' || $('#category_id').val() !== '' || $('#package_id').val() !== ''))  {
                    $('#search').prop('disabled', false);
                } else {
                    $('#search').prop('disabled', true);
                }
            });

            $('#package_id').change(function() {
                if ($('#department_id').val() !== '' && $('#town_id').val() !== '' && ($('#channel_id').val() !== '' || $('#category_id').val() !== '' || $('#package_id').val() !== ''))  {
                    $('#search').prop('disabled', false);
                } else {
                    $('#search').prop('disabled', true);
                }
            });

            $('#department_id').change(function() {
                if ($('#department_id').val() !== '' && $('#town_id').val() !== '' && ($('#channel_id').val() !== '' || $('#category_id').val() !== '' || $('#package_id').val() !== ''))  {
                    $('#search').prop('disabled', false);
                } else {
                    $('#search').prop('disabled', true);
                }
            });

            $('#town_id').change(function() {
                if ($('#department_id').val() !== '' && $('#town_id').val() !== '' && ($('#channel_id').val() !== '' || $('#category_id').val() !== '' || $('#package_id').val() !== ''))  {
                    $('#search').prop('disabled', false);
                } else {
                    $('#search').prop('disabled', true);
                }
            });

        });

    </script>
@stop
