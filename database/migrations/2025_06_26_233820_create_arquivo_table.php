<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('arquivo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('public_id', 255)->unique();
            $table->string('cloudinary_url', 255);
            $table->string('secure_url', 255);
            $table->string('resource_type', 20);
            $table->string('original_name', 255);
            $table->string('format', 10);
            $table->bigInteger('bytes');
            $table->json('metadata')->nullable();
            $table->string('nome', 255);
            $table->string('descricao', 255)->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->string('codigo', 20)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arquivo');
    }
};