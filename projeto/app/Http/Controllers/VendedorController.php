<?php

namespace App\Http\Controllers;

use App\Models\Vendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendedores = Vendedor::all();
        return view('pages.vendedores.lista', compact('vendedores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.vendedores.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'cpf' => 'required|unique:vendedores,cpf',
        ]);

        Vendedor::create([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
        ]);

        return redirect()->route('vendedores.index')->with('success', 'Vendedor criado com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendedor $vendedore)
    {
        $vendedor = $vendedore;
        return view('pages.vendedores.index', compact('vendedor'))->with('viewMode', true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendedor $vendedore)
    {
        $vendedor = $vendedore;
        return view('pages.vendedores.index', compact('vendedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vendedor $vendedor)
    {
        $request->validate([
            'nome' => 'required',
            'cpf' => 'required|unique:vendedores,cpf,' . $vendedor->id,
        ]);

        $vendedor->update([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
        ]);
        return redirect()->route('vendedores.index')->with('success', 'Vendedor atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendedor $vendedore)
    {
        $vendedor = $vendedore;
        $vendedor->delete();
        return redirect()->route('vendedores.index')->with('success', 'Vendedor deletado com sucesso');
    }
}
