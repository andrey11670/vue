<?php

namespace App\Http\Controllers\Passwords;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use App\Models\Password;
use App\Models\User_password_access;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class StoreController extends Controller
{
    public function __invoke(PasswordRequest $request){
        try {
            DB::beginTransaction();
        //проверка на ошибки
        $validatedData = $request->validated();
        $username = $validatedData['username'];
        $title = $validatedData['title'];
        $password = $validatedData['password'];
        $project = $validatedData['project'];
        $folder_id = $validatedData['folder_id'];
        $password = Password::create([
            'username' => $username,
            'title' => $title,
            'password' => $password,
            'project' => $project,
            'folder_id' => $folder_id,
            'user_id' =>  Auth::id(),

        ]);
        // Если пользователь User создаем для него доступы к этому паролю
            if (Auth::user()->hasRole('user')) {
                User_password_access::create([
                   'password_id' => $password->id,
                    'user_id' => Auth::id()
                ]);
            }

            DB::commit();
        }catch (\Exception $exception ){
            DB::rollBack();
            return $exception->getMessage();
        }
        return  response()->json(['result' => 'success']);
    }
}
