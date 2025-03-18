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
            <input type="hidden" name="audio_base64_pai" id="audio_base64_pai">
            <input type="hidden" name="audio_base64_mae" id="audio_base64_mae">
            <div class="card card-border-shadow-primary mb-4">
                <div class="card-body">
                    <h6 class="card-title">Homem</h6>
                    <div class="row">
                        <div class="col-md-8 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input required class="form-control" type="text" id="nome_pai" name="nome_pai"/>
                                <label for="nome_pai">Nome:</label>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="file" id="foto_pai" name="foto_pai"/>
                                <label for="foto_pai">Foto:</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="text" id="fone_pai" name="fone_pai" maxlength="15" onkeypress="mascara( this, mtel )"/>
                                <label for="fone_pai">Fone:</label>
                            </div>
                        </div>
                        <div class="col-md-3 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="email" id="email_pai" name="email_pai"/>
                                <label for="email_pai">Email:</label>
                            </div>
                        </div>
                        <div class="col-md-3 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="date" id="dt_nascimento_pai" name="dt_nascimento_pai"/>
                                <label for="dt_nascimento_pai">Nascimento:</label>
                            </div>
                        </div>
                        @if($situacao == "Membro")
                            <div class="col-md-3 mt-3">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control" type="date" id="data_batismo_pai" name="data_batismo_pai"/>
                                    <label for="data_batismo_pai">Data Batismo:</label>
                                </div>
                            </div>
                        @else
                            <div class="col-md-3 mt-3">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control" type="text" id="como_veio_pai" name="como_veio_pai"/>
                                    <label for="como_veio_pai">Como Veio?</label>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-3 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="text" id="postar_redes_pai" name="postar_redes_pai"/>
                                <label for="postar_redes_pai">Autoriza Postagem?</label>
                            </div>
                        </div>
                        @if($situacao == "Membro")
                            <div class="col-md-3 mt-3">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control" type="text" id="cooperador_pai" name="cooperador_pai"/>
                                    <label for="cooperador_pai">Cooperador:</label>
                                </div>
                            </div>
                            <div class="col-md-3 mt-3">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control" type="text" id="funcao_pai" name="funcao_pai"/>
                                    <label for="funcao_pai">Função:</label>
                                </div>
                            </div>
                        @else
                            <div class="col-md-3 mt-3">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control" type="text" id="aceita_msg_pai" name="aceita_msg_pai"/>
                                    <label for="aceita_msg_pai">Aceita Mensagem?</label>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-3 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="text" id="igreja_anterior_pai" name="igreja_anterior_pai"/>
                                <label for="igreja_anterior_pai">Igreja Anterior:</label>
                            </div>
                        </div>
                        <div class="col-md-3 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="text" id="recebeu_lembranca_pai" name="recebeu_lembranca_pai"/>
                                <label for="recebeu_lembranca_pai">Recebeu Lembrança?</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <div class="form-floating form-floating-outline">
                                <textarea class="form-control h-px-100" id="obs_pai" name="obs_pai" placeholder="Observação do membro"></textarea>
                                <label for="obs_pai">Observação</label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h6 class="card-title">Ministerios</h6>
                    <div class="row">
                        @foreach($ministerios as $ministerio)
                            <div class="col-md-3 mt-3">
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" name="ministerios_pai[]" value="{{ $ministerio->id }}" id="ministerio_pai_{{ $ministerio->id }}">
                                    <label class="form-check-label" for="ministerio_pai_{{ $ministerio->id }}"> {{ $ministerio->nm_ministerio }} </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-start mt-3">
                        <button id='botao_gravar_start_pai' type="button" class="btn rounded-pill btn-icon btn-outline-secondary waves-effect mt-2">
                            <span class="tf-icons mdi mdi-microphone-outline"></span>
                        </button>
                        <button style="display: none !important" id='botao_gravar_stop_pai' type="button" class="btn rounded-pill btn-icon btn-label-danger waves-effect mt-2">
                            <span class="tf-icons mdi mdi-microphone"></span>
                        </button>
                        <audio id='audio_source_pai' style="margin-left: 15px" controls="controls">
                        </audio>
                    </div>
                </div>
            </div>
            <div class="card card-border-shadow-primary mb-4">
                <div class="card-body">
                    <h6 class="card-title">Mulher</h6>
                    <div class="row">
                        <div class="col-md-8 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input required class="form-control" type="text" id="nome_mae" name="nome_mae"/>
                                <label for="nome_mae">Nome:</label>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="file" id="foto_mae" name="foto_mae"/>
                                <label for="foto_mae">Foto:</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="text" id="fone_mae" name="fone_mae" maxlength="15" onkeypress="mascara( this, mtel )"/>
                                <label for="fone_mae">Fone:</label>
                            </div>
                        </div>
                        <div class="col-md-3 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="email" id="email_mae" name="email_mae"/>
                                <label for="email_mae">Email:</label>
                            </div>
                        </div>
                        <div class="col-md-3 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="date" id="dt_nascimento_mae" name="dt_nascimento_mae"/>
                                <label for="dt_nascimento_mae">Nascimento:</label>
                            </div>
                        </div>
                        @if($situacao == "Membro")
                            <div class="col-md-3 mt-3">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control" type="date" id="data_batismo_mae" name="data_batismo_mae"/>
                                    <label for="data_batismo_mae">Data Batismo:</label>
                                </div>
                            </div>
                        @else
                            <div class="col-md-3 mt-3">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control" type="text" id="como_veio_mae" name="como_veio_mae"/>
                                    <label for="como_veio_mae">Como Veio?</label>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-3 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="text" id="postar_redes_mae" name="postar_redes_mae"/>
                                <label for="postar_redes_mae">Autoriza Postagem?</label>
                            </div>
                        </div>
                        @if($situacao == "Membro")
                            <div class="col-md-3 mt-3">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control" type="text" id="cooperador_mae" name="cooperador_mae"/>
                                    <label for="cooperador_mae">Cooperador:</label>
                                </div>
                            </div>
                            <div class="col-md-3 mt-3">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control" type="text" id="funcao_mae" name="funcao_mae"/>
                                    <label for="funcao_mae">Função:</label>
                                </div>
                            </div>
                        @else
                            <div class="col-md-3 mt-3">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control" type="text" id="aceita_msg_mae" name="aceita_msg_mae"/>
                                    <label for="aceita_msg_mae">Aceita Mensagem?</label>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-3 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="text" id="igreja_anterior_mae" name="igreja_anterior_mae"/>
                                <label for="igreja_anterior_mae">Igreja Anterior:</label>
                            </div>
                        </div>
                        <div class="col-md-3 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="text" id="recebeu_lembranca_mae" name="recebeu_lembranca_mae"/>
                                <label for="recebeu_lembranca_mae">Recebeu Lembrança?</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <div class="form-floating form-floating-outline">
                                <textarea class="form-control h-px-100" id="obs_mae" name="obs_mae" placeholder="Observação do membro"></textarea>
                                <label for="obs_mae">Observação</label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h6 class="card-title">Ministerios</h6>
                    <div class="row">
                        @foreach($ministerios as $ministerio)
                            <div class="col-md-3 mt-3">
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" name="ministerios_mae[]" value="{{ $ministerio->id }}" id="ministerio_mae_{{ $ministerio->id }}">
                                    <label class="form-check-label" for="ministerio_mae_{{ $ministerio->id }}"> {{ $ministerio->nm_ministerio }} </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-start mt-3">
                        <button id='botao_gravar_start_mae' type="button" class="btn rounded-pill btn-icon btn-outline-secondary waves-effect mt-2">
                            <span class="tf-icons mdi mdi-microphone-outline"></span>
                        </button>
                        <button style="display: none !important" id='botao_gravar_stop_mae' type="button" class="btn rounded-pill btn-icon btn-label-danger waves-effect mt-2">
                            <span class="tf-icons mdi mdi-microphone"></span>
                        </button>
                        <audio id='audio_source_mae' style="margin-left: 15px" controls="controls">
                        </audio>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary me-2">Salvar</button>
            </div>
        </form>
    </div>
