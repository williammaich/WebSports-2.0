<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = array('rua', 'numero', 'complemento', 'cidade', 'cep');
}
