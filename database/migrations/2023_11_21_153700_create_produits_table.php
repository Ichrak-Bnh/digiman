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
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->integer('prix_achat');
            $table->integer('prix_vente');
            $table->integer('quantite')->default(0);
            $table->integer('stock_securite');
            $table->string('photo');
            $table->string('nom');
            $table->string('statut');
            $table->integer('categorie');
            $table->text('description');
            $table->integer('id_societe');
            $table->string('code_bar');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produit');
    }
};
