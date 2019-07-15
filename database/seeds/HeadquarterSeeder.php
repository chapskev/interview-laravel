<?php

use Illuminate\Database\Seeder;

class HeadquarterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(shopApp\Headquarter::class, 1)->create();
    }
}
