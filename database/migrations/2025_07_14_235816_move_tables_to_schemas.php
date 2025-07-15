<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement('ALTER TABLE cliente SET SCHEMA clientes');
        
        DB::statement('ALTER TABLE arquivo SET SCHEMA arquivo');
        DB::statement('ALTER TABLE arquivo_pasta SET SCHEMA arquivo');
        DB::statement('ALTER TABLE arquivo_categoria SET SCHEMA arquivo');
        DB::statement('ALTER TABLE arquivo_tag SET SCHEMA arquivo');
        DB::statement('ALTER TABLE categoria SET SCHEMA arquivo');
        DB::statement('ALTER TABLE tag SET SCHEMA arquivo');
        
        DB::statement('ALTER TABLE pasta SET SCHEMA documentacao');
    }

    public function down()
    {
        DB::statement('ALTER TABLE clientes.cliente SET SCHEMA public');
        DB::statement('ALTER TABLE arquivo.arquivo SET SCHEMA public');
        DB::statement('ALTER TABLE arquivo.arquivo_pasta SET SCHEMA public');
        DB::statement('ALTER TABLE arquivo.arquivo_categoria SET SCHEMA public');
        DB::statement('ALTER TABLE arquivo.arquivo_tag SET SCHEMA public');
        DB::statement('ALTER TABLE arquivo.categoria SET SCHEMA public');
        DB::statement('ALTER TABLE arquivo.tag SET SCHEMA public');
        DB::statement('ALTER TABLE documentacao.pasta SET SCHEMA public');
    }
};