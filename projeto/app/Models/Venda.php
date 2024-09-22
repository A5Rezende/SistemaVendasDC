<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_cliente',
        'id_vendedor',
        'data_venda',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function vendedor()
    {
        return $this->belongsTo(Vendedor::class, 'id_vendedor');
    }

    public function itens()
    {
        return $this->hasMany(Item::class, 'id_venda');
    }

    public function pagamentos()
    {
        return $this->hasMany(Pagamento::class, 'id_venda');
    }
}
