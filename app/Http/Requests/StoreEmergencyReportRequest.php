<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmergencyReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
{
    return [
        'IncidentType' => 'required|string|max:50',
        'SeverityLevel' => 'required|string|max:20',
        'Status' => 'sometimes|string|max:20',
        'Description' => 'nullable|string',
          'latitude'      => 'required|numeric',
            'longitude'     => 'required|numeric', 
    ];
}
}