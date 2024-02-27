@extends('layouts.main')

@section('title', 'Изменить валюту')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4>Изменить валюту</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Главная</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('currency.index') }}">Справочник валют</a></li>
                    <li class="breadcrumb-item active">Изменить валюту</li>
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
                                        title: 'Уведомление',
                                        body: `{!! $errorMessage !!}`
                                    })
                                </script>
                            @stop
                        @endif
                        <form method="POST" action="{{ route('currency.update', $currency->id) }}">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label for="v_name">Валюта</label>
                                <select class="form-control" name="v_name" required>
                                    @foreach($currencies as $value)
                                        <option value="{{$value}}" {{ $currency->v_name == $value ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="report_period_id">Период</label>
                                <select class="form-control" name="report_period_id" required>
                                    <option>...</option>
                                    @foreach($period as $value)
                                        <option value="{{$value->id}}" {{ $currency->report_period_id == $value->id ? 'selected' : '' }}>{{ $value->v_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="n_exchange_start">Курсы на начало периода</label>
                                <input type="hidden" class="form-control" name="id" value="{{ $currency->id }}">
                                <input id="n_exchange_start" type="number" class="form-control" name="n_exchange_start" required value="{{ $currency->n_exchange_start }}">
                            </div>

                            <div class="form-group">
                                <label for="n_exchange_stop">Курсы на конец периода</label>
                                <input id="n_exchange_stop" type="number" class="form-control" name="n_exchange_stop" required value="{{ $currency->n_exchange_stop }}">
                            </div>

                            <div class="form-group">
                                <div class="text-right">
                                    <a href="{{ url()->previous() }}" class="btn btn-secondary mr-3"><i class="fa-solid fa-arrow-left"></i> Назад</a>
                                    <button type="submit" class="btn btn-success"><i class="fa-regular fa-floppy-disk"></i> Сохранить</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
