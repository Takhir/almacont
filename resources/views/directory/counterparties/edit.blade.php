@extends('layouts.main')

@section('title', 'Изменить Контрагента')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4>Изменить Контрагента</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Главная</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('counterparties.index') }}">Справочник Контрагентов</a></li>
                    <li class="breadcrumb-item active">Изменить Контрагента</li>
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
                        <form method="POST" action="{{ route('counterparties.update', $counterparty->id) }}">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label for="name">Контрагент</label>
                                <input type="text" class="form-control" name="name" required value="{{ $counterparty->name }}">
                            </div>
                            <div class="form-group">
                                <label for="bin">БИН</label>
                                <input type="number" class="form-control" name="bin" required value="{{ $counterparty->bin }}" min="0">
                            </div>
                            <div class="form-group">
                                <label for="resident">Резидент РК</label>
                                <select class="form-control" name="resident" required>
                                    @foreach($resident as $k => $value)
                                        <option value="{{$k}}" {{ $counterparty->resident == $k ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
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
