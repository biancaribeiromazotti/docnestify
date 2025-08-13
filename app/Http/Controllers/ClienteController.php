<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Listar todos os clientes
     */
    public function index()
    {
        $clientes = Cliente::with('user')
            ->orderBy('nome')
            ->paginate(15);
            
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Mostrar formulário de criação
     */
    public function create()
    {
        $users = User::orderBy('name')->get();
        return view('clientes.create', compact('users'));
    }

    /**
     * Armazenar novo cliente
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'codigo' => [
                'required',
                'string',
                'max:20',
                function ($attribute, $value, $fail) {
                    if (Cliente::where('codigo', $value)->exists()) {
                        $fail('O código já está sendo usado.');
                    }
                },
            ],
            'user_id' => 'required|exists:users,id'
        ]);

        Cliente::create([
            'nome' => $request->nome,
            'codigo' => $request->codigo,
            'user_id' => $request->user_id
        ]);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente criado com sucesso!');
    }

    /**
     * Mostrar detalhes de um cliente
     */
    public function show(Cliente $cliente)
    {
        $cliente->load('user');
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Mostrar formulário de edição
     */
    public function edit(Cliente $cliente)
    {
        $users = User::orderBy('name')->get();
        return view('clientes.edit', compact('cliente', 'users'));
    }

    /**
     * Atualizar cliente
     */
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'codigo' => 'required|string|max:20|unique:clientes.cliente,codigo,' . $cliente->id,
            'codigo' => [
                'required',
                'string',
                'max:20',
                function ($attribute, $value, $fail) {
                    if (Cliente::where('codigo', $value)->exists()) {
                        $fail('O código já está sendo usado.');
                    }
                },
            ],
            'user_id' => 'required|exists:users,id'
        ]);

        $cliente->update([
            'nome' => $request->nome,
            'codigo' => $request->codigo,
            'user_id' => $request->user_id
        ]);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente atualizado com sucesso!');
    }

    /**
     * Remover cliente
     */
    public function destroy(Cliente $cliente)
    {
        try {
            $cliente->delete();
            return redirect()->route('clientes.index')
                ->with('success', 'Cliente removido com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('clientes.index')
                ->with('error', 'Erro ao remover cliente. Verifique se não há dependências.');
        }
    }
}