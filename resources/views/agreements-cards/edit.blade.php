@extends('adminlte::page')

@section('title', 'Изменить карточку договора контрагента')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4>Изменить карточку договора контрагента</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Главная</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('agreements-cards.index') }}">Карточки договоров контрагентов</a></li>
                    <li class="breadcrumb-item active">Изменить карточку договора контрагента</li>
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
                        <form method="POST" action="{{ route('agreements-cards.update', $agreement->id) }}">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label for="channel_id">Канал</label>
                                <select class="form-control" name="channel_id" required>
                                    <option value="" disabled selected>Канал</option>
                                    @foreach($channels as $channel)
                                        <option value="{{ $channel->id }}" {{ $agreement->channel_id == $channel->id ? 'selected' : '' }}>{{ $channel->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="counterparty_id">Контрагент</label>
                                <select class="form-control" name="counterparty_id" required>
                                    <option value="" disabled selected>Контрагент</option>
                                    @foreach($counterparties as $counterparty)
                                        <option value="{{ $counterparty->id }}" {{ $agreement->counterparty_id == $counterparty->id ? 'selected' : '' }}>{{ $counterparty->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sum">Сумма</label>
                                <input type="text" class="form-control" name="sum" step="any" required value="{{ $agreement->sum }}" placeholder="Сумма">
                            </div>
                            <div class="form-group">
                                <label for="period_id">Период</label>
                                <select class="form-control" name="period_id" required id="selectPeriod">
                                    <option value="" disabled selected>Период</option>
                                    @foreach($periods as $period)
                                        <option value="{{ $period->id }}" {{ $agreement->period_id == $period->id ? 'selected' : '' }}>{{ $period->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="currency_id">Валюта</label>
                                <span class="loader" style="display:none;">
                                        <i class="fas fa-spinner fa-spin"></i> Loading...
                                </span>
                                <select id="currency_id" data-currency-id="{{ $agreement->currency_id }}" class="form-control" name="currency_id" required>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="currency_presence">Тип курса</label>
                                <select class="form-control" name="currency_presence" required>
                                    @foreach($presence as $k => $value)
                                        <option value="{{ $k }}" {{ $agreement->currency_presence == $value ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
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
        $(document).ready(function(){
            const selectedOption = $('#selectPeriod').find('option:selected');
            const periodId = selectedOption.val();
            const currencyId = $('#currency_id').data('currency-id');

            getCurrencies(periodId, currencyId);

            $('#selectPeriod').change(function(){
                $('.loader').show();
                $('#create_btn').hide();

                const periodId = $(this).val();
                getCurrencies(periodId);

            });

            function getCurrencies(periodId, currencyId = null)
            {
                const URL = currencyId == null ? "{{ route('agreements-cards.currencies', ':period_id') }}".replace(':period_id', periodId) : "{{ route('agreements-cards.currencies', ':period_id') }}".replace(':period_id', periodId) + '?currency_id=' + currencyId;
                $.ajax({
                    url: URL,
                    method: 'GET',
                    success: function(response){
                        $('#currency_id').empty();
                        $('#currency_id').append(response);
                        $('.loader').hide();
                        $('#create_btn').show();
                    },
                    error: function(xhr, status, error){
                        console.error(xhr.responseText);
                        $('.loader').hide();
                        $('#create_btn').show();
                    }
                });
            }
        });
    </script>
@stop

