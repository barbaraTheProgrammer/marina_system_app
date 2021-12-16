<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrafficTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traffic', function (Blueprint $table) {
            $table->id();
            $table->foreignId('place_id')
                ->constrains('places')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->date('date_of_come');
            $table->date('date_of_leave');
            $table->foreignId('yacht_id')
                ->constrains('yachts')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('skipper_id')
                ->constrains('skippers')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('created_by');
            $table->string('updated_by');
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
        Schema::dropIfExists('traffic');
    }
}
