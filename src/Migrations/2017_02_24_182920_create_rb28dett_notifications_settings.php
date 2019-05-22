<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use RB28DETT\Notifications\Models\Settings;

class CreateRB28DETTNotificationsSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rb28dett_notifications_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('mail_enabled');
            $table->timestamps();
        });

        Settings::create([
            'mail_enabled'  => false,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rb28dett_notifications_settings');
    }
}
