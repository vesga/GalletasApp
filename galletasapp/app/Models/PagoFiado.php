<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PagoFiado extends Model
{
    protected $fillable = ['venta_id', 'forma_pago', 'fecha_pago'];

public function venta() {
    return $this->belongsTo(Venta::class);
}
}
