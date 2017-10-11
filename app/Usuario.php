<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = array('nome', 'senha', 'email', 'cpf', 'endereco_id', 'saldo', 'tipo');

}