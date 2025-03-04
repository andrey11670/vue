<?php

namespace App\Http\Controllers\Passwords;

use App\Http\Controllers\Controller;
use App\Models\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DestroyController extends Controller
{
    public function __invoke($id){
        //удаляем пароль
        $password = Password::find($id);
        $password->delete();
        return  response()->json();

    }
}
