<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

class CreateResourcesTable extends Migration
{
    protected $table = 'resources';

    public function up()
    {
        if (!Capsule::schema()->hasTable($this->table)) {
            Capsule::schema()->create($this->table, function(Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->text('description');
                $table->json('media');
                $table->boolean('enabled');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Capsule::schema()->dropIfExists($this->table);
    }
}
