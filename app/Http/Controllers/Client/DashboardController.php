<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $viewData = [
            'title' => 'Dashboard',
        ];

        return view('client.dashboard', $viewData);
    }
}
