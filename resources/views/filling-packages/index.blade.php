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
                                            <label for="channel_id">Канал:</label>
                                            <select class="form-control select2" name="channel_id[]" multiple>
                                                <option></option>
                                                @foreach($channels as $channel)
                                                    <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                                                @endforeach
                                            </select>
                                        </th>
                                        <th>
                                            <label for="package_id">Тематика канала:</label>
                                            <select class="form-control select2" name="category_id[]" multiple>
                                                <option></option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </th>
                                        <th>
                                            <label for="package_id">Пакет:</label>
                                            <select class="form-control select2" name="package_id[]" multiple>
                                                <option></option>
                                                @foreach($packages as $package)
                                                    <option value="{{ $package->id }}">{{ $package->name }}</option>
                                                @endforeach
                                            </select>
                                        </th>
                                        <th>
                                            <label for="department_id">Филиал:</label>
                                            <select class="form-control select2" name="department_id[]" id="department_id" multiple data-departments="{{ $departments }}">
                                                <option></option>
                                                @foreach($departments->unique('department_id') as $value)
                                                    <option value="{{ $value->department_id }}">{{ $value->department }}</option>
                                                @endforeach
                                            </select>
                                        </th>
                                        <th>
                                            <label for="town_id">Город:</label>
                                            <select class="form-control select2" name="town_id[]" id="town_id" multiple>
                                                <option></option>
                                            </select>
                                        </th>
                                        <th>
                                            <a href="{{ route('filling-packages.index') }}" class="btn btn-secondary mb-2"><i class="fa-solid fa-rotate-right"></i> Сбросить</a>
                                            <button type="submit" class="btn btn-success mb-2" style="width: 111px;"><i class="fa-solid fa-magnifying-glass"></i> Поиск</button>
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
                                    <td>{{ $channelsPackage->department }}</td>
                                    <td>{{ $channelsPackage->town }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        <label>Общее количество:</label> {{ count($channelsPackages) > 0 ? $channelsPackages->total() : 0 }}
                        <div class="float-right">
                            {{ count($channelsPackages) > 0 ?? $channelsPackages->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
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

            let departments =  $('#department_id').data('departments');
            let selectedOptions = [];
            let filteredDepartments = [];
            $('#department_id').change(function() {
                selectedOptions = [];

                $('#department_id option:selected').each(function() {
                    selectedOptions.push($(this).val());
                });

                selectedOptions = selectedOptions.map(Number);

                filteredDepartments = $.grep(departments, function(item) {
                    return selectedOptions.includes(item.department_id);
                });

                $('#town_id').empty();

                filteredDepartments.forEach(function(item) {
                    $('#town_id').append('<option value="'+item.town_id+'">'+item.town+'</option>')
                });
            });

        });

    </script>
@stop
