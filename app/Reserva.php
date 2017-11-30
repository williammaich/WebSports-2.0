<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $fillable = array('dataReservada', 'quantidade', 'quadra_id', 'pagamento_id', 'cliente_id');

    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }

    public function pagamento()
    {
        return $this->belongsTo('App\Pagamento');
    }

    public function quadra()
    {
        return $this->belongsTo('App\Quadra');
    }


}