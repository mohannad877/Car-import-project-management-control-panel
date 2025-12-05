@extends('layouts.admin')

@section('breadcrumb', 'لوحة التحكم / السيارات / تعديل')

@section('content')
    <main class="section">
        <div class="container">
            <h1 class="section__title"><i class="fa-solid fa-edit"></i> تعديل السيارة</h1>

            <form method="POST" action="{{ route('admin.cars.update', $car->id) }}"
                style="background: rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.06); border-radius: 14px; padding: 24px; margin-top: 16px;">
                @csrf
                @method('PUT')

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
                        <input type="text" name="brand" value="{{ old('brand', $car->brand) }}" required
                            style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 4px; font-weight: 700;">الموديل *</label>
                        <input type="text" name="model" value="{{ old('model', $car->model) }}" required
                            style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 4px; font-weight: 700;">السنة *</label>
                        <input type="number" name="year" value="{{ old('year', $car->year) }}" required min="1900"
                            max="{{ date('Y') + 1 }}"
                            style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 4px; font-weight: 700;">الفئة</label>
                        <input type="text" name="grade" value="{{ old('grade', $car->grade) }}"
                            style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 4px; font-weight: 700;">الممشى (كم)</label>
                        <input type="number" name="mileage" value="{{ old('mileage', $car->mileage) }}" min="0"
                            style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 4px; font-weight: 700;">الحالة</label>
                        <input type="text" name="condition_status"
                            value="{{ old('condition_status', $car->condition_status) }}"
                            style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 4px; font-weight: 700;">سعر المزاد</label>
                        <input type="number" name="auction_price" value="{{ old('auction_price', $car->auction_price) }}"
                            step="0.01" min="0"
                            style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 4px; font-weight: 700;">التكلفة التقديرية</label>
                        <input type="number" name="estimated_cost" value="{{ old('estimated_cost', $car->estimated_cost) }}"
                            step="0.01" min="0"
                            style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 4px; font-weight: 700;">العملة *</label>
                        <input type="text" name="currency" value="{{ old('currency', $car->currency) }}" required
                            maxlength="8"
                            style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 4px; font-weight: 700;">الموقع</label>
                        <input type="text" name="location" value="{{ old('location', $car->location) }}"
                            style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 4px; font-weight: 700;">ناقل الحركة</label>
                        <input type="text" name="transmission" value="{{ old('transmission', $car->transmission) }}"
                            style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 4px; font-weight: 700;">المحرك</label>
                        <input type="text" name="engine" value="{{ old('engine', $car->engine) }}"
                            style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 4px; font-weight: 700;">نوع الوقود</label>
                        <input type="text" name="fuel" value="{{ old('fuel', $car->fuel) }}"
                            style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 4px; font-weight: 700;">نوع الدفع</label>
                        <input type="text" name="drive_type" value="{{ old('drive_type', $car->drive_type) }}"
                            style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 4px; font-weight: 700;">اللون</label>
                        <input type="text" name="color" value="{{ old('color', $car->color) }}"
                            style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 4px; font-weight: 700;">VIN</label>
                        <input type="text" name="vin" value="{{ old('vin', $car->vin) }}"
                            style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 4px; font-weight: 700;">رقم المزاد</label>
                        <input type="text" name="lot_number" value="{{ old('lot_number', $car->lot_number) }}"
                            style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                    </div>

                    <div style="grid-column: 1 / -1;">
                        <label style="display: block; margin-bottom: 4px; font-weight: 700;">رابط الصورة</label>
                        <input type="url" name="image_url" value="{{ old('image_url', $car->image_url) }}"
                            style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: var(--color-text);">
                    </div>
                </div>

                <div style="margin-top: 24px; display: flex; gap: 12px;">
                    <button type="submit" class="btn btn--primary">تحديث</button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn--outline">إلغاء</a>
                </div>
            </form>
        </div>
    </main>
@endsection