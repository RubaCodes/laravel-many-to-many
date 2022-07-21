<?php

use App\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['Apple','Samsung','Windows','Linux','Microsoft'];

        foreach($tags as $tag){
            $newCategory = new Tag();
            $newCategory->name = $tag;
            $newCategory->slug= Str::of($tag)->slug('-');
            $newCategory->save();
        }
    }
}
