@include('pages.includes.header')

<div class="container">
    <div class="mt-5 mb-4 d-flex justify-content-between">
        <h3>Lista de Clientes</h3>
        <a href="{{ route('clientes.create') }}" class="btn btn-success">Novo Cliente</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
            <tr>
                <td>{{ $cliente->id }}</td>
                <td>{{ $cliente->nome }}</td>
                <td>{{ $cliente->cpf }}</td>
                <td>
                    <a href="{{ route('clientes.show', $cliente->id) }}" class="me-3"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('clientes.edit', $cliente->id) }}" class="me-3"><i class="bi bi-pencil-square"></i></a>
                    <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display: inline-block;">
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
