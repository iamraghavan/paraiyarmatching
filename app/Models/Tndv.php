<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tndv extends Model
{
    use HasFactory;

    protected $table = 'tamil_nadu_district_village';

    protected $fillable = [
        'MDDS_STC',
        'STATE_NAME',
        'MDDS_DTC',
        'DISTRICT_NAME',
        'MDDS_Sub_DT',
        'SUB_DISTRICT_NAME',
        'MDDS_PLCN',
        'Area_Name',
    ];
}
