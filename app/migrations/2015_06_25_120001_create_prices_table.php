<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

class CreatePricesTable extends Migration
{
    protected $table = 'prices';

    public function up()
    {
        if (!Capsule::schema()->hasTable($this->table)) {
            Capsule::schema()->create($this->table, function(Blueprint $table) {
                $table->increments('id');
                $table->integer('quantity');
                $table->float('price');
                $table->float('tax_rate');
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
