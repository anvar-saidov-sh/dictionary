<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('scholars')) {
            Schema::create('scholars', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password');
                $table->timestamps();
            });

            DB::table('scholars')->insert([
                'name' => 'admin',
                'email' => 'admin@scholars.com',
                'password' => Hash::make('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        Schema::table('words', function (Blueprint $table) {
            if (!Schema::hasColumn('words', 'reviewed_by_scholar')) {
                $table->boolean('reviewed_by_scholar')->default(false);
            }

            if (!Schema::hasColumn('words', 'approved_by_scholar')) {
                $table
                    ->foreignId('approved_by_scholar')
                    ->nullable()
                    ->constrained('scholars')
                    ->onDelete('set null');
            }

            if (!Schema::hasColumn('words', 'status')) {
                $table->string('status')->default('pending');
            } else {
                $table->string('status')->default('pending')->change();
            }

            if (!Schema::hasColumn('words', 'verified')) {
                $table->boolean('verified')->default(false);
            } else {
                $table->boolean('verified')->default(false)->change();
            }

            if (!Schema::hasColumn('words', 'rejected')) {
                $table->boolean('rejected')->nullable()->default(false);
            } else {
                $table->boolean('rejected')->nullable()->default(false)->change();
            }
        });
    }

    public function down(): void
    {
        Schema::table('words', function (Blueprint $table) {
            if (Schema::hasColumn('words', 'reviewed_by_scholar')) {
                $table->dropColumn('reviewed_by_scholar');
            }
            if (Schema::hasColumn('words', 'approved_by_scholar')) {
                $table->dropConstrainedForeignId('approved_by_scholar');
            }
        });

        Schema::dropIfExists('scholars');
    }
};
