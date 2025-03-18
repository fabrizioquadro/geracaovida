@extends('layout.sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Visitas - Agendamento</h4>
        </div>
        <hr>
        <form action="{{ route('visitas.agendamento_set') }}" method="post">
            @csrf
            <input type="hidden" name="visita_id" value="{{ $visita->id }}">
            <div class="row">
                <div class="col-md-6 mt-3">
                    <div class="form-floating form-floating-outline">
                        <select required class="form-select" id="user_id" name='user_id' aria-label="Default select example">
                            <option value=""></option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->nm_usuario }}</option>
                            @endforeach
                        </select>
                        <label for="user_id">Usuário:</label>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="date" id="data" name="data" />
                        <label for="data">Data:</label>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="time" id="hora" name="hora" />
                        <label for="hora">Hora:</label>
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
