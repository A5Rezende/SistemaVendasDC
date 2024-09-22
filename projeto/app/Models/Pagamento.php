<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_venda',
        'quantidade_parcelas',
    ];

    public function venda()
    {
        return $this->belongsTo(Venda::class, 'id_venda');
    }

    public function parcelas()
    {
        return $this->hasMany(Parcela::class, 'id_pagamento');
    }
}
