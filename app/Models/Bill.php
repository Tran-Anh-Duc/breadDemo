<?php


namespace App\Models;


class Bill extends BaseModel
{
    const COLUMN_TOTAL = 'total';
    const COLUMN_COUPON = 'coupon';
    const COLUMN_CREATED_BY = 'created_by';
    const COLUMN_USER = 'user';

    protected $table = 'bills';

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('total','price')->withTimestamps();
    }
}
