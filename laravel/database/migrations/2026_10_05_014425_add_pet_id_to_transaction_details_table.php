<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transaction_details', function (Blueprint $table) {
            // Tambah pet_id nullable agar data lama tidak rusak
            $table->foreignId('pet_id')->nullable()->after('transaction_id')->constrained('pets')->nullOnDelete();
        });

        // Isi pet_id lama dari kolom pet_id di tabel transactions (migrasi data historis)
        \Illuminate\Support\Facades\DB::statement('
            UPDATE transaction_details td
            JOIN transactions t ON td.transaction_id = t.id
            SET td.pet_id = t.pet_id
            WHERE td.pet_id IS NULL
        ');
    }

    public function down(): void
    {
        Schema::table('transaction_details', function (Blueprint $table) {
            $table->dropForeign(['pet_id']);
            $table->dropColumn('pet_id');
        });
    }
};
