@extends('layout.sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Visitante - Adicionar</h4>
        </div>
        <hr>
        <form action="{{ route('visitantes.insert') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="tipo" value="{{ $tipo }}">
            <input type="hidden" name="contador_filhos" id="contador_filhos" value="1">
            <div class="card card-border-shadow-primary mb-4">
                <div class="card-body">
                    <h6 class="card-title">Pai</h6>
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
                                <input class="form-control" type="text" id="fone_pai" name="fone_pai" onkeypress="mascara( this, mtel )"/>
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
                        <div class="col-md-3 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="text" id="igreja_anterior_pai" name="igreja_anterior_pai"/>
                                <label for="igreja_anterior_pai">Igreja Anterior:</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="text" id="como_veio_pai" name="como_veio_pai"/>
                                <label for="como_veio_pai">Como Veio:</label>
                            </div>
                        </div>
                        <div class="col-md-3 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="text" id="postar_redes_pai" name="postar_redes_pai"/>
                                <label for="postar_redes_pai">Postar nas Redes:</label>
                            </div>
                        </div>
                        <div class="col-md-3 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="text" id="aceita_msg_pai" name="aceita_msg_pai"/>
                                <label for="aceita_msg_pai">Aceita Mensagem?</label>
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
                </div>
            </div>
            <div class="card card-border-shadow-primary mb-4">
                <div class="card-body">
                    <h6 class="card-title">Mãe</h6>
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
                                <input class="form-control" type="text" id="fone_mae" name="fone_mae" onkeypress="mascara( this, mtel )"/>
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
                        <div class="col-md-3 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="text" id="igreja_anterior_mae" name="igreja_anterior_mae"/>
                                <label for="igreja_anterior_mae">Igreja Anterior:</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="text" id="como_veio_mae" name="como_veio_mae"/>
                                <label for="como_veio_mae">Como Veio:</label>
                            </div>
                        </div>
                        <div class="col-md-3 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="text" id="postar_redes_mae" name="postar_redes_mae"/>
                                <label for="postar_redes_mae">Postar nas Redes:</label>
                            </div>
                        </div>
                        <div class="col-md-3 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="text" id="aceita_msg_mae" name="aceita_msg_mae"/>
                                <label for="aceita_msg_mae">Aceita Mensagem?</label>
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
                </div>
            </div>
            <div class="card card-border-shadow-primary mb-4">
                <div class="card-body" id='div_filhos'>
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Filhos</h4>
                        <button type='button' id='adicionar_filhos' class="btn btn-primary">Adicionar</button>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="datatables-products table" id="table-index">
                            <thead class="table-light">
                                <tr>
                                    <th>Nome</th>
                                    <th>Foto</th>
                                    <th>Nascimento</th>
                                    <th>Alérgico</th>
                                    <th>Recebeu Lembrança</th>
                                    <th>Obs</th>
                                </tr>
                            </thead>
                            <tbody id="tabela_filhos">
                                <tr>
                                    <td>
                                        <div class="form-floating form-floating-outline">
                                            <input required class="form-control" type="text" id="nome_filho1" name="nome_filho1"/>
                                            <label for="nome_filho1">Nome:</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" type="file" id="foto_filho1" name="foto_filho1"/>
                                            <label for="foto_filho1">Foto:</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" type="date" id="dt_nascimento_filho1" name="dt_nascimento_filho1"/>
                                            <label for="dt_nascimento_filho1">Nascimento:</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" type="text" id="alergico_filho1" name="alergico_filho1"/>
                                            <label for="alergico_filho1">Alérgico:</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" type="text" id="recebeu_lembranca_filho1" name="recebeu_lembranca_filho1"/>
                                            <label for="recebeu_lembranca_filho1">Recebeu Lembrança?</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" type="text" id="obs_filho1" name="obs_filho1"/>
                                            <label for="obs_filho1">Observação:</label>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
document.getElementById('adicionar_filhos').addEventListener('click', ()=>{

    contador = parseInt(document.getElementById('contador_filhos').value);
    contador++;
    document.getElementById('contador_filhos').value = contador

    tr = document.createElement('tr');

    td1 = document.createElement('td');

    div_form1 = document.createElement('div');
    div_form1.setAttribute('class', 'form-floating form-floating-outline');

    input1 = document.createElement('input');
    input1.setAttribute('class','form-control');
    input1.setAttribute('type','text');
    input1.setAttribute('id','nome_filho' + contador);
    input1.setAttribute('name','nome_filho' + contador);

    label1 = document.createElement('label');
    label1.setAttribute('for','nome_filho' + contador);
    label1.innerHTML = "Nome:";

    div_form1.appendChild(input1);
    div_form1.appendChild(label1);
    td1.appendChild(div_form1);
    tr.appendChild(td1);

    td2 = document.createElement('td');

    div_form2 = document.createElement('div');
    div_form2.setAttribute('class', 'form-floating form-floating-outline');

    input2 = document.createElement('input');
    input2.setAttribute('class','form-control');
    input2.setAttribute('type','file');
    input2.setAttribute('id','foto_filho' + contador);
    input2.setAttribute('name','foto_filho' + contador);

    label2 = document.createElement('label');
    label2.setAttribute('for','foto_filho' + contador);
    label2.innerHTML = "Foto:";

    div_form2.appendChild(input2);
    div_form2.appendChild(label2);
    td2.appendChild(div_form2);
    tr.appendChild(td2);

    td3 = document.createElement('td');

    div_form3 = document.createElement('div');
    div_form3.setAttribute('class', 'form-floating form-floating-outline');

    input3 = document.createElement('input');
    input3.setAttribute('class','form-control');
    input3.setAttribute('type','date');
    input3.setAttribute('id','dt_nascimento_filho' + contador);
    input3.setAttribute('name','dt_nascimento_filho' + contador);

    label3 = document.createElement('label');
    label3.setAttribute('for','dt_nascimento_filho' + contador);
    label3.innerHTML = "Nascimento:";

    div_form3.appendChild(input3);
    div_form3.appendChild(label3);
    td3.appendChild(div_form3);
    tr.appendChild(td3);

    td4 = document.createElement('td');

    div_form4 = document.createElement('div');
    div_form4.setAttribute('class', 'form-floating form-floating-outline');

    input4 = document.createElement('input');
    input4.setAttribute('class','form-control');
    input4.setAttribute('type','text');
    input4.setAttribute('id','alergico_filho' + contador);
    input4.setAttribute('name','alergico_filho' + contador);

    label4 = document.createElement('label');
    label4.setAttribute('for','alergico_filho' + contador);
    label4.innerHTML = "Alérgico:";

    div_form4.appendChild(input4);
    div_form4.appendChild(label4);
    td4.appendChild(div_form4);
    tr.appendChild(td4);

    td5 = document.createElement('td');

    div_form5 = document.createElement('div');
    div_form5.setAttribute('class', 'form-floating form-floating-outline');

    input5 = document.createElement('input');
    input5.setAttribute('class','form-control');
    input5.setAttribute('type','text');
    input5.setAttribute('id','recebeu_lembranca_filho' + contador);
    input5.setAttribute('name','recebeu_lembranca_filho' + contador);

    label5 = document.createElement('label');
    label5.setAttribute('for','recebeu_lembranca_filho' + contador);
    label5.innerHTML = "Recebeu Lembrança?";

    div_form5.appendChild(input5);
    div_form5.appendChild(label5);
    td5.appendChild(div_form5);
    tr.appendChild(td5);

    td6 = document.createElement('td');

    div_form6 = document.createElement('div');
    div_form6.setAttribute('class', 'form-floating form-floating-outline');

    input6 = document.createElement('input');
    input6.setAttribute('class','form-control');
    input6.setAttribute('type','text');
    input6.setAttribute('id','obs_filho' + contador);
    input6.setAttribute('name','obs_filho' + contador);

    label6 = document.createElement('label');
    label6.setAttribute('for','obs_filho' + contador);
    label6.innerHTML = "Observação:";

    div_form6.appendChild(input6);
    div_form6.appendChild(label6);
    td6.appendChild(div_form6);
    tr.appendChild(td6);

    document.getElementById('tabela_filhos').appendChild(tr);
})
</script>
@endsection
