<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'لوحة التحكم - إيليت موتورز' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer">

    <link rel="stylesheet" href="{{ asset('assets-original/css/main.css') }}">
    <style>
        .admin-layout {
            display: flex;
            min-height: 100vh;
        }

        .admin-sidebar {
            width: 260px;
            background: linear-gradient(180deg, #1a1f3a 0%, #0f1630 100%);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: transform 0.3s;
            z-index: 1000;
        }

        .admin-sidebar__header {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .admin-sidebar__logo {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #fff;
            text-decoration: none;
        }

        .admin-sidebar__logo i {
            font-size: 28px;
            color: var(--color-primary);
        }

        .admin-sidebar__logo-text h2 {
            margin: 0;
            font-size: 18px;
            font-weight: 800;
        }

        .admin-sidebar__logo-text small {
            font-size: 12px;
            opacity: 0.7;
        }

        .admin-sidebar__nav {
            padding: 20px 0;
        }

        .admin-nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.2s;
            border-right: 3px solid transparent;
        }

        .admin-nav-item:hover {
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
        }

        .admin-nav-item.active {
            background: rgba(63, 163, 255, 0.1);
            color: var(--color-primary);
            border-right-color: var(--color-primary);
        }

        .admin-nav-item i {
            width: 20px;
            text-align: center;
        }

        .admin-nav-divider {
            height: 1px;
            background: rgba(255, 255, 255, 0.1);
            margin: 16px 20px;
        }

        .admin-nav-label {
            padding: 8px 20px;
            font-size: 12px;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.4);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .admin-content {
            flex: 1;
            margin-right: 260px;
            background: var(--color-bg);
            min-height: 100vh;
        }

        .admin-topbar {
            background: rgba(255, 255, 255, 0.03);
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            padding: 16px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .admin-topbar__left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .admin-topbar__toggle {
            display: none;
            background: none;
            border: none;
            color: var(--color-text);
            font-size: 24px;
            cursor: pointer;
            padding: 8px;
        }

        .admin-topbar__breadcrumb {
            color: var(--color-text-dim);
            font-size: 14px;
        }

        .admin-topbar__right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .admin-user {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 24px;
        }

        .admin-user__avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--color-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
        }

        .admin-user__info {
            display: flex;
            flex-direction: column;
        }

        .admin-user__name {
            font-size: 14px;
            font-weight: 700;
        }

        .admin-user__role {
            font-size: 12px;
            opacity: 0.6;
        }

        .admin-main {
            padding: 32px;
        }

        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(100%);
            }

            .admin-sidebar.is-open {
                transform: translateX(0);
            }

            .admin-content {
                margin-right: 0;
            }

            .admin-topbar__toggle {
                display: block;
            }

            .admin-main {
                padding: 16px;
            }
        }
    </style>
    @stack('styles')
</head>

<body>
    <div class="admin-layout">
        <aside class="admin-sidebar" id="adminSidebar">
            <div class="admin-sidebar__header">
                <a href="{{ route('admin.dashboard') }}" class="admin-sidebar__logo">
                    <i class="fa-solid fa-gauge-high"></i>
                    <div class="admin-sidebar__logo-text">
                        <h2>إيليت موتورز</h2>
                        <small>لوحة التحكم</small>
                    </div>
                </a>
            </div>

            <nav class="admin-sidebar__nav">
                <div class="admin-nav-label">القائمة الرئيسية</div>

                <a href="{{ route('admin.dashboard') }}"
                    class="admin-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-line"></i>
                    <span>لوحة التحكم</span>
                </a>

                <div class="admin-nav-divider"></div>
                <div class="admin-nav-label">إدارة السيارات</div>

                <a href="{{ route('admin.cars.index') }}"
                    class="admin-nav-item {{ request()->routeIs('admin.cars.index') ? 'active' : '' }}">
                    <i class="fa-solid fa-car"></i>
                    <span>جميع السيارات</span>
                </a>

                <a href="{{ route('admin.cars.create') }}"
                    class="admin-nav-item {{ request()->routeIs('admin.cars.create') ? 'active' : '' }}">
                    <i class="fa-solid fa-plus-circle"></i>
                    <span>إضافة سيارة جديدة</span>
                </a>

                <div class="admin-nav-divider"></div>
                <div class="admin-nav-label">التواصل</div>

                <a href="{{ route('admin.contacts.index') }}"
                    class="admin-nav-item {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-envelope"></i>
                    <span>رسائل الاتصال</span>
                </a>

                <div class="admin-nav-divider"></div>
                <div class="admin-nav-label">الموقع</div>

                <a href="{{ route('home') }}" class="admin-nav-item" target="_blank">
                    <i class="fa-solid fa-globe"></i>
                    <span>عرض الموقع</span>
                </a>

                <a href="{{ route('cars.index') }}" class="admin-nav-item" target="_blank">
                    <i class="fa-solid fa-car-side"></i>
                    <span>معرض السيارات</span>
                </a>

                <div class="admin-nav-divider"></div>

                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="admin-nav-item"
                        style="width: 100%; text-align: right; background: none; border: none; cursor: pointer; font-family: inherit; font-size: inherit;">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>تسجيل الخروج</span>
                    </button>
                </form>
            </nav>
        </aside>

        <div class="admin-content">
            <div class="admin-topbar">
                <div class="admin-topbar__left">
                    <button class="admin-topbar__toggle" id="sidebarToggle">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <div class="admin-topbar__breadcrumb">
                        @yield('breadcrumb', 'لوحة التحكم')
                    </div>
                </div>

                <div class="admin-topbar__right">
                    <div class="admin-user">
                        <div class="admin-user__avatar">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <div class="admin-user__info">
                            <div class="admin-user__name">{{ auth()->user()->name }}</div>
                            <div class="admin-user__role">مدير النظام</div>
                        </div>
                    </div>
                </div>
            </div>

            <main class="admin-main">
                @if(session('success'))
                    <div
                        style="padding: 12px 16px; background: rgba(21,194,122,0.1); border: 1px solid rgba(21,194,122,0.3); border-radius: 10px; color: #15c27a; margin-bottom: 24px;">
                        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div
                        style="padding: 12px 16px; background: rgba(255,59,48,0.1); border: 1px solid rgba(255,59,48,0.3); border-radius: 10px; color: #ff3b30; margin-bottom: 24px;">
                        <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const adminSidebar = document.getElementById('adminSidebar');

        sidebarToggle?.addEventListener('click', () => {
            adminSidebar?.classList.toggle('is-open');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 768) {
                if (!adminSidebar?.contains(e.target) && !sidebarToggle?.contains(e.target)) {
                    adminSidebar?.classList.remove('is-open');
                }
            }
        });
    </script>
    @stack('scripts')
</body>

</html>