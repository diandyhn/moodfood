<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('current_mood')->nullable();
            $table->json('dietary_preferences')->nullable();
            $table->decimal('budget_range', 10, 2)->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['current_mood', 'dietary_preferences', 'budget_range']);
        });
    }
};
