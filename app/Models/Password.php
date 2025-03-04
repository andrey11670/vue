<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

class Password extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'title',
        'username',
        'password',
        'project',
        'user_id',
        'folder_id',
    ];
    public function folder(){
        return $this->belongsTo(Folder::class, 'folder_id', 'id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    protected function accesses(){
        return $this->hasMany(User_password_access::class, 'password_id');
    }
}
