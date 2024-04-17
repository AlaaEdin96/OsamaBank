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
        Schema::table('bank_account', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bank_account', function (Blueprint $table) {
            $table->string('email')->nullable();
            $table->string('account_number')->nullable();
            $table->string('iban_number')->nullable();
            $table->string('phone_contact')->nullable();
            $table->date('expires')->nullable();

        });
    }
};
