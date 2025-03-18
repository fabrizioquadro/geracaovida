@extends('layout.sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">{{ $ministerio->nm_ministerio }} - Atividades - Adicionar</h4>
        </div>
        <hr>
        <form id='formulario' action="{{ route('reunioes.insert') }}" method="post">
            @csrf
            <input type="hidden" name="ministerio_id" value="{{ $ministerio->id }}">
            <input type="hidden" name="audio_base64" id="audio_base64">
            <div class="row">
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="date" id="dt_culto" name="dt_culto"/>
                        <label for="dt_culto">Data:</label>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="time" id="hr_culto" name="hr_culto"/>
                        <label for="hr_culto">Hora:</label>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="text" id="nm_culto" name="nm_culto"/>
                        <label for="nm_culto">Atividade:</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="form-floating form-floating-outline">
                        <textarea class="form-control h-px-100" id="ds_culto" name="ds_culto"></textarea>
                        <label for="ds_culto">Descrição da Atividade:</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="form-floating form-floating-outline">
                        <textarea class="form-control h-px-100" id="ds_parecer" name="ds_parecer"></textarea>
                        <label for="ds_parecer">Resumo da Atividade:</label>
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
