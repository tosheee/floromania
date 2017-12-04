<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_company')->nullable();
            $table->string('address_com')->nullable();
            $table->string('email_com')->nullable();
            $table->string('phone_com')->nullable();
            $table->string('logo_com')->nullable();
            $table->string('work_time_com')->nullable();
            $table->text('description_com')->nullable();
            $table->text('map_com')->nullable();
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
        Schema::dropIfExists('info_companies');
    }
}
