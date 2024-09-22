<?php

namespace App\Http\Controllers;

use App\Models\Forma_pagamento;
use Illuminate\Http\Request;

class Forma_pagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formas_pagamento = Forma_pagamento::all();
        return view('pages.formas_pagamento.lista', compact('formas_pagamento'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.formas_pagamento.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
        ]);

        Forma_pagamento::create($request->all());
        return redirect()->route('formas_pagamento.index')->with('success', 'Forma de pagamento criado com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(Forma_pagamento $formas_pagamento)
    {
        $forma_pagamento = $formas_pagamento;
        return view('pages.formas_pagamento.index', compact('forma_pagamento'))->with('viewMode', true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Forma_pagamento $formas_pagamento)
    {
        $forma_pagamento = $formas_pagamento;
        return view('pages.formas_pagamento.index', compact('forma_pagamento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Forma_pagamento $formas_pagamento)
    {
        $request->validate([
            'nome' => 'required',
        ]);

        $forma_pagamento = $formas_pagamento;
        $forma_pagamento->update($request->all());
        return redirect()->route('formas_pagamento.index')->with('success', 'Forma de pagamento atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Forma_pagamento $formas_pagamento)
    {
        $forma_pagamento = $formas_pagamento;
        $forma_pagamento->delete();
        return redirect()->route('formas_pagamento.index')->with('success', 'Forma de pagamento deletado com sucesso');
    }
}
