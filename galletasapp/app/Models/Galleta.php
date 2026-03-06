<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galleta extends Model
{
    protected $fillable = ['nombre', 'precio', 'stock'];
}