<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __invoke(UserRequest $request, $id){
        $validatedData = $request->validated();
        $user = User::find($id);
        $user->update($validatedData);

        return  response()->json(['user' => $user, 'result' => 'success']);
    }
}
