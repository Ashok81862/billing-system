<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerCredit extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function customerPayment()
    {
        return $this->hasMany(CustomerPayment::class);
    }

    /**
     * Calculate amount remaining to be paid
     *
     * @return float|int
     */
    public function toPay()
    {
        $total = $this->total_amount;
        $paid = 0;

        foreach ($this->customerPayment as $cp) {
            $paid += $cp->paid_amount;
        }

        return $total - $paid;
    }

}
