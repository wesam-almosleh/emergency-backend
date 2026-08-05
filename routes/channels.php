<?php
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('operations-room', function ($Users) {
    // بافتراض أن رقم الـ id الخاص بدور غرفة العمليات في جدول الروبرت هو 2
    return $Users->RoleID === 2;
});