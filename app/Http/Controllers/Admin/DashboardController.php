<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(){
        $viewData = [
            'title' => 'Dashboard',
            'usersCount' => User::count(),
            'ordersCount' => Order::count(),
        ];

        return view('admin.dashboard', $viewData);
    }
}
