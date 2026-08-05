<?php
namespace App\Services;

use App\Models\Login; // أو نموذج المواطن لديك (Citizen)

class LoginService
{
    public function login(array $credentials)
    {
        // 1. البحث عن المستخدم في قاعدة البيانات بواسطة البريد الإلكتروني
        $user = Login::where('email', $credentials['email'])->first();

        // 2. التحقق مما إذا كان المستخدم موجوداً وهل كلمة المرور مطابقة للحفظ المشفر
        if (!$user || $user->Password !== $credentials['Password'])
        {
            return null; // فشل التحقق
        }

        // 3. إنشاء توكن جديد للمستخدم (في حال استخدام Laravel Sanctum)
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'token' => $token,
            'user' => $user
        ];
    }
}