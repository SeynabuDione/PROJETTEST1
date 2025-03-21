<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
   

    public function up(): void
{
    Schema::create('commandes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('client_id')->constrained('clients')->onDelete('cascade'); // Clé étrangère vers clients
        $table->foreignId('produit_id')->constrained('produits')->onDelete('cascade'); // Clé étrangère vers produits
        $table->decimal('total', 8, 2);
        $table->enum('status', ['en_attente', 'en_preparation', 'pret', 'termine']);
        $table->integer('nombre_de_pieces');
        $table->timestamp('date')->default(DB::raw('CURRENT_TIMESTAMP'));
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
