<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('arquivo_tag', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('arquivo_id');
            $table->unsignedBigInteger('tag_id');
            
            $table->foreign('arquivo_id')->references('id')->on('arquivo')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tag')->onDelete('cascade');
            
            // Índice único para evitar duplicatas
            $table->unique(['arquivo_id', 'tag_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arquivo_tag');
    }
};