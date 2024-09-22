<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_produto',
        'id_venda',
        'quantidade',
        'preco_unitario',
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'id_produto');
    }

    public function venda()
    {
        return $this->belongsTo(Venda::class, 'id_venda');
    }

    protected $table = 'itens';
}
