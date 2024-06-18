<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::truncate();
        Post::truncate();
        Category::truncate();

        $user = User::factory()->create();

        $personal = Category::create([
            'name'=>'Personal',
            'slug'=>'personal'
        ]);

        $family = Category::create([
            'name'=>'Family',
            'slug'=>'family'
        ]);

        
        $work = Category::create([
            'name'=>'Work',
            'slug'=>'work'
        ]);

        Post::create([
            'user_id' => $user->id,
            'category_id' => $personal->id,
            'title' => 'My first post',
            'slug' => 'my-first-post',
            'excerpt'=> 'My first excerpt',
            'body' => '<p>My first body</p>'
        ]);

        Post::create([
            'user_id' => $user->id,
            'category_id' => $family->id,
            'title' => 'My second post',
            'slug' => 'my-second-post',
            'excerpt'=> 'My second excerpt',
            'body' => '<p>My second body</p>'
        ]);

        Post::create([
            'user_id' => $user->id,
            'category_id' => $work->id,
            'title' => 'My third post',
            'slug' => 'my-third-post',
            'excerpt'=> 'My third excerpt',
            'body' => '<p>My third body</p>'
        ]);
    }
}
