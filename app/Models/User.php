<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * ROLE CONSTANTS
     */
    const ROLE_ADMIN = 1;
    const ROLE_MANAGER = 2;
    const ROLE_CASHIER = 3;

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'company_id',
        'branch_id',
        'is_deleted',
    ];

    /**
     * Hidden attributes
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

 
    protected $casts = [
        'is_deleted' => 'boolean',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //   RELATIONSHIPS


    // User belongs to Company
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    // User belongs to Role
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    // User belongs to Branch
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * ROLE CHECKS
     */

    public function isAdmin(): bool
    {
        return $this->role_id == self::ROLE_ADMIN;
    }

    public function isManager(): bool
    {
        return $this->role_id == self::ROLE_MANAGER;
    }

    public function isCashier(): bool
    {
        return $this->role_id == self::ROLE_CASHIER;
    }


    public function hasBranch(): bool
    {
        return !is_null($this->branch_id);
    }
}
