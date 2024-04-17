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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId("confirmation_by_user_id")->nullable()->constrained("users")->cascadeOnDelete();
            $table->foreignId("bank_account_id")->constrained("bank_account")->cascadeOnDelete();
            $table->string('statuses_old')->nullable();
            $table->string('statuses_now')->nullable();
            $table->boolean("confirmation")->default(false);
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
