<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Category;
class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Computer','Smartphone','Tv','Pc Portatili','Fotocamere'];

        foreach($categories as $category){
            $newCategory = new Category();
            $newCategory->name = $category;
            $newCategory->slug= Str::of($category)->slug('-');
            $newCategory->save();
        }
    }
}
