<?php

namespace App\Repositories\Contracts;

use App\Models\Incidents;

interface EmergencyReportRepositoryInterface
{
    public function create(array $data): Incidents;
}