</div>
<script>
const start_pai = document.getElementById('botao_gravar_start_pai');
const stop_pai = document.getElementById('botao_gravar_stop_pai');
const start_mae = document.getElementById('botao_gravar_start_mae');
const stop_mae = document.getElementById('botao_gravar_stop_mae');

window.addEventListener('load',()=>{
    let mediaRecorder_pai;
    let mediaRecorder_mae;
    navigator.mediaDevices.getUserMedia({ audio: true }).then(
        (stream_pai) => {
            mediaRecorder_pai = new MediaRecorder(stream_pai);
            mediaRecorder_mae = new MediaRecorder(stream_pai);
            let chunks_pai = [];
            let chunks_mae = [];

            mediaRecorder_pai.ondataavailable = data_pai => {
                chunks_pai.push(data_pai.data);
            }
            mediaRecorder_pai.onstop = () => {
                const blob = new Blob(chunks_pai, { type: 'audio/ogg; code=opus' });
                const reader = new window.FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = () => {
                    document.getElementById('audio_source_pai').src = reader.result
                    document.getElementById('audio_base64_pai').value = reader.result
                }
            }
            start_pai.addEventListener('click', ()=>{
                chunks_pai = [];
                start_pai.setAttribute('style', 'display: none !important');
                stop_pai.setAttribute('style', 'display: block !important');
                mediaRecorder_pai.start();
            });

            stop_pai.addEventListener('click', ()=>{
                start_pai.setAttribute('style', 'display: block !important');
                stop_pai.setAttribute('style', 'display: none !important');
                mediaRecorder_pai.stop();
            });


            mediaRecorder_mae.ondataavailable = data_mae => {
                chunks_mae.push(data_mae.data);
            }
            mediaRecorder_mae.onstop = () => {
                const blob = new Blob(chunks_mae, { type: 'audio/ogg; code=opus' });
                const reader = new window.FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = () => {
                    document.getElementById('audio_source_mae').src = reader.result
                    document.getElementById('audio_base64_mae').value = reader.result
                }
            }
            start_mae.addEventListener('click', ()=>{
                chunks_pai = [];
                start_mae.setAttribute('style', 'display: none !important');
                stop_mae.setAttribute('style', 'display: block !important');
                mediaRecorder_mae.start();
            });

            stop_mae.addEventListener('click', ()=>{
                start_mae.setAttribute('style', 'display: block !important');
                stop_mae.setAttribute('style', 'display: none !important');
                mediaRecorder_mae.stop();
            });
        },
        (err) => {
            alert('Você deve permitir o áudio');
        }
    )
})

</script>
@endsection
