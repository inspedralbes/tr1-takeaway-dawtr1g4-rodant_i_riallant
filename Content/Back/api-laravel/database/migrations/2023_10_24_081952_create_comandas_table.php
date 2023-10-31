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
        Schema::create('comandas', function (Blueprint $table) {
            $table->id();
            $table->text('productes');
            // $table->integer('preuTotal');
            $table->decimal('preuTotal', 8, 2);
            $table->string('email');
            $table->integer('estat')->default(0);
            $table->timestamps();
            $table->timestamp('momentPreparacio')->nullable();
            $table->timestamp('momentEnviament')->nullable();
            $table->timestamp('momentRepartiment')->nullable();
            $table->timestamp('momentRebuda')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comandas');
    }
};
