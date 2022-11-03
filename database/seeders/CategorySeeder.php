<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use File;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('database/data/category.json');
        $categories = json_decode($json, true);

        foreach ($categories as $category) {
            Category::query()->updateOrCreate([
                'title' => $category['title'],
                'description' => $category['description'],
                'status' => $category['status'],
                'order_by' => $category['order_by'],
                'parent_id' => $category['parent_id'],
                'slug' => $category['slug'],
                'created_at' => Carbon::yesterday(),
                'updated_at' => Carbon::today(),
            ]);
        }
    }
}
