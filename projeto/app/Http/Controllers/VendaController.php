<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Vendedor;
use App\Models\Produto;
use App\Models\Venda;
use App\Models\Item;
use App\Models\Pagamento;
use App\Models\Parcela;
use App\Models\Forma_pagamento;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    public function index() {
        $vendas = Venda::with(['cliente', 'vendedor'])->get();
        return view('pages.vendas.lista', compact('vendas'));
    }

    public function create()
    {
        $produtos = Produto::all();
        $clientes = Cliente::all();
        $vendedores = Vendedor::all();
        $formasPagamento = Forma_Pagamento::all();

        return view('pages.vendas.index', compact('produtos', 'clientes', 'vendedores', 'formasPagamento'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_cliente' => 'required',
            'id_vendedor' => 'required',
            'produto_id' => 'required|array',
            'quantidade' => 'required|array',
            'preco_unitario' => 'required|array',
            'quantidade_parcelas' => 'required|numeric',
            'valor_parcela' => 'required|array',
            'data_vencimento' => 'required|array',
        ]);

        $venda = Venda::create([
            'id_cliente' => $request->id_cliente,
            'id_vendedor' => $request->id_vendedor,
            'data_venda' => now(),
        ]);

        foreach ($request->produto_id as $key => $produto_id) {
            Item::create([
                'id_produto' => $produto_id,
                'id_venda' => $venda->id,
                'quantidade' => $request->quantidade[$key],
                'preco_unitario' => $request->preco_unitario[$key],
            ]);
        }

        $pagamento = Pagamento::create([
            'id_venda' => $venda->id,
            'quantidade_parcelas' => $request->quantidade_parcelas,
        ]);

        foreach ($request->valor_parcela as $key => $valor) {
            Parcela::create([
                'id_pagamento' => $pagamento->id,
                'id_forma_pagamento' => $request->forma_pagamento[$key],
                'valor' => $valor,
                'data_vencimento' => $request->data_vencimento[$key],
            ]);
        }

        return redirect()->route('vendas.index')->with('success', 'Venda cadastrada com sucesso!');
    }

    public function show($id)
    {
        $venda = Venda::with(['itens.produto', 'pagamentos.parcelas.formaPagamento', 'cliente', 'vendedor'])->findOrFail($id);

        return view('pages.vendas.show', compact('venda'));
    }

    public function destroy(Venda $venda)
    {

        $venda->delete();
        return redirect()->route('vendas.index')->with('success', 'Venda deletada com sucesso');
    }

    public function edit($id)
    {
        $venda = Venda::with(['itens.produto', 'pagamentos.parcelas.formaPagamento', 'cliente', 'vendedor'])->findOrFail($id);

        $clientes = Cliente::all();
        $vendedores = Vendedor::all();
        $produtos = Produto::all();
        $formasPagamento = Forma_Pagamento::all();

        return view('pages.vendas.edit', compact('venda', 'clientes', 'vendedores', 'produtos', 'formasPagamento'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_cliente' => 'required',
            'id_vendedor' => 'required',
            'produto_id' => 'required|array',
            'quantidade' => 'required|array',
            'preco_unitario' => 'required|array',
            'quantidade_parcelas' => 'required|numeric',
            'valor_parcela' => 'required|array',
            'data_vencimento' => 'required|array',
        ]);

        $venda = Venda::findOrFail($id);
        $venda->update([
            'id_cliente' => $request->id_cliente,
            'id_vendedor' => $request->id_vendedor,
            'data_venda' => now(),
        ]);

        $venda->itens()->delete();
        foreach ($request->produto_id as $key => $produto_id) {
            Item::create([
                'id_produto' => $produto_id,
                'id_venda' => $venda->id,
                'quantidade' => $request->quantidade[$key],
                'preco_unitario' => $request->preco_unitario[$key],
            ]);
        }

        $venda->pagamento->parcelas()->delete();
        $venda->pagamento->update([
            'quantidade_parcelas' => $request->quantidade_parcelas,
        ]);

        foreach ($request->valor_parcela as $key => $valor) {
            Parcela::create([
                'id_pagamento' => $venda->pagamento->id,
                'id_forma_pagamento' => $request->forma_pagamento[$key],
                'valor' => $valor,
                'data_vencimento' => $request->data_vencimento[$key],
            ]);
        }

        return redirect()->route('vendas.index')->with('success', 'Venda atualizada com sucesso!');
    }
}
