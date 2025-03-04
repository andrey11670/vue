<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_folder_access extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'folder_id'
    ];
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function folder(){
        return $this->belongsTo(Password::class, 'folder_id', 'id');
    }
}
