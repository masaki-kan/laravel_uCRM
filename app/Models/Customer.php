<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Purchase;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'kana', 'tel', 'email', 'postcode', 'address', 'birthday', 'gender', 'memo'];

    public function scopeSearchCustomer($query, $input = null)
    {
        if (!empty($input)) {
            if (Customer::where('kana', 'LIKE', $input . '%')->orwhere('tel', 'LIKE', $input . '%')->exists()) {
                return $query->where('kana', 'LIKE', $input . '%')->orwhere('tel', 'LIKE', $input . '%');
            }
        }
    }

    /**
     * 　Purchaseと一対多
     */
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
