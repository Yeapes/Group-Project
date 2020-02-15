<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Prescription_Medicine extends Model
{
    protected $table = 'medicine_prescription';

    public static function thisMonthTrends($year,$month){
        $c=DB::table('medicine_prescription')
        ->join('medicines',"medicines.id","=","medicine_prescription.medicine_id")
        ->selectRaw("name_sinhala,name_english,medicine_id,count(medicine_id) as issues")
        ->whereRaw("year(medicine_prescription.created_at)=$year")
        ->whereRaw("month(medicine_prescription.created_at)=$month")
        ->groupBy('medicine_id')->get();
        return $c;
    }
}
// select medicine_id,count(medicine_id) as issues from `medicine_prescription` where year(`created_at`) = 2020 and month(`created_at`) = 2 group by `medicine_id`