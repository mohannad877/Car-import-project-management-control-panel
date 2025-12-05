<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Car::query();

        // Filter by brand
        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }

        // Search in model, brand, year
        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('model', 'like', "%{$search}%")
                    ->orWhere('brand', 'like', "%{$search}%")
                    ->orWhere('year', 'like', "%{$search}%");
            });
        }

        // Sorting
        switch ($request->input('sort', 'newest')) {
            case 'price_asc':
                $query->orderByRaw('auction_price ASC NULLS LAST')->orderBy('id', 'desc');
                break;
            case 'price_desc':
                $query->orderByRaw('auction_price DESC NULLS LAST')->orderBy('id', 'desc');
                break;
            case 'year_desc':
                $query->orderBy('year', 'desc')->orderBy('id', 'desc');
                break;
            case 'year_asc':
                $query->orderBy('year', 'asc')->orderBy('id', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc')->orderBy('id', 'desc');
        }

        $cars = $query->paginate(20);
        $brands = \App\Models\Car::distinct()->orderBy('brand')->pluck('brand');

        return view('cars.index', compact('cars', 'brands'));
    }

    public function show($id)
    {
        $car = \App\Models\Car::findOrFail($id);
        return view('cars.show', compact('car'));
    }

    public function compare(Request $request)
    {
        $ids = explode(',', $request->input('ids', ''));
        $cars = \App\Models\Car::whereIn('id', array_filter($ids))->get();
        return view('cars.compare', compact('cars'));
    }
}
