@extends('layout.sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">{{ $nm_pagina." - ".$culto->nm_culto }} - Acessar</h4>
        </div>
        <hr>
        <form id='formulario' action="{{ route('reunioes.acessar_set') }}" method="post">
            @csrf
            <input type="hidden" name="culto_id" value="{{ $culto->id }}">
            {{--<input type="hidden" name="ministerio_id" value="{{ $ministerio->id }}"> --}}
            <input type="hidden" name="audio_base64" id="audio_base64">
            <div class="row">
                <div class="col-md-2 mt-3 form-group">
                    <label for="dt_culto">Data:</label><br>
                    <b>{{ dataDbForm($dt_culto) }}</b>
                </div>
                <div class="col-md-2 form-group mt-3">
                    <label for="hr_culto">Hora:</label><br>
                    <b>{{ $hr_culto }}</b>
                </div>
                <div class="col-md-2 form-group mt-3">
                    <label for="nm_culto">Situação:</label><br>
                    <b>{{ $culto->st_culto }}</b>
                </div>
                <div class="col-md-4 form-group mt-3">
                    <label for="nm_culto">Atividade:</label><br>
                    <b>{{ $culto->nm_culto }}</b>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12 form-group mt-3">
                    <label for="ds_culto">Descrição da Atividade:</label><br>
                    <b>{{ $culto->ds_culto }}</b>
                </div>
            </div>
            @if($culto->st_culto == 'Aberto')
            <div class="card card-border-shadow-primary mt-4 mb-4">
                <div class="card-body">
                    <h6 class="card-title">Resumo da Atividade</h6>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-floating form-floating-outline">
                                <textarea class="form-control h-px-100" id="ds_parecer" name="ds_parecer"></textarea>
                            </div>
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
                </div>
            </div>
            @else
                <hr>
                @if($culto->ds_parecer)
                    <div class="row">
                        <div class="col-md-12 form-group mt-3">
                            <label for="ds_culto">Resumo da Atividade:</label><br>
                            <b>{{ $culto->ds_parecer }}</b>
                        </div>
                    </div>
                @endif
                @if($culto->audio_base64)
                    <audio style="margin-top: 20px" controls="controls" src="{{ $culto->audio_base64 }}">
                    </audio>
                @endif
                <hr>
                <h4 class="card-title">Membros - Presenças</h4>
                <table class="table mt-5">
                    <tbody>
                        @foreach($culto->reservas() as $reserva)
                            <tr>
                                <th>{{ $reserva->membro->nome }}</th>
                                <td>{{ $reserva->membro->confere_presenca($culto->id) == 'checked' ? 'Participou' : 'Não Participou' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <h4 class="card-title mt-5">Convites </h4>
                <table class="table mt-5">
                    <tbody>
                        @foreach($culto->convites() as $reserva)
                            <tr>
                                <th>{{ $reserva->nm_convite }}</th>
                                <td>{{ $reserva->presenca_convite == 'Sim' ? 'Participou' : 'Não Participou' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
