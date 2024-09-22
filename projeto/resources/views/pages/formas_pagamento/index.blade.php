@include('pages.includes.header')

<div class="container">

    <a href="{{ route('formas_pagamento.index') }}" class="btn btn-secondary mt-2">Voltar</a>

    <h1>{{ isset($forma_pagamento) ? (isset($viewMode) ? 'Visualizar Forma de Pagamento' : 'Editar Forma de Pagamento') : 'Criar Forma de Pagamento' }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($forma_pagamento) ? route('formas_pagamento.update', $forma_pagamento->id) : route('formas_pagamento.store') }}" method="POST">
        @csrf
        @if (isset($forma_pagamento))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" name="nome" class="form-control" value="{{ old('nome', $forma_pagamento->nome ?? '') }}" {{ isset($viewMode) ? 'disabled' : '' }}>
        </div>

        @if (!isset($viewMode))
            <button type="submit" class="btn btn-primary">Salvar</button>
        @endif
    </form>
</div>
