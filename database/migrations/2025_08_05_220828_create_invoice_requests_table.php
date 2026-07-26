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
    Schema::create('invoice_requests', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email');
        $table->string('currency', 10); // rsd / eur
        $table->integer('amount'); // čuva se u centima
        $table->string('status')->default('pending'); // pending, approved, generated
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_requests');
    }
};
