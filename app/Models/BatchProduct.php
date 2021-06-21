<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchProduct extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = ['pivot'];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
