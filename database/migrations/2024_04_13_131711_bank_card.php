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
        Schema::create('bank_card', function (Blueprint $table) {
            $table->id();
            $table->string('numder');
            $table->string('password'); 
            $table->string('tayp')->nullable();
            $table->string('note')->nullable();
            $table->foreignId("bank_account_id")->constrained("bank_account")->cascadeOnDelete();
            $table->foreignId("creted_by_user_id")->constrained("users")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
