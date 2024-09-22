@include('pages.includes.header')

<div class="container">
    <div class="mt-5 mb-4 d-flex justify-content-between">
        <h3>Lista de Formas de Pagamento</h3>
        <a href="{{ route('formas_pagamento.create') }}" class="btn btn-success">Nova Forma de Pagamento</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($formas_pagamento as $forma_pagamento)
            <tr>
                <td>{{ $forma_pagamento->id }}</td>
                <td>{{ $forma_pagamento->nome }}</td>
                <td>
                    <a href="{{ route('formas_pagamento.show', $forma_pagamento->id) }}" class="me-3"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('formas_pagamento.edit', $forma_pagamento->id) }}" class="me-3"><i class="bi bi-pencil-square"></i></a>
                    <form action="{{ route('formas_pagamento.destroy', $forma_pagamento->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Deletar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
