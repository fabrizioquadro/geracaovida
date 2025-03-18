@extends('layout/sistema')

@section('conteudo')
@php
$horario = explode(' ',$reuniao->dt_hr_reuniao);
@endphp
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Reunião</h4>
        </div>
        @if($mensagem = Session::get('mensagem'))
            <div class="alert alert-success alert-dismissible mt-3" role="alert">
                {{ $mensagem }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <hr>
        <form action="{{ route('agendas.acessar_reuniao_set') }}" method="post">
            @csrf
            <input type="hidden" name="reuniao_id" value="{{ $reuniao->id }}">
            <input type="hidden" name="audio_base64" id="audio_base64">
            <div class="row">
                <div class="col-md-4 mt-3 form-group">
                    <label for="">Horário Reunião:</label><br>
                    <b>{{ dataDbForm($horario[0])." ".$horario[1] }}</b>
                </div>
                <div class="col-md-4 mt-3 form-group">
                    <label for="">Situação:</label><br>
                    <b>{{ $reuniao->st_reuniao }}</b>
                </div>
                <div class="col-md-4 mt-3 form-group">
                    <label for="">Tipo de Reunião:</label><br>
                    <b>{{ $reuniao->tp_reuniao }}</b>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3 form-group">
                    <label for="">Descrição de Reunião:</label><br>
                    <b>{{ $reuniao->ds_reuniao }}</b>
                </div>
            </div>
            <h6 class="card-title mt-5">Participantes</h6>
            <hr>
            <ul class="list-group">
                @foreach($membros as $membro)
                <li class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <div class="form-check form-check-primary mt-3">
                              <label class="form-check-label" for="presenca_nome_{{ $membro->id }}">{{ $membro->nome }}</label>
                        </div>
                        @if($reuniao->st_reuniao == 'Finalizada')
                            <div class="form-check form-check-primary mt-3">
                                  <label class="form-check-label">
                                      <span>{{ App\Models\ReuniaoPresenca::verifica_presenca($reuniao->id, $membro->id) ? 'Participou' : 'Não Participou' }}</span>
                                  </label>
                            </div>
                        @else
                            <div class="form-check form-check-primary mt-3">
                                  <input class="form-check-input" type="checkbox" value="{{ $membro->id }}" id="presenca_{{ $membro->id }}" name="presenca[]">
                                  <label class="form-check-label" for="presenca_{{ $membro->id }}">Presente</label>
                            </div>
                        @endif
                    </div>
                </li>
                @endforeach
            </ul>
            @if($reuniao->st_reuniao == "Aberta")
                <div class="row">
                    <div class="col-md-12 mt-3 form-group">
                        <label for="">Parecer Reunião:</label>
                        <textarea style="min-height: 200px !important" name="ds_parecer" class="form-control"></textarea>
                    </div>
                </div>
                <div class="d-flex justify-content-start mt-3">
                    <button id='botao_gravar_start' type="button" class="btn rounded-pill btn-icon btn-outline-secondary waves-effect mt-2">
                        <span class="tf-icons mdi mdi-microphone-outline"></span>
                    </button>
                    <button style="display: none !important" id='botao_gravar_stop' type="button" class="btn rounded-pill btn-icon btn-label-danger waves-effect mt-2">
                        <span class="tf-icons mdi mdi-microphone"></span>
                    </button>
                    <audio id='audio_source' style="margin-left: 15px" controls="controls">
                    </audio>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary me-2">Salvar</button>
                </div>
            @endif
            @if($reuniao->st_reuniao == "Finalizada")
                <hr>
                <h6 class="card-title">Parecer Atendimento</h6>
                @if($reuniao->ds_parecer)
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <p>{{ $reuniao->ds_parecer }}</p>
                        </div>
                    </div>
                @endif
                @if($reuniao->audio_base64)
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <audio controls="controls" src="{{ $reuniao->audio_base64 }}">
                            </audio>
                        </div>
                    </div>
                @endif
            @endif
        </form>
    </div>
</div>
<script>
const start = document.getElementById('botao_gravar_start');
const stop = document.getElementById('botao_gravar_stop');

window.addEventListener('load',()=>{
    let mediaRecorder;
    navigator.mediaDevices.getUserMedia({ audio: true }).then(
        (stream) => {
            mediaRecorder = new MediaRecorder(stream);
            let chunks = [];
            mediaRecorder.ondataavailable = data => {
                chunks.push(data.data);
            }
            mediaRecorder.onstop = () => {
                const blob = new Blob(chunks, { type: 'audio/ogg; code=opus' });
                const reader = new window.FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = () => {
                    document.getElementById('audio_source').src = reader.result
                    document.getElementById('audio_base64').value = reader.result
                }
            }
            start.addEventListener('click', ()=>{
                chunks = [];
                start.setAttribute('style', 'display: none !important');
                stop.setAttribute('style', 'display: block !important');
                mediaRecorder.start();
            });

            stop.addEventListener('click', ()=>{
                start.setAttribute('style', 'display: block !important');
                stop.setAttribute('style', 'display: none !important');
                mediaRecorder.stop();
            });
        },
        (err) => {
            alert('Você deve permitir o áudio');
        }
    )
})

</script>
@endsection
