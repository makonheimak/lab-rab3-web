<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use MaksimYurash\EcommerceSuite\Database\Seeders\EcommerceSuiteSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(EcommerceSuiteSeeder::class);
    }
}
