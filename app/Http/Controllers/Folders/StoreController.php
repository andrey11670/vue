<?php

namespace App\Http\Controllers\Folders;

use App\Http\Controllers\Controller;
use App\Http\Requests\FolderRequest;
use App\Models\Folder;
use App\Models\User_folder_access;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function __invoke(FolderRequest $request){
        // Создаем папку
        $validatedData = $request->validated();
        $name = $validatedData['name'];
        try {
            DB::beginTransaction();
        $folder = Folder::create([
            'name' => $name,
            'user_id' =>  Auth::id(),

        ]);
        // Если эту папку создал USER сразу создаем доступы к этой папке
            if (Auth::user()->hasRole('user')) {
                User_folder_access::create([
                    'folder_id' => $folder->id,
                    'user_id' => Auth::id()
                ]);
            }
            DB::commit();
        }catch (\Exception $exception ){
            DB::rollBack();
            return $exception->getMessage();
        }

        return response()->json(['result' =>'success']);

    }
}
