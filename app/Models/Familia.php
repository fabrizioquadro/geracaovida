<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{
    use HasFactory;

    protected $fillable = [
        'pai_id',
        'mae_id',
    ];


    public function pai(){
        return Membro::where('id', $this->pai_id)->first();
    }

    public function mae(){
        return Membro::where('id', $this->mae_id)->first();
    }
/*
    public function filhos(){
        return FamiliaFilho::where('familia_id', $this->id)->get();
    }

    */

}
