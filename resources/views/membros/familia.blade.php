@extends('layout.sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Membro {{ $membro->nome }} - Família</h4>
        </div>
        <hr>
        @if($membro->foto)
            <div class="row">
                <div class="col-md-3 mb-3">
                    <img src="/public/img/membros/{{ $membro->foto }}" class="img-fluid" style='border-radius: 20px; max-height: 100px' alt="">
                </div>
            </div>
        @endif
        @if($membro->conjugue())
            <div class="row">
                <div class="col-md-12 form-group mb-3">
                    <label for="">Conjugue:</label><br>
                    <b>{{ $membro->conjugue()->nome }}</b>
                </div>
            </div>
        @endif
        <div class="row">
            @if($membro->pai())
                <div class="col-md-6 form-group mb-3">
                    <label for="">Pai:</label><br>
                    <b>{{ $membro->pai()->nome }}</b>
                </div>
            @endif
            @if($membro->mae())
                <div class="col-md-6 form-group mb-3">
                    <label for="">Mãe:</label><br>
                    <b>{{ $membro->mae()->nome }}</b>
                </div>
            @endif
        </div>
        @if($membro->filhos()->count() > 0)
            <hr>
            <h5 class="card-title mt-1">Filhos</h5>
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($membro->filhos() as $filho)
                        <tr>
                            <td>{{ $filho->nome }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
