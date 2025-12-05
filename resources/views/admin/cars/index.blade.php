@extends('layouts.admin')

@section('breadcrumb', 'لوحة التحكم / السيارات / جميع السيارات')

@section('content')
    <style>
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 800;
            margin: 0;
        }

        .search-filters {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 24px;
        }

        .search-filters input,
        .search-filters select {
            flex: 1;
            min-width: 200px;
            padding: 10px 14px;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            color: var(--color-text);
        }

        .cars-table {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 14px;
            overflow: hidden;
        }

        .cars-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .cars-table thead {
            background: rgba(255, 255, 255, 0.05);
        }

        .cars-table th {
            padding: 16px;
            text-align: right;
            font-weight: 700;
            font-size: 14px;
            color: var(--color-text-dim);
        }

        .cars-table td {
            padding: 16px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        .car-image {
            width: 60px;
            height: 40px;
            object-fit: cover;
            border-radius: 6px;
            background: #0f1630;
        }

        .car-title {
            font-weight: 700;
            margin-bottom: 4px;
        }

        .car-meta {
            font-size: 13px;
            color: var(--color-text-dim);
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-success {
            background: rgba(21, 194, 122, 0.15);
            color: #15c27a;
        }

        .badge-warning {
            background: rgba(255, 159, 10, 0.15);
            color: #ff9f0a;
        }

        .table-actions {
            display: flex;
            gap: 8px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 12px;
            padding: 20px;
        }

        .stat-card__label {
            font-size: 13px;
            color: var(--color-text-dim);
            margin-bottom: 8px;
        }

        .stat-card__value {
            font-size: 32px;
            font-weight: 800;
            color: var(--color-primary);
        }

        @media (max-width: 768px) {
            .cars-table {
                overflow-x: auto;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>

    <div class="page-header">
        <h1 class="page-title"><i class="fa-solid fa-car"></i> إدارة السيارات</h1>
        <a href="{{ route('admin.cars.create') }}" class="btn btn--primary">
            <i class="fa-solid fa-plus"></i> إضافة سيارة جديدة
        </a>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-card__label">إجمالي السيارات</div>
            <div class="stat-card__value">{{ $cars->total() }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-card__label">في هذه الصفحة</div>
            <div class="stat-card__value">{{ $cars->count() }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-card__label">عدد الصفحات</div>
            <div class="stat-card__value">{{ $cars->total() > 0 ? $cars->lastPage() : 0 }}</div>
        </div>
    </div>

    <form method="GET" class="search-filters">
        <input type="text" name="search" placeholder="بحث في العلامة، الموديل، السنة..." value="{{ request('search') }}">
        <select name="brand">
            <option value="">كل العلامات</option>
            @foreach(\App\Models\Car::distinct()->orderBy('brand')->pluck('brand') as $brand)
                <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>{{ $brand }}</option>
            @endforeach
        </select>
        <select name="sort">
            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>الأحدث إضافة</option>
            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>الأقدم إضافة</option>
            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>الأعلى سعراً</option>
            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>الأقل سعراً</option>
        </select>
        <button type="submit" class="btn btn--outline"><i class="fa-solid fa-search"></i> بحث</button>
        @if(request()->hasAny(['search', 'brand', 'sort']))
            <a href="{{ route('admin.cars.index') }}" class="btn btn--outline"><i class="fa-solid fa-times"></i> إعادة تعيين</a>
        @endif
    </form>

    @if($cars->count() > 0)
        <div class="cars-table">
            <table>
                <thead>
                    <tr>
                        <th style="width: 80px;">#</th>
                        <th style="width: 80px;">صورة</th>
                        <th>السيارة</th>
                        <th>السعر</th>
                        <th>الحالة</th>
                        <th>تاريخ الإضافة</th>
                        <th style="width: 180px;">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cars as $car)
                        <tr>
                            <td><strong>#{{ $car->id }}</strong></td>
                            <td>
                                @if($car->primary_image)
                                    <img src="{{ $car->primary_image }}" alt="{{ $car->brand }} {{ $car->model }}" class="car-image">
                                @else
                                    <div class="car-image" style="display: flex; align-items: center; justify-content: center;">
                                        <i class="fa-solid fa-car" style="opacity: 0.3;"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="car-title">{{ $car->brand }} {{ $car->model }}</div>
                                <div class="car-meta">السنة: {{ $car->year }} • المشى: {{ number_format($car->mileage ?? 0) }} كم
                                </div>
                            </td>
                            <td>
                                @if($car->auction_price)
                                    <strong style="color: var(--color-primary);">{{ number_format($car->auction_price) }}
                                        {{ $car->currency }}</strong>
                                @else
                                    <span style="color: var(--color-text-dim);">-</span>
                                @endif
                            </td>
                            <td>
                                @if($car->condition_status)
                                    <span class="badge badge-success">{{ $car->condition_status }}</span>
                                @else
                                    <span class="badge badge-warning">غير محدد</span>
                                @endif
                            </td>
                            <td>{{ $car->created_at->format('Y/m/d') }}</td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('cars.show', $car->id) }}" class="btn btn--outline"
                                        style="padding: 6px 12px; font-size: 13px;" target="_blank" title="عرض">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.cars.edit', $car->id) }}" class="btn btn--outline"
                                        style="padding: 6px 12px; font-size: 13px;" title="تعديل">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.cars.destroy', $car->id) }}"
                                        style="display: inline; margin: 0;"
                                        onsubmit="return confirm('هل أنت متأكد من حذف هذه السيارة؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn--outline"
                                            style="padding: 6px 12px; font-size: 13px; color: #ff3b30;" title="حذف">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="margin-top: 24px;">
            {{ $cars->links() }}
        </div>
    @else
        <div style="padding: 60px 20px; text-align: center; background: rgba(255,255,255,0.03); border-radius: 14px;">
            <i class="fa-solid fa-car" style="font-size: 48px; color: var(--color-text-dim); margin-bottom: 16px;"></i>
            <h3>لا توجد سيارات</h3>
            <p style="color: var(--color-text-dim); margin-bottom: 20px;">لم يتم العثور على سيارات مطابقة للبحث.</p>
            <a href="{{ route('admin.cars.create') }}" class="btn btn--primary">
                <i class="fa-solid fa-plus"></i> إضافة سيارة جديدة
            </a>
        </div>
    @endif
@endsection