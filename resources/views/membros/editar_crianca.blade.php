@extends('layout.sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Membros - Editar {{ $membro->genero }}</h4>
        </div>
        <hr>
        <form action="{{ route('membros.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="membro_id" value="{{ $membro->id }}">
            <input type="hidden" name="audio_base64" id="audio_base64">
            @if($membro->foto)
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <img src="/public/img/membros/{{ $membro->foto }}" class="img-fluid" style='border-radius: 20px; max-height: 100px' alt="">
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="text" id="nome" name="nome" value="{{ $membro->nome }}"/>
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
                        <input class="form-control" type="date" id="dt_nascimento" name="dt_nascimento" value="{{ $membro->dt_nascimento }}"/>
                        <label for="dt_nascimento">Nascimento:</label>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <select class="form-select" id="genero" name='genero' aria-label="Default select example">
                            <option @if($membro->genero == 'Homem') selected @endif value="Homem">Homem</option>
                            <option @if($membro->genero == 'Mulher') selected @endif value="Mulher">Mulher</option>
                            <option @if($membro->genero == 'Jovem') selected @endif value="Jovem">Jovem</option>
                            <option @if($membro->genero == 'Adolescente') selected @endif value="Adolescente">Adolescente</option>
                            <option @if($membro->genero == 'Pré-adolescente') selected @endif value="Pré-adolescente">Pré-adolescente</option>
                            <option @if($membro->genero == 'Criança') selected @endif value="Criança">Criança</option>
                            <option @if($membro->genero == 'Infantil A') selected @endif value="Infantil A">Infantil A</option>
                            <option @if($membro->genero == 'Infantil B') selected @endif value="Infantil B">Infantil B</option>
                            <option @if($membro->genero == 'Berçário') selected @endif value="Berçário">Berçário</option>
                        </select>
                        <label for="genero">Gênero:</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input class="form-control" type="text" id="fone" name="fone" maxlength="15" onkeypress="mascara( this, mtel )" value="{{ $membro->fone }}"/>
                        <label for="fone_pai">Fone:</label>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <select class="form-select" id="pai" name='pai_id' aria-label="Default select example">
                            <option value=""></option>
                            @foreach($pais as $pai)
                                <option @if($pai->id == $membro->pai_id) selected @endif value="{{ $pai->id }}">{{ $pai->nome }}</option>
                            @endforeach
                        </select>
                        <label for="pai">Pai:</label>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <select class="form-select" id="mae" name='mae_id' aria-label="Default select example">
                            <option value=""></option>
                            @foreach($maes as $mae)
                                <option @if($mae->id == $membro->mae_id) selected @endif value="{{ $mae->id }}">{{ $mae->nome }}</option>
                            @endforeach
                        </select>
                        <label for="mae">Mãe:</label>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input class="form-control" type="text" id="alergico" name="alergico" value="{{ $membro->alergico }}"/>
                        <label for="alergico">Alérgico:</label>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input class="form-control" type="text" id="recebeu_lembranca" name="recebeu_lembranca" value="{{ $membro->recebeu_lembranca }}"/>
                        <label for="recebeu_lembranca">Recebeu Lembrança?</label>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input class="form-control" type="text" id="postar_redes" name="postar_redes" value="{{ $membro->postar_redes }}"/>
                        <label for="postar_redes">Postar nas Redes?</label>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input class="form-control" type="text" id="cpf" name="cpf" value="{{ $membro->cpf }}"/>
                        <label for="cpf">CPF:</label>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input class="form-control" type="text" id="rg" name="rg" value="{{ $membro->rg }}"/>
                        <label for="rg">RG:</label>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input class="form-control" type="text" id="endereco" name="endereco" value="{{ $membro->endereco }}"/>
                        <label for="endereco">Endereço:</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="form-floating form-floating-outline">
                        <textarea class="form-control h-px-100" id="obs" name="obs" placeholder="Observação do membro">{{ $membro->obs }}</textarea>
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
                            <input class="form-check-input" type="checkbox" name="ministerios[]" value="{{ $ministerio->id }}" id="ministerio_{{ $ministerio->id }}" {{ $membro->verifica_ministerio($ministerio->id) ? 'checked' : '' }}>
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
                <audio id='audio_source' style="margin-left: 15px" controls="controls" src='{{ $membro->audio_base64 }}'>
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
