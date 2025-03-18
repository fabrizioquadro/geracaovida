@extends('layout/sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Secretaria - Atendimentos</h4>
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
                <div class="row">
                    @foreach($users as $user)
                        @php
                        if($user->imagem){
                            $avatar = "/public/img/users/$user->imagem";
                        }
                        elseif($user->ds_genero == "Masculino"){
                            $avatar = '/public/template/img/avatars/1.png';
                        }
                        else{
                            $avatar = '/public/template/img/avatars/2.png';
                        }
                        @endphp
                        <div class="col-md-12 mt-3">
                            <a href="{{ route('secretaria.atendimentos', $user->id) }}" style="text-decoration: none; color: #636578">
                                <img src="{{ $avatar }}" style='height:40px; border-radius: 20px' alt="">
                                {{ $user->nm_usuario }}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            @if($user_agenda)
                <div class="col-md-8">
                    <div class="card card-border-shadow-primary mb-4">
                        <div class="card-body">
                            <h6 class="card-title mb-4">Agenda {{ $user_agenda->nm_usuario }}</h6>
                            <div id='calendar'></div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<script>
@if($user_agenda)
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
            events: '{{ route("secretaria.atendimentos.listar_eventos_user") }}/{{ $user_agenda->id }}',
    	    extraParams: function() {
    			return {
    				cachebuster: new Date().valueOf()
    			};
    		},
    		eventClick: function(info) {
    		    info.jsEvent.preventDefault(); // don't let the browser navigate
                dados = info.event.id.split(',');

                if(dados[0] == "Livre"){
                    window.location.href = "{{ route('secretaria.atendimentos.adicionar_atendimento') }}/" + dados[1] + '/' + dados[2] + '/' + dados[3];
                }
                else if(dados[0] == "Reuniao"){
                    window.location.href = "{{ route('secretaria.atendimentos.editar_atendimento') }}/" + dados[1];
                }

            }
        });

        calendar.render();
    });
    </script>
@endif
@endsection
