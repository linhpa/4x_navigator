<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDevices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('ip')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('platform')->nullable();
            $table->string('device_name')->nullable();
            $table->string('browser')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->smallInteger('attempts')->default(0);
            $table->timestamps();
            $table->index('ip');
            $table->index('user_agent');
            $table->index(['ip', 'user_agent']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('devices', function (Blueprint $table) {
            $table->dropIndex(['ip']);
            $table->dropIndex(['user_agent']);
            $table->dropIndex(['ip', 'user_agent']);
        });
        Schema::dropIfExists('devices');
        
    }
}
