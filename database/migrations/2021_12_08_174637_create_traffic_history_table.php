<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrafficHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traffic_history', function (Blueprint $table) {
            $table->id();
            $table->string('pier');
            $table->string('spot_number');
            $table->date('date_of_come');
            $table->date('date_of_leave');
            $table->foreignId('yacht_id')->constratins('yachts');
            $table->string('yacht_name');
            $table->string('yacht_registration_number');
            $table->string('yacht_type');
            $table->string('yacht_length');
            $table->string('yacht_owner');
            $table->foreignId('skipper_id')->constratins('skippers');
            $table->string('skipper_name');
            $table->string('skipper_surname');
            $table->string('skipper_personal_id_number');
            $table->string('skipper_country');
            $table->string('skipper_email');
            $table->string('created_by');
            $table->string('updated_by');
            $table->string('archived_by');
            $table->date('archived_at');
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
        Schema::dropIfExists('traffic_history');
    }
}
