<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

class CreateResourcePricesTable extends Migration
{
    protected $table = 'resource_price';

    public function up()
    {
        if (!Capsule::schema()->hasTable($this->table)) {
            Capsule::schema()->create($this->table, function(Blueprint $table) {
                $table->integer('resource_id')->unsigned();
                $table->integer('price_id')->unsigned();
                $table->json('options');

                $table->foreign('resource_id')->references('id')->on('resources')->onDelete('cascade');
                $table->foreign('price_id')->references('id')->on('prices')->onDelete('cascade');
            });
        }
    }

    public function down()
    {
        Capsule::schema()->dropIfExists($this->table);
    }
}
