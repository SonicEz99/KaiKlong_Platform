<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->enum('product_approve', ['อนุมัติ', 'ไม่อนุมัติ'])
                  ->default('ไม่อนุมัติ')
                  ->after('product_condition'); // Position after product_condition
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('product_approve');
        });
    }
};

