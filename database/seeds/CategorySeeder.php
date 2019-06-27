<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Category::create([
            'name' => 'SmallAppliances'
        ]);

        \Category::create([
            'name' => 'Dishwashers'
        ]);
    }
}
