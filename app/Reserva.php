<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $fillable = array('dataReservada', 'usuario_id', 'quadra_id', 'pagamento_id');
}
