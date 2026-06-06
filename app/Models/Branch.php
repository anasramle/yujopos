<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branches';

    protected $fillable = [
        'company_id',
        'branch_name',
        'code',
        'address',
        'postcode',
        'phone',
        'is_active',
        'is_deleted'
    ];

    public function users()
{
    return $this->hasMany(\App\Models\User::class);
}
}
