<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            
            $table->string('provider_number')->unique();
            $table->string('npi')->unique();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('extension_name')->nullable();
            $table->string('qualifications')->nullable();
            $table->string('gender');
            $table->string('main_phone')->nullable();
            $table->string('direct_dial')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('web_url')->nullable();
            $table->bigInteger('facility_id')->unsigned();
            $table->string('profession')->nullable();
            $table->string('speciality1')->nullable();
            $table->string('speciality2')->nullable();
            $table->string('title1')->nullable();
            $table->string('title2')->nullable();
            $table->string('title3')->nullable();
            $table->string('title4')->nullable();
            $table->string('title5')->nullable();
            $table->string('status');
            $table->date('date_last_modified')->nullable();
            $table->string('modified_by')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('facility_id')->references('id')->on('facilities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('providers');
    }
}
