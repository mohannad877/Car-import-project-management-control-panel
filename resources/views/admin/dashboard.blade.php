@extends('layouts.admin')

@section('breadcrumb', 'لوحة التحكم / الرئيسية')

@section('content')
    <style>
        .dashboard-header {
            margin-bottom: 32px;
        }

        .dashboard-title {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .dashboard-subtitle {
            color: var(--color-text-dim);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: linear-gradient(135deg, rgba(63, 163, 255, 0.1) 0%, rgba(63, 163, 255, 0.05) 100%);
            border: 1px solid rgba(63, 163, 255, 0.2);
            border-radius: 16px;
            padding: 24px;
            position: relative;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(63, 163, 255, 0.15);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(63, 163, 255, 0.1) 0%, transparent 70%);
        }

        .stat-card__icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            background: rgba(63, 163, 255, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: var(--color-primary);
            margin-bottom: 16px;
        }

        .stat-card__label {
            font-size: 14px;
            color: var(--color-text-dim);
            margin-bottom: 8px;
        }

        .stat-card__value {
            font-size: 36px;
            font-weight: 800;
            color: var(--color-primary);
        }

        .stat-card__change {
            font-size: 13px;
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .stat-card__change--up {
            color: #15c27a;
        }

        .stat-card__change--down {
            color: #ff3b30;
        }

        .stat-card--success {
            background: linear-gradient(135deg, rgba(21, 194, 122, 0.1) 0%, rgba(21, 194, 122, 0.05) 100%);
            border-color: rgba(21, 194, 122, 0.2);
        }

        .stat-card--success .stat-card__icon {
            background: rgba(21, 194, 122, 0.15);
            color: #15c27a;
        }

        .stat-card--success .stat-card__value {
            color: #15c27a;
        }

        .stat-card--warning {
            background: linear-gradient(135deg, rgba(255, 159, 10, 0.1) 0%, rgba(255, 159, 10, 0.05) 100%);
            border-color: rgba(255, 159, 10, 0.2);
        }

        .stat-card--warning .stat-card__icon {
            background: rgba(255, 159, 10, 0.15);
            color: #ff9f0a;
        }

        .stat-card--warning .stat-card__value {
            color: #ff9f0a;
        }

        .stat-card--purple {
            background: linear-gradient(135deg, rgba(191, 90, 242, 0.1) 0%, rgba(191, 90, 242, 0.05) 100%);
            border-color: rgba(191, 90, 242, 0.2);
        }

        .stat-card--purple .stat-card__icon {
            background: rgba(191, 90, 242, 0.15);
            color: #bf5af2;
        }

        .stat-card--purple .stat-card__value {
            color: #bf5af2;
        }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 32px;
        }

        .quick-action-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            transition: all 0.2s;
            text-decoration: none;
            color: var(--color-text);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
        }

        .quick-action-card:hover {
            background: rgba(255, 255, 255, 0.06);
            border-color: rgba(63, 163, 255, 0.3);
            transform: translateY(-2px);
        }

        .quick-action-card i {
            font-size: 32px;
            color: var(--color-primary);
        }

        .quick-action-card span {
            font-weight: 600;
        }

        .recent-table {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 32px;
        }

        .recent-table__header {
            padding: 20px 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .recent-table__title {
            font-size: 20px;
            font-weight: 700;
        }

        .recent-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .recent-table th {
            padding: 12px 24px;
            text-align: right;
            font-weight: 600;
            font-size: 13px;
            color: var(--color-text-dim);
            background: rgba(255, 255, 255, 0.02);
        }

        .recent-table td {
            padding: 16px 24px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        .recent-table tbody tr {
            transition: background 0.2s;
        }

        .recent-table tbody tr:hover {
            background: rgba(255, 255, 255, 0.03);
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge--unread {
            background: rgba(255, 59, 48, 0.15);
            color: #ff3b30;
        }

        .badge--read {
            background: rgba(21, 194, 122, 0.15);
            color: #15c27a;
        }

        .top-brands {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 32px;
        }

        .top-brands__title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .brand-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .brand-item:last-child {
            border-bottom: none;
        }

        .brand-item__name {
            font-weight: 600;
        }

        .brand-item__count {
            font-weight: 700;
            color: var(--color-primary);
        }

        .brand-item__bar {
            height: 6px;
            background: rgba(63, 163, 255, 0.2);
            border-radius: 3px;
            margin-top: 8px;
            overflow: hidden;
        }

        .brand-item__bar-fill {
            height: 100%;
            background: var(--color-primary);
            border-radius: 3px;
            transition: width 0.5s ease;
        }

        @media (max-width: 640px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .quick-actions {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>

    <div class="dashboard-header">
        <h1 class="dashboard-title">مرحباً، {{ auth()->user()->name }} 👋</h1>
        <p class="dashboard-subtitle">هذا ملخص شامل لنشاطك ومعلومات النظام</p>
    </div>

    <!-- بطاقات الإحصائيات -->
    <div class="stats-grid">
        <!-- إجمالي السيارات -->
        <div class="stat-card">
            <div class="stat-card__icon">
                <i class="fa-solid fa-car"></i>
            </div>
            <div class="stat-card__label">إجمالي السيارات</div>
            <div class="stat-card__value">{{ $totalCars }}</div>
            @if($carsLastMonth > 0)
                @php
                    $change = $carsThisMonth - $carsLastMonth;
                    $percentage = round(($change / $carsLastMonth) * 100);
                @endphp
                <div class="stat-card__change {{ $change >= 0 ? 'stat-card__change--up' : 'stat-card__change--down' }}">
                    <i class="fa-solid fa-{{ $change >= 0 ? 'arrow-up' : 'arrow-down' }}"></i>
                    {{ abs($percentage) }}% عن الشهر الماضي
                </div>
            @endif
        </div>

        <!-- سيارات هذا الشهر -->
        <div class="stat-card stat-card--success">
            <div class="stat-card__icon">
                <i class="fa-solid fa-calendar-plus"></i>
            </div>
            <div class="stat-card__label">سيارات هذا الشهر</div>
            <div class="stat-card__value">{{ $carsThisMonth }}</div>
        </div>

        <!-- جهات الاتصال -->
        <div class="stat-card stat-card--warning">
            <div class="stat-card__icon">
                <i class="fa-solid fa-envelope"></i>
            </div>
            <div class="stat-card__label">إجمالي الرسائل</div>
            <div class="stat-card__value">{{ $totalContacts }}</div>
            @if($unreadContacts > 0)
                <div class="stat-card__change" style="color: #ff3b30;">
                    <i class="fa-solid fa-exclamation-circle"></i>
                    {{ $unreadContacts }} رسالة غير مقروءة
                </div>
            @endif
        </div>

        <!-- الرسائل هذا الأسبوع -->
        <div class="stat-card stat-card--purple">
            <div class="stat-card__icon">
                <i class="fa-solid fa-inbox"></i>
            </div>
            <div class="stat-card__label">رسائل هذا الأسبوع</div>
            <div class="stat-card__value">{{ $contactsThisWeek }}</div>
        </div>

        <!-- إجمالي المستخدمين -->
        <div class="stat-card stat-card--success">
            <div class="stat-card__icon">
                <i class="fa-solid fa-users"></i>
            </div>
            <div class="stat-card__label">إجمالي المستخدمين</div>
            <div class="stat-card__value">{{ $totalUsers }}</div>
        </div>

        <!-- عدد العلامات -->
        <div class="stat-card">
            <div class="stat-card__icon">
                <i class="fa-solid fa-tags"></i>
            </div>
            <div class="stat-card__label">عدد العلامات التجارية</div>
            <div class="stat-card__value">{{ $brandsCount }}</div>
        </div>

        <!-- المفضلات -->
        <div class="stat-card stat-card--warning">
            <div class="stat-card__icon">
                <i class="fa-solid fa-heart"></i>
            </div>
            <div class="stat-card__label">إجمالي المفضلات</div>
            <div class="stat-card__value">{{ $totalFavorites }}</div>
        </div>

        <!-- متوسط السعر -->
        <div class="stat-card stat-card--purple">
            <div class="stat-card__icon">
                <i class="fa-solid fa-dollar-sign"></i>
            </div>
            <div class="stat-card__label">متوسط سعر السيارات</div>
            <div class="stat-card__value" style="font-size: 24px;">
                @if($averagePrice)
                    {{ number_format($averagePrice, 0) }} USD
                @else
                    -
                @endif
            </div>
        </div>
    </div>

    <!-- إجراءات سريعة -->
    <h2 style="font-size: 24px; font-weight: 700; margin-bottom: 16px;">
        <i class="fa-solid fa-bolt"></i> إجراءات سريعة
    </h2>
    <div class="quick-actions">
        <a href="{{ route('admin.cars.create') }}" class="quick-action-card">
            <i class="fa-solid fa-plus-circle"></i>
            <span>إضافة سيارة جديدة</span>
        </a>
        <a href="{{ route('admin.cars.index') }}" class="quick-action-card">
            <i class="fa-solid fa-list"></i>
            <span>عرض جميع السيارات</span>
        </a>
        <a href="{{ route('admin.contacts.index') }}" class="quick-action-card">
            <i class="fa-solid fa-envelope-open"></i>
            <span>جهات الاتصال</span>
        </a>
        <a href="{{ route('cars.index') }}" class="quick-action-card" target="_blank">
            <i class="fa-solid fa-globe"></i>
            <span>عرض الموقع</span>
        </a>
    </div>

    <!-- أفضل العلامات التجارية -->
    @if($topBrands->count() > 0)
        <div class="top-brands">
            <h2 class="top-brands__title"><i class="fa-solid fa-crown"></i> أفضل العلامات التجارية</h2>
            @php $maxCount = $topBrands->first()->total; @endphp
            @foreach($topBrands as $brand)
                <div class="brand-item">
                    <div style="flex: 1;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span class="brand-item__name">{{ $brand->brand }}</span>
                            <span class="brand-item__count">{{ $brand->total }} سيارة</span>
                        </div>
                        <div class="brand-item__bar">
                            <div class="brand-item__bar-fill" style="width: {{ ($brand->total / $maxCount) * 100 }}%"></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- أحدث السيارات المضافة -->
    <div class="recent-table">
        <div class="recent-table__header">
            <h2 class="recent-table__title"><i class="fa-solid fa-clock-rotate-left"></i> أحدث السيارات المضافة</h2>
            <a href="{{ route('admin.cars.index') }}" class="btn btn--outline" style="padding: 8px 16px; font-size: 14px;">
                عرض الكل <i class="fa-solid fa-arrow-left"></i>
            </a>
        </div>

        @if($recentCars->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>السيارة</th>
                        <th>السعر</th>
                        <th>تاريخ الإضافة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentCars as $car)
                        <tr>
                            <td><strong>#{{ $car->id }}</strong></td>
                            <td>
                                <strong>{{ $car->brand }} {{ $car->model }}</strong><br>
                                <small style="color: var(--color-text-dim);">السنة: {{ $car->year }}</small>
                            </td>
                            <td>
                                @if($car->auction_price)
                                    <strong style="color: var(--color-primary);">{{ number_format($car->auction_price) }}
                                        {{ $car->currency }}</strong>
                                @else
                                    <span style="color: var(--color-text-dim);">-</span>
                                @endif
                            </td>
                            <td>{{ $car->created_at->diffForHumans() }}</td>
                            <td>
                                <div style="display: flex; gap: 8px;">
                                    <a href="{{ route('admin.cars.edit', $car->id) }}" class="btn btn--outline"
                                        style="padding: 6px 12px; font-size: 13px;">
                                        <i class="fa-solid fa-edit"></i> تعديل
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div style="padding: 60px 20px; text-align: center;">
                <i class="fa-solid fa-car" style="font-size: 48px; color: var(--color-text-dim); margin-bottom: 16px;"></i>
                <p style="color: var(--color-text-dim);">لا توجد سيارات بعد</p>
                <a href="{{ route('admin.cars.create') }}" class="btn btn--primary" style="margin-top: 16px;">
                    <i class="fa-solid fa-plus"></i> إضافة سيارة جديدة
                </a>
            </div>
        @endif
    </div>

    <!-- آخر جهات الاتصال -->
    @if($recentContacts->count() > 0)
        <div class="recent-table">
            <div class="recent-table__header">
                <h2 class="recent-table__title"><i class="fa-solid fa-envelope"></i> آخر جهات الاتصال</h2>
                <a href="{{ route('admin.contacts.index') }}" class="btn btn--outline"
                    style="padding: 8px 16px; font-size: 14px;">
                    عرض الكل <i class="fa-solid fa-arrow-left"></i>
                </a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>البريد الإلكتروني</th>
                        <th>الرسالة</th>
                        <th>الحالة</th>
                        <th>التاريخ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentContacts as $contact)
                        <tr>
                            <td><strong>#{{ $contact->id }}</strong></td>
                            <td><strong>{{ $contact->name }}</strong></td>
                            <td>{{ $contact->email }}</td>
                            <td>
                                <div style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ Str::limit($contact->message, 50) }}
                                </div>
                            </td>
                            <td>
                                <span class="badge {{ $contact->is_read ? 'badge--read' : 'badge--unread' }}">
                                    {{ $contact->is_read ? 'مقروءة' : 'غير مقروءة' }}
                                </span>
                            </td>
                            <td>{{ $contact->created_at->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

@endsection