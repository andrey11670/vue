<?php

namespace App\Http\Controllers\Passwords;

use App\Http\Controllers\Controller;
use App\Models\Folder;
use App\Models\Password;
use App\Models\User;
use App\Models\User_password_access;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class IndexController extends Controller
{
    public function __invoke(Request $request){
        // Показ паролей
        $folder = Folder::all();
        $user = User::all();
            // Админу показывают все пароли
            if (Auth::user()->hasRole('admin')) {
                // Пользователь имеет роль администратора
                $query = Password::query()->with('user', 'folder');
                $isUser = true;
            } else{
                // Юзеру показывают Пароли доступные ему
                $isUser = Auth::id();
                $access = User_password_access::where('user_id', Auth::id())->select('password_id')->get();
                $arrAccess = [];
                foreach ($access as $item){
                    $arrAccess[] = $item->password_id;
                }
                $query = Password::query()->with('user', 'folder')->whereIn('id', $arrAccess);
            }


        $username_request = $request ->input('username');
        $title_request = $request ->input('title');
        $folder_request = $request ->input('folder_id');
        $user_id_request = $request ->input('user_id');

        //Фильтры
        if ($username_request){
            $query ->where('username', 'like', '%'.$username_request.'%');
        }

        if ($title_request){
            $query ->where('title', 'like', '%'.$title_request.'%');
        }
        if ($folder_request){
            $query ->where('folder_id', $folder_request);
        }
        if ($user_id_request){
            $query ->where('user_id', $user_id_request);
        }
        //проверяем на пустоту пагинацию по умолчанию ставим 20
        $perPage = $limit ?? 20;
        $password = $query->paginate($perPage);


       return  response()->json(['password' => $password, 'user' => $user, 'folder' => $folder, 'isUser'=> $isUser]);
    }
}
