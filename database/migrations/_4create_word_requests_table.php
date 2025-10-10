<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('word_requests')) {
            Schema::create('word_requests', function (Blueprint $table) {
                $table->id();
                $table->foreignId('word_id')->constrained('words')->onDelete('cascade');
                $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
                $table->foreignId('scholar_id')->nullable()->constrained('scholars')->onDelete('set null');
                $table->text('message')->nullable();
                $table->text('definition');
                $table->text('examples')->nullable();
                $table->text('idioms')->nullable();
                $table->string('image')->nullable();
                $table->enum('status', [
                    'pending_owner',
                    'pending_scholar',
                    'approved_by_scholar',
                    'rejected_by_scholar',
                ])->default('pending_owner');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('word_requests');
    }
};
