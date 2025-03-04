<?php

namespace App\Http\Controllers\Passwords;

use App\Http\Controllers\Controller;
use App\Models\Folder;
use App\Models\Password;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke($id){
        //выбор одного проля
        $password = Password::find($id);
        $folder = Folder::all();

        return  response()->json(['password' => $password, 'folder' => $folder] );
    }
}
