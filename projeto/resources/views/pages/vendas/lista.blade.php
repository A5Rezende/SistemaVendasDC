@include('pages.includes.header')

<div class="container">
    <div class="mt-5 mb-4 d-flex justify-content-between">
        <h3>Lista de Vendas</h3>
        <a href="{{ route('vendas.create') }}" class="btn btn-success">Novo Venda</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Vendedor</th>
                <th>Data da Venda</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vendas as $venda)
            <tr>
                <td>{{ $venda->id }}</td>
                <td>{{ $venda->cliente->nome }}</td>
                <td>{{ $venda->vendedor->nome }}</td>
                <td>{{ $venda->data_venda }}</td>
                <td>
                    <a href="{{ route('vendas.show', $venda->id) }}" class="me-3"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('vendas.edit', $venda->id) }}" class="me-3"><i class="bi bi-pencil-square"></i></a>
                    <form action="{{ route('vendas.destroy', $venda->id) }}" method="POST" style="display: inline-block;">
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
