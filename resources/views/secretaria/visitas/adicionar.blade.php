@extends('layout.sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Secretaria - Visitas - Adicionar</h4>
        </div>
        <hr>
        <form action="{{ route('secretaria.visitas.insert') }}" method="post">
            @csrf
            <input type="hidden" name="audio_base64" id="audio_base64">
            <div class="row">
                <div class="col-md-6 mt-3">
                    <div class="form-floating form-floating-outline">
                        <select required class="form-select" id="membro_id" name='membro_id' aria-label="Default select example">
                            <option value=""></option>
                            @foreach($membros as $membro)
                                <option value="{{ $membro->id }}">{{ $membro->nome }}</option>
                            @endforeach
                        </select>
                        <label for="membro_id">Membro:</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="form-floating form-floating-outline">
                        <textarea class="form-control h-px-100" id="ds_visita" name="ds_visita"></textarea>
                        <label for="ds_visita">Descrição</label>
                    </div>
                </div>
            </div>
            <h6 class="card-title mt-5">Endereço</h6>
            <div class="row">
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="text" id="cep" name="nr_cep" placeholder="CEP:"  maxlength="9" onkeypress="formatar('#####-###', this)" />
                        <label for="cep">CEP:</label>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="text" id="endereco" name="ds_endereco" placeholder="Endereço:"/>
                        <label for="endereco">Endereço:</label>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="text" id="numero" name="nr_endereco" placeholder="Número:" />
                        <label for="numero">Número:</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input class="form-control" type="text" id="complemento" name="ds_complemento" placeholder="Complemento:" />
                        <label for="complemento">Complemento:</label>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input class="form-control" type="text" id="bairro" name="ds_bairro" placeholder="Bairro:"/>
                        <label for="bairro">Bairro:</label>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="text" id="cidade" name="nm_cidade" placeholder="Cidade:" />
                        <label for="cidade">Cidade:</label>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="text" id="uf" name="ds_uf" placeholder="UF:" />
                        <label for="uf">UF:</label>
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

document.getElementById('cep').addEventListener('blur', (e)=>{
    var valor = e.target.value;
    var cep = valor.replace(/\D/g, '');
    if (cep != ""){
        var validacep = /^[0-9]{8}$/;
        if(validacep.test(cep)){
            var url = `https://viacep.com.br/ws/${cep}/json/`;
            fetch(url).then(response => response.json()).then(json => {
                if( json.logradouro ){
                    document.getElementById('endereco').value = json.logradouro;
                    document.getElementById('bairro').value = json.bairro;
                    document.getElementById('cidade').value = json.localidade;
                    document.getElementById('uf').value = json.uf;
                }
            });
        }
    }
});

</script>
@endsection
