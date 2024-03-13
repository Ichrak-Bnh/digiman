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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_societe');
            $table->foreign('id_societe')->references('id')->on('users')->onDelete('cascade');
            $table->decimal('total_amount', 10, 2);
            $table->string('status')->default('en_attente');
            $table->string('nom_client')->nullable();
            $table->string('email')->nullable();
            $table->string('adresse')->nullable();
            $table->string('type')->nullable();
            $table->string('motif')->nullable();
            $table->string('telephone')->nullable();
            $table->string('gouvernerat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
