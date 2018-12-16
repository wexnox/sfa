<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Hovedkort',
            'Prosessor',
            'Minnebrikker',
            'Kontrollere',
            'Skjermkort',
            'Stromforsyning',
            'Skjerm',
            'Kabinett'
        ];
        
        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => trim(strtolower($category)),
                'status' => 1,
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
