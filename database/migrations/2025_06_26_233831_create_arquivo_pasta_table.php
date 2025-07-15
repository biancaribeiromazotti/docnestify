<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('arquivo_pasta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('arquivo_id');
            $table->unsignedBigInteger('pasta_id');
            
            $table->foreign('arquivo_id')->references('id')->on('arquivo')->onDelete('cascade');
            $table->foreign('pasta_id')->references('id')->on('pasta')->onDelete('cascade');
            
            // Índice único para evitar duplicatas
            $table->unique(['arquivo_id', 'pasta_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arquivo_pasta');
    }
};