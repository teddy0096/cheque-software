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
        Schema::table('cheque_issuances', function (Blueprint $table) {
            $table->decimal('amount', 10, 2)->nullable()->after('cheque_number');; 
            $table->string('status')->default('pending')->after('amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cheque_issuances', function (Blueprint $table) {
            $table->dropColumn(['status', 'amount']);
        });
    }
};