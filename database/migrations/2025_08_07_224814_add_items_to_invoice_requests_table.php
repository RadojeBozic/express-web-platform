<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('invoice_requests', function (Blueprint $table) {
        $table->json('items')->nullable(); // [{name, qty, unit_price}]
        // (opciono) ako želiš fiksirati preračunati total:
        $table->integer('total_cents')->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoice_requests', function (Blueprint $table) {
            //
        });
    }
};
