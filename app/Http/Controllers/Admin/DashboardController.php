<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Bread;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalBreads = Bread::count();
        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard' , compact(
            'totalOrders',
            'pendingOrders',
            'totalBreads',
            'recentOrders',
        ));
    }
}
