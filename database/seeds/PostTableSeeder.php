<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Facades\Hash;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $category1 = Category::create([
            'name'=>'news'
        ]);

        $category2 = Category::create([
            'name'=>'marketting'
        ]);

        $category3 = Category::create([
            'name'=>'partnership'
        ]);

        $author1 = User::create([
            'name'=>'John Doe',
            'email'=>'john@doe.com',
            'password'=>Hash::make('password')
        ]);

        $author2 = User::create([
            'name'=>'Jane Doe',
            'email'=>'jane@doe.com',
            'password'=>Hash::make('password')
        ]);

        $post1 = $author1->posts()->create([
            'title'=>'We relocated our office to a new designed garage',
            'description'=>'Hello there 1',
            'content'=>'content 1',
            'category_id'=>$category1->id,
            'image'=>'posts/1.jpg',
        ]);

        $post2 = $author2->posts()->create([
            'title'=>'Top 5 brilliant content marketing strategies',
            'description'=>'Hello there 2',
            'content'=>'content 2',
            'category_id'=>$category2->id,
            'image'=>'posts/2.jpg',
            'user_id'=>$author2->id
        ]);

        $post3 = $author1->posts()->create([
            'title'=>'Best practices for minimalist design with example',
            'description'=>'Hello there 3',
            'content'=>'content 3',
            'category_id'=>$category3->id,
            'image'=>'posts/3.jpg'
        ]);

        $post4 = $author2->posts()->create([
            'title'=>'Congratulate and thank to Maryam for joining our team',
            'description'=>'Hello there 4',
            'content'=>'content 4',
            'category_id'=>$category2->id,
            'image'=>'posts/4.jpg'
        ]);

        $tag1 = Tag::create([
            'name'=>'job'
        ]);

        $tag2 = Tag::create([
            'name'=>'customers'
        ]);

        $tag3 = Tag::create([
            'name'=>'record'
        ]);
        
        $post1->tags()->attach([$tag1->id, $tag2->id]);
        $post2->tags()->attach([$tag2->id, $tag3->id]);
        $post3->tags()->attach([$tag1->id, $tag3->id]);

    }
}
