<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = ['cliente_id', 'galleta_id', 'cantidad', 'total', 'forma_pago', 'estado'];

public function cliente() {
    return $this->belongsTo(Cliente::class);
}

public function galleta() {
    return $this->belongsTo(Galleta::class);
}

public function pagos() {
    return $this->hasMany(PagoFiado::class);
}
}
