@extends('layouts.public')

@section('content')
    <style>
        .filters {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin: 12px 0 16px;
        }

        .filters input,
        .filters select {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 10px;
            color: var(--color-text);
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
        }

        .car-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: var(--radius);
            overflow: hidden;
        }

        .car-media {
            aspect-ratio: 16/9;
            background: #0f1630 center/cover no-repeat;
        }

        .car-body {
            padding: 12px;
            display: grid;
            gap: 4px;
        }

        .car-title {
            font-weight: 800;
        }

        .car-meta {
            color: var(--color-text-dim);
            font-size: 14px;
        }

        .price {
            color: var(--color-primary);
            font-weight: 800;
        }

        @media (max-width: 1200px) {
            .grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 900px) {
            .grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 560px) {
            .grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <main class="section">
        <div class="container">
            <h1 class="section__title"><i class="fa-solid fa-car"></i> معرض السيارات</h1>

            <form method="get" class="filters">
                <select name="brand">
                    <option value="">كل العلامات</option>
                    @foreach($brands as $b)
                        <option value="{{ $b }}" {{ request('brand') == $b ? 'selected' : '' }}>{{ $b }}</option>
                    @endforeach
                </select>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="بحث: الموديل/العام...">
                <select name="sort">
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>الأحدث إضافة</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>السعر من الأقل</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>السعر من الأعلى
                    </option>
                    <option value="year_desc" {{ request('sort') == 'year_desc' ? 'selected' : '' }}>الأحدث سنة</option>
                    <option value="year_asc" {{ request('sort') == 'year_asc' ? 'selected' : '' }}>الأقدم سنة</option>
                </select>
                <button class="btn btn--outline" type="submit">تطبيق</button>
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a class="btn btn--primary" href="{{ route('admin.cars.create') }}">+ إضافة</a>
                    @endif
                @endauth
            </form>

            <div class="grid">
                @if($cars->count() == 0)
                    <div class="car-card" style="grid-column: 1/-1; padding:16px; text-align:center">لا توجد سيارات مطابقة
                        حاليًا.</div>
                @else
                    @foreach($cars as $car)
                        <div class="car-card">
                            @if($car->primary_image)
                                <div class="car-media" style="background-image:url('{{ $car->primary_image }}')"></div>
                            @else
                                <div class="car-media" style="display: flex; align-items: center; justify-content: center; color: rgba(255,255,255,0.3);">
                                    <i class="fa-solid fa-car" style="font-size: 48px;"></i>
                                </div>
                            @endif
                            <div class="car-body">
                                <div class="car-title">{{ $car->brand }} {{ $car->model }} {{ $car->year }}</div>
                                <div class="car-meta">فئة: {{ $car->grade ?? '-' }} • ممشى: {{ number_format($car->mileage ?? 0) }}
                                    كم</div>
                                <div class="car-meta">ناقل: {{ $car->transmission ?? '-' }} • وقود: {{ $car->fuel ?? '-' }}</div>
                                <div class="car-meta">الموقع: {{ $car->location ?? '-' }} • حالة:
                                    {{ $car->condition_status ?? '-' }}</div>
                                <div class="price">سعر المزاد: {{ number_format($car->auction_price ?? 0, 2) }} {{ $car->currency }}
                                </div>
                                @if($car->estimated_cost)
                                    <div class="car-meta">التكلفة التقديرية: {{ number_format($car->estimated_cost, 2) }}
                                        {{ $car->currency }}</div>
                                @endif
                                <div style="margin-top:8px;">
                                    <a class="btn btn--primary" href="{{ route('cars.show', $car->id) }}"
                                        style="width:100%; justify-content:center">عرض التفاصيل</a>
                                    @auth
                                        @if(auth()->user()->role === 'admin')
                                            <div style="display:flex; gap:8px; margin-top:8px;">
                                                <a class="btn btn--outline" href="{{ route('admin.cars.edit', $car->id) }}"
                                                    style="flex:1; justify-content:center">تعديل</a>
                                                <form method="post" action="{{ route('admin.cars.destroy', $car->id) }}"
                                                    onsubmit="return confirm('تأكيد الحذف؟');" style="flex:1; margin:0">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn--outline" type="submit"
                                                        style="width:100%; justify-content:center">حذف</button>
                                                </form>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div style="margin-top: 24px;">
                {{ $cars->links() }}
            </div>
        </div>
    </main>
@endsection