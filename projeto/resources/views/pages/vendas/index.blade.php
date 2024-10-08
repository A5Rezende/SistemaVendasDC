@include('pages.includes.header')

<div class="container">
    <form action="{{ route('vendas.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <h3>Venda</h3>
            <div class="row">
                <div class="col form-group">
                    <label for="id_cliente">Cliente</label>
                    <select name="id_cliente" class="form-control">
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col form-group">
                    <label for="id_vendedor">Vendedor</label>
                    <select name="id_vendedor" class="form-control">
                        @foreach($vendedores as $vendedor)
                            <option value="{{ $vendedor->id }}">{{ $vendedor->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <h3>Itens da Venda</h3>
            <div id="itens-venda">
                <div class="row item-venda">
                    <div class="col">
                        <select name="produto_id[]" class="form-control">
                            @foreach($produtos as $produto)
                                <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <input type="number" name="quantidade[]" placeholder="Quantidade" class="form-control quantidade">
                    </div>
                    <div class="col">
                        <input type="number" name="preco_unitario[]" placeholder="Preço Unitário" class="form-control preco-unitario" step="0.01">
                    </div>
                </div>
            </div>

            <div id="resultadoTotal">Total: R$ 0.00</div>

            <button type="button" id="adicionar-item" class="btn btn-secondary">Adicionar Item</button>
        </div>

        <div class="mb-4">
            <h3>Cadastro de Pagamento</h3>

            <div class="mb-4">
                <label for="quantidade_parcelas">Quantidade de Parcelas:</label>
                <input type="number" name="quantidade_parcelas" id="quantidade_parcelas" class="form-control" min="1">
            </div>

            <div id="parcelas" class="mb-4"></div>
        </div>

        <button type="submit" id="salvar-venda" class="btn btn-primary" disabled>Salvar Venda</button>
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

    document.getElementById('adicionar-item').addEventListener('click', function() {
        const item = document.querySelector('.item-venda').cloneNode(true);
        document.getElementById('itens-venda').appendChild(item);

        item.querySelector('.quantidade').addEventListener('input', validarTotais);
        item.querySelector('.preco-unitario').addEventListener('input', validarTotais);
    });

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

        document.querySelectorAll('[name="valor_parcela[]"]').forEach(input => {
            input.addEventListener('input', validarTotais);
        });
        validarTotais();
    });

    document.querySelectorAll('.quantidade, .preco-unitario').forEach(input => {
        input.addEventListener('input', validarTotais);
    });
</script>
