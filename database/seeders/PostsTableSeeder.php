<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Post One',
                'excerpt' => 'Summary of Post One',
                'body' => 'Body of Post One',
                'image_path' => 'Empty',
                'is_published' => false,
                'min_to_read' => 2,
            ],

            [
                'title' => 'Post Two',
                'excerpt' => 'Summary of Post Two',
                'body' => 'Body of Post Two',
                'image_path' => 'Empty',
                'is_published' => true,
                'min_to_read' => 9,
            ],

            [
                'title' => 'Post Tree',
                'excerpt' => 'Summary of Post Tree',
                'body' => 'Body of Post Tree',
                'image_path' => 'Empty',
                'is_published' => false,
                'min_to_read' => 39,
            ],
        ];

        foreach ($posts as $key => $value) {
            Post::create($value);
        }
    }
}
