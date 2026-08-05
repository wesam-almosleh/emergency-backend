<?php

namespace App\Listeners;

use App\Events\EmergencyReportCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class NotifyOperationsRoomListener
{
    public function __construct()
    {
        //
    }

    public function handle(EmergencyReportCreatedEvent $event): void
    {
        $report = $event->report;

        // هنا يتم كتابة كود إرسال الإشعار لغرفة العمليات (وج أو إرسال WebSockمثلاً تسجيل في اللets)
        Log::info("Operations Room Notified: New Emergency Description '{$report->IncidentType}'");
    }
}

