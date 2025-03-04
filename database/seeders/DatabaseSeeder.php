<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Folder;
use App\Models\Password;
use App\Models\User;
use App\Models\User_folder_access;
use App\Models\User_password_access;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(10)->create();
         Folder::factory(10)->create();
         Password::factory(10)->create();
         User_password_access::factory(10)->create();
         User_folder_access::factory(10)->create();


        // \App\Models\Users::factory()->create([
        //     'name' => 'Test Users',
        //     'email' => 'test@example.com',
        // ]);
    }
}
