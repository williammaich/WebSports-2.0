<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = array('nome', 'email', 'cpf', 'saldo', 'endereco_id');
}
