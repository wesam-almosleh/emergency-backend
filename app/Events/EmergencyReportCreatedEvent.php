<?php

namespace App\Events;

use App\Models\Incidents;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EmergencyReportCreatedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // متغير عام لحفظ بيانات البلاغ لكي يتمكن الفرونت إند من قراءته
    public $report;

    /**
     * Create a new event instance.
     */
    public function __construct(Incidents $report)
    {
        // استقبال البلاغ عند إطلاق الحدث وتخزينه
        $this->report = $report;
    }

    /**
     * تحديد القناة (Channel) الخاصة بغرفة العمليات التي سيتم البث من خلالها.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('operations-room'),
        ];
    }

    /**
     * تحديد اسم الحدث عند استقباله في الواجهة الأمامية (Frontend).
     */
    public function broadcastAs(): string
    {
        return 'report.created';
    }
}