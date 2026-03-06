<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('ventas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('cliente_id')->constrained('clientes');
        $table->foreignId('galleta_id')->constrained('galletas');
        $table->integer('cantidad');
        $table->decimal('total', 8, 2);
        $table->enum('forma_pago', ['efectivo', 'nequi', 'daviplata', 'fiado']);
        $table->enum('estado', ['pagado', 'pendiente'])->default('pagado');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
