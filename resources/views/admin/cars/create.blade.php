@extends('layouts.admin')

@section('breadcrumb', 'لوحة التحكم / السيارات / إضافة جديدة')

@section('content')
    <main class="section">
        <div class="container">
            <h1 class="section__title"><i class="fa-solid fa-plus"></i> إضافة سيارة جديدة</h1>

            <form method="POST" action="{{ route('admin.cars.store') }}" enctype="multipart/form-data"
                style="background: rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.06); border-radius: 14px; padding: 24px; margin-top: 16px;">
                @csrf

                @if($errors->any())
                    <div
                        style="padding: 12px; background: rgba(255,59,48,0.1); border: 1px solid rgba(255,59,48,0.3); border-radius: 10px; color: #ff3b30; margin-bottom: 16px;">
                        <ul style="margin: 0; padding-right: 20px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px;">
                    <div>
                        <label style="display: block; margin-bottom: 4px; font-weight: 700;">العلامة التجارية *</label>
                        <input type="text" name="brand" value="{{ old('brand') }}" required
                            style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 4px; font-weight: 700;">الموديل *</label>
                        <input type="text" name="model" value="{{ old('model') }}" required
                            style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 4px; font-weight: 700;">السنة *</label>
                        <input type="number" name="year" value="{{ old('year') }}" required min="1900"
                            max="{{ date('Y') + 1 }}"
                            style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 4px; font-weight: 700;">الفئة</label>
                        <input type="text" name="grade" value="{{ old('grade') }}"
                            style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 4px; font-weight: 700;">الممشى (كم)</label>
                        <input type="number" name="mileage" value="{{ old('mileage') }}" min="0"
                            style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 4px; font-weight: 700;">الحالة</label>
                        <input type="text" name="condition_status" value="{{ old('condition_status') }}"
                            style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                    </div>

                <div>
                    <label style="display: block; margin-bottom: 4px; font-weight: 700;">سعر المزاد</label>
                    <input type="number" name="auction_price" value="{{ old('auction_price') }}" step="0.01" min="0"
                        style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                </div>

                <div>
                    <label style="display: block; margin-bottom: 4px; font-weight: 700;">التكلفة التقديرية</label>
                    <input type="number" name="estimated_cost" value="{{ old('estimated_cost') }}" step="0.01" min="0"
                        style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                </div>

                <div>
                    <label style="display: block; margin-bottom: 4px; font-weight: 700;">العملة *</label>
                    <input type="text" name="currency" value="{{ old('currency', 'USD') }}" required maxlength="8"
                        style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                </div>

                <div>
                    <label style="display: block; margin-bottom: 4px; font-weight: 700;">الموقع</label>
                    <input type="text" name="location" value="{{ old('location') }}"
                        style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                </div>

                <div>
                    <label style="display: block; margin-bottom: 4px; font-weight: 700;">ناقل الحركة</label>
                    <input type="text" name="transmission" value="{{ old('transmission') }}"
                        style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                </div>

                <div>
                    <label style="display: block; margin-bottom: 4px; font-weight: 700;">المحرك</label>
                    <input type="text" name="engine" value="{{ old('engine') }}"
                        style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                </div>

                <div>
                    <label style="display: block; margin-bottom: 4px; font-weight: 700;">نوع الوقود</label>
                    <input type="text" name="fuel" value="{{ old('fuel') }}"
                        style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                </div>

                <div>
                    <label style="display: block; margin-bottom: 4px; font-weight: 700;">نوع الدفع</label>
                    <input type="text" name="drive_type" value="{{ old('drive_type') }}"
                        style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                </div>

                <div>
                    <label style="display: block; margin-bottom: 4px; font-weight: 700;">اللون</label>
                    <input type="text" name="color" value="{{ old('color') }}"
                        style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                </div>

                <div>
                    <label style="display: block; margin-bottom: 4px; font-weight: 700;">VIN</label>
                    <input type="text" name="vin" value="{{ old('vin') }}"
                        style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                </div>

                <div>
                    <label style="display: block; margin-bottom: 4px; font-weight: 700;">رقم المزاد</label>
                    <input type="text" name="lot_number" value="{{ old('lot_number') }}"
                        style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                </div>

                <div style="grid-column: 1 / -1;">
                    <label style="display: block; margin-bottom: 4px; font-weight: 700;">صور السيارة (حتى 10 صور)</label>
                    <input type="file" name="images[]" multiple accept="image/*" id="carImages" onchange="previewImages(event)"
                        style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                    <small style="color: var(--color-text-dim); display: block; margin-top: 4px;">
                        <i class="fa-solid fa-info-circle"></i> يمكنك اختيار حتى 10 صور (JPEG, PNG, JPG, WEBP - حد أقصى 5MB لكل صورة)
                    </small>
                    <div id="imagePreview" style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 12px; margin-top: 16px;"></div>
                </div>

                <div style="grid-column: 1 / -1;">
                    <label style="display: block; margin-bottom: 4px; font-weight: 700;">رابط الصورة (اختياري)</label>
                    <input type="url" name="image_url" value="{{ old('image_url') }}"
                        style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                    <small style="color: var(--color-text-dim); display: block; margin-top: 4px;">
                        <i class="fa-solid fa-info-circle"></i> يمكنك استخدام رابط خارجي كبديل
                    </small>
                </div>

                <script>
                function previewImages(event) {
                    const preview = document.getElementById('imagePreview');
                    preview.innerHTML = '';
                    const files = event.target.files;
                    
                    if (files.length > 10) {
                        alert('يمكنك رفع حتى 10 صور فقط');
                        event.target.value = '';
                        return;
                    }
                    
                    Array.from(files).forEach((file, index) => {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const div = document.createElement('div');
                            div.style.cssText = 'position: relative; aspect-ratio: 1; border-radius: 10px; overflow: hidden; background: #0f1630;';
                            div.innerHTML = `
                                <img src="${e.target.result}" style="width: 100%; height: 100%; object-fit: cover;">
                                <div style="position: absolute; bottom: 4px; right: 4px; background: rgba(0,0,0,0.7); color: #fff; padding: 4px 8px; border-radius: 6px; font-size: 12px;">
                                    ${index + 1}
                                </div>
                            `;
                            preview.appendChild(div);
                        };
                        reader.readAsDataURL(file);
                    });
                }
                </script>
        </div>

        <div style="margin-top: 24px; display: flex; gap: 12px;">
            <button type="submit" class="btn btn--primary">حفظ</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn--outline">إلغاء</a>
        </div>
        </form>
        </div>
    </main>
@endsection