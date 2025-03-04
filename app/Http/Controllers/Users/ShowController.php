<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke($id){

        $user = User::find($id);

        return  response()->json(['user' => $user]);

    }
}
