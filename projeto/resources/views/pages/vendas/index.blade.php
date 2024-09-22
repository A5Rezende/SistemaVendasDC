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
                        <input type="number" name="preco_unitario[]" placeholder="Preço Unitário" class="form-control preco-unitario">
                    </div>
                </div>
            </div>

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

        <!-- Adicionando o id salvar-venda para ser referenciado no JavaScript -->
        <button type="submit" id="salvar-venda" class="btn btn-primary" disabled>Salvar Venda</button>
    </form>
</div>

<script>
    // Função para calcular o total da venda
    function calcularTotalVenda() {
        let totalVenda = 0;
        const itens = document.querySelectorAll('.item-venda');
        itens.forEach(item => {
            const quantidade = item.querySelector('.quantidade').value || 0;
            const precoUnitario = item.querySelector('.preco-unitario').value || 0;
            totalVenda += (quantidade * precoUnitario);
        });
        return totalVenda;
    }

    // Função para calcular o total das parcelas
    function calcularTotalParcelas() {
        let totalParcelas = 0;
        const parcelas = document.querySelectorAll('.parcela');
        parcelas.forEach(parcela => {
            const valorParcela = parcela.querySelector('[name="valor_parcela[]"]').value || 0;
            totalParcelas += parseFloat(valorParcela);
        });
        return totalParcelas;
    }

    // Função para validar se a soma das parcelas bate com o total da venda
    function validarTotais() {
        const totalVenda = calcularTotalVenda();
        const totalParcelas = calcularTotalParcelas();
        const botaoSalvar = document.getElementById('salvar-venda');

        // Habilitar/desabilitar o botão com base na comparação
        if (totalParcelas === totalVenda && totalParcelas > 0) {
            botaoSalvar.disabled = false; // Habilita o botão se os totais batem
        } else {
            botaoSalvar.disabled = true;  // Desabilita o botão se os totais não batem
        }
    }

    // Adiciona novo item de venda
    document.getElementById('adicionar-item').addEventListener('click', function() {
        const item = document.querySelector('.item-venda').cloneNode(true);
        document.getElementById('itens-venda').appendChild(item);

        // Atualiza os totais sempre que um item é adicionado
        item.querySelector('.quantidade').addEventListener('input', validarTotais);
        item.querySelector('.preco-unitario').addEventListener('input', validarTotais);
    });

    // Função para gerar as parcelas com base na quantidade
    document.getElementById('quantidade_parcelas').addEventListener('input', function() {
        const quantidadeParcelas = parseInt(this.value);
        const parcelasContainer = document.getElementById('parcelas');

        // Limpa as parcelas atuais
        parcelasContainer.innerHTML = '';

        // Gera as novas parcelas
        for (let i = 0; i < quantidadeParcelas; i++) {
            const parcelaHtml = `
                <div class="row parcela mb-3">
                    <div class="col">
                        <input type="number" name="valor_parcela[]" placeholder="Valor da Parcela" class="form-control">
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

        // Atualiza a validação dos totais sempre que um valor de parcela é alterado
        document.querySelectorAll('[name="valor_parcela[]"]').forEach(input => {
            input.addEventListener('input', validarTotais);
        });
    });

    // Atualiza os totais sempre que um valor nos itens da venda é alterado
    document.querySelectorAll('.quantidade, .preco-unitario').forEach(input => {
        input.addEventListener('input', validarTotais);
    });
</script>
