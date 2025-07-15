<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('arquivo_categoria', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('arquivo_id');
            $table->unsignedBigInteger('categoria_id');
            
            $table->foreign('arquivo_id')->references('id')->on('arquivo')->onDelete('cascade');
            $table->foreign('categoria_id')->references('id')->on('categoria')->onDelete('cascade');
            
            // Índice único para evitar duplicatas
            $table->unique(['arquivo_id', 'categoria_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arquivo_categoria');
    }
};