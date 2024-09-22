<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('parcelas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pagamento');
            $table->unsignedBigInteger('id_forma_pagamento');
            $table->date('data_vencimento');
            $table->decimal('valor', 10, 2);
            $table->timestamps();

            $table->foreign('id_pagamento')->references('id')->on('pagamentos')->onDelete('cascade');
            $table->foreign('id_forma_pagamento')->references('id')->on('formas_pagamento')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parcelas', function (Blueprint $table) {
            $table->dropForeign(['id_pagamento']);
            $table->dropForeign(['id_forma_pagamento']);
        });

        Schema::dropIfExists('parcelas');
    }
};
