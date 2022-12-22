<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Purchase;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'memo', 'price', 'is_selling'
    ];


    public function purchases()
    {
        return $this->belongsToMany(Purchase::class) //「belongsToMany」メソッドは中間テーブル先のデータを取得する時使用
            ->withPivot('quantity');
        //withPivoは中間テーブルの値を取得する
    }
}
