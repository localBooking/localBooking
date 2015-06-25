<?php

use Illuminate\Database\Seeder;
use LocalBooking\Model\Resource;

class ResourceTableSeeder extends Seeder
{
    public function run()
    {
        Resource::unguard();
        Resource::create([
            'id' => 1,
            'name' => 'Meetingraum',
            'description' => 'Unser super Meetingraum',
            'enabled' => true
        ]);

        Resource::create([
            'id' => 2,
            'name' => 'Arbeitsplatz',
            'description' => 'Unsere supertollen Schreibtische',
            'enabled' => true
        ]);

        Resource::reguard();
    }
}
