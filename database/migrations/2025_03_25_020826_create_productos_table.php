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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('producto_nombre', 100);
            $table->string('producto_descripcion', 200);
            $table->decimal('producto_precio', 10, 2);
            $table->unsignedInteger('producto_stock')->default(0);
            $table->foreignId('marca_id')->constrained('marcas');
            $table->foreignId('tipo_producto_id')->constrained('tipo_productos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
