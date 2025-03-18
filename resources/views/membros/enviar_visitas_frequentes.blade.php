@extends('layout.sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Membros - Enviar para Visitantes Frequentes</h4>
        </div>
        <hr>
        <form action="{{ route('membros.enviar_visitas_frequentes_set') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="membro_id" value="{{ $membro->id }}">
            @if($membro->foto)
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <img src="/public/img/membros/{{ $membro->foto }}" class="img-fluid" style='border-radius: 20px; max-height: 100px' alt="">
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12 form-group mt-3">
                    <p>Tem certeza que deseja enviar o membro {{ $membro->nome }} para Visitantes Frequentes?</p>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary me-2">Enviar</button>
            </div>
        </form>
    </div>
</div>
@endsection
