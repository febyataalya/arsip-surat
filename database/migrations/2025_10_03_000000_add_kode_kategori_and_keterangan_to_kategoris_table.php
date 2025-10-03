<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('kategoris', function (Blueprint $table) {
            if (! Schema::hasColumn('kategoris', 'kode_kategori')) {
                $table->string('kode_kategori', 50)->nullable()->after('id');
            }
            if (! Schema::hasColumn('kategoris', 'keterangan')) {
                $table->text('keterangan')->nullable()->after('nama_kategori');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kategoris', function (Blueprint $table) {
            if (Schema::hasColumn('kategoris', 'kode_kategori')) {
                $table->dropColumn('kode_kategori');
            }
            if (Schema::hasColumn('kategoris', 'keterangan')) {
                $table->dropColumn('keterangan');
            }
        });
    }
};
