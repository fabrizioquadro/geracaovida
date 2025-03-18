<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Culto;
use App\Models\Membro;

class ImprimirController extends Controller
{
    public function imprimir($tipo, $id){
        if($tipo == "culto"){
            $culto = Culto::where('id', $id)->first();
            $var = explode(' ', $culto->dt_hr_culto);
            $dt_culto = $var[0];
            $hr_culto = $var[1];

            if($culto->tp_culto == "Atividade"){
                $header = "Imprimir Atividade - ".$culto->ministerio->nm_ministerio;

                $var = explode(' ', $culto->dt_hr_culto);
                $membros = Membro::where('created_at', '<=', $var[0]." 23:59:59")
                ->where('situacao', 'Membro')
                ->whereIn('id', $in)
                ->orderBy('nome')
                ->get();

                $frequentes = Membro::where('created_at', '<=', $var[0]." 23:59:59")
                ->where('situacao', 'Visitante Frequente')
                ->whereIn('id', $in)
                ->orderBy('nome')
                ->get();

                $primeiras = Membro::where('created_at', '<=', $var[0]." 23:59:59")
                ->where('situacao', 'Primeiras Visitas')
                ->whereIn('id', $in)
                ->orderBy('nome')
                ->get();
            }
            else{
                $header = "Imprimir ".$culto->tp_culto;

                $membros = Membro::where('created_at', '<=', $var[0]." 23:59:59")
                ->where('situacao', 'membro')
                ->orderBy('nome')
                ->get();

                $frequentes = Membro::where('created_at', '<=', $var[0]." 23:59:59")
                ->where('situacao', 'Visitante Frequente')
                ->orderBy('nome')
                ->get();

                $primeiras = Membro::where('created_at', '<=', $var[0]." 23:59:59")
                ->where('situacao', 'Primeiras Visitas')
                ->orderBy('nome')
                ->get();
            }

            $html = "
            <div class='d-flex align-items-center justify-content-between'>
                <img src='/public/img/logo.png' style='height: 70px'>
                <h3 class='card-title'>".$header."</h3>
            </div>
            <hr>
            <div class='row'>
                <div class='col-sm-2 mt-3 form-group'>
                    <label for='dt_culto'>Data:</label><br>
                    <b>".dataDbForm($dt_culto)."</b>
                </div>
                <div class='col-sm-2 mt-3 form-group'>
                    <label for=''>Tipo:</label><br>
                    <b>".$culto->tp_culto."</b>
                </div>
                <div class='col-sm-2 form-group mt-3'>
                    <label for='hr_culto'>Hora:</label><br>
                    <b>".$hr_culto."</b>
                </div>
                <div class='col-sm-2 form-group mt-3'>
                    <label for='nm_culto'>Situação:</label><br>
                    <b>".$culto->st_culto."</b>
                </div>
                <div class='col-sm-4 form-group mt-3'>
                    <label for='nm_culto'>".$culto->tp_culto."</label><br>
                    <b>".$culto->nm_culto."</b>
                </div>
            </div>
            <hr>
            ";
            if($culto->ds_culto){
                $html .= "
                <div class='row'>
                    <div class='col-md-12 form-group mt-3'>
                        <label for='ds_culto'>Descrição do ".$culto->tp_culto.":</label><br>
                        <b>".$culto->ds_culto."</b>
                    </div>
                </div>
                ";
            }
            if($culto->ds_parecer){
                $html .= "
                <div class='row'>
                    <div class='col-md-12 form-group mt-3'>
                        <label for='ds_culto'>Resumo do ".$culto->tp_culto.":</label><br>
                        <b>".$culto->ds_parecer."</b>
                    </div>
                </div>
                ";
            }

            $html .= "
            <hr>
            <h5 class='card-title'>Presenças - Membro</h5>
            <table class='table'>
                <thead>
                    <th>Nome</th>";
                    if($culto->tp_culto == "Ceia"){
                        $html .= "<th>Oração</th>";
                    }
                    $html .= "
                    <th>Presença</th>
                </thead>
                <tbody>";
                foreach($membros as $membro){
                    $html .= "
                    <tr>
                        <td>".$membro->nome."</td>";
                        if($culto->tp_culto == "Ceia"){
                            if($membro->confere_presenca_oracao($culto->id) == 'checked'){
                                $html .= "<td>Participou</td>";
                            }
                            else{
                                $html .= "<td>Não Participou</td>";
                            }
                        }
                        if($membro->confere_presenca($culto->id) == 'checked'){
                            $html .= "<td>Participou</td>";
                        }
                        else{
                            $html .= "<td>Não Participou</td>";
                        }
                        $html .= "
                    </tr>
                    ";
                }
                $html .= "
                </tbody>
            </table>
            <hr>
            <h5 class='card-title'>Presenças - Visitantes Frequentes</h5>
            <table class='table'>
                <thead>
                    <th>Nome</th>";
                    if($culto->tp_culto == "Ceia"){
                        $html .= "<th>Oração</th>";
                    }
                    $html .= "
                    <th>Presença</th>
                </thead>
                <tbody>";
                foreach($frequentes as $membro){
                    $html .= "
                    <tr>
                        <td>".$membro->nome."</td>";
                        if($culto->tp_culto == "Ceia"){
                            if($membro->confere_presenca_oracao($culto->id) == 'checked'){
                                $html .= "<td>Participou</td>";
                            }
                            else{
                                $html .= "<td>Não Participou</td>";
                            }
                        }
                        if($membro->confere_presenca($culto->id) == 'checked'){
                            $html .= "<td>Participou</td>";
                        }
                        else{
                            $html .= "<td>Não Participou</td>";
                        }
                        $html .= "
                    </tr>
                    ";
                }
                $html .= "
                </tbody>
            </table>
            <hr>
            <h5 class='card-title'>Presenças - Primeiras Visitas</h5>
            <table class='table'>
                <thead>
                    <th>Nome</th>";
                    if($culto->tp_culto == "Ceia"){
                        $html .= "<th>Oração</th>";
                    }
                    $html .= "
                    <th>Presença</th>
                </thead>
                <tbody>";
                foreach($primeiras as $membro){
                    $html .= "
                    <tr>
                        <td>".$membro->nome."</td>";
                        if($culto->tp_culto == "Ceia"){
                            if($membro->confere_presenca_oracao($culto->id) == 'checked'){
                                $html .= "<td>Participou</td>";
                            }
                            else{
                                $html .= "<td>Não Participou</td>";
                            }
                        }
                        if($membro->confere_presenca($culto->id) == 'checked'){
                            $html .= "<td>Participou</td>";
                        }
                        else{
                            $html .= "<td>Não Participou</td>";
                        }
                        $html .= "
                    </tr>
                    ";
                }
                $html .= "
                </tbody>
            </table>         

            ";

            return view('layout/imprimir', compact('html'));
        }
    }
}
