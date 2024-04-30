<?php

namespace Database\Seeders;

use App\Models\Phone;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\UserList;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        UserList::factory()->count(10)->create();
        Phone::factory()->count(100)->create();
    }
}
