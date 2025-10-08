<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('word_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('word_id')->constrained('words')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->text('message')->nullable();
            $table->string('status')->default('pending');
            $table->text('definition');
            $table->text('examples')->nullable();
            $table->text('idioms')->nullable();
            $table->string('image')->nullable();
            $table->boolean('approved_by_owner')->default(false);
            $table->boolean('rejected_by_owner')->nullable(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('word_requests');
    }
};
