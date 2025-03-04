<?php

namespace App\Http\Controllers\Passwords;

use App\Http\Controllers\Controller;

use App\Models\Folder;
use App\Models\User;
use Illuminate\Http\Request;
use mysql_xdevapi\Result;

class CreateController extends Controller
{
    public function __invoke(){
        // Создаем пароль
        $folder = Folder::all();
        return  response()->json(['folder' => $folder]);
    }
}
