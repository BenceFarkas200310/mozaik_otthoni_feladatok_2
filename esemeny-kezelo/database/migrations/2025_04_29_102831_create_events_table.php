<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->dateTime('date');
            $table->string('location');
            $table->string('img')->nullable();
            $table->enum('type', ['koncert', 'konferencia', 'sport', 'expo', 'dedikálás', 'egyéb' ]);
            $table->text('description')->nullable();
            $table->boolean('is_public')->default(true);
            $table->unsignedBigInteger('author_id')->default(0);
            $table->string('thumbnail')->nullable();
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('events');
    }
};