<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderAffiliationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_affiliations', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('provider_id')->unsigned();
            $table->bigInteger('facility_id')->unsigned();
            $table->boolean('primary');

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('provider_id')->references('id')->on('providers');
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
        Schema::dropIfExists('provider_affiliations');
    }
}
