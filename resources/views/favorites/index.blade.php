@extends('layouts.public')

@section('content')
    <style>
        .favorites-section {
            padding: 60px 0;
            min-height: 70vh;
        }

        .favorites-title {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 32px;
            text-align: center;
        }

        .favorites-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 24px;
        }

        .favorite-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 14px;
            overflow: hidden;
            transition: all 0.3s;
        }

        .favorite-card:hover {
            transform: translateY(-4px);
            border-color: var(--color-primary);
        }

        .favorite-card__image {
            width: 100%;
            aspect-ratio: 16/9;
            object-fit: cover;
            background: #0f1630;
        }

        .favorite-card__content {
            padding: 20px;
        }

        .favorite-card__title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .favorite-card__meta {
            color: var(--color-text-dim);
            font-size: 14px;
            margin-bottom: 12px;
        }

        .favorite-card__price {
            font-size: 24px;
            font-weight: 800;
            color: var(--color-primary);
            margin-bottom: 16px;
        }

        .favorite-card__actions {
            display: flex;
            gap: 8px;
        }

        .empty-state {
            text-align: center;
            padding: 80px 20px;
        }

        .empty-state i {
            font-size: 64px;
            color: var(--color-text-dim);
            margin-bottom: 24px;
        }
    </style>

    <section class="favorites-section">
        <div class="container">
            <h1 class="favorites-title"><i class="fa-solid fa-heart"></i> سياراتي المفضلة</h1>

            @if($favorites->count() > 0)
                <div class="favorites-grid">
                    @foreach($favorites as $favorite)
                        @php $car = $favorite->car; @endphp
                        <div class="favorite-card">
                            @if($car->images && count($car->images) > 0)
                                <img src="{{ asset('storage/' . $car->images[0]) }}" alt="{{ $car->brand }} {{ $car->model }}"
                                    class="favorite-card__image">
                            @elseif($car->image_url)
                                <img src="{{ $car->image_url }}" alt="{{ $car->brand }} {{ $car->model }}" class="favorite-card__image">
                            @else
                                <div class="favorite-card__image" style="display: flex; align-items: center; justify-content: center;">
                                    <i class="fa-solid fa-car" style="font-size: 48px; opacity: 0.3;"></i>
                                </div>
                            @endif

                            <div class="favorite-card__content">
                                <h3 class="favorite-card__title">{{ $car->brand }} {{ $car->model }}</h3>
                                <div class="favorite-card__meta">
                                    <i class="fa-solid fa-calendar"></i> {{ $car->year }} •
                                    <i class="fa-solid fa-gauge"></i> {{ number_format($car->mileage ?? 0) }} كم
                                </div>
                                <div class="favorite-card__price">
                                    {{ number_format($car->auction_price ?? 0) }} {{ $car->currency }}
                                </div>

                                <div class="favorite-card__actions">
                                    <a href="{{ route('cars.show', $car->id) }}" class="btn btn--primary" style="flex: 1;">
                                        <i class="fa-solid fa-eye"></i> عرض التفاصيل
                                    </a>
                                    <button onclick="toggleFavorite({{ $car->id }}, this)" class="btn btn--outline"
                                        style="padding: 0 16px;">
                                        <i class="fa-solid fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <i class="fa-solid fa-heart-crack"></i>
                    <h2>لا توجد سيارات مفضلة</h2>
                    <p style="color: var(--color-text-dim); margin-bottom: 24px;">ابدأ بإضافة سيارات إلى المفضلة لتسهيل الوصول
                        إليها لاحقاً</p>
                    <a href="{{ route('cars.index') }}" class="btn btn--primary">
                        <i class="fa-solid fa-car"></i> تصفح السيارات
                    </a>
                </div>
            @endif
        </div>
    </section>

    <script>
        function toggleFavorite(carId, button) {
            fetch('/favorites/toggle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ car_id: carId })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'removed') {
                        // إزالة البطاقة من الصفحة
                        button.closest('.favorite-card').style.animation = 'fadeOut 0.3s';
                        setTimeout(() => {
                            button.closest('.favorite-card').remove();
                            // إذا لم يبق سيارات، إعادة تحميل الصفحة
                            if (document.querySelectorAll('.favorite-card').length === 0) {
                                location.reload();
                            }
                        }, 300);
                    }
                });
        }
    </script>

    <style>
        @keyframes fadeOut {
            to {
                opacity: 0;
                transform: scale(0.9);
            }
        }
    </style>
@endsection