<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mockery\Generator\StringManipulation\Pass\Pass;

class User_password_access extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'password_id'
    ];
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function password(){
        return $this->belongsTo(Password::class, 'password_id', 'id');
    }
}
