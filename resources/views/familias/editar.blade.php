@extends('layout.sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Família - Editar</h4>
        </div>
        <hr>
        <form id='formulario' action="{{ route('familias.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="familia_id" value="{{ $familia->id }}">
            <input type="hidden" name="contador_filhos" id="contador_filhos" value="0">
            <div class="card card-border-shadow-primary mb-4">
                <div class="card-body">
                    <h6 class="card-title">Familia</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <select class="form-select" id="pai_id" name='pai_id' aria-label="Default select example">
                                    <option value=""></option>
                                    @foreach($pais as $pai)
                                        @if(!$pai->familia() || $pai->id == $familia->pai_id)
                                            <option @if($familia->pai_id == $pai->id) selected @endif value="{{ $pai->id }}">{{ $pai->nome }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <label for="pai_id">Pai:</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <select class="form-select" id="mae_id" name='mae_id' aria-label="Default select example">
                                    <option value=""></option>
                                    @foreach($maes as $mae)
                                        @if(!$mae->familia() || $mae->id == $familia->mae_id)
                                            <option @if($familia->mae_id == $mae->id) selected @endif value="{{ $mae->id }}">{{ $mae->nome }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <label for="mae_id">Mãe:</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-border-shadow-primary mb-4">
                <div class="card-body" id='div_filhos'>
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Filhos</h4>
                    </div>
                    <div class="row align-items-end">
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <select class="form-select" id="filho_id" aria-label="Default select example">
                                    <option value=""></option>
                                    @foreach($criancas as $crianca)
                                        @if(!$crianca->familia_crianca())
                                            <option value="{{ $crianca->id }}">{{ $crianca->nome }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <label for="filho_id">Filho:</label>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <button type="button" id="btn_adicionar_filho" class="btn btn-primary">Adicionar</button>
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="datatables-products table" id="table-index">
                            <thead class="table-light">
                                <tr>
                                    <th>Foto</th>
                                    <th>Nome</th>
                                    <td></td>
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
                                        <td> <button type="button" name="button" onclick="excluir_filho({{ $filho->id }})" class="btn btn-danger btn-sm">Excluir</button> </td>
                                    </tr>
                                @endforeach
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
