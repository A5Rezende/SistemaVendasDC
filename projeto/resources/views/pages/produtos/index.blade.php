@include('pages.includes.header')

<div class="container">

    <a href="{{ route('produtos.index') }}" class="btn btn-secondary mt-2">Voltar</a>

    <h1>{{ isset($produto) ? (isset($viewMode) ? 'Visualizar Produto' : 'Editar Produto') : 'Criar Produto' }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($produto) ? route('produtos.update', $produto->id) : route('produtos.store') }}" method="POST">
        @csrf
        @if (isset($produto))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" name="nome" class="form-control" value="{{ old('nome', $produto->nome ?? '') }}" {{ isset($viewMode) ? 'disabled' : '' }}>
        </div>

        @if (!isset($viewMode))
            <button type="submit" class="btn btn-primary">Salvar</button>
        @endif
    </form>
</div>
