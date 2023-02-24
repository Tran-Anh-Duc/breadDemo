<?php


namespace App\Models;


class bill extends BaseModel
{
    const COLUMN_TOTAL = 'total';
    const COLUMN_COUPON = 'coupon';

    protected $table = 'bills';

    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }
}
