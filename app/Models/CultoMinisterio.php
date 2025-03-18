<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CultoMinisterio extends Model
{
    use HasFactory;

    protected $fillable = [
        'culto_id',
        'ministerio_id',
    ];

    public function ministerio(){
        return $this->belongsTo(Ministerio::class);
    }
}
