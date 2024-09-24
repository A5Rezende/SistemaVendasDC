@include('pages.includes.header')

<div class="container">
    <form action="{{ route('vendas.update', $venda->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <h3>Editar Venda</h3>
            <div class="row">
                <div class="col form-group">
                    <label for="id_cliente">Cliente</label>
                    <select name="id_cliente" class="form-control">
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}" {{ $venda->id_cliente == $cliente->id ? 'selected' : '' }}>
                                {{ $cliente->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col form-group">
                    <label for="id_vendedor">Vendedor</label>
                    <select name="id_vendedor" class="form-control">
                        @foreach($vendedores as $vendedor)
                            <option value="{{ $vendedor->id }}" {{ $venda->id_vendedor == $vendedor->id ? 'selected' : '' }}>
                                {{ $vendedor->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <h3>Itens da Venda</h3>
            <div id="itens-venda">
                @foreach($venda->itens as $item)
                <div class="row item-venda">
                    <div class="col">
                        <select name="produto_id[]" class="form-control">
                            @foreach($produtos as $produto)
                                <option value="{{ $produto->id }}" {{ $item->produto_id == $produto->id ? 'selected' : '' }}>
                                    {{ $produto->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <input type="number" name="quantidade[]" value="{{ $item->quantidade }}" placeholder="Quantidade" class="form-control quantidade">
                    </div>
                    <div class="col">
                        <input type="number" name="preco_unitario[]" value="{{ $item->preco_unitario }}" placeholder="Preço Unitário" class="form-control preco-unitario" step="0.01">
                    </div>
                </div>
                @endforeach
            </div>

            <div id="resultadoTotal">Total: R$ {{ number_format($venda->total, 2, ',', '.') }}</div>

            <button type="button" id="adicionar-item" class="btn btn-secondary">Adicionar Item</button>
        </div>

        <div class="mb-4">
        @foreach($venda->pagamentos as $pagamento)
            <h3>Cadastro de Pagamento</h3>

            <div class="mb-4">
                <label for="quantidade_parcelas">Quantidade de Parcelas:</label>
                <input type="number" name="quantidade_parcelas" id="quantidade_parcelas" class="form-control" value="{{ $pagamento->quantidade_parcelas }}" min="1">
            </div>

            <div id="parcelas" class="mb-4">
                @foreach($pagamento->parcelas as $parcela)
                <div class="row parcela mb-3">
                    <div class="col">
                        <input type="number" step="0.01" name="valor_parcela[]" value="{{ $parcela->valor }}" placeholder="Valor da Parcela" class="form-control">
                    </div>
                    <div class="col">
                        <input type="date" name="data_vencimento[]" value="{{ $parcela->data_vencimento }}" class="form-control">
                    </div>
                    <div class="col">
                        <select name="forma_pagamento[]" class="form-control">
                            @foreach($formasPagamento as $forma)
                                <option value="{{ $forma->id }}" {{ $parcela->forma_pagamento_id == $forma->id ? 'selected' : '' }}>
                                    {{ $forma->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endforeach
            </div>
        @endforeach
        </div>

        <button type="submit" id="salvar-venda" class="btn btn-primary">Salvar Alterações</button>
    </form>
</div>

<script>
    function calcularTotalVenda() {
        let totalVenda = 0;
        const itens = document.querySelectorAll('.item-venda');
        itens.forEach(item => {
            const quantidade = parseFloat(item.querySelector('.quantidade').value) || 0;
            const precoUnitario = parseFloat(item.querySelector('.preco-unitario').value) || 0;
            totalVenda += (quantidade * precoUnitario);
        });
        document.getElementById('resultadoTotal').textContent = 'Total: R$ ' + totalVenda.toFixed(2);
        return totalVenda;
    }

    function calcularTotalParcelas() {
        let totalParcelas = 0;
        const parcelas = document.querySelectorAll('.parcela');
        parcelas.forEach(parcela => {
            const valorParcela = parseFloat(parcela.querySelector('[name="valor_parcela[]"]').value) || 0;
            totalParcelas += valorParcela;
        });
        return totalParcelas;
    }

    function validarTotais() {
        const totalVenda = calcularTotalVenda();
        const totalParcelas = calcularTotalParcelas();
        const botaoSalvar = document.getElementById('salvar-venda');

        const margemErro = 0.01;
        if (Math.abs(totalParcelas - totalVenda) <= margemErro && totalParcelas > 0) {
            botaoSalvar.disabled = false;
        } else {
            botaoSalvar.disabled = true;
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Calcula o total da venda quando a página é carregada
        calcularTotalVenda();

        // Calcula os totais sempre que houver mudanças nos inputs de quantidade, preço ou valor de parcela
        document.querySelectorAll('.quantidade, .preco-unitario').forEach(input => {
            input.addEventListener('input', validarTotais);
        });

        // Adiciona evento de input para os campos de valor de parcela
        document.querySelectorAll('[name="valor_parcela[]"]').forEach(input => {
            input.addEventListener('input', validarTotais);
        });
    });

    document.getElementById('adicionar-item').addEventListener('click', function() {
        const item = document.querySelector('.item-venda').cloneNode(true);
        document.getElementById('itens-venda').appendChild(item);

        item.querySelector('.quantidade').addEventListener('input', validarTotais);
        item.querySelector('.preco-unitario').addEventListener('input', validarTotais);
    });

    // Atualiza as parcelas ao mudar a quantidade de parcelas e adiciona eventos de input
    document.getElementById('quantidade_parcelas').addEventListener('input', function() {
        const quantidadeParcelas = parseInt(this.value);
        const total_venda = calcularTotalVenda();
        const valor_parcela = total_venda / quantidadeParcelas;

        const parcelasContainer = document.getElementById('parcelas');
        parcelasContainer.innerHTML = '';

        for (let i = 0; i < quantidadeParcelas; i++) {
            const parcelaHtml = `
                <div class="row parcela mb-3">
                    <div class="col">
                        <input type="number" step="0.01" name="valor_parcela[]" placeholder="Valor da Parcela" class="form-control" value="${valor_parcela}">
                    </div>
                    <div class="col">
                        <input type="date" name="data_vencimento[]" class="form-control">
                    </div>
                    <div class="col">
                        <select name="forma_pagamento[]" class="form-control">
                            @foreach($formasPagamento as $forma)
                                <option value="{{ $forma->id }}">{{ $forma->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            `;
            parcelasContainer.insertAdjacentHTML('beforeend', parcelaHtml);
        }

        // Adiciona evento de input para os novos campos de valor de parcela
        document.querySelectorAll('[name="valor_parcela[]"]').forEach(input => {
            input.addEventListener('input', validarTotais);
        });

        validarTotais();
    });
</script>
