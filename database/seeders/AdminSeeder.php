<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Enums\UserRole;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'admin@example.com',
            'password' => 123456,
            'role' => UserRole::ADMIN,
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
