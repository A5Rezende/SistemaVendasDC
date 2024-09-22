<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcela extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pagamento',
        'id_forma_pagamento',
        'data_vencimento',
        'valor',
    ];

    public function pagamento()
    {
        return $this->belongsTo(Pagamento::class, 'id_pagamento');
    }

    public function formaPagamento()
    {
        return $this->belongsTo(Forma_pagamento::class, 'id_forma_pagamento');
    }
}
