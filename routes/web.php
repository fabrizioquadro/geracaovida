<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MinisterioController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\MembroController;
use App\Http\Controllers\FamiliaController;
use App\Http\Controllers\VisitanteController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\CultoController;
use App\Http\Controllers\SecretariaController;
use App\Http\Controllers\VisitaController;
use App\Http\Controllers\ReuniaoController;
use App\Http\Controllers\ImprimirController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LoginController::class, 'index'])->name('index');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/esqueceu_senha', [LoginController::class, 'esqueceu_senha'])->name('esqueceu_senha');
Route::post('/recuperar_senha', [LoginController::class, 'recuperar_senha'])->name('recuperar_senha');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/perfil', [DashboardController::class, 'perfil'])->name('perfil');
    Route::post('/perfil/update', [DashboardController::class, 'perfil_update'])->name('perfil.update');
    Route::get('/alterar_senha', [DashboardController::class, 'alterar_senha'])->name('alterar_senha');
    Route::post('/alterar_senha/update', [DashboardController::class, 'alterar_senha_update'])->name('alterar_senha.update');

    Route::get('/ministerios', [MinisterioController::class, 'index'])->name('ministerios');
    Route::get('/ministerios/adicionar', [MinisterioController::class, 'adicionar'])->name('ministerios.adicionar');
    Route::post('/ministerios/insert', [MinisterioController::class, 'insert'])->name('ministerios.insert');
    Route::get('/ministerios/editar/{id}', [MinisterioController::class, 'editar'])->name('ministerios.editar');
    Route::get('/ministerios/excluir/{id}', [MinisterioController::class, 'excluir'])->name('ministerios.excluir');
    Route::post('/ministerios/update', [MinisterioController::class, 'update'])->name('ministerios.update');
    Route::post('/ministerios/delete', [MinisterioController::class, 'delete'])->name('ministerios.delete');

    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios');
    Route::get('/usuarios/adicionar', [UsuarioController::class, 'adicionar'])->name('usuarios.adicionar');
    Route::get('/usuarios/editar/{id}', [UsuarioController::class, 'editar'])->name('usuarios.editar');
    Route::get('/usuarios/excluir/{id}', [UsuarioController::class, 'excluir'])->name('usuarios.excluir');
    Route::get('/usuarios/alterar_senha/{id}', [UsuarioController::class, 'alterar_senha'])->name('usuarios.alterar_senha');
    Route::post('/usuarios/insert', [UsuarioController::class, 'insert'])->name('usuarios.insert');
    Route::post('/usuarios/update', [UsuarioController::class, 'update'])->name('usuarios.update');
    Route::post('/usuarios/delete', [UsuarioController::class, 'delete'])->name('usuarios.delete');
    Route::post('/usuarios/alterar_senha/update', [UsuarioController::class, 'alterar_senha_update'])->name('usuarios.alterar_senha.update');

    Route::get('/membros', [MembroController::class, 'membros'])->name('membros');
    Route::get('/visitas_frequentes', [MembroController::class, 'visitas_frequentes'])->name('visitas_frequentes');
    Route::get('/primeiras_visitas', [MembroController::class, 'primeiras_visitas'])->name('primeiras_visitas');
    Route::get('/membros/adicionar/{situacao}/{genero}', [MembroController::class, 'adicionar'])->name('membros.adicionar');
    Route::get('/membros/editar/{id}', [MembroController::class, 'editar'])->name('membros.editar');
    Route::get('/membros/excluir/{id}', [MembroController::class, 'excluir'])->name('membros.excluir');
    Route::get('/membros/visualizar/{id}', [MembroController::class, 'visualizar'])->name('membros.visualizar');
    Route::get('/membros/enviar_visitas_frequentes/{id}', [MembroController::class, 'enviar_visitas_frequentes'])->name('membros.enviar_visitas_frequentes');
    Route::get('/membros/batizar/{id}', [MembroController::class, 'batizar'])->name('membros.batizar');
    Route::post('/membros/enviar_visitas_frequentes_set', [MembroController::class, 'enviar_visitas_frequentes_set'])->name('membros.enviar_visitas_frequentes_set');
    Route::post('/membros/batizar_set', [MembroController::class, 'batizar_set'])->name('membros.batizar_set');
    Route::post('/membros/insert', [MembroController::class, 'insert'])->name('membros.insert');
    Route::post('/membros/update', [MembroController::class, 'update'])->name('membros.update');
    Route::post('/membros/delete', [MembroController::class, 'delete'])->name('membros.delete');

    Route::get('/cultos_reunioes', [CultoController::class, 'index'])->name('cultos_reunioes');
    Route::get('/cultos_reunioes/adicionar', [CultoController::class, 'adicionar'])->name('cultos_reunioes.adicionar');
    Route::get('/cultos_reunioes/editar/{id}', [CultoController::class, 'editar'])->name('cultos_reunioes.editar');
    Route::get('/cultos_reunioes/excluir/{id}', [CultoController::class, 'excluir'])->name('cultos_reunioes.excluir');
    Route::get('/cultos_reunioes/acessar/{id}', [CultoController::class, 'acessar'])->name('cultos_reunioes.acessar');
    Route::post('/cultos_reunioes/insert', [CultoController::class, 'insert'])->name('cultos_reunioes.insert');
    Route::post('/cultos_reunioes/update', [CultoController::class, 'update'])->name('cultos_reunioes.update');
    Route::post('/cultos_reunioes/delete', [CultoController::class, 'delete'])->name('cultos_reunioes.delete');
    Route::post('/cultos_reunioes/acessar_set', [CultoController::class, 'acessar_set'])->name('cultos_reunioes.acessar_set');
    Route::get('/cultos_reunioes/presencas/{id}', [CultoController::class, 'precencas'])->name('cultos_reunioes.presencas');
    Route::get('/cultos_reunioes/set_presencas', [CultoController::class, 'set_presencas'])->name('cultos_reunioes.set_presencas');

    Route::get('/cultos/{tp_culto}', [CultoController::class, 'index'])->name('cultos');
    Route::get('/cultos_adicionar/{tp_culto}', [CultoController::class, 'adicionar'])->name('cultos.adicionar');
    Route::get('/cultos_editar/{id}', [CultoController::class, 'editar'])->name('cultos.editar');
    Route::get('/cultos_excluir/{id}', [CultoController::class, 'excluir'])->name('cultos.excluir');
    Route::get('/cultos_acessar/{id}', [CultoController::class, 'acessar'])->name('cultos.acessar');
    Route::get('/cultos_presencas/{id}', [CultoController::class, 'presencas'])->name('cultos.presencas');
    Route::get('/cultos_set_presencas', [CultoController::class, 'set_presencas'])->name('cultos.set_presencas');
    Route::get('/cultos_set_presencas_oracao', [CultoController::class, 'set_presencas_oracao'])->name('cultos.set_presencas_oracao');
    Route::post('/cultos_insert', [CultoController::class, 'insert'])->name('cultos.insert');
    Route::post('/cultos_update', [CultoController::class, 'update'])->name('cultos.update');
    Route::post('/cultos_delete', [CultoController::class, 'delete'])->name('cultos.delete');
    Route::post('/cultos_acessar_set', [CultoController::class, 'acessar_set'])->name('cultos.acessar_set');


    Route::get('/secretaria/visitas', [SecretariaController::class, 'visitas'])->name('secretaria.visitas');
    Route::get('/secretaria/visitas/adicionar', [SecretariaController::class, 'adicionar'])->name('secretaria.visitas.adicionar');
    Route::get('/secretaria/visitas/editar/{id}', [SecretariaController::class, 'editar'])->name('secretaria.visitas.editar');
    Route::get('/secretaria/visitas/excluir/{id}', [SecretariaController::class, 'excluir'])->name('secretaria.visitas.excluir');
    Route::get('/secretaria/visitas/visualizar/{id}', [SecretariaController::class, 'visualizar'])->name('secretaria.visitas.visualizar');
    Route::post('/secretaria/visitas/insert', [SecretariaController::class, 'insert'])->name('secretaria.visitas.insert');
    Route::post('/secretaria/visitas/update', [SecretariaController::class, 'update'])->name('secretaria.visitas.update');
    Route::post('/secretaria/visitas/delete', [SecretariaController::class, 'delete'])->name('secretaria.visitas.delete');

    Route::get('/secretaria/atendimentos/{id?}', [SecretariaController::class, 'atendimentos'])->name('secretaria.atendimentos');
    Route::get('/secretaria/atendimentos/listar_eventos_user/{id?}', [SecretariaController::class, 'listar_eventos_user'])->name('secretaria.atendimentos.listar_eventos_user');
    Route::get('/secretaria/atendimentos/adicionar_atendimento/{user_id?}/{inc?}/{fn?}', [SecretariaController::class, 'adicionar_atendimento'])->name('secretaria.atendimentos.adicionar_atendimento');
    Route::get('/secretaria/atendimentos/editar_atendimento/{id?}', [SecretariaController::class, 'editar_atendimento'])->name('secretaria.atendimentos.editar_atendimento');
    Route::post('/secretaria/atendimentos/insert', [SecretariaController::class, 'insert_atendimento'])->name('secretaria.atendimentos.insert');
    Route::post('/secretaria/atendimentos/update', [SecretariaController::class, 'update_atendimento'])->name('secretaria.atendimentos.update');
    Route::get('/secretaria/atendimentos/delete/{id}', [SecretariaController::class, 'delete_atendimento'])->name('secretaria.atendimentos.delete');

    Route::get('/secretaria/atividades/', [SecretariaController::class, 'atividades'])->name('secretaria.atividades');
    Route::get('/secretaria/atividades/adicionar', [SecretariaController::class, 'adicionar_atividade'])->name('secretaria.atividades.adicionar');
    Route::get('/secretaria/atividades/editar/{id}', [SecretariaController::class, 'editar_atividade'])->name('secretaria.atividades.editar');
    Route::get('/secretaria/atividades/excluir/{id}', [SecretariaController::class, 'excluir_atividade'])->name('secretaria.atividades.excluir');
    Route::post('/secretaria/atividades/insert', [SecretariaController::class, 'insert_atividade'])->name('secretaria.atividades.insert');
    Route::post('/secretaria/atividades/update', [SecretariaController::class, 'update_atividade'])->name('secretaria.atividades.update');
    Route::post('/secretaria/atividades/delete', [SecretariaController::class, 'delete_atividade'])->name('secretaria.atividades.delete');

    Route::get('/visitas', [VisitaController::class, 'index'])->name('visitas');
    Route::get('/visitas/acessar/{id}', [VisitaController::class, 'acessar'])->name('visitas.acessar');
    Route::post('/visitas/agendamento_set', [VisitaController::class, 'agendamento_set'])->name('visitas.agendamento_set');
    Route::post('/visitas/feedback_set', [VisitaController::class, 'feedback_set'])->name('visitas.feedback_set');


    /*
    Route::get('/familias', [FamiliaController::class, 'index'])->name('familias');
    Route::get('/familias/adicionar', [FamiliaController::class, 'adicionar'])->name('familias.adicionar');
    Route::get('/familias/editar/{id}', [FamiliaController::class, 'editar'])->name('familias.editar');
    Route::get('/familias/excluir/{id}', [FamiliaController::class, 'excluir'])->name('familias.excluir');
    Route::get('/familias/visualizar/{id}', [FamiliaController::class, 'visualizar'])->name('familias.visualizar');
    Route::get('/familias/excluir_filho', [FamiliaController::class, 'excluir_filho'])->name('familias.excluir_filho');
    Route::post('/familias/insert', [FamiliaController::class, 'insert'])->name('familias.insert');
    Route::post('/familias/update', [FamiliaController::class, 'update'])->name('familias.update');
    Route::post('/familias/delete', [FamiliaController::class, 'delete'])->name('familias.delete');

    Route::get('/membros', [MembroController::class, 'index'])->name('membros');
    Route::get('/membros/adicionar/{tipo}', [MembroController::class, 'adicionar'])->name('membros.adicionar');
    Route::get('/membros/editar/{id}', [MembroController::class, 'editar'])->name('membros.editar');
    Route::get('/membros/excluir/{id}', [MembroController::class, 'excluir'])->name('membros.excluir');
    Route::get('/membros/visualizar/{id}', [MembroController::class, 'visualizar'])->name('membros.visualizar');
    Route::post('/membros/insert', [MembroController::class, 'insert'])->name('membros.insert');
    Route::post('/membros/update', [MembroController::class, 'update'])->name('membros.update');
    Route::post('/membros/delete', [MembroController::class, 'delete'])->name('membros.delete');

    Route::get('/visitantes', [VisitanteController::class, 'index'])->name('visitantes');
    Route::get('/visitantes/adicionar/{tipo}', [VisitanteController::class, 'adicionar'])->name('visitantes.adicionar');
    Route::get('/visitantes/editar/{id}', [VisitanteController::class, 'editar'])->name('visitantes.editar');
    Route::get('/visitantes/excluir/{id}', [VisitanteController::class, 'excluir'])->name('visitantes.excluir');
    Route::get('/visitantes/visualizar/{id}', [VisitanteController::class, 'visualizar'])->name('visitantes.visualizar');
    Route::get('/visitantes/batizar/{id}', [VisitanteController::class, 'batizar'])->name('visitantes.batizar');
    Route::post('/visitantes/insert', [VisitanteController::class, 'insert'])->name('visitantes.insert');
    Route::post('/visitantes/update', [VisitanteController::class, 'update'])->name('visitantes.update');
    Route::post('/visitantes/delete', [VisitanteController::class, 'delete'])->name('visitantes.delete');
    Route::post('/visitantes/batizar_set', [VisitanteController::class, 'batizar_set'])->name('visitantes.batizar_set');

    */

    Route::get('/contatos', [ContatoController::class, 'index'])->name('contatos');
    Route::get('/contatos/view/{id}', [ContatoController::class, 'view'])->name('contatos.view');
    Route::post('/contatos/insert', [ContatoController::class, 'insert'])->name('contatos.insert');

    Route::get('/agendas', [AgendaController::class, 'index'])->name('agendas');
    Route::get('/agendas/lista_atendimentos', [AgendaController::class, 'lista_atendimentos'])->name('agendas.lista_atendimentos');
    Route::get('/agendas/listar_eventos_user/{id?}', [AgendaController::class, 'listar_eventos'])->name('agendas.listar_eventos_user');
    Route::get('/agendas/adicionar_reuniao/{id?}/{inc?}/{fn?}/{redirect?}', [AgendaController::class, 'adicionar_reuniao'])->name('agendas.adicionar_reuniao');
    Route::get('/agendas/acessar_reuniao/{id?}', [AgendaController::class, 'acessar_reuniao'])->name('agendas.acessar_reuniao');
    Route::post('/agendas/insert_reuniao', [AgendaController::class, 'insert_reuniao'])->name('agendas.insert_reuniao');
    Route::post('/agendas/acessar_reuniao_set', [AgendaController::class, 'acessar_reuniao_set'])->name('agendas.acessar_reuniao_set');

    Route::get('/reunioes/{ministerio_id}', [ReuniaoController::class, 'index'])->name('reunioes');
    Route::get('/reunioes_acessar/{id}', [ReuniaoController::class, 'acessar'])->name('reunioes.acessar');
    Route::post('/reunioes_acessar_set', [ReuniaoController::class, 'acessar_set'])->name('reunioes.acessar_set');
    Route::get('/reunioes_presencas/{id}', [ReuniaoController::class, 'presenca'])->name('reunioes.presencas');
    Route::get('/reunioes_adicionar/{id}', [ReuniaoController::class, 'adicionar'])->name('reunioes.adicionar');
    Route::post('/reunioes_insert', [ReuniaoController::class, 'insert'])->name('reunioes.insert');

    Route::get('/imprimir/{tipo}/{id}', [ImprimirController::class, 'imprimir'])->name('imprimir');

});
