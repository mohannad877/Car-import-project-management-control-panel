<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Car::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('brand', 'like', "%{$search}%")
                    ->orWhere('model', 'like', "%{$search}%")
                    ->orWhere('year', 'like', "%{$search}%");
            });
        }

        // Filter by brand
        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }

        // Sorting
        switch ($request->input('sort', 'newest')) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'price_high':
                $query->orderBy('auction_price', 'desc');
                break;
            case 'price_low':
                $query->orderBy('auction_price', 'asc');
                break;
            default: // newest
                $query->orderBy('created_at', 'desc');
        }

        $cars = $query->paginate(15)->appends($request->all());

        return view('admin.cars.index', compact('cars'));
    }

    public function create()
    {
        return view('admin.cars.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand' => 'required|string|max:80',
            'model' => 'required|string|max:120',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'grade' => 'nullable|string|max:80',
            'mileage' => 'nullable|integer|min:0',
            'condition_status' => 'nullable|string|max:60',
            'auction_price' => 'nullable|numeric|min:0',
            'estimated_cost' => 'nullable|numeric|min:0',
            'currency' => 'required|string|max:8',
            'location' => 'nullable|string|max:120',
            'transmission' => 'nullable|string|max:40',
            'engine' => 'nullable|string|max:60',
            'fuel' => 'nullable|string|max:30',
            'drive_type' => 'nullable|string|max:30',
            'color' => 'nullable|string|max:40',
            'vin' => 'nullable|string|max:32',
            'lot_number' => 'nullable|string|max:32',
            'image_url' => 'nullable|url|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        // Handle multiple images upload
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('cars', 'public');
                $imagePaths[] = $path;
            }
        }

        $validated['images'] = $imagePaths;

        \App\Models\Car::create($validated);

        return redirect()->route('admin.cars.index')->with('success', 'تم إضافة السيارة بنجاح');
    }

    public function show(string $id)
    {
        $car = \App\Models\Car::findOrFail($id);
        return view('admin.cars.show', compact('car'));
    }

    public function edit(string $id)
    {
        $car = \App\Models\Car::findOrFail($id);
        return view('admin.cars.edit', compact('car'));
    }

    public function update(Request $request, string $id)
    {
        $car = \App\Models\Car::findOrFail($id);

        $validated = $request->validate([
            'brand' => 'required|string|max:80',
            'model' => 'required|string|max:120',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'grade' => 'nullable|string|max:80',
            'mileage' => 'nullable|integer|min:0',
            'condition_status' => 'nullable|string|max:60',
            'auction_price' => 'nullable|numeric|min:0',
            'estimated_cost' => 'nullable|numeric|min:0',
            'currency' => 'required|string|max:8',
            'location' => 'nullable|string|max:120',
            'transmission' => 'nullable|string|max:40',
            'engine' => 'nullable|string|max:60',
            'fuel' => 'nullable|string|max:30',
            'drive_type' => 'nullable|string|max:30',
            'color' => 'nullable|string|max:40',
            'vin' => 'nullable|string|max:32',
            'lot_number' => 'nullable|string|max:32',
            'image_url' => 'nullable|url|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        // Handle new images upload
        if ($request->hasFile('images')) {
            $imagePaths = $car->images ?? [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('cars', 'public');
                $imagePaths[] = $path;
            }
            $validated['images'] = $imagePaths;
        }

        $car->update($validated);

        return redirect()->route('admin.cars.index')->with('success', 'تم تحديث السيارة بنجاح');
    }

    public function destroy(string $id)
    {
        $car = \App\Models\Car::findOrFail($id);
        $car->delete();

        return redirect()->route('admin.cars.index')->with('success', 'تم حذف السيارة بنجاح');
    }
}
