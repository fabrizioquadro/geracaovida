@extends('layout.sistema')

@section('conteudo')
<div class="card card-border-shadow-danger mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">{{ $culto->tp_culto }} - Excluir</h4>
        </div>
        <hr>
        <form id='formulario' action="{{ route('cultos.delete') }}" method="post">
            @csrf
            <input type="hidden" name="culto_id" value="{{ $culto->id }}">
            <div class="row">
                <div class="col-md-12 mt-3">
                    <p>Tem certeza que deseja excluir o culto/reunião {{ $culto->nm_culto }}?</p>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-danger me-2">Excluir</button>
            </div>
        </form>
    </div>
</div>
@endsection
