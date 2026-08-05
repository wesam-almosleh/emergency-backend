<?php
namespace App\Services;

use App\Repositories\Contracts\EmergencyReportRepositoryInterface;
use App\Models\Incidents;
use App\Events\EmergencyReportCreatedEvent;
use Illuminate\Support\Facades\DB;

class EmergencyReportService
{
    protected EmergencyReportRepositoryInterface $repository;

    public function __construct(EmergencyReportRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function createReport(array $reportData)
    {
        // استخراج الإحداثيات القادمة من الـ GPS المباشر للموبايل
        $lat = $reportData['latitude'] ?? null;
        $lng = $reportData['longitude'] ?? null;

        // تحويلهما إلى صيغة geography::Point الخاصة بـ SQL Server وحقنها في Location
        if ($lat && $lng) {
            $reportData['Location'] = DB::raw("geography::Point($lat, $lng, 4326)");
        }

        // إزالة الحقول المؤقتة لكي لا يرسلها لاراول كأعمدة منفصلة غير موجودة في الجدول
        unset($reportData['latitude']);
        unset($reportData['longitude']);

        // إرسال البيانات كاملة إلى الريبوزيتوري لتنفيذ Insert واحد مباشر
        $report = $this->repository->create($reportData);

        // إطلاق الحدث البرمجي

        return $report;
    }

  


public function getReports()
{
    // 1. جلب الحوادث كالمعتاد
    $incidents = Incidents::select(
        '*',
        DB::raw('Location.Lat as latitude'),
        DB::raw('Location.Long as longitude')
    )->get();

    // 2. المرور على كل بلاغ وجلب اسم المستخدم من الجدول مباشرة
    return $incidents->map(function ($incident) {
        $data = $incident->toArray();

        // تنظيف حقل الموقع الثنائي
        unset($data['Location']);

        // جلب اسم المستخدم مباشرة من جدول المستخدمين عبر الـ CitizenID
        $user = DB::table('Users') // <-- ضع هنا اسم جدول المستخدمين لديك في قاعدة البيانات
                    ->where('UserID', $incident->CitizenID) // <-- 'id' هو المفتاح الأساسي، و CitizenID هو المفتاح الأجنبي
                    ->first();

        // إتمام تعبئة الاسم أو وضع "مجهول" إذا لم يتم العثور عليه
        $data['FullName'] = $user ? $user->FullName : 'مجهول';

        return $data;
    });
}
}
