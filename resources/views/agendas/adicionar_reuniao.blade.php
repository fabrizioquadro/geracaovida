@extends('layout/sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Agendar Atendimento - {{ $user->nm_usuario }}</h4>
        </div>
        @if($mensagem = Session::get('mensagem'))
            <div class="alert alert-success alert-dismissible mt-3" role="alert">
                {{ $mensagem }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <hr>
        <form action="{{ route('agendas.insert_reuniao') }}" method="post">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <input type="hidden" name="data" value="{{ $data }}">
            <input type="hidden" name="redirect" value="{{ $redirect }}">
            <div class="row">
                <div class="col-md-3 form-group">
                    <label for="">Tipo de Reunião:</label>
                    <select required name="tp_reuniao" id='tp_reuniao' class="form-control">
                        <option value=""></option>
                        <option value="Individual">Individual</option>
                        <option value="Casal">Casal</option>
                    </select>
                </div>
                <div class="col-md-2 form-group">
                    <label for="">Hora:</label>
                    <input required type="time" class="form-control" name="hr_inc" min="{{ $inc }}" max="{{ $fn }}">
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Tempo de Reunião(Minutos):</label>
                    <input required type="number" class="form-control" name="tempo_reuniao">
                </div>
                <div class="col-md-4 form-group" id='div_casal' style='display:none'>
                    <label for="">Casal:</label>
                    <select name="familia_id" id="familia_id" class="form-control">
                        <option value=""></option>
                        @foreach($familias as $familia)
                            <option value="{{ $familia->id }}">{{ $familia->pai() ? $familia->pai()->nome.' & ' : ''}}{{ $familia->mae() ? $familia->mae()->nome : ''}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 form-group" id="div_individual" style='display:none'>
                    <label for="">Membro:</label>
                    <select name="membro_id" id="membro_id" class="form-control">
                        <option value=""></option>
                        @foreach($membros as $membro)
                            <option value="{{ $membro->id }}">{{ $membro->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="">Descrição da Reunião:</label>
                    <textarea name="ds_reuniao" class="form-control" required></textarea>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary me-2">Salvar</button>
            </div>
        </form>
    </div>
</div>
<script>
document.getElementById('tp_reuniao').addEventListener('change', (e)=>{
    if(e.target.value == 'Casal'){
        document.getElementById('div_casal').style.display = 'block';
        document.getElementById('div_individual').style.display = 'none';
        document.getElementById('familia_id').setAttribute('required','required');
        document.getElementById('membro_id').removeAttribute('required');
    }
    else if(e.target.value == 'Individual'){
        document.getElementById('div_casal').style.display = 'none';
        document.getElementById('div_individual').style.display = 'block';
        document.getElementById('membro_id').setAttribute('required','required');
        document.getElementById('familia_id').removeAttribute('required');
    }
    else{
        document.getElementById('div_casal').style.display = 'none';
        document.getElementById('div_individual').style.display = 'none';
    }
});
</script>
@endsection
