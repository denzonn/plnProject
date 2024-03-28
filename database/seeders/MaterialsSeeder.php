<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('materials_type')->insert([
            [
                'name' => 'Filter',
            ],
            [
                'name' => 'Fast Mooving',
            ],
            [
                'name' => 'Critical',
            ],
        ]);
    }
}
