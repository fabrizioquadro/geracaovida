@extends('layout.sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Família - Adionar</h4>
        </div>
        <hr>
        <form id='formulario' action="{{ route('familias.insert') }}" method="post" enctype="multipart/form-data">
            @csrf
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
                                        @if(!$pai->familia())
                                            <option value="{{ $pai->id }}">{{ $pai->nome }}</option>
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
                                        @if(!$mae->familia())
                                            <option value="{{ $mae->id }}">{{ $mae->nome }}</option>
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
                                    <th>Nome</th>
                                </tr>
                            </thead>
                            <tbody id="tabela_filhos">

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
