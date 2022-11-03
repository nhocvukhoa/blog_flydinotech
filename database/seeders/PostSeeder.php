<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use File;
use Carbon\Carbon;
use App\Enums\PostStatus;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('database/data/post.json');
        $posts = json_decode($json, true);
        $key = 0;

        foreach ($posts as $post) {
            Post::query()->updateOrCreate([
                'user_id' => User::all()->random()->id,
                'category_id' => $post['category_id'],
                'title' => $post['title'],
                'description' => $post['description'],
                'content' => $post['content'],
                'viewed' => $post['viewed'],
                'status' => PostStatus::getRandomValue(),
                'image' => 'posts/minions.jpg',
                'slug' => 'Bao-Bo-Dao-Nha-muon-Ronaldo-thoi-da-chinh-o-ĐTQG-' . $key++,
                'deleted_at' => null,
                'published_at' => Carbon::yesterday(),
                'created_at' => Carbon::yesterday(),
                'updated_at' => Carbon::today(),
            ]);
        }
    }
}
