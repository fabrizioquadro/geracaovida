@extends('layout/sistema')

@section('conteudo')
<div class="card card-border-shadow-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Editar Atendimento - {{ $user->nm_usuario }}</h4>
        </div>
        @if($mensagem = Session::get('mensagem'))
            <div class="alert alert-success alert-dismissible mt-3" role="alert">
                {{ $mensagem }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <hr>
        <form action="{{ route('secretaria.atendimentos.update') }}" method="post">
            @csrf
            <input type="hidden" name="reuniao_id" value="{{ $reuniao->id }}">
            <div class="row">
                <div class="col-md-2 form-group">
                    <label for="">Tipo de Atendimento:</label>
                    <select required name="tp_reuniao" id='tp_reuniao' class="form-control">
                        <option value=""></option>
                        <option @if($reuniao->tp_reuniao == "Individual") selected @endif value="Individual">Individual</option>
                        <option @if($reuniao->tp_reuniao == "Casal") selected @endif value="Casal">Casal</option>
                    </select>
                </div>
                <div class="col-md-2 form-group">
                    <label for="">Data:</label>
                    <input required type="date" class="form-control" name="data" value="{{ $data }}">
                </div>
                <div class="col-md-2 form-group">
                    <label for="">Hora:</label>
                    <input required type="time" class="form-control" name="hr_inc" value="{{ $hora }}">
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Tempo de Atendimento(Minutos):</label>
                    <input required type="number" class="form-control" name="tempo_reuniao" value="{{ $reuniao->tempo_reuniao }}">
                </div>
                <div class="col-md-3 form-group" id='div_casal' style='display:{{ $reuniao->tp_reuniao == "Casal" ? "block" : "none" }}'>
                    <label for="">Casal:</label>
                    <select name="familia_id" id="familia_id" class="form-control">
                        <option value=""></option>
                        @foreach($familias as $familia)
                            <option @if($reuniao->familia_id == $familia->id) selected @endif value="{{ $familia->id }}">{{ $familia->pai() ? $familia->pai()->nome.' & ' : ''}}{{ $familia->mae() ? $familia->mae()->nome : ''}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 form-group" id="div_individual" style='display:{{ $reuniao->tp_reuniao == "Individual" ? "block" : "none" }}'>
                    <label for="">Membro:</label>
                    <select name="membro_id" id="membro_id" class="form-control">
                        <option value=""></option>
                        @foreach($membros as $membro)
                            <option @if($membro->id == $reuniao->membro_id) selected @endif value="{{ $membro->id }}">{{ $membro->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="">Descrição do Atendimento:</label>
                    <textarea name="ds_reuniao" class="form-control" required>{{ $reuniao->ds_reuniao }}</textarea>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary me-2">Salvar</button>
                <button id='btn_excluir_reuniao' type="button" class="btn btn-danger me-2">Excluir</button>
            </div>
        </form>
    </div>
</div>
<script>
document.getElementById('btn_excluir_reuniao').addEventListener('click', ()=>{
    if(confirm('Tem certeza que deseja excluir este atendimento?')){
        window.location.href = "{{ route('secretaria.atendimentos.delete', $reuniao->id) }}";
    }
});

document.getElementById('tp_reuniao').addEventListener('change', (e)=>{
    if(e.target.value == 'Casal'){
        document.getElementById('div_casal').style.display = 'block';
        document.getElementById('div_individual').style.display = 'none';
        document.getElementById('familia_id').setAttribute('required','required');
        document.getElementById('membro_id').removeAttribute('required');
        document.getElementById('membro_id').value = "";
    }
    else if(e.target.value == 'Individual'){
        document.getElementById('div_casal').style.display = 'none';
        document.getElementById('div_individual').style.display = 'block';
        document.getElementById('membro_id').setAttribute('required','required');
        document.getElementById('familia_id').removeAttribute('required');
        document.getElementById('familia_id').value = "";
    }
    else{
        document.getElementById('div_casal').style.display = 'none';
        document.getElementById('div_individual').style.display = 'none';
        document.getElementById('membro_id').value = "";
        document.getElementById('familia_id').value = "";
    }
});
</script>
@endsection
