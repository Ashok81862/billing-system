<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $hidden = ['pivot'];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function batchProducts()
    {
        return $this->hasMany(BatchProduct::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'batch_products', 'product_id', 'batch_id');
    }
}
