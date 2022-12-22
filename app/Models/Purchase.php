<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\Item;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 'status'
    ];

    /**
     * Customerと多対1
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class) //「belongsToMany」メソッドは中間テーブル先のデータを取得する時使用
            ->withPivot('quantity');
        //withPivoは中間テーブルの値を取得できる
    }
}
