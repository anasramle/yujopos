<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    //  CHECK ROLE
    protected function isAdmin()
    {
        return Auth::user()->role_id == 1;
    }

    protected function isManager()
    {
        return Auth::user()->role_id == 2;
    }

    protected function isCashier()
    {
        return Auth::user()->role_id == 3;
    }

    //  GET BRANCH
    protected function getBranchId()
    {
        $user = Auth::user();

        // ADMIN
        if ($this->isAdmin()) {
            return session('branch_id');
        }

        // MANAGER / CASHIER → auto branch
        return $user->branch_id;
    }
}
