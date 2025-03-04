<?php

namespace App\Http\Controllers\Folders;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function __invoke(){
        //создание папки
        return response()->json();
    }
}
