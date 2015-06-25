<?php

use Illuminate\Database\Seeder;
use LocalBooking\Model\Price;

class PriceTableSeeder extends Seeder
{
    public function run()
    {
        Price::unguard();

        $data = [
            [
                'quantity' => 1,
                'price' => 50,
                'option' => ['duration' => '1 day'],
                'resource_id' => 1
            ],
            [
                'quantity' => 1,
                'price' => 250,
                'option' => ['duration' => '1 month'],
                'resource_id' => 2

            ],
            [
                'quantity' => 2,
                'price' => 210,
                'option' => ['duration' => '3 month'],
                'resource_id' => 2
            ],
            [
                'quantity' => 3,
                'price' => 175,
                'option' => ['duration' => '6 month'],
                'resource_id' => 2
            ],
            [
                'quantity' => 1,
                'price' => 210,
                'option' => ['duration' => '1 month'],
                'resource_id' => 2
            ],
            [
                'quantity' => 2,
                'price' => 175,
                'option' => ['duration' => '3 month'],
                'resource_id' => 2
            ],
            [
                'quantity' => 3,
                'price' => 175,
                'option' => ['duration' => '6 month'],
                'resource_id' => 2
            ],
            [
                'quantity' => 1,
                'price' => 175,
                'option' => ['duration' => '1 month'],
                'resource_id' => 2
            ],
            [
                'quantity' => 2,
                'price' => 175,
                'option' => ['duration' => '3 month'],
                'resource_id' => 2
            ],
            [
                'quantity' => 3,
                'price' => 175,
                'option' => ['duration' => '6 month'],
                'resource_id' => 2
            ]
        ];


        foreach ($data as $key => $values) {
            $id = $key + 1;
            $price = Price::create([
                'id' => $id,
                'quantity' => $values['quantity'],
                'tax_rate' => 0.19,
                'price' => $values['price'],
            ]);

            $resource = \LocalBooking\Model\Resource::where('id', $values['resource_id'])->first();

            $resource->prices()->attach($price, array('options' => json_encode($values['option'])));
        }

        Price::reguard();
    }
}
