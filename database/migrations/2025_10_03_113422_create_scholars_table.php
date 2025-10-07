<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
            $table->boolean('verified')->default(false);
            $table->boolean('rejected')->nullable(true);
        });

        DB::table('scholars')->insert([
            'name' => 'admin',
            'email' => 'admin@scholars.com',
            'password' => Hash::make('admin123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::table('words', function (Blueprint $table) {
            $table->dropColumn(['verified', 'rejected']);
        });

        Schema::dropIfExists('scholars');
    }
};
