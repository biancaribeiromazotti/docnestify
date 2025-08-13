{{-- resources/views/clientes/_form.blade.php --}}
<div class="border rounded p-4 bg-light">
    <form action="{{ $action }}" method="POST">
        @csrf
        @if($method !== 'POST')
            @method($method)
        @endif
    
    <!-- Nome -->
    <div class="row mb-3">
        <div class="col-12">
            <label for="nome" class="form-label fw-bold">
                <i class="fas fa-user"></i> Nome do Cliente *
            </label>
            <input type="text" 
                   class="form-control @error('nome') is-invalid @enderror" 
                   id="nome" 
                   name="nome" 
                   value="{{ old('nome', $cliente->nome ?? '') }}"
                   placeholder="Digite o nome completo do cliente"
                   maxlength="255"
                   required>
            @error('nome')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <!-- Código -->
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="codigo" class="form-label fw-bold">
                <i class="fas fa-barcode"></i> Código *
            </label>
            <input type="text" 
                   class="form-control @error('codigo') is-invalid @enderror" 
                   id="codigo" 
                   name="codigo" 
                   value="{{ old('codigo', $cliente->codigo ?? '') }}"
                   placeholder="Ex: CLI001"
                   maxlength="20"
                   required>
            @error('codigo')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Usuário -->
        <div class="col-md-6">
            <label for="user_id" class="form-label fw-bold">
                <i class="fas fa-user-tie"></i> Usuário Responsável *
            </label>
            <select class="form-select @error('user_id') is-invalid @enderror" 
                    id="user_id" 
                    name="user_id" 
                    required>
                <option value="">Selecione um usuário</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" 
                            {{ old('user_id', $cliente->user_id ?? '') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            @error('user_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <!-- Botões -->
    <div class="row">
        <div class="col-12">
            <hr class="my-4">
            <div class="d-flex justify-content-between">
                <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-times"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> {{ $submitText }}
                </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Auto-gerar código baseado no nome (apenas para novos clientes)
    @if($isCreate ?? false)
    document.getElementById('nome').addEventListener('input', function() {
        const nome = this.value;
        const codigo = document.getElementById('codigo');
        
        if (nome && !codigo.value) {
            const prefix = nome.substring(0, 3).toUpperCase().replace(/[^A-Z]/g, '');
            const number = Math.floor(Math.random() * 9000) + 1000;
            codigo.value = prefix + number;
        }
    });
    @endif

    // Validação em tempo real
    document.getElementById('codigo').addEventListener('input', function() {
        this.value = this.value.toUpperCase();
    });
</script>
@endpush