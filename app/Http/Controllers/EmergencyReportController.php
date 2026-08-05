<?php

namespace App\Http\Controllers;
use App\Models\Incidents;
use App\Http\Requests\StoreEmergencyReportRequest;
use App\Services\EmergencyReportService;

class EmergencyReportController extends Controller
{
    protected EmergencyReportService $service;

    public function __construct(EmergencyReportService $service)
    {
        $this->service = $service;
    }

   public function store(StoreEmergencyReportRequest $request)
{
    // 1. جلب البيانات المرسلة من الطلب (مثل نوع الحادث والوصف)
    $data = $request->validated();

    // 2. سحب معرف المواطن تلقائياً من الـ Token الخاص بالمستخدم الحالي وحقنه في المصفوفة
    // (تأكد أن اسم الحقل في جدول المستخدمين لديك هو id، وإن كان اسمه citizen_id فاستبدلها بما يناسب جدولك)
    $data['CitizenID'] = auth()->id(); 

    // 3. إرسال المصفوفة كاملة إلى الـ Service كما هي
    $report = $this->service->createReport($data);
    
        return response()->json([
            'message' => 'Emergency report created successfully',
            'data' => $report
        ], 201);
    
    }

        public function index()
        {
         // جلب البلاغات من قاعدة البيانات مرتبة من الأحدث للأقدم
        $reports = $this->service->getReports();

        return response()->json($reports);
        }

}