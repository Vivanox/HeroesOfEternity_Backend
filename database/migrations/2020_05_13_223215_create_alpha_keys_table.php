<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlphaKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alpha_keys', function (Blueprint $table) {
            $table->id();
            $table->string('recipient_email');
            $table
                ->foreignId('alpha_sign_up_id')
                ->nullable()
                ->references('id')
                ->on('alpha_sign_ups');
            $table
                ->foreignId('recipient_user_id')
                ->nullable()
                ->references('id')
                ->on('users');
            $table
                ->foreignId('assigned_by')
                ->references('id')
                ->on('users');
            $table->string('key');
            $table->timestamp('email_sent_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alpha_keys');
    }
}
