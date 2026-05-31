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
    Schema::create('reportes', function (Blueprint $table) {

        $table->id();

        $table->string('titulo');

        $table->text('descripcion');

        $table->string('imagen')->nullable();

        $table->decimal('latitud', 10, 7)->nullable();

        $table->decimal('longitud', 10, 7)->nullable();

        $table->string('estado')->default('Pendiente');

        $table->foreignId('user_id')
              ->constrained()
              ->onDelete('cascade');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportes');
    }
};
