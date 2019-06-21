@extends('calendario::template')

@section('title', 'Calendário')

@section('content')

    <!-- Modal -->
    <div class="modal fade" id="eventoModal" tabindex="-1" role="dialog" aria-labelledby="eventoModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventoModalLabel">Novo evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('eventos.criar')}}" id="eventoForm" method="post">
                        <div class="form-group">
                            <label for="eventoTitulo">Título</label>
                            <input type="text" class="form-control" id="eventoTitulo">
                        </div>
                        <div class="form-group">
                            <label>Data</label>
                            <div class="form-row">
                                <div class="col-6">
                                    <div class="input-group date" id="eventoDataInicio" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                               data-target="#eventoDataInicio"/>
                                        <div class="input-group-append" data-target="#eventoDataInicio"
                                             data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="input-group date" id="eventoDataFim" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                               data-target="#eventoDataFim"/>
                                        <div class="input-group-append" data-target="#eventoDataFim"
                                             data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <i class="material-icons">alarm</i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <div class="input-group date" id="eventoHoraInicio" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                               data-target="#eventoHoraInicio"/>
                                        <div class="input-group-append" data-target="#eventoHoraInicio"
                                             data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group date" id="eventoHoraFim" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                               data-target="#eventoHoraFim"/>
                                        <div class="input-group-append" data-target="#eventoHoraFim"
                                             data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="eventoAgenda">Agenda</label>
                            <select id="eventoAgenda" class="form-control">
                                <option value="Pessoal">Pessoal</option>
                                <option value="Pessoal">Pessoal</option>
                                <option value="Pessoal">Pessoal</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" form="eventoForm" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </div>
    <div id="calendario"></div>
@stop

@section('css')
    <link rel="stylesheet" type="text/css"
          href="{{Module::asset(config('calendario.id').':fullcalendar-4.2.0/packages/core/main.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{Module::asset(config('calendario.id').':fullcalendar-4.2.0/packages/daygrid/main.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{Module::asset(config('calendario.id').':fullcalendar-4.2.0/packages/timegrid/main.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{Module::asset(config('calendario.id').':fullcalendar-4.2.0/packages/list/main.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{Module::asset(config('calendario.id').':fullcalendar-4.2.0/packages/bootstrap/main.min.css')}}">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    @parent
@endsection

@section('js')
    <script type="text/javascript"
            src="{{Module::asset(config('calendario.id').':fullcalendar-4.2.0/packages/core/main.min.js')}}"></script>
    <script type="text/javascript"
            src="{{Module::asset(config('calendario.id').':fullcalendar-4.2.0/packages/daygrid/main.min.js')}}"></script>
    <script type="text/javascript"
            src="{{Module::asset(config('calendario.id').':fullcalendar-4.2.0/packages/interaction/main.min.js')}}"></script>
    <script type="text/javascript"
            src="{{Module::asset(config('calendario.id').':fullcalendar-4.2.0/packages/timegrid/main.min.js')}}"></script>
    <script type="text/javascript"
            src="{{Module::asset(config('calendario.id').':fullcalendar-4.2.0/packages/list/main.min.js')}}"></script>
    <script type="text/javascript"
            src="{{Module::asset(config('calendario.id').':fullcalendar-4.2.0/packages/core/locales/pt-br.js')}}"></script>
    <script type="text/javascript" src="https://momentjs.com/downloads/moment-with-locales.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>

    <script>
        $(function () {
            $('#eventoDataInicio, #eventoDataFim').datetimepicker({
                format: 'L',
                locale: 'pt-br',
            });
            $("#eventoDataInicio").on("change.datetimepicker", function (e) {
                $('#eventoDataFim').datetimepicker('minDate', e.date);
                $('#eventoDataFim').datetimepicker('date', e.date);
            });
            $('#eventoHoraInicio, #eventoHoraFim').datetimepicker({
                format: 'HH:mm'
            });

        });

        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendario');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'pt-br',
                height: 'parent',
                plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                navLinks: true, // can click day/week names to navigate views
                businessHours: true, // display business hours
                events: '{{route('eventos')}}',
                dateClick: function (info) {
                    console.log(info.dateStr);
                    $('#eventoDataInicio').val(info.dateStr);
                    $('#eventoDataFim').val(info.dateStr);
                    $('#eventoModal').modal('show');
                },
                eventClick: function (info) {
                    alert('Event: ' + info.event.id);
                }
            });

            calendar.render();
        });
    </script>
    @parent
@endsection