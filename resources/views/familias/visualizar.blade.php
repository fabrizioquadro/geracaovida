@extends('layout.sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Família - Visualizar</h4>
        </div>
        <hr>
        <div class="card card-border-shadow-primary mb-4">
            <div class="card-body">
                <h6 class="card-title">Familia</h6>
                <div class="row">
                    <div class="col-md-6 mt-3 form-group">
                        <label for="pai_id">Pai:</label><br>
                        <b>{{ $familia->pai()->nome }}</b>
                    </div>
                    <div class="col-md-6 mt-3 form-group">
                        <label for="mae_id">Mãe:</label><br>
                        <b>{{ $familia->mae()->nome }}</b>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-border-shadow-primary mb-4">
            <div class="card-body" id='div_filhos'>
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Filhos</h4>
                </div>
                <div class="table-responsive mt-3">
                    <table class="datatables-products table" id="table-index">
                        <thead class="table-light">
                            <tr>
                                <th>Foto</th>
                                <th>Nome</th>
                            </tr>
                        </thead>
                        <tbody id="tabela_filhos">
                            @foreach($familia->filhos() as $filho)
                                @php
                                $filho = $filho->filho();

                                if($filho->foto){
                                    $avatar = "/public/img/membros/$filho->foto";
                                }
                                elseif($filho->genero == "Masculino"){
                                    $avatar = '/public/template/img/avatars/1.png';
                                }
                                else{
                                    $avatar = '/public/template/img/avatars/2.png';
                                }
                                @endphp
                                <tr id="tr_{{ $filho->id }}">
                                    <td><img src="{{ $avatar }}" style='height:40px; border-radius: 20px' alt=""></td>
                                    <td>{{ $filho->nome }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function excluir_filho(filho_id){
    if(confirm('Tem certeza que deseja excluir o filho selecionado? Esta ação não poderá ser revertida.')){
        $.getJSON(
            '{{ route("familias.excluir_filho") }}',
            {
                filho_id : filho_id,
                familia_id : {{ $familia->id }}
            },
            function(json){
                if(json.controle == "true"){
                    document.getElementById('tr_' + json.filho_id).remove();
                }
            }
        );
    }
}

document.getElementById('btn_adicionar_filho').addEventListener('click', ()=>{

    filho = document.getElementById('filho_id');
    option = filho.children[filho.selectedIndex];
    texto = option.textContent;

    contador = parseInt(document.getElementById('contador_filhos').value);
    contador++;
    document.getElementById('contador_filhos').value = contador

    //vamos criar o input
    input = document.createElement('input');
    input.setAttribute('type', 'hidden');
    input.setAttribute('name', 'filho_' + contador);
    input.setAttribute('value', filho_id.value);

    document.getElementById('formulario').appendChild(input);
    //vamos colocar o nome do filho na tabela
    tr = document.createElement('tr');
    td = document.createElement('td');
    td.setAttribute('colspan', '3');
    td.innerHTML = texto;
    tr.appendChild(td);
    document.getElementById('tabela_filhos').appendChild(tr);
})
</script>
@endsection
