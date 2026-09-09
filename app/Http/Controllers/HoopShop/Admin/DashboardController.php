<?php

namespace App\Http\Controllers\HoopShop\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $productCount = Product::count();
        $customerCount = User::where('role', 'client')->count();
        $orderCount = Order::count();
        $revenue = Order::where('status', '!=', 'Cancelled')->sum('total');

        return view('hoop.admin.dashboard', compact(
            'productCount',
            'customerCount',
            'orderCount',
            'revenue'
        ));
    }
}
