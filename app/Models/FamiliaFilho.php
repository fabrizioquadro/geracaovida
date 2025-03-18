<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamiliaFilho extends Model
{
    use HasFactory;

    protected $fillable = [
        'familia_id',
        'filho_id',
    ];

    public function filho(){
        return Membro::where('id', $this->filho_id)->first();
    }
}
