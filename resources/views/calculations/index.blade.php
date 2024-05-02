@extends('adminlte::page')

@section('title', 'Расчёты')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4>Расчёты</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Главная</a></li>
                    <li class="breadcrumb-item active">Расчёты</li>
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
                        <div class="row">
                            <div class="col-7">
                                <div class="form-group row calculate">
                                    <label for="period_id" class="col-sm-2 col-form-label">Период:</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="period_id" required>
                                            <option value="" disabled selected>Не выбрано</option>
                                            @foreach($periods as $period)
                                                <option value="{{ $period->id }}" {{ old('period_id') == $period->id ? 'selected' : '' }}>{{ $period->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <button type="button" class="btn btn-success" id="calculate">
                                            <i class="fa-solid fa-calculator"></i> Запустить расчёт
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="period_id" class="col-sm-2 col-form-label">Период:</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="period_id" required>
                                            <option value="" disabled selected>Не выбрано</option>
                                            @foreach($periods as $period)
                                                <option value="{{ $period->id }}" {{ old('period_id') == $period->id ? 'selected' : '' }}>{{ $period->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <button type="button" class="btn btn-success">
                                            <i class="fa-regular fa-money-bill-1"></i> Цена за 1 канал/1 абонент
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="period_id" class="col-sm-2 col-form-label">Период:</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="period_id" required>
                                            <option value="" disabled selected>Не выбрано</option>
                                            @foreach($periods as $period)
                                                <option value="{{ $period->id }}" {{ old('period_id') == $period->id ? 'selected' : '' }}>{{ $period->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <button type="button" class="btn btn-success">
                                            <i class="fa-regular fa-file-excel"></i> Создать загрузочный файл в 1С РУ
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="period_id" class="col-sm-2 col-form-label">Период:</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="period_id" required>
                                            <option value="" disabled selected>Не выбрано</option>
                                            @foreach($periods as $period)
                                                <option value="{{ $period->id }}" {{ old('period_id') == $period->id ? 'selected' : '' }}>{{ $period->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <button type="button" class="btn btn-success">
                                            <i class="fa-regular fa-file-excel"></i> Создать загрузочный файл в 1С Бух
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="period_id" class="col-sm-2 col-form-label">Период:</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="period_id" required>
                                            <option value="" disabled selected>Не выбрано</option>
                                            @foreach($periods as $period)
                                                <option value="{{ $period->id }}" {{ old('period_id') == $period->id ? 'selected' : '' }}>{{ $period->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <button type="button" class="btn btn-success">
                                            <i class="fa-regular fa-file-excel"></i> Проверочный файл по 1С Бух
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="period_id" class="col-sm-2 col-form-label">Период:</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="period_id" required>
                                            <option value="" disabled selected>Не выбрано</option>
                                            @foreach($periods as $period)
                                                <option value="{{ $period->id }}" {{ old('period_id') == $period->id ? 'selected' : '' }}>{{ $period->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <button type="button" class="btn btn-success">
                                            <i class="fa-regular fa-file-excel"></i> Количество абонентов на канале
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-5">
                                <div id="progress-container">
                                    <div class="progress">
                                        <div id="progress-bar" class="progress-bar bg-success progress-bar-striped" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
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
            function checkButtonState() {
                $('#progress-bar').css('width', '0%');
                $('#progress-bar').closest('.progress').hide();

                $('.form-group').each(function() {
                    let $select = $(this).find('select[name="period_id"]');
                    let $button = $(this).find('button');

                    if ($select.val() === null || $select.val() === '') {
                        $button.prop('disabled', true);
                    } else {
                        $button.prop('disabled', false);
                    }
                });
            }

            checkButtonState();

            $('select[name="period_id"]').on('change', function() {
                checkButtonState();
            });

            $('#calculate').on('click', function() {
                let period_id = $('.calculate select[name="period_id"]').val();
                let $button = $(this);
                $button.prop('disabled', true);

                if (period_id !== null && period_id !== '') {
                    $('#progress-bar').closest('.progress').show();
                    $('#progress-bar').css('width', '0%');
                    $.ajax({
                        url: '/calculations/calculate/' + period_id,
                        method: 'GET',
                        xhr: function() {
                            let xhr = new window.XMLHttpRequest();

                            xhr.upload.addEventListener('progress', function(evt) {
                                if (evt.lengthComputable) {
                                    let percentComplete = (evt.loaded / evt.total) * 100;
                                    $('#progress-bar').css('width', percentComplete + '%');
                                }
                            }, false);

                            return xhr;
                        },
                        success: function(response) {

                        },
                        error: function(error) {
                            console.error('Произошла ошибка при запросе:', error);
                        },
                        complete: function() {
                            $('#progress-bar').css('width', '100%');
                            $button.prop('disabled', false);
                        }
                    });
                }
            });

        });
    </script>
@stop
