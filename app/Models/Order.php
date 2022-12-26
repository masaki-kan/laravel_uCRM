<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\Subtotal;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

    protected static function booted()
    {
        //sql分のスコープをここで設定
        static::addGlobalScope(new Subtotal);
    }

    public function scopeBetweenDate($query, $startDate = null, $endDate = null)
    {
        //$queryは staticのbooted()を指している
        if (is_null($startDate) && is_null($endDate)) {
            return $query;
        }
        if (!is_null($startDate) && is_null($endDate)) {

            return $query->where('created_at', ">=", $startDate);
        }
        if (is_null($startDate) && !is_null($endDate)) {

            $endDate_1 = Carbon::parse($endDate)->addDays(1);
            return $query->where('created_at', '<=', $endDate_1);
        }
        if (!is_null($startDate) && !is_null($endDate)) {

            $endDate_1 = Carbon::parse($endDate)->addDays(1);
            return $query->where('created_at', ">=", $startDate)
                ->where('created_at', '<=', $endDate_1);
        }
    }
}
