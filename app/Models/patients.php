<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class patients extends Model
{
    protected $primaryKey = 'patientID';

        protected $fillable = [
            'patientID',
            'individualID',
            'careGroupID',
            'familyCode',
            'admissionDate',
            'dischargeDate'
        ];
        public function individual()
        {
            return $this->belongsTo(Individuals::class, 'individualID', 'individualID');
        }

    }
