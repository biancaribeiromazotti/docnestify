<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pasta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('cliente_id');
            $table->string('codigo', 20);
            
            $table->foreign('cliente_id')->references('id')->on('cliente')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pasta');
    }
};