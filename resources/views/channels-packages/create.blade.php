@extends('layouts.main')

@section('title', 'Добавить канал по пакетам')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4>Добавить канал по пакетам</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Главная</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('channels-packages.index') }}">Каналы по пакетам</a></li>
                    <li class="breadcrumb-item active">Добавить канал по пакетам</li>
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
                            @section('js')
                                <script>
                                    $(document).Toasts('create', {
                                        class: 'bg-danger',
                                        title: 'Ошибка',
                                        body: `{!! $errorMessage !!}`
                                    })
                                </script>
                            @stop
                        @endif
                        <form method="POST" action="{{ route('channels-packages.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="channel_id">Канал</label>
                                <select class="form-control" name="channel_id" required>
                                    <option value="" disabled selected>Канал</option>
                                    @foreach($channels as $channel)
                                        <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>{{ $channel->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="package_id">Пакет</label>
                                <select class="form-control select2" name="package_id" required>
                                    <option></option>
                                    @foreach($packages as $package)
                                        <option value="{{ $package->id }}">{{ $package->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="package_id">Филиал</label>
                                <select class="form-control select2" name="department_id" id="department_id" data-departments="{{ $departments }}" required>
                                    <option></option>
                                    @foreach($departments->unique('department_id') as $value)
                                        <option value="{{ $value->department_id }}">{{ $value->department }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="package_id">Город</label>
                                <select class="form-control select2" name="town_id" id="town_id" required>
                                    <option></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="package_id">Дата начала</label>
                                <div class="input-group date picker" data-target-input="nearest">
                                    <input name="dt_start" value="{{ old('dt_start') }}" type="text" class="form-control datetimepicker-input" data-target="#datepicker"/>
                                    <div class="input-group-append" data-target="#datepicker" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa-regular fa-calendar-days"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="package_id">Дата окончания</label>
                                <div class="input-group date picker" data-target-input="nearest">
                                    <input name="dt_stop" value="{{ old('dt_stop') }}" type="text" class="form-control datetimepicker-input" data-target="#datepicker"/>
                                    <div class="input-group-append" data-target="#datepicker" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa-regular fa-calendar-days"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="text-right">
                                    <a href="{{ url()->previous() }}" class="btn btn-secondary mr-3"><i class="fa-solid fa-arrow-left"></i> Назад</a>
                                    <span class="loader" style="display:none;">
                                        <i class="fas fa-spinner fa-spin"></i> Loading...
                                    </span>
                                    <button id="create_btn" type="submit" class="btn btn-success"><i class="fa-regular fa-floppy-disk"></i> Добавить</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {

            $('.select2').select2();

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

        $(function () {
            $('.picker').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
                language: 'ru'
            });
        });

    </script>
@stop


