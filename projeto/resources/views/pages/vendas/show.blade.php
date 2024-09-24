@include('pages.includes.header')

<div class="container">
    <h3>Detalhes da Venda</h3>

    <div class="row mb-4">
        <div class="col">

            <h4>Cliente</h4>
            <p>
                <strong>Nome:</strong> {{ $venda->cliente->nome }}
            </p>
            <p>
                <strong>CPF:</strong> {{ $venda->cliente->cpf }}
            </p>
        </div>

        <div class="col">

            <h4>Vendedor</h4>
            <p>
                <strong>Nome:</strong> {{ $venda->vendedor->nome }}
            </p>
            <p>
                <strong>CPF:</strong> {{ $venda->vendedor->cpf }}
            </p>

        </div>
    </div>

    <h4>Itens da Venda</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço Unitário</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalVenda = 0;
            @endphp
            @foreach($venda->itens as $item)
                @php
                    $totalVenda += $item->quantidade * $item->preco_unitario;
                @endphp
            <tr>
                <td>{{ $item->produto->nome }}</td>
                <td>{{ $item->quantidade }}</td>
                <td>R$ {{ number_format($item->preco_unitario, 2, ',', '.') }}</td>
                <td>R$ {{ number_format($item->quantidade * $item->preco_unitario, 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        Valor total : {{ number_format($totalVenda, 2, ',', '.') }}
    </div>


    <h4>Pagamento</h4>
    @foreach($venda->pagamentos as $pagamento)
    <p><strong>Quantidade de Parcelas:</strong> {{ $venda->pagamento->quantidade_parcelas }}</p>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Parcela</th>
                <th>Forma de Pagamento</th>
                <th>Data de Vencimento</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pagamento->parcelas as $key => $parcela)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $parcela->formaPagamento->nome }}</td>
                <td>{{ \Carbon\Carbon::parse($parcela->data_vencimento)->format('d/m/Y') }}</td>
                <td>R$ {{ number_format($parcela->valor, 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endforeach

    <a href="{{ route('vendas.index') }}" class="btn btn-primary">Voltar</a>
</div>
