@extends('layout/sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h5 class="card-title">Contatos {{ $membro->nome }}</h5>
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
                <h6 class="card-title">Adicionar Contato</h6>
                <form action="{{ route('contatos.insert') }}" method="post">
                    <input type="hidden" name="membro_id" value="{{ $membro->id }}">
                    <input type="hidden" name="audio_base64" id="audio_base64">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input required class="form-control" type="date" id="data" name="data"/>
                                <label for="data">Data:</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input required class="form-control" type="time" id="hora" name="hora"/>
                                <label for="hora">Hora:</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <div class="form-floating form-floating-outline">
                                <textarea class="form-control h-px-100" id="ds_contato" name="ds_contato"></textarea>
                                <label for="ds_contato">Descrição do Contato:</label>
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
        <div class="card card-border-shadow-primary mb-4">
            <div class="card-body">
                <h6 class="card-title">Histórico</h6>
                <ul class="timeline pb-0 mb-0">
                    @foreach($contatos as $contato)
                        @php
                        $var = explode(' ', $contato->dt_hr_contato);
                        $dt_hr_contato = dataDbForm($var[0])." ".$var[1];
                        @endphp
                        <li class="timeline-item timeline-item-transparent border-primary">
                            <span class="timeline-point timeline-point-primary"></span>
                            <div class="timeline-event">
                                <div class="timeline-header">
                                    <div>
                                        <h6 class="mb-0">{{ $contato->ds_contato }}</h6>
                                        @if($contato->audio_base64)
                                            <audio controls="controls" class="mt-3" src='{{ $contato->audio_base64 }}'>
                                            </audio>
                                        @endif
                                    </div>
                                    <span class="text-muted">
                                        {{ $dt_hr_contato }}<br>
                                        {{ $contato->user->nm_usuario }}
                                    </span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
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
