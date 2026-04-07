@extends('layout.sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Secretaria Atividades - Editar</h4>
        </div>
        <hr>
        <form id='formulario' action="{{ route('secretaria.atividades.update') }}" method="post">
            @csrf
            <input type="hidden" name="culto_id" value="{{ $culto->id }}">
            <div class="row">
                <div class="col-md-2 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="date" id="dt_culto" name="dt_culto" value="{{ $data }}"/>
                        <label for="dt_culto">Data:</label>
                    </div>
                </div>
                <div class="col-md-2 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="time" id="hr_culto" name="hr_culto" value="{{ $hora }}"/>
                        <label for="hr_culto">Hora:</label>
                    </div>
                </div>
                <div class="col-md-2 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="number" id="nr_vagas" name="nr_vagas" value="{{ $culto->nr_vagas }}"/>
                        <label for="nr_vagas">Vagas:</label>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="text" id="nm_culto" name="nm_culto" value="{{ $culto->nm_culto }}"/>
                        <label for="nm_culto">Atividade:</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-3">
                    <div class="form-floating form-floating-outline">
                        <select required multiple class="form-select h-px-100" id="ministerio_id" name='ministerio_id[]' aria-label="Default select example">
                            @foreach($ministerios as $ministerio)
                                <option @if($culto->ministerios()->where('ministerio_id', $ministerio->id)->count() > 0) selected @endif value="{{ $ministerio->id }}">{{ $ministerio->nm_ministerio }}</option>
                            @endforeach
                        </select>
                        <label for="ministerio_id">Ministerio:</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="form-floating form-floating-outline">
                        <textarea class="form-control h-px-100" id="ds_culto" name="ds_culto">{{ $culto->ds_culto }}</textarea>
                        <label for="ds_culto">Descrição da Atividade:</label>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary me-2">Salvar</button>
            </div>
        </form>
    </div>
</div>
@endsection
