@extends('layout.sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Ministérios - Editar</h4>
        </div>
        <hr>
        <form action="{{ route('ministerios.update') }}" method="post">
            @csrf
            <input type="hidden" name="ministerio_id" value="{{ $ministerio->id }}">
            <div class="row">
                <div class="col-md-6 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="text" id="nome" name="nm_ministerio" value="{{ $ministerio->nm_ministerio }}"/>
                        <label for="nome">Nome:</label>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <select required class="form-select" id="st_reuniao" name='st_reuniao' aria-label="Default select example">
                            <option value=""></option>
                            <option @if($ministerio->st_reuniao == "Sim") selected @endif  value="Sim">Sim</option>
                            <option @if($ministerio->st_reuniao == "Não") selected @endif  value="Não">Não</option>
                        </select>
                        <label for="st_reuniao">Liberar Reunião:</label>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <select required class="form-select" id="st_geral" name='st_geral' aria-label="Default select example">
                            <option value=""></option>
                            <option @if($ministerio->st_geral == "Sim") selected @endif  value="Sim">Sim</option>
                            <option @if($ministerio->st_geral == "Não") selected @endif  value="Não">Não</option>
                        </select>
                        <label for="st_geral">Geral:</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="form-floating form-floating-outline">
                        <textarea class="form-control h-px-100" id="exampleFormControlTextarea1" name="ds_ministerio" placeholder="Descrição do ministério">{{ $ministerio->ds_ministerio }}</textarea>
                        <label for="exampleFormControlTextarea1">Descrição</label>
                    </div>
                </div>
            </div>
            {{--
            <div class="card card-border-shadow-primary mb-4 mt-3">
                <div class="card-body">
                    <h6 class="card-title">Gêneros</h6>
                    <div class="row">
                        @foreach($generos as $genero)
                            <div class="col-md-3 mt-3">
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" name="generos[]" value="{{ $genero }}" id="genero_{{ $genero }}" {{ $ministerio->verifica_genero($genero) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="genero_{{ $genero }}"> {{ $genero }} </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            --}}
            <div class="mt-4">
                <button type="submit" class="btn btn-primary me-2">Salvar</button>
            </div>
        </form>
    </div>
</div>
@endsection
