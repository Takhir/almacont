@extends('adminlte::page')

@section('title', 'Каналы по пакетам')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4>Каналы по пакетам</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Главная</a></li>
                    <li class="breadcrumb-item active">Каналы по пакетам</li>
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
                        <table class="table table-bordered table-hover">
                            <thead>
                                <form method="GET" action="{{ route('channels-packages.index') }}" class="form-inline mb-2 float-right">
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
                                        <th colspan="2">
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
                                            <label>Дата начала:</label>
                                            <div class="input-group date picker mb-2" data-target-input="nearest">
                                                <input name="dt_start_from" value="{{ old('dt_start_from') }}" type="text" class="form-control datetimepicker-input" data-target="#datepicker"/>
                                                <div class="input-group-append" data-target="#datepicker" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa-regular fa-calendar-days"></i></div>
                                                </div>
                                            </div>
                                            <div class="input-group date picker" data-target-input="nearest">
                                                <input name="dt_start_to" value="{{ old('dt_start_to') }}" type="text" class="form-control datetimepicker-input" data-target="#datepicker"/>
                                                <div class="input-group-append" data-target="#datepicker" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa-regular fa-calendar-days"></i></div>
                                                </div>
                                            </div>
                                        </th>
                                        <th>
                                            <label>Дата окончания:</label>
                                            <div class="input-group date picker mb-2" data-target-input="nearest">
                                                <input name="dt_stop_from" value="{{ old('dt_stop_from') }}" type="text" class="form-control datetimepicker-input" data-target="#datepicker"/>
                                                <div class="input-group-append" data-target="#datepicker" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa-regular fa-calendar-days"></i></div>
                                                </div>
                                            </div>
                                            <div class="input-group date picker" data-target-input="nearest">
                                                <input name="dt_stop_to" value="{{ old('dt_stop_to') }}" type="text" class="form-control datetimepicker-input" data-target="#datepicker"/>
                                                <div class="input-group-append" data-target="#datepicker" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa-regular fa-calendar-days"></i></div>
                                                </div>
                                            </div>
                                        </th>
                                        <th>
                                            <a href="{{ route('channels-packages.index') }}" class="btn btn-secondary mb-2"><i class="fa-solid fa-rotate-right"></i> Сбросить</a>
                                            <button type="submit" class="btn btn-success" style="width: 111px;"><i class="fa-solid fa-magnifying-glass"></i> Поиск</button>
                                        </th>
                                    </tr>
                                </form>
                                <tr>
                                    <th>№</th>
                                    <th>ID канала</th>
                                    <th>Канал</th>
                                    <th>ID пакета</th>
                                    <th>Пакет</th>
                                    <th>Филиал</th>
                                    <th>Город</th>
                                    <th>Дата начала</th>
                                    <th>Дата окончания</th>
                                    <th>
                                        <a href="{{ route('channels-packages.create') }}" class="btn btn-outline-success"><i class="fa-solid fa-plus"></i> Добавить</a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($channelsPackages as $k => $channelsPackage)
                                <tr>
                                    <td>{{ $k + 1 }}</td>
                                    <td>{{ $channelsPackage->channel_id }}</td>
                                    <td>{{ $channelsPackage->channel?->name }}</td>
                                    <td>{{ $channelsPackage->package_id }}</td>
                                    <td>{{ $channelsPackage->package->name }}</td>
                                    <td>{{ $channelsPackage->department->department }}</td>
                                    <td>{{ $channelsPackage->town->town }}</td>
                                    <td>{{ $channelsPackage->dt_start }}</td>
                                    <td>{{ $channelsPackage->dt_stop }}</td>
                                    <td>
                                        <a href="{{ route('channels-packages.edit', $channelsPackage->id) }}"><i class="fa-regular fa-pen-to-square text-green mr-5" title="Редактировать"></i></a>
                                        <a href="#" data-toggle="modal" data-target="#modal-delete" data-channels-package-id="{{ $channelsPackage->id }}">
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
                            {{ $channelsPackages->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
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
                const channelsPackageId = button.data('channels-package-id');
                const modal = $(this);
                const url = "{{ route('channels-packages.delete', ':id') }}".replace(':id', channelsPackageId);
                modal.find('.delete-form').attr('action', url);
            });

            @if(session('success'))
                $(document).Toasts('create', {
                    class: 'bg-success',
                    title: 'Уведомление',
                    body: `{!! session('success') !!}`
                });
            @endif

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
                format: 'dd.mm.yyyy',
                language: 'ru'
            });
        });

    </script>
@stop
