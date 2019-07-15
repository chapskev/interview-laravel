<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SupplierSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(BranchSeeder::class);
        $this->call(HeadquarterSeeder::class);
        $this->call(OrderSeeder::class);
    }
}
