<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasefieldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key')->unique();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->smallInteger('position');
            $table->boolean('on_grid')->default(false);
            $table->boolean('editable')->default(false);
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
        Schema::dropIfExists('case_field');
    }
}
