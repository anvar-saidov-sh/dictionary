<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('scholars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });

        Schema::table('words', function (Blueprint $table) {
            $table->boolean('verified_by_scholar')->default(false);
            $table->foreignId('approved_by_scholar')->nullable()->constrained('scholars')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('words', function (Blueprint $table) {
            $table->dropColumn(['verified_by_scholar', 'approved_by_scholar']);
        });

        Schema::dropIfExists('scholars');
    }
};
