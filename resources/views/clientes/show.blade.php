{{-- resources/views/clientes/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2>
                    <i class="fas fa-user"></i> {{ __('Detalhes do Cliente') }}
                </h2>
                <div class="btn-group">
                    <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Voltar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Alertas de Sucesso -->
    @if(session('success'))
        <div class="row mb-3">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        </div>
    @endif

    <!-- Dados do Cliente -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle"></i> Informações do Cliente
                    </h5>
                </div>
                <div class="card-body">
                    <!-- Nome -->
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label fw-bold text-muted">
                                    <i class="fas fa-user"></i> Nome do Cliente
                                </label>
                                <div class="form-control-plaintext bg-light border rounded p-3">
                                    {{ $cliente->nome }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Código e Usuário Responsável -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label fw-bold text-muted">
                                    <i class="fas fa-barcode"></i> Código
                                </label>
                                <div class="form-control-plaintext bg-light border rounded p-3">
                                    <span class="badge bg-secondary fs-6">{{ $cliente->codigo }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label fw-bold text-muted">
                                    <i class="fas fa-user-tie"></i> Usuário Responsável
                                </label>
                                <div class="form-control-plaintext bg-light border rounded p-3">
                                    {{ $cliente->user->name ?? 'Não informado' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Datas -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label fw-bold text-muted">
                                    <i class="fas fa-calendar-plus"></i> Data de Cadastro
                                </label>
                                <div class="form-control-plaintext bg-light border rounded p-3">
                                    {{ $cliente->created_at->format('d/m/Y H:i:s') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label fw-bold text-muted">
                                    <i class="fas fa-calendar-check"></i> Última Atualização
                                </label>
                                <div class="form-control-plaintext bg-light border rounded p-3">
                                    {{ $cliente->updated_at->format('d/m/Y H:i:s') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ações Adicionais -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="d-flex justify-content-center gap-2">
                <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Editar Cliente
                </a>
                
                <!-- Botão de Excluir (opcional) -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    <i class="fas fa-trash"></i> Excluir Cliente
                </button>
                
                <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
                    <i class="fas fa-list"></i> Listar Clientes
                </a>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmação para Exclusão -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">
                        <i class="fas fa-exclamation-triangle"></i> Confirmar Exclusão
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza que deseja excluir o cliente <strong>{{ $cliente->nome }}</strong>?</p>
                    <p class="text-danger">
                        <i class="fas fa-warning"></i> Esta ação não pode ser desfeita.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                    <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Confirmar Exclusão
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .form-control-plaintext {
        font-size: 1rem;
        font-weight: 500;
        color: #495057;
        min-height: 50px;
        display: flex;
        align-items: center;
    }
    
    .card-header {
        border-bottom: 3px solid #dee2e6;
    }
    
    .btn-group .btn {
        margin-left: 0.25rem;
    }
</style>
@endsection