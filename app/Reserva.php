<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $fillable = array('dataReservada', 'quadra_id', 'pagamento_id', 'cliente_id');
}
