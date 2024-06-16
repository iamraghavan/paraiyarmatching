<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserPayment extends Model
{
    protected $fillable = [
        'user_pmid', 'name', 'phone_number', 'package_details', 'paid_status', 'date_of_paid', 'plan_expired_date'
    ];

    protected $dates = ['date_of_paid', 'plan_expired_date'];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->paid_status && $model->date_of_paid) {
                switch ($model->package_details) {
                    case '3 Months':
                        $model->plan_expired_date = Carbon::parse($model->date_of_paid)->addMonths(3);
                        break;
                    case '6 Months':
                        $model->plan_expired_date = Carbon::parse($model->date_of_paid)->addMonths(6);
                        break;
                    case '9 Months':
                        $model->plan_expired_date = Carbon::parse($model->date_of_paid)->addMonths(9);
                        break;
                    case '12 Months':
                        $model->plan_expired_date = Carbon::parse($model->date_of_paid)->addMonths(12);
                        break;
                }
            }
        });
    }
}
