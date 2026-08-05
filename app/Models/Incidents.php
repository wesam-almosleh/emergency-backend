<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidents extends Model
{
    use HasFactory;

    // ربط الـ Model بالجدول الصحيح في قاعدة البيانات
    protected $table = 'Incidents';
    
    // تحديد المفتاح الأساسي لأنه ليس اسمه id الافتراضي
    protected $primaryKey = 'IncidentID';
    public $incrementing = true;
    // إذا لم تكن أعمدة timestamps (created_at, updated_at) موجودة بالجدول، فعّلي هذا السطر:
    public $timestamps = false;

    // السماح بتعبئة هذه الحقول مباشرة
    protected $fillable = [
        'CitizenID',
        'IncidentType',
        'SeverityLevel',
        'Status',
        'Location',
        'Description',
    ];


  
}
