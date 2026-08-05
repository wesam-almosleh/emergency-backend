<?php
namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\LoginService;

class LoginController extends Controller
{
    protected LoginService $authService;

    public function __construct(LoginService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        // استدعاء السيرفس للتحقق وتسجيل الدخول
        $result = $this->authService->login($request->validated());

        // إذا كان النتيجة فارغة (أي الحساب غير موجود أو كلمة المرور خطأ)
        if (!$result) {
            return response()->json([
                'message' => 'بيانات الاعتماد غير صحيحة، يرجى التأكد من البريد الإلكتروني أو كلمة المرور.'
            ], 401);
        }

        // إرجاع التوكن وبيانات المستخدم عند النجاح
        return response()->json([
            'message' => 'تم تسجيل الدخول بنجاح',
            'token' => $result['token'],
            'user' => $result['user']
        ], 200);
    }
}