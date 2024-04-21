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
        Schema::create('deportations', function (Blueprint $table) {
            $table->id();
            $table->foreignId("creted_by_user_id")->constrained("users")->cascadeOnDelete();
            $table->foreignId("deportations_to")->nullable()->constrained("users")->cascadeOnDelete();
            $table->boolean("confirmation")->default(false);
            $table->foreignId("confirm_from")->nullable()->constrained("users")->cascadeOnDelete();
            $table->foreignId("bank_card_id")->constrained("bank_card")->cascadeOnDelete();
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deportations');
    }
};
