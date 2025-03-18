@extends('layout/sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Dashboard</h4>
        </div>
        @if($mensagem = Session::get('mensagem'))
            <div class="alert alert-success alert-dismissible mt-3" role="alert">
                {{ $mensagem }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <hr>
        <div class="card card-border-shadow-primary mb-4">
            <div class="card-body">
                <h6 class="card-title mb-4">Agenda</h6>
                <div id='calendar'></div>
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
        events: '{{ route("agendas.listar_eventos_user") }}/{{ auth()->user()->id }}',
	    extraParams: function() {
			return {
				cachebuster: new Date().valueOf()
			};
		},
		eventClick: function(info) {
		    info.jsEvent.preventDefault(); // don't let the browser navigate
            dados = info.event.id.split(',');

            if(dados[0] == "Livre"){
                window.location.href = "{{ route('agendas.adicionar_reuniao') }}/" + dados[1] + '/' + dados[2] + '/' + dados[3] + '/dashboard' ;
            }
            else if(dados[0] == "Reuniao"){
                window.location.href = "{{ route('agendas.acessar_reuniao') }}/" + dados[1];
            }

        }
    });

    calendar.render();
});
</script>
@endsection
