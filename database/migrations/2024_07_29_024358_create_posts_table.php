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
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); //asal
            $table->uuid('uuid')->unique(); //gantikan PK & random ID
            $table->string('title', 255); //tambah
            $table->text('content'); //tambah
            $table->bigInteger('author')->unsigned(); //unsigned tidak boleh negatif
            $table->foreign('author')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade'); //cascade @ restrict
            $table->timestamps(); //asal
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};