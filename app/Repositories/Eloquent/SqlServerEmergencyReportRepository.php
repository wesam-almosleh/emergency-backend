<?php

namespace App\Repositories\Eloquent;

use App\Models\Incidents;
use App\Repositories\Contracts\EmergencyReportRepositoryInterface;

class SqlServerEmergencyReportRepository implements EmergencyReportRepositoryInterface
{
    public function create(array $data): Incidents
    {
        return Incidents::create($data);
    }
}