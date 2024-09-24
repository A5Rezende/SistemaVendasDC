@include('pages.includes.header')

<div class="container">
    <div class="mt-5 mb-4 d-flex justify-content-between">
        <h3>Lista de Vendedores</h3>
        <a href="{{ route('vendedores.create') }}" class="btn btn-success">Novo Vendedor</a>
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
            @foreach ($vendedores as $vendedor)
            <tr>
                <td>{{ $vendedor->id }}</td>
                <td>{{ $vendedor->nome }}</td>
                <td>{{ $vendedor->cpf }}</td>
                <td>
                    <a href="{{ route('vendedores.show', $vendedor->id) }}" class="me-3"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('vendedores.edit', $vendedor->id) }}" class="me-3"><i class="bi bi-pencil-square"></i></a>
                    <form action="{{ route('vendedores.destroy', $vendedor->id) }}" method="POST" style="display: inline-block;">
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
