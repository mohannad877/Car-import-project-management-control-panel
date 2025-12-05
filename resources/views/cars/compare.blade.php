@extends('layouts.public')

@section('content')
    <style>
        .compare-section {
            padding: 60px 0;
            min-height: 80vh;
        }

        .compare-title {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 32px;
            text-align: center;
        }

        .compare-table {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 14px;
            overflow-x: auto;
        }

        .compare-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .compare-table th {
            padding: 20px;
            text-align: center;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
        }

        .compare-table td {
            padding: 16px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .compare-table tr td:first-child {
            font-weight: 700;
            text-align: right;
            background: rgba(255, 255, 255, 0.02);
        }

        .car-image {
            width: 100%;
            aspect-ratio: 16/9;
            object-fit: cover;
            border-radius: 10px;
        }

        .car-title {
            font-size: 20px;
            font-weight: 700;
            margin-top: 12px;
        }

        .highlight-diff {
            background: rgba(255, 159, 10, 0.1);
        }
    </style>

    <section class="compare-section">
        <div class="container">
            <h1 class="compare-title"><i class="fa-solid fa-code-compare"></i> مقارنة السيارات</h1>

            @if(count($cars) > 0)
                <div class="compare-table">
                    <table>
                        <thead>
                            <tr>
                                <th style="text-align: right;">المواصفات</th>
                                @foreach($cars as $car)
                                    <th style="min-width: 250px;">
                                        @if($car->images && count($car->images) > 0)
                                            <img src="{{ asset('storage/' . $car->images[0]) }}"
                                                alt="{{ $car->brand }} {{ $car->model }}" class="car-image">
                                        @elseif($car->image_url)
                                            <img src="{{ $car->image_url }}" alt="{{ $car->brand }} {{ $car->model }}"
                                                class="car-image">
                                        @endif
                                        <div class="car-title">{{ $car->brand }} {{ $car->model }}</div>
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>السنة</td>
                                @foreach($cars as $car)
                                    <td>{{ $car->year }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>الفئة</td>
                                @foreach($cars as $car)
                                    <td>{{ $car->grade ?? '-' }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>الممشى</td>
                                @foreach($cars as $car)
                                    <td>{{ number_format($car->mileage ?? 0) }} كم</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>السعر</td>
                                @foreach($cars as $car)
                                    <td style="font-weight: 700; color: var(--color-primary);">
                                        {{ number_format($car->auction_price ?? 0) }} {{ $car->currency }}
                                    </td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>ناقل الحركة</td>
                                @foreach($cars as $car)
                                    <td>{{ $car->transmission ?? '-' }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>المحرك</td>
                                @foreach($cars as $car)
                                    <td>{{ $car->engine ?? '-' }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>نوع الوقود</td>
                                @foreach($cars as $car)
                                    <td>{{ $car->fuel ?? '-' }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>نوع الدفع</td>
                                @foreach($cars as $car)
                                    <td>{{ $car->drive_type ?? '-' }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>اللون</td>
                                @foreach($cars as $car)
                                    <td>{{ $car->color ?? '-' }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>الموقع</td>
                                @foreach($cars as $car)
                                    <td>{{ $car->location ?? '-' }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>الحالة</td>
                                @foreach($cars as $car)
                                    <td>{{ $car->condition_status ?? '-' }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td></td>
                                @foreach($cars as $car)
                                    <td>
                                        <a href="{{ route('cars.show', $car->id) }}" class="btn btn--primary" style="width: 100%;">
                                            عرض التفاصيل
                                        </a>
                                    </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            @else
                <div style="text-align: center; padding: 60px 20px;">
                    <i class="fa-solid fa-code-compare"
                        style="font-size: 64px; color: var(--color-text-dim); margin-bottom: 24px;"></i>
                    <h2>لم يتم اختيار سيارات للمقارنة</h2>
                    <p style="color: var(--color-text-dim); margin-bottom: 24px;">
                        استخدم الرابط مع IDs السيارات: /compare?ids=1,2,3
                    </p>
                    <a href="{{ route('cars.index') }}" class="btn btn--primary">
                        تصفح السيارات
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection