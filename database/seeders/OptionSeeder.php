<?php

namespace Database\Seeders;

use App\Enums\OptionStatus;
use App\Enums\OptionType;
use App\Models\Option;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use File;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('database/data/option.json');
        $options = json_decode($json, true);

        foreach ($options as $option) {
            Option::query()->updateOrCreate([
                'title' => $option['title'],
                'content' => $option['content'],
                'type' => $option['type'],
                'status' => $option['status'],
                'created_at' => Carbon::yesterday(),
                'updated_at' => Carbon::today(),
            ]);
        }
    }
}
