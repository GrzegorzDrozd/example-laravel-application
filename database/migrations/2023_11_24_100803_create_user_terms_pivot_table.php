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
        Schema::create('terms_acceptance_log', function (Blueprint $table) {
            $userIdColumn = 'user_id';
            $termsIdColumn = 'terms_id';
            $table->unsignedBigInteger($userIdColumn);
            $table->unsignedBigInteger($termsIdColumn);
            $table->primary([$userIdColumn, $termsIdColumn]);

            $table->foreign($userIdColumn, 'fk_terms_acceptance_user')->references('id')->on('users');
            $table->foreign($termsIdColumn, 'fk_terms_acceptance_terms')->references('id')->on('terms');
            $table->timestamp('created_at', 0)->default(now());
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('terms_acceptance_log');
    }
};
