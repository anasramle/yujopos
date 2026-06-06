<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use SoftDeletes;

    protected $table = 'inventory';

    protected $fillable = [
        'product_id',
        'branch_id',
        'company_id',
        'qty'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
