<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategoris')->insert(
            [
                'kategori' => 'CCTV',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori' => 'Wifi',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        );
    }
}
