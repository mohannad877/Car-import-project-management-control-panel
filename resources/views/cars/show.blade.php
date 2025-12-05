@extends('layouts.public')

@section('content')
    <main class="section">
        <div class="container">
            <h1 class="section__title"><i class="fa-solid fa-car"></i> تفاصيل السيارة</h1>

            <div
                style="background: rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.06); border-radius: var(--radius); padding: 24px; margin-top: 16px;">

                @if(($car->images && count($car->images) > 0) || $car->image_url)
                    <div style="margin-bottom: 24px;">
                        @if($car->images && count($car->images) > 0)
                            {{-- معرض الصور --}}
                            <div id="carGallery" style="margin-bottom: 16px;">
                                <img src="{{ asset('storage/' . $car->images[0]) }}" alt="{{ $car->brand }} {{ $car->model }}"
                                    id="mainImage"
                                    style="width: 100%; max-height: 500px; object-fit: cover; border-radius: 12px; cursor: zoom-in;"
                                    onclick="openLightbox(0)">
                            </div>

                            {{-- Thumbnails --}}
                            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); gap: 12px;">
                                @foreach($car->images as $index => $image)
                                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $car->brand }} {{ $car->model }}"
                                        style="width: 100%; aspect-ratio: 1; object-fit: cover; border-radius: 8px; cursor: pointer; border: 2px solid {{ $index === 0 ? 'var(--color-primary)' : 'transparent' }}; transition: all 0.2s;"
                                        onclick="changeMainImage({{ $index }})" class="thumbnail" data-index="{{ $index }}">
                                @endforeach
                            </div>
                        @elseif($car->image_url)
                            <img src="{{ $car->image_url }}" alt="{{ $car->brand }} {{ $car->model }}"
                                style="width: 100%; max-height: 400px; object-fit: cover; border-radius: 10px;">
                        @endif
                    </div>
                @endif

                <h2 style="font-size: 28px; margin-bottom: 16px;">{{ $car->brand }} {{ $car->model }} {{ $car->year }}</h2>

                <div
                    style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-top: 20px;">
                    <div>
                        <strong>السنة:</strong> {{ $car->year }}
                    </div>
                    <div>
                        <strong>الفئة:</strong> {{ $car->grade ?? '-' }}
                    </div>
                    <div>
                        <strong>الممشى:</strong> {{ number_format($car->mileage ?? 0) }} كم
                    </div>
                    <div>
                        <strong>انناقل الحركة:</strong> {{ $car->transmission ?? '-' }}
                    </div>
                    <div>
                        <strong>المحرك:</strong> {{ $car->engine ?? '-' }}
                    </div>
                    <div>
                        <strong>نوع الوقود:</strong> {{ $car->fuel ?? '-' }}
                    </div>
                    <div>
                        <strong>نوع الدفع:</strong> {{ $car->drive_type ?? '-' }}
                    </div>
                    <div>
                        <strong>اللون:</strong> {{ $car->color ?? '-' }}
                    </div>
                    <div>
                        <strong>الموقع:</strong> {{ $car->location ?? '-' }}
                    </div>
                    <div>
                        <strong>الحالة:</strong> {{ $car->condition_status ?? '-' }}
                    </div>
                    <div>
                        <strong>VIN:</strong> {{ $car->vin ?? '-' }}
                    </div>
                    <div>
                        <strong>رقم المزاد:</strong> {{ $car->lot_number ?? '-' }}
                    </div>
                </div>

                <div style="margin-top: 24px; padding-top: 24px; border-top: 1px solid rgba(255,255,255,0.1);">
                    <h3 style="font-size: 24px; color: var(--color-primary); margin-bottom: 8px;">الأسعار</h3>
                    <div style="font-size: 20px; margin-bottom: 8px;">
                        <strong>سعر المزاد:</strong> {{ number_format($car->auction_price ?? 0, 2) }} {{ $car->currency }}
                    </div>
                    @if($car->estimated_cost)
                        <div style="font-size: 20px;">
                            <strong>التكلفة التقديرية (بعد الشحن/التخليص):</strong> {{ number_format($car->estimated_cost, 2) }}
                            {{ $car->currency }}
                        </div>
                    @endif
                </div>

                <div style="margin-top: 24px; display: flex; gap: 12px; flex-wrap: wrap;">
                    <a href="{{ route('cars.index') }}" class="btn btn--outline">عودة للقائمة</a>
                    @auth
                        <button onclick="toggleFavorite({{ $car->id }})" id="favoriteBtn" class="btn btn--outline">
                            <i class="fa-solid fa-heart" id="favoriteIcon"></i>
                            <span id="favoriteText">إضافة للمفضلة</span>
                        </button>
                    @endauth
                    <a href="https://wa.me/201000000000?text=مرحباً، أنا مهتم بـ {{ $car->brand }} {{ $car->model }} {{ $car->year }}"
                        class="btn btn--primary" target="_blank" style="flex: 1;">
                        <i class="fa-brands fa-whatsapp"></i> استفسار عبر واتساب
                    </a>
                </div>
            </div>
        </div>
    </main>

    {{-- Lightbox --}}
    <div id="lightbox"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.95); z-index: 9999; justify-content: center; align-items: center;">
        <button onclick="closeLightbox()"
            style="position: absolute; top: 20px; right: 20px; background: rgba(255,255,255,0.2); border: none; color: #fff; font-size: 32px; cursor: pointer; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">×</button>
        <button onclick="prevImage()"
            style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.2); border: none; color: #fff; font-size: 32px; cursor: pointer; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">‹</button>
        <img id="lightboxImage" style="max-width: 90%; max-height: 90%; object-fit: contain;">
        <button onclick="nextImage()"
            style="position: absolute; right: 20px; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.2); border: none; color: #fff; font-size: 32px; cursor: pointer; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">›</button>
        <div id="imageCounter"
            style="position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); color: #fff; font-size: 18px;">
        </div>
    </div>

    <script>
        const carImages = @json($car->images ?? []);
        let currentImageIndex = 0;

        function changeMainImage(index) {
            currentImageIndex = index;
            document.getElementById('mainImage').src = '/storage/' + carImages[index];

            // Update thumbnails border
            document.querySelectorAll('.thumbnail').forEach((thumb, i) => {
                thumb.style.border = i === index ? '2px solid var(--color-primary)' : '2px solid transparent';
            });
        }

        function openLightbox(index) {
            currentImageIndex = index;
            const lightbox = document.getElementById('lightbox');
            const lightboxImage = document.getElementById('lightboxImage');
            lightbox.style.display = 'flex';
            lightboxImage.src = '/storage/' + carImages[index];
            updateCounter();
        }

        function closeLightbox() {
            document.getElementById('lightbox').style.display = 'none';
        }

        function nextImage() {
            currentImageIndex = (currentImageIndex + 1) % carImages.length;
            document.getElementById('lightboxImage').src = '/storage/' + carImages[currentImageIndex];
            updateCounter();
        }

        function prevImage() {
            currentImageIndex = (currentImageIndex - 1 + carImages.length) % carImages.length;
            document.getElementById('lightboxImage').src = '/storage/' + carImages[currentImageIndex];
            updateCounter();
        }

        function updateCounter() {
            document.getElementById('imageCounter').textContent = `${currentImageIndex + 1} / ${carImages.length}`;
        }

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (document.getElementById('lightbox').style.display === 'flex') {
                if (e.key === 'ArrowRight') prevImage();
                if (e.key === 'ArrowLeft') nextImage();
                if (e.key === 'Escape') closeLightbox();
            }
        });
            // Favorite functionality
            @auth
                function toggleFavorite(carId) {
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
                        const icon = document.getElementById('favoriteIcon');
                        const text = document.getElementById('favoriteText');
                        if (data.status === 'added') {
                            icon.style.color = '#ff3b30';
                            text.textContent = 'إزالة من المفضلة';
                        } else {
                            icon.style.color = '';
                            text.textContent = 'إضافة للمفضلة';
                        }
                    });
                }

                // Check if already in favorites
                fetch('/api/check-favorite/{{ $car->id }}')
                    .then(r => r.json())
                    .then(data => {
                        if (data.is_favorite) {
                            document.getElementById('favoriteIcon').style.color = '#ff3b30';
                            document.getElementById('favoriteText').textContent = 'إزالة من المفضلة';
                        }
                    });
            @endauth
        </script>
@endsection