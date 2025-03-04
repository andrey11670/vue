<?php

namespace Database\Factories;

use App\Models\Folder;
use App\Models\Password;
use App\Models\User;
use App\Models\UserPasswordaccess;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Session;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Password>
 */
class PasswordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        Session::flush();
        $user = User::get()->random();

        return [
            'title' => fake() -> text('7'),
            'username' => fake() -> firstName(),
            'password' => fake() -> password('6', '8'),
            'project' => fake() -> firstNameMale(),
            'user_id' =>  $user->id,
            'folder_id' => Folder::get()->random()->id,
        ];
    }
}
