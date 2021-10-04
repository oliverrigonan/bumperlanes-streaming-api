<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_logs', function (Blueprint $table) {
            $table->id();

            $table->dateTime('log_date', $precision = 0);
            $table->bigInteger('provider_id')->unsigned();
            $table->string('modified_by');
            $table->string('modified_field');
            $table->text('old_value');
            $table->text('new_value');

            $table->softDeletes();
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
        Schema::dropIfExists('provider_logs');
    }
}
