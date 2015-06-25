<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

class CreateBookingsTable extends Migration
{
    protected $table = 'bookings';

    public function up()
    {
        if (!Capsule::schema()->hasTable($this->table)) {
            Capsule::schema()->create($this->table, function(Blueprint $table) {
                $table->increments('id');
                $table->dateTime('start');
                $table->dateTime('end');
                $table->boolean('confirmed');
                $table->timestamps();

                $table->foreign('resource_id')->references('id')->on('resources')->onDelete('cascade');
            });


        }
    }

    public function down()
    {
        Capsule::schema()->dropIfExists($this->table);
    }
}
