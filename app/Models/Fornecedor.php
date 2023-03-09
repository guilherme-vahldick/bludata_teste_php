<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $table = 'fornecedor';
    protected $fillable = [
        'tipo_pessoa', 'nome', 'empresa_id', 'cpf', 'cnpj', 'telefone', 'rg', 'data_nascimento'
    ];
    protected $dates = ['data_nascimento'];

    public function empresa() {
        return $this->belongsTo(Empresa::class);
    }
}
