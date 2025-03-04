<?php

namespace App\Http\Controllers\AccessUser;

use App\Http\Controllers\Controller;
use App\Models\User_password_access;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UpdateController extends Controller
{
    public function __invoke(Request $request, $id){
        // USER редактирует права на доступ к своему Паролю
        try {
            DB::beginTransaction();
        // Находим все дотупы к нашему паролю $id и удаляем их
        User_password_access::where('password_id', $id)->delete();
        $password = $request->checkedPassword;
        $checkedPassword = [];
        foreach ( $password as $item) {
            // создаем переданные доступы пользователям $id которых мы получили
            $access = User_password_access::create([
                'user_id' => $item,
                'password_id' => $id
            ]);
            // передаем $id доступов на фронт
            $checkedPassword[] = $access->user_id;
        }
            DB::commit();
        }catch (\Exception $exception ){
            DB::rollBack();
            return $exception->getMessage();
        }


        return  response()->json(['checkedPassword' => $checkedPassword]);
    }
}
