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
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique;
            $table->timestamps();
        });

        DB::table('categorias')->insert([
            [
                'nom' => 'Esports',
            ],
            [
                'nom' => 'Gimnas',
            ],
            [
                'nom' => 'Salut',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
