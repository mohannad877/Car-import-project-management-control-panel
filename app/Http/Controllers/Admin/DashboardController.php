<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // إحصائيات السيارات
        $totalCars = \App\Models\Car::count();
        $carsThisMonth = \App\Models\Car::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $carsLastMonth = \App\Models\Car::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();
        $brandsCount = \App\Models\Car::distinct('brand')->count('brand');
        $recentCars = \App\Models\Car::latest()->take(5)->get();

        // متوسط السعر
        $averagePrice = \App\Models\Car::whereNotNull('auction_price')
            ->avg('auction_price');

        // إحصائيات المستخدمين
        $totalUsers = \App\Models\User::count();

        // إحصائيات جهات الاتصال
        $totalContacts = \App\Models\Contact::count();
        $unreadContacts = \App\Models\Contact::where('is_read', false)->count();
        $recentContacts = \App\Models\Contact::latest()->take(5)->get();
        $contactsThisWeek = \App\Models\Contact::where('created_at', '>=', now()->subWeek())->count();

        // إحصائيات المفضلات
        $totalFavorites = \App\Models\Favorite::count();

        // أفضل 5 علامات تجارية
        $topBrands = \App\Models\Car::select('brand', \DB::raw('count(*) as total'))
            ->groupBy('brand')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalCars',
            'carsThisMonth',
            'carsLastMonth',
            'brandsCount',
            'recentCars',
            'averagePrice',
            'totalUsers',
            'totalContacts',
            'unreadContacts',
            'recentContacts',
            'contactsThisWeek',
            'totalFavorites',
            'topBrands'
        ));
    }
}
