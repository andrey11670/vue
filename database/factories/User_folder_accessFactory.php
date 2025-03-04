<?php

namespace Database\Factories;

use App\Models\Folder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User_folder_access>
 */
class User_folder_accessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //$modelIds = Product::inRandomOrder()->pluck('id')->toArray(); // получаем все существующие id из модели
        $folder = Folder::with('user')->get();
        $timeToLive = 0.1;
        //print_r($password[0]->user) ;
        if (!session()->has('custom_model_ids2')) {
            session(['custom_model_ids2' => $folder, now()->addMinutes($timeToLive)]);
        }
        $counter = session('counter4', 0);
        //return  session('custom_model_ids' );
        session(['counter4',  $counter, now()->addMinutes($timeToLive)]);
        // return $counter;
        $folderIds = session('custom_model_ids2');
        //Session::flush();

        //return (session('counter3'));

        $uniqueId = $folderIds[$counter]; // Получаем уникальный идентификатор из массива по порядку
        print_r($counter);
        $folder_id =  $uniqueId->id;
        $counter++; // Увеличиваем счетчик на 1

        session(['counter4' => $counter]); // Обновляем значение счетчика в сессии
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
            'folder_id' => $folder_id
        ];



    }
}
