@extends('adminlte::page')

@section('title', 'Добавить валюту')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4>Добавить валюту</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Главная</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('currency.index') }}">Справочник валют</a></li>
                    <li class="breadcrumb-item active">Добавить валюту</li>
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
                        <form method="POST" action="{{ route('currency.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Валюта</label>
                                <select class="form-control" name="currency_type_id" required>
                                    @foreach($currencies as $value)
                                        <option value="{{$value->id}}" {{ old('currency_type_id') == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="period_id">Период</label>
                                <select class="form-control" name="period_id" required>
                                    <option>...</option>
                                    @foreach($period as $value)
                                        <option value="{{$value->id}}" {{ old('period_id') == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="n_exchange_start">Курсы на начало периода</label>
                                <input type="number" class="form-control" name="exchange_start" step="any" required value="{{ old('exchange_start') }}" min="0">
                            </div>

                            <div class="form-group">
                                <label for="n_exchange_stop">Курсы на конец периода</label>
                                <input type="number" class="form-control" name="exchange_stop" step="any" required value="{{ old('exchange_stop') }}" min="0">
                            </div>

                            <div class="form-group">
                                <div class="text-right">
                                    <a href="{{ url()->previous() }}" class="btn btn-secondary mr-3"><i class="fa-solid fa-arrow-left"></i> Назад</a>
                                    <button type="submit" class="btn btn-success"><i class="fa-regular fa-floppy-disk"></i> Добавить</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
