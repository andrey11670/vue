<?php

namespace App\Http\Controllers\Access;

use App\Http\Controllers\Controller;
use App\Models\Folder;
use App\Models\Password;
use App\Models\User;
use App\Models\User_folder_access;
use App\Models\User_password_access;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke($id){
        //отправляем на фронт таблицы пользователя чиь доступы редактируются
        $user = User::find($id);
        $password = Password::with('user')->get();
        $passwordAccess = User_password_access::with('password', 'user')->get();
        $folder = Folder::with('user')->get();
        $folderAccess = User_folder_access::with('user')->get();
        //dd($access);
        return  response()->json(['user' => $user, 'passwordAccess' => $passwordAccess, 'folder' => $folder, 'password' => $password, 'folderAccess' => $folderAccess ]);
    }
}
