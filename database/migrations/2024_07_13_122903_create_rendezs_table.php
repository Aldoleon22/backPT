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
        Schema::create('rendezs', function (Blueprint $table) {
            $table->id();

            $table->date('datedebut');
            $table->date('datefin');
            $table->unsignedBigInteger('users');
            $table->foreign('users')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->unsignedBigInteger('id_vehicules');
            $table->foreign('id_vehicules')
            ->references('id')
            ->on('vehicules')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rendezs');
    }
};
