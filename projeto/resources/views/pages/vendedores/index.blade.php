@include('pages.includes.header')

<div class="container">
    <a href="{{ route('vendedores.index') }}" class="btn btn-secondary mt-2">Voltar</a>
    <h1>{{isset($vendedor)?(isset($viewMode)?'Visualizar Vendedor':'Editar Vendedor'):'Criar Vendedor'}}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($vendedor) ? route('vendedores.update', $vendedor->id) : route('vendedores.store') }}" method="POST">
    @csrf
    @if (isset($vendedor))
        @method('PUT')
    @endif

        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control" value="{{ old('nome', $vendedor->nome ?? '') }}" {{ isset($viewMode) ? 'disabled' : '' }}>
        </div>
        <div class="form-group">
            <label>CPF</label>
            <input type="text" name="cpf" class="form-control" value="{{ old('cpf', $vendedor->cpf ?? '') }}" {{ isset($viewMode) ? 'disabled' : '' }}>
        </div>
        <div class="form-group">
            <label>Senha</label>
            <input type="text" name="senha" class="form-control" value="{{ old('senha', $vendedor->senha ?? '') }}" {{ isset($viewMode) ? 'disabled' : '' }}>
        </div>

        @if (!isset($viewMode))
            <button type="submit" class="btn btn-primary">Salvar</button>
        @endif
    </form>
</div>
