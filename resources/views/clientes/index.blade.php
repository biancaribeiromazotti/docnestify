@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2>{{ __('Clientes') }}</h2>
                <a href="{{ route('clientes.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Novo Cliente
                </a>
            </div>
        </div>
    </div>

    <!-- Alertas -->
    @if (session('success'))
        <div class="row mb-3">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="row mb-3">
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        </div>
    @endif

    @if($clientes->count() > 0)
        <!-- Grid Header -->
        <div class="row bg-primary text-white py-2 mb-2 rounded">
            <div class="col-1 fw-bold">ID</div>
            <div class="col-2 fw-bold">Código</div>
            <div class="col-4 fw-bold">Nome</div>
            {{-- <div class="col-3 fw-bold">Usuário</div> --}}
            <div class="col-2 fw-bold">Criado em</div>
            <div class="col-3 fw-bold text-center">Ações</div>
        </div>

        <!-- Grid Body -->
        @foreach($clientes as $cliente)
            <div class="row border-bottom py-2 align-items-center hover-effect">
                <div class="col-1">
                    <small class="text-muted">{{ $cliente->id }}</small>
                </div>
                
                <div class="col-2">
                    <span class="badge bg-primary">{{ $cliente->codigo }}</span>
                </div>
                
                <div class="col-4">
                    <strong>{{ $cliente->nome }}</strong>
                </div>
                
                {{-- <div class="col-3">
                    @if($cliente->user)
                        <i class="fas fa-user text-muted me-1"></i>
                        {{ $cliente->user->name }}
                    @else
                        <span class="text-muted">N/A</span>
                    @endif
                </div> --}}
                
                <div class="col-2">
                    <small class="text-muted">
                        <i class="fas fa-calendar me-1"></i>
                        {{ $cliente->created_at->format('d/m/Y') }}
                    </small>
                </div>
                
                <div class="col-3 text-center">
                    <div class="btn-group" role="group">
                        <a href="{{ route('clientes.show', $cliente) }}" 
                           class="btn btn-sm btn-outline-info" 
                           title="Visualizar">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('clientes.edit', $cliente) }}" 
                           class="btn btn-sm btn-outline-warning" 
                           title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" 
                                class="btn btn-sm btn-outline-danger" 
                                title="Excluir"
                                data-bs-toggle="modal" 
                                data-bs-target="#deleteModal{{ $cliente->id }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal de Confirmação -->
            <div class="modal fade" id="deleteModal{{ $cliente->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Confirmar Exclusão</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            Tem certeza que deseja excluir o cliente <strong>{{ $cliente->nome }}</strong>?
                            <br><small class="text-muted">Esta ação não pode ser desfeita.</small>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Paginação -->
        <div class="row mt-4">
            <div class="col-sm-6">
                <small class="text-muted">
                    Mostrando {{ $clientes->firstItem() }} a {{ $clientes->lastItem() }} 
                    de {{ $clientes->total() }} registros
                </small>
            </div>
            <div class="col-sm-6 d-flex justify-content-end">
                {{ $clientes->links() }}
            </div>
        </div>
    @else
        <!-- Estado vazio -->
        <div class="row">
            <div class="col-12 text-center py-5">
                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Nenhum cliente cadastrado</h5>
                <p class="text-muted">Comece criando seu primeiro cliente</p>
                <a href="{{ route('clientes.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Criar Primeiro Cliente
                </a>
            </div>
        </div>
    @endif
</div>

<style>
.hover-effect:hover {
    background-color: #f8f9fa;
}
</style>
@endsection