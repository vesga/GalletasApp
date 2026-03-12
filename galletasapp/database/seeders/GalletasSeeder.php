<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;
use App\Models\Galleta;

class GalletasSeeder extends Seeder
{
    public function run(): void
    {
        // Crear Clientes
        Cliente::create(['nombre' => 'Juan Pérez', 'telefono' => '3001234567']);
        Cliente::create(['nombre' => 'María Cookies', 'telefono' => '3119876543']);

        // Crear Galletas iniciales
        Galleta::create(['nombre' => 'Choco Chips', 'precio' => 2500, 'stock' => 20]);
        Galleta::create(['nombre' => 'Vainilla Real', 'precio' => 1800, 'stock' => 15]);
    }
}