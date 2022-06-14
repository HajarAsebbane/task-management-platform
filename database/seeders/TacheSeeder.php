<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class TacheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('taches')->insert([
            'user_id'=>'1',
            'project_id' => '1',
            'datedebut'  => '2022-04-10',
            'datefin' => '2022-04-20',
            'name'=>'Conception',
            'description' => Str::random(10)
        ]);
    }
}
