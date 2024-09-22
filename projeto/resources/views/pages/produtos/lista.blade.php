@include('pages.includes.header')

<div class="container">
    <div class="mt-5 mb-4 d-flex justify-content-between">
        <h3>Lista de Produtos</h3>
        <a href="{{ route('produtos.create') }}" class="btn btn-success">Novo Produto</a>
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
            @foreach ($produtos as $produto)
            <tr>
                <td>{{ $produto->id }}</td>
                <td>{{ $produto->nome }}</td>
                <td>
                    <a href="{{ route('produtos.show', $produto->id) }}" class="me-3"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('produtos.edit', $produto->id) }}" class="me-3"><i class="bi bi-pencil-square"></i></a>
                    <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" style="display: inline-block;">
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
