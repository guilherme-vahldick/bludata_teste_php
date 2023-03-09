<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresa';
    protected $fillable = [
        'estado_id', 'nome', 'cnpj'
    ];

    public function estado() {
        return $this->belongsTo(Estado::class);
    }

    public function fornecedor() {
        return $this->hasMany(Fornecedor::class);
    }
}
