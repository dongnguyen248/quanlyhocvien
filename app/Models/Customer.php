<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['CodeCustomer','name','birthday','phone',
    'address','location','Type','Owner','Facebook','dukienthi',
    'createdBy','photo','email','school','first','datefirst','second',
    'datesecond','third','datethird','fourth','datefour','healthyMoney','dayhealth','totalMoney','statusExam','needMoney'];


    public function money(){
        return $this->hasOne(HistoryMoney::class);
    }
}