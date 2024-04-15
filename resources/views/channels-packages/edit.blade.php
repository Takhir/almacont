@extends('adminlte::page')

@section('title', 'Изменить канал по пакетам')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4>Изменить канал по пакетам</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Главная</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('channels-packages.index') }}">Каналы по пакетам</a></li>
                    <li class="breadcrumb-item active">Изменить канал по пакетам</li>
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
                        <form method="POST" action="{{ route('channels-packages.update', $channelsPackage->id) }}">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label for="channel_id">Канал</label>
                                <select class="form-control" name="channel_id" required>
                                    <option value="" disabled selected>Канал</option>
                                    @foreach($channels as $channel)
                                        <option value="{{ $channel->id }}" {{ $channelsPackage->channel_id == $channel->id ? 'selected' : '' }}>{{ $channel->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="package_id">Пакет</label>
                                <select class="form-control select2" name="package_id" required>
                                    <option></option>
                                    @foreach($packages as $package)
                                        <option value="{{ $package->id }}" {{ $channelsPackage->package_id == $package->id ? 'selected' : '' }}>{{ $package->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="all_department" type="checkbox" id="all_department">
                                <label for="all_department">
                                    Добавить во все филиалы
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="package_id">Филиал</label>
                                <select class="form-control select2" name="department_id" id="department_id" data-departments="{{ $departments }}" required>
                                    <option></option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}" {{ $channelsPackage->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="package_id">Город</label>
                                <i id="spinner" class="fa-solid fa-spinner" style="display: none;"></i>
                                <select class="form-control select2" name="town_id" id="town_id" required>
                                    <option></option>
                                    @foreach($towns as $town)
                                        <option value="{{ $town->id }}" {{ $channelsPackage->town_id == $town->id ? 'selected' : '' }}>{{ $town->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="package_id">Дата начала</label>
                                <div class="input-group date picker" data-target-input="nearest">
                                    <input name="dt_start" value="{{ $channelsPackage->dt_start }}" type="text" class="form-control datetimepicker-input" data-target="#datepicker"/>
                                    <div class="input-group-append" data-target="#datepicker" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa-regular fa-calendar-days"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="package_id">Дата окончания</label>
                                <div class="input-group date picker" data-target-input="nearest">
                                    <input name="dt_stop" value="{{ $channelsPackage->dt_stop }}" type="text" class="form-control datetimepicker-input" data-target="#datepicker"/>
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
                                    <button id="create_btn" type="submit" class="btn btn-success"><i class="fa-regular fa-floppy-disk"></i> Сохранить</button>
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

            $("#all_department").on('change', function(){
                if($(this).is(":checked")) {
                    $("#department_id").removeAttr("required");
                    $("#town_id").removeAttr("required");
                } else {
                    $("#department_id").attr("required", "required");
                    $("#town_id").attr("required", "required");
                }
            });

        });

    </script>
@stop


