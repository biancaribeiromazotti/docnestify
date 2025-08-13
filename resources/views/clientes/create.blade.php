{{-- resources/views/clientes/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2>{{ __('Novo Cliente') }}</h2>
                <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Voltar
                </a>
            </div>
        </div>
    </div>

    <!-- Alertas de Erro -->
    @if ($errors->any())
        <div class="row mb-3">
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Ops! Algo deu errado:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        </div>
    @endif

    <!-- Formulário -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('clientes._form', [
                'action' => route('clientes.store'),
                'method' => 'POST',
                'submitText' => 'Salvar Cliente',
                'isCreate' => true,
                'cliente' => null,
                'users' => $users
            ])
        </div>
    </div>

    <!-- Info adicional -->
    <div class="row mt-4">
        <div class="col-12 text-center">
            <small class="text-muted">
                <i class="fas fa-info-circle"></i> 
                Campos marcados com (*) são obrigatórios
            </small>
        </div>
    </div>
</div>
@endsection

@stack('scripts')