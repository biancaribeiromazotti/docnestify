<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes.cliente'; // schema.tabela

    protected $fillable = [
        'nome',
        'codigo',
        'user_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relacionamento com User
     * Um cliente pertence a um usuário
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relacionamento com Cliente
     * Um usuário pode ter muitos clientes
     */
    public function clientes()
    {
        return $this->hasMany(Cliente::class);
    }

    /**
     * Scope para buscar por código
     */
    public function scopeByCodigo($query, $codigo)
    {
        return $query->where('codigo', $codigo);
    }

    /**
     * Scope para buscar por nome
     */
    public function scopeByNome($query, $nome)
    {
        return $query->where('nome', 'like', "%{$nome}%");
    }

    /**
     * Accessor para formatar o nome
     */
    public function getNomeCompletoAttribute()
    {
        return "{$this->codigo} - {$this->nome}";
    }
}