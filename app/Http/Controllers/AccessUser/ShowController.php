<?php

namespace App\Http\Controllers\AccessUser;

use App\Http\Controllers\Controller;
use App\Models\Password;
use App\Models\User;
use App\Models\User_password_access;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowController extends Controller
{
    public function __invoke($id)
    {
        // от USER отправляем на фронт таблицы Пароля доступы к которому мы редактируем
        $userId = User::find( Auth::id() );
        $passwordId = Password::find($id);
        $user = User::where('role', 'user')->where('id','!=',  Auth::id())->get();

        $passwordAccess = User_password_access::with('password', 'user')->get();

        return  response()->json([
            'user' => $user,
            'passwordAccess' => $passwordAccess,
            'passwordId' => $passwordId,
            'userId' => $userId
        ]);

    }
}
