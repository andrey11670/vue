<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function __invoke(){
        // кнопки пердактирования пользователей админам можно
            if (Auth::user()->hasRole('admin')) {
                $isUser = true;
            }else{
                $isUser = false;
            }

        $user = User::all();
        return  response()->json(['user' => $user, 'isUser' => $isUser]);
    }
}
