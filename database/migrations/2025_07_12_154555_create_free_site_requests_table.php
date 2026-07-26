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
         Schema::create('free_site_requests', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->text('description');
        $table->string('email');
        $table->string('phone')->nullable();
        $table->string('facebook')->nullable();
        $table->string('instagram')->nullable();
        $table->string('logo_path')->nullable(); // putanja do slike
        $table->timestamps();

        $table->string('template')->default('klasicni');
        $table->string('slug')->unique();
        $table->string('hero_title')->nullable();
        $table->text('hero_subtitle')->nullable();
        $table->string('hero_image')->nullable();

        $table->string('about_title')->nullable();
        $table->text('about_text')->nullable();
        $table->string('about_image')->nullable();

        $table->string('offer_title')->nullable();
        $table->json('offer_items')->nullable();
        $table->json('offer_images')->nullable();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('free_site_requests');
    }
};
