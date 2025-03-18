@extends('layout.sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Visitas - Acessar</h4>
        </div>
        <hr>
        <div class="card mb-4">
            <div class="card-body">
                <h6 class="card-title">Geral</h6>
                <div class="row">
                    <div class="col-md-6 form-group mt-3">
                        <label for="membro_id">Membro:</label><br>
                        <b>{{ $visita->membro->nome }}</b>
                    </div>
                    <div class="col-md-6 form-group mt-3">
                        <label for="st_visita">Situação:</label><br>
                        <b>{{ $visita->st_visita }}</b>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group mt-3">
                        <label for="ds_visita">Descrição</label><br>
                        <b>{{ $visita->ds_visita }}</b>
                    </div>
                </div>
                <div class="card mb-4 mt-5">
                    <div class="card-body">
                        <h6 class="card-title">Endereço</h6>
                        <div class="row">
                            <div class="col-md-3 mt-3 form-group">
                                <label for="cep">CEP:</label><br>
                                <b>{{ $visita->nr_cep }}</b>
                            </div>
                            <div class="col-md-6 mt-3 form-group">
                                <label for="endereco">Endereço:</label><br>
                                <b>{{ $visita->ds_endereco }}</b>
                            </div>
                            <div class="col-md-3 mt-3 form-group">
                                <label for="numero">Número:</label><br>
                                <b>{{ $visita->nr_endereco }}</b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mt-3 form-group">
                                <label for="complemento">Complemento:</label><br>
                                <b>{{ $visita->ds_complemento }}</b>
                            </div>
                            <div class="col-md-3 mt-3 form-group">
                                <label for="bairro">Bairro:</label><br>
                                <b>{{ $visita->ds_bairro }}</b>
                            </div>
                            <div class="col-md-3 mt-3 form-group">
                                <label for="cidade">Cidade:</label><br>
                                <b>{{ $visita->nm_cidade }}</b>
                            </div>
                            <div class="col-md-3 mt-3 form-group">
                                <label for="uf">UF:</label><br>
                                <b>{{ $visita->ds_uf }}</b>
                            </div>
                        </div>
                    </div>
                </div>
                @if($visita->st_visita != "Finalizada")
                    @php
                    if($visita->dt_hr_visita){
                        $var = explode(' ', $visita->dt_hr_visita);
                        $data = $var[0];
                        $hora = $var[1];
                    }
                    else{
                        $data = null;
                        $hora = null;
                    }
                    @endphp
                    <div class="card mb-4 mt-3">
                        <div class="card-body">
                            <h6 class="card-title">Agendar/Remarcar</h6>
                            <form action="{{ route('visitas.agendamento_set') }}" method="post">
                                @csrf
                                <input type="hidden" name="visita_id" value="{{ $visita->id }}">
                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                        <div class="form-floating form-floating-outline">
                                            <select required class="form-select" id="user_id" name='user_id' aria-label="Default select example">
                                                <option value=""></option>
                                                @foreach($users as $user)
                                                    <option @if($visita->user_id == $user->id) selected @endif value="{{ $user->id }}">{{ $user->nm_usuario }}</option>
                                                @endforeach
                                            </select>
                                            <label for="user_id">Usuário:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <div class="form-floating form-floating-outline">
                                            <input required class="form-control" type="date" id="data" name="data" value="{{ $data }}" />
                                            <label for="data">Data:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <div class="form-floating form-floating-outline">
                                            <input required class="form-control" type="time" id="hora" name="hora" value="{{ $hora }}"/>
                                            <label for="hora">Hora:</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary me-2">Salvar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
                @if($visita->st_visita == "Agendada")
                    <div class="card mb-4 mt-3">
                        <div class="card-body">
                            <h6 class="card-title">Resumo/Feedback do Atendimento</h6>
                            <form action="{{ route('visitas.feedback_set') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="visita_id" value="{{ $visita->id }}">
                                <input type="hidden" name="audio_base64" id="audio_base64">
                                <div class="row">
                                    <div class="col-md-12 mt-3">
                                        <div class="form-floating form-floating-outline">
                                            <textarea class="form-control h-px-100" id="ds_resumo" name="ds_resumo"></textarea>
                                            <label for="ds_resumo">Resumo/Feedback</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" type="file" id="audio_whats" name="audio_whats"/>
                                            <label for="audio_whats">Anexar Arquivo de Áudio</label>
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
                            </form>
                        </div>
                    </div>
                @endif
                @if($visita->st_visita == "Finalizada")
                    <div class="card mb-4 mt-3">
                        <div class="card-body">
                            <h6 class="card-title">Resumo/Feedback do Atendimento</h6>
                            @if($visita->ds_resumo)
                                <div class="row">
                                    <div class="col-md-12 mt-3 form-group">
                                        <label for="ds_resumo">Resumo/Feedback</label><br>
                                        <b>{{ $visita->ds_resumo }}</b>
                                    </div>
                                </div>
                            @endif
                            @if($visita->audio_whats)
                                <div class="row">
                                    <div class="col-md-12 mb-2 mt-3">
                                        <label for="">Audio Anexo de Whatsapp:</label><br>
                                        <audio controls="controls" src='/public/audio/visitas/{{ $visita->audio_whats }}'>
                                        </audio>
                                    </div>
                                </div>
                            @endif
                            @if($visita->audio_base64)
                                <audio id='audio_source' style="margin-top: 25px" controls="controls" src='{{ $visita->audio_base64 }}'>
                                </audio>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
        @if($visita->audio_base64 && $visita->st_visita != 'Finalizada')
            <audio id='audio_source' style="margin-top: 25px" controls="controls" src='{{ $visita->audio_base64 }}'>
            </audio>
        @endif
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
