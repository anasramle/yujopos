<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'company_id',
        'sn_no',
        'item_name',
        'item_desc',
        'img',
        'price',
        'category_id',
        'is_deleted'
    ];

    public function inventories()
{
    return $this->hasMany(Inventory::class, 'product_id');
}
}
