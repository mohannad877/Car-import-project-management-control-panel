<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="{{ $metaDescription ?? 'إيليت موتورز لاستيراد السيارات - نوفر أفضل السيارات من المزادات العالمية بأسعار تنافسية وخدمات شحن وتخليص ممتازة' }}">
    <meta name="keywords"
        content="استيراد سيارات, سيارات مزادات, سيارات مستعملة, {{ $metaKeywords ?? 'تويوتا, هوندا, نيسان, شحن سيارات, تخليص جمركي' }}">
    <meta name="author" content="إيليت موتورز">
    <meta property="og:title" content="{{ $ogTitle ?? 'إيليت موتورز لاستيراد السيارات' }}">
    <meta property="og:description" content="{{ $ogDescription ?? 'نوفر أفضل السيارات من المزادات العالمية' }}">
    <meta property="og:image" content="{{ $ogImage ?? asset('assets-original/images/logo.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <title>{{ $title ?? 'إيليت موتورز لاستيراد السيارات' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer">

    <link rel="stylesheet" href="{{ asset('assets-original/css/main.css') }}">
    @stack('styles')
</head>

<body>
    <header class="topbar">
        <div class="container topbar__content">
            <div class="topbar__left">
                <span><i class="fa-solid fa-location-dot"></i> نخدم جميع المحافظات</span>
            </div>
            <div class="topbar__right">
                <a href="tel:+201000000000"><i class="fa-solid fa-phone"></i> +20 100 000 0000</a>
                <a href="https://wa.me/201000000000" target="_blank" rel="noopener"><i
                        class="fa-brands fa-whatsapp"></i> واتساب</a>
                <a href="mailto:info@example.com"><i class="fa-regular fa-envelope"></i> info@example.com</a>
            </div>
        </div>
    </header>

    <nav class="navbar">
        <div class="container navbar__content">
            <a href="{{ route('home') }}" class="logo">
                <i class="fa-solid fa-car-rear"></i>
                <span>إيليت موتورز</span>
                <small>لاستيراد السيارات</small>
            </a>
            <button class="navbar__toggle" id="navToggle">
                <i class="fa-solid fa-bars"></i>
            </button>
            <ul class="navbar__links" id="navLinks">
                <li><a href="{{ route('home') }}">الرئيسية</a></li>
                <li><a href="{{ route('cars.index') }}">المعرض</a></li>
                <li><a href="{{ route('contact.create') }}">اتصل بنا</a></li>
                @auth
                    @if(auth()->user()->role === 'admin')
                        <li><a href="{{ route('admin.dashboard') }}">لوحة التحكم</a></li>
                        <li><a href="{{ route('admin.cars.create') }}">إضافة سيارة</a></li>
                    @endif
                    <li>
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit"
                                style="background: none; border: none; color: inherit; cursor: pointer; padding: 0; font: inherit;">خروج</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}">تسجيل الدخول</a></li>
                    <li><a href="{{ route('register') }}" class="btn btn--primary" style="padding:8px 12px">إنشاء حساب</a>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>

    <main>
        @if(session('success'))
            <div class="container" style="margin-top: 16px;">
                <div
                    style="padding: 12px; background: rgba(21,194,122,0.1); border: 1px solid rgba(21,194,122,0.3); border-radius: 10px; color: #15c27a;">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        @if(session('error'))
            <div class="container" style="margin-top: 16px;">
                <div
                    style="padding: 12px; background: rgba(255,59,48,0.1); border: 1px solid rgba(255,59,48,0.3); border-radius: 10px; color: #ff3b30;">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="footer">
        <div class="container footer__content">
            <p>© <span id="year"></span> إيليت موتورز لاستيراد السيارات. جميع الحقوق محفوظة.</p>
            <div class="footer__socials">
                <a href="https://facebook.com/" target="_blank" rel="noopener"><i class="fa-brands fa-facebook"></i></a>
                <a href="https://instagram.com/" target="_blank" rel="noopener"><i
                        class="fa-brands fa-instagram"></i></a>
                <a href="https://t.me" target="_blank" rel="noopener"><i class="fa-brands fa-telegram"></i></a>
            </div>
        </div>
    </footer>

    <script>
        const navToggle = document.getElementById('navToggle');
        const navLinks = document.getElementById('navLinks');
        navToggle?.addEventListener('click', () => {
            navLinks?.classList.toggle('is-open');
        });
        document.getElementById('year').textContent = new Date().getFullYear();
    </script>
    @stack('scripts')
</body>

</html>