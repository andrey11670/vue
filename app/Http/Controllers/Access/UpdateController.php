<?php

namespace App\Http\Controllers\Access;

use App\Http\Controllers\Controller;
use App\Models\User_folder_access;
use App\Models\User_password_access;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UpdateController extends Controller
{
    public function __invoke(Request $request, $id){
        // ADMIN редактирует доступы пользователя $id  к Паролям и Папкам
        try {
            DB::beginTransaction();
        // ADMIN удаляет все таблицы с доступами к Паролям и Папкам
        User_password_access::where('user_id', $id)->delete();
        $password = $request->checkedPassword;
        $checkedPassword = [];
        foreach ( $password as $item) {
        // по переданному массиву с id паролями которые мы разрешаем доступ этому $id, создаем строчку доступа
            $access = User_password_access::create([
                'user_id' => $id,
                'password_id' => $item
            ]);
            //передаем на фронт id паролей с доступами
            $checkedPassword[] = $access->password_id;
        }

        $folderRequest =  $request->checkedFolder;
        // ADMIN  удаляет все таблицы с доступами к Папкам
        User_folder_access::where('user_id', $id)->delete();
        $checkedFolder = [];
        foreach ( $folderRequest as $item) {
            // по переданному массиву с id папками кот мы разрешаем доступ создаем строчку доступа
            $folder = User_folder_access::create([
                'user_id' => $id,
                'folder_id' => $item
            ]);
            //передаем на фронт id папок с доступами
            $checkedFolder[] = $folder->folder_id;
        }
            DB::commit();
        }catch (\Exception $exception ){
            DB::rollBack();
            return $exception->getMessage();
        }

        return  response()->json(['checkedPassword' => $checkedPassword,'checkedFolder' => $checkedFolder ]);
    }
}
