<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Criar schema clientes
        DB::statement('CREATE SCHEMA IF NOT EXISTS clientes');
        
        // Criar schema documentacao
        DB::statement('CREATE SCHEMA IF NOT EXISTS documentacao');
        
        // Criar schema arquivo
        DB::statement('CREATE SCHEMA IF NOT EXISTS arquivo');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remover schemas (cuidado: isso vai apagar todas as tabelas dos schemas)
        DB::statement('DROP SCHEMA IF EXISTS clientes CASCADE');
        DB::statement('DROP SCHEMA IF EXISTS documentacao CASCADE');
        DB::statement('DROP SCHEMA IF EXISTS arquivo CASCADE');
    }
};