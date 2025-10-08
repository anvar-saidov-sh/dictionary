<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        }

        if (!Schema::hasTable('word_requests')) {
            Schema::create('word_requests', function (Blueprint $table) {
                $table->id();

                $table->foreignId('word_id')
                    ->constrained('words')
                    ->onDelete('cascade');

                $table->foreignId('student_id')
                    ->constrained('students')
                    ->onDelete('cascade');

                $table->text('message')->nullable();
                $table->text('definition');
                $table->text('examples')->nullable();
                $table->text('idioms')->nullable();
                $table->string('image')->nullable();

                $table->boolean('approved_by_owner')->default(false);
                $table->boolean('rejected_by_owner')->nullable()->default(false);

                $table->enum('status', [
                    'pending_owner',
                    'pending_scholar',
                    'approved_by_scholar',
                    'rejected_by_scholar',
                ])->default('pending_owner');

                $table->foreignId('scholar_id')
                    ->nullable()
                    ->constrained('scholars')
                    ->onDelete('set null');

                $table->timestamps();
            });
        } else {
            Schema::table('word_requests', function (Blueprint $table) {
                if (!Schema::hasColumn('word_requests', 'approved_by_owner')) {
                    $table->boolean('approved_by_owner')->default(false);
                }

                if (!Schema::hasColumn('word_requests', 'rejected_by_owner')) {
                    $table->boolean('rejected_by_owner')->nullable()->default(false);
                }

                if (!Schema::hasColumn('word_requests', 'status')) {
                    $table->enum('status', [
                        'pending_owner',
                        'pending_scholar',
                        'approved_by_scholar',
                        'rejected_by_scholar',
                    ])->default('pending_owner');
                }

                if (!Schema::hasColumn('word_requests', 'scholar_id')) {
                    $table->foreignId('scholar_id')
                        ->nullable()
                        ->constrained('scholars')
                        ->onDelete('set null');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('word_requests')) {
            Schema::table('word_requests', function (Blueprint $table) {
                if (Schema::hasColumn('word_requests', 'scholar_id')) {
                    $table->dropConstrainedForeignId('scholar_id');
                }
            });

            Schema::dropIfExists('word_requests');
        }

        if (Schema::hasTable('scholars')) {
            Schema::dropIfExists('scholars');
        }
    }
};
