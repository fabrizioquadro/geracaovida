@extends('layout/sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Atendimentos</h4>
        </div>
        @if($mensagem = Session::get('mensagem'))
            <div class="alert alert-success alert-dismissible mt-3" role="alert">
                {{ $mensagem }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <hr>
        <div class="row">
            <div class="col-md-4" style="border-right: 1px solid #cdcdcd">
                <div class="list-group">
                    <a href="javascript:void(0);" class="list-group-item list-group-item-action active waves-effect disabled">Apresentação</a>
                    <a href="{{ route('agendas') }}" class="list-group-item list-group-item-action waves-effect">Agenda</a>
                    <a href="{{ route('agendas.lista_atendimentos') }}" class="list-group-item list-group-item-action waves-effect">Todos os Atendimentos</a>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-border-shadow-primary mb-4">
                    <div class="card-body">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
	    locale: 'pt-br',
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        defaultDate: "<?php echo date('Y-m-d');?>",
        navLinks: true, // can click day/week names to navigate views
        businessHours: true, // display business hours
        editable: true,
	    eventLimit: true,
	    displayEventEnd: true,
        events: '{{ route("agendas.listar_eventos_user") }}/{{ $user->id }}',
	    extraParams: function() {
			return {
				cachebuster: new Date().valueOf()
			};
		},
		eventClick: function(info) {
		    info.jsEvent.preventDefault(); // don't let the browser navigate
            dados = info.event.id.split(',');

            if(dados[0] == "Reuniao"){
                window.location.href = "{{ route('agendas.acessar_reuniao') }}/" + dados[1];
            }

        }
    });

    calendar.render();
});
</script>

@endsection
