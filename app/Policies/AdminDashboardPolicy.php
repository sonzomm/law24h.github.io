<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;

class AdminDashboardPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function AdminDashboardPolicy(Admin $admin){
        return auth()->guard('admin');
    }

}
