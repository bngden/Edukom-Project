<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->dateTime('occurred_at', 6)->index();
            $table->string('actor_type', 10);
            $table->foreignId('actor_id')->nullable();
            $table->string('actor_role', 20)->nullable();
            $table->string('action', 100);
            $table->string('subject_type', 50);
            $table->string('subject_id', 64)->nullable();
            $table->string('subject_label')->nullable();
            $table->json('before')->nullable();
            $table->json('after')->nullable();
            $table->text('reason')->nullable();
            $table->string('ip', 45)->nullable();
            $table->string('user_agent', 512)->nullable();
            $table->string('request_id', 64)->nullable();

            // Filter + ORDER BY occurred_at DESC tanpa filesort.
            $table->index(['subject_type', 'subject_id', 'occurred_at']);
            $table->index(['actor_id', 'occurred_at']);
            $table->index(['action', 'occurred_at']);
        });

        DB::unprepared("
            CREATE TRIGGER audit_logs_block_update BEFORE UPDATE ON audit_logs FOR EACH ROW
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'audit_logs append-only: update ditolak'
        ");

        // Penghapusan hanya lewat edukom:purge-audit yang menyetel @edukom_audit_purge = 1.
        DB::unprepared("
            CREATE TRIGGER audit_logs_block_delete BEFORE DELETE ON audit_logs FOR EACH ROW
            BEGIN
                IF COALESCE(@edukom_audit_purge, 0) <> 1 THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'audit_logs append-only: delete ditolak';
                END IF;
            END
        ");
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
