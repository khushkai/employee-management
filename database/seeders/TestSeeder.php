<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Test;
class TestSeeder extends Seeder
{

    public function run(): void
    {
         Test::factory()->count(5000)->create();
    }
//     for ($i=0; $i<10; $i++) {
//     \App\Models\Test::factory()->count(5000)->create();
// }
}
