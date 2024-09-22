<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forma_pagamento extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];
    protected $table = 'formas_pagamento';
}
