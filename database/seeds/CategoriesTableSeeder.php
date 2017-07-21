<?php

use Illuminate\Database\Seeder;

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
        ['name'=>'Muscle Building', 'slug'=> 'muscle-building'],
        ['name'=>'Pre Workout', 'slug'=> 'pre-workout'],
        ['name'=>'Health & Wellness', 'slug'=> 'health-wellness'],
        ['name'=>'Fat Burner', 'slug'=> 'fat-burner'],
        ['name'=>'Snacks & more', 'slug'=> 'snacks-more'],
        ['name'=>'Accessories', 'slug'=> 'accessories'],
    	];

    	DB::table('product_categories')->insert($categories);
    }
}
