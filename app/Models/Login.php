<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Login extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'Users'; // أو اسم الجدول لديك في قاعدة البيانات
    protected $primaryKey = 'UserID';
    public $timestamps = false;
    /**
     * الحقول القابلة للتعبئة (الإدخال)
     */
    protected $fillable = [
        'FullName',
        'email',
        'Password',
        'RoleID',
    ];

   
    protected $hidden = [
        'password',
        'remember_token',
    ];

    
   
}