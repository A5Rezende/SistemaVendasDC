@include('pages.includes.header')

<div class="container">

    <a href="{{ route('clientes.index') }}" class="btn btn-secondary mt-2">Voltar</a>

    <h1>{{ isset($cliente) ? (isset($viewMode) ? 'Visualizar Cliente' : 'Editar Cliente') : 'Criar Cliente' }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($cliente) ? route('clientes.update', $cliente->id) : route('clientes.store') }}" method="POST">
        @csrf
        @if (isset($cliente))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" name="nome" class="form-control" value="{{ old('nome', $cliente->nome ?? '') }}" {{ isset($viewMode) ? 'disabled' : '' }}>
        </div>

        <div class="form-group">
            <label for="cpf">CPF</label>
            <input type="text" name="cpf" class="form-control" value="{{ old('cpf', $cliente->cpf ?? '') }}" {{ isset($viewMode) ? 'disabled' : '' }}>
        </div>

        @if (!isset($viewMode))
            <button type="submit" class="btn btn-primary">Salvar</button>
        @endif
    </form>
</div>
