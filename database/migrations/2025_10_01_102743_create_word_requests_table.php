<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('word_requests', function (Blueprint $table) {
            $table->enum('status', [
                'pending_owner',
                'pending_scholar',
                'approved',
                'rejected'
            ])->default('pending_owner')->change();
            $table->foreignId('scholar_id')->nullable()->constrained('scholars')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('word_requests', function (Blueprint $table) {
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->change();
            $table->dropConstrainedForeignId('scholar_id');
        });
    }
};
