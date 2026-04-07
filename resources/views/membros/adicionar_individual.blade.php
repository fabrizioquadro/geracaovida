@extends('layout.sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Membros - Adicionar {{ $genero }}</h4>
        </div>
        <hr>
        <form action="{{ route('membros.insert') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="situacao" value="{{ $situacao }}">
            <input type="hidden" name="genero" value="{{ $genero }}">
            <input type="hidden" name="audio_base64" id="audio_base64">
            <div class="row">
                <div class="col-md-6 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="text" id="nome" name="nome"/>
                        <label for="nome">Nome:</label>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input class="form-control" type="file" id="foto" name="foto"/>
                        <label for="foto">Foto:</label>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <select class="form-select" id="conjugue" name='conjugue' aria-label="Default select example">
                            <option value=""></option>
                            @foreach($membros as $membro)
                                @if(!$membro->conjugue())
                                    <option value="{{ $membro->id }}">{{ $membro->nome }}</option>
                                @endif
                            @endforeach
                        </select>
                        <label for="conjugue">Conjugue:</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input class="form-control" type="text" id="fone" name="fone" maxlength="15" onkeypress="mascara( this, mtel )"/>
                        <label for="fone">Fone:</label>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input class="form-control" type="email" id="email" name="email"/>
                        <label for="email">Email:</label>
                    </div>
                </div>
                @if($situacao == "Membro")
                    <div class="col-md-2 mt-3">
                        <div class="form-floating form-floating-outline">
                            <input class="form-control" type="date" id="dt_nascimento" name="dt_nascimento"/>
                            <label for="dt_nascimento">Nascimento:</label>
                        </div>
                    </div>
                    <div class="col-md-2 mt-3">
                        <div class="form-floating form-floating-outline">
                            <input class="form-control" type="text" id="st_batismo" name="st_batismo"/>
                            <label for="st_batismo">Tipo Batismo</label>
                        </div>
                    </div>
                    <div class="col-md-2 mt-3">
                        <div class="form-floating form-floating-outline">
                            <input class="form-control" type="date" id="data_batismo" name="data_batismo"/>
                            <label for="data_batismo">Data Batismo:</label>
                        </div>
                    </div>
                @else
                    <div class="col-md-3 mt-3">
                        <div class="form-floating form-floating-outline">
                            <input class="form-control" type="date" id="dt_nascimento" name="dt_nascimento"/>
                            <label for="dt_nascimento">Nascimento:</label>
                        </div>
                    </div>
                    <div class="col-md-3 mt-3">
                        <div class="form-floating form-floating-outline">
                            <input class="form-control" type="text" id="como_veio" name="como_veio"/>
                            <label for="como_veio">Como Veio?</label>
                        </div>
                    </div>
                @endif
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input class="form-control" type="text" id="cpf" name="cpf"/>
                        <label for="cpf">CPF:</label>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input class="form-control" type="text" id="rg" name="rg"/>
                        <label for="rg">RG:</label>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input class="form-control" type="text" id="endereco" name="endereco"/>
                        <label for="endereco">Endereço:</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input class="form-control" type="text" id="postar_redes" name="postar_redes"/>
                        <label for="postar_redes">Autoriza Postagem?</label>
                    </div>
                </div>
                @if($situacao == "Membro")
                    <div class="col-md-3 mt-3">
                        <div class="form-floating form-floating-outline">
                            <input class="form-control" type="text" id="cooperador" name="cooperador"/>
                            <label for="cooperador">Cooperador:</label>
                        </div>
                    </div>
                    <div class="col-md-3 mt-3">
                        <div class="form-floating form-floating-outline">
                            <input class="form-control" type="text" id="funcao" name="funcao"/>
                            <label for="funcao">Função:</label>
                        </div>
                    </div>
                @else
                    <div class="col-md-3 mt-3">
                        <div class="form-floating form-floating-outline">
                            <input class="form-control" type="text" id="aceita_msg" name="aceita_msg"/>
                            <label for="aceita_msg">Aceita Mensagem?</label>
                        </div>
                    </div>
                @endif
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input class="form-control" type="text" id="igreja_anterior" name="igreja_anterior"/>
                        <label for="igreja_anterior">Igreja Anterior:</label>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input class="form-control" type="text" id="recebeu_lembranca" name="recebeu_lembranca"/>
                        <label for="recebeu_lembranca">Recebeu Lembrança?</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="form-floating form-floating-outline">
                        <textarea class="form-control h-px-100" id="obs" name="obs" placeholder="Observação do membro"></textarea>
                        <label for="obs">Observação</label>
                    </div>
                </div>
            </div>
            <hr>
            <h6 class="card-title">Ministerios</h6>
            <div class="row">
                @foreach($ministerios as $ministerio)
                    <div class="col-md-3 mt-3">
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" name="ministerios[]" value="{{ $ministerio->id }}" id="ministerio_{{ $ministerio->id }}">
                            <label class="form-check-label" for="ministerio_{{ $ministerio->id }}"> {{ $ministerio->nm_ministerio }} </label>
                        </div>
                    </div>
                @endforeach
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
