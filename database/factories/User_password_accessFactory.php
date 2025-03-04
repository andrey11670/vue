<?php

namespace Database\Factories;

use App\Models\Password;
use App\Models\User_password_access;
use Illuminate\Database\Eloquent\Factories\Factory;
use function Laravel\Prompts\password;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class User_password_accessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //$modelIds = Product::inRandomOrder()->pluck('id')->toArray(); // получаем все существующие id из модели
        $password = Password::with('user')->get();
        $timeToLive = 0.1;
        //print_r($password[0]->user) ;
        if (!session()->has('custom_model_ids')) {
            session(['custom_model_ids' => $password, now()->addMinutes($timeToLive)]);
        }
        $counter = session('counter3', 0);
        //return  session('custom_model_ids' );
        session(['counter3',  $counter, now()->addMinutes($timeToLive)]);
        // return $counter;
        $passwordIds = session('custom_model_ids');
        //Session::flush();

        //return (session('counter3'));

        $uniqueId = $passwordIds[$counter]; // Получаем уникальный идентификатор из массива по порядку
        print_r($counter);
        $password_id =  $uniqueId->id;
        $counter++; // Увеличиваем счетчик на 1

        session(['counter3' => $counter]); // Обновляем значение счетчика в сессии
        $user_id = $uniqueId->user;
        if ($counter > 9){
            $counter = 0;
        }
        /*print_r( $counter);
        print_r( $user_id->role === 'user' );
        print_r(['user_id' => $user_id->id,
                'password_id' => $password[$counter]->id]);*/

            return [
                'user_id' => $user_id->id,
                'password_id' => $password_id
            ];



    }
}
