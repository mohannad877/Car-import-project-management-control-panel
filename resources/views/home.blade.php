@extends('layouts.public')

@section('content')
    <div id="home" class="hero">
        <div class="container hero__content">
            <div class="hero__text">
                <h1>شركة <span class="brand">إيليت موتورز</span> لاستيراد السيارات</h1>
                <p>استيراد سيارات مميزة ومضمونة من المزادات العالمية، بفحص شامل، توثيق كامل، وشحن وتخليص جمركي حتى باب بيتك.
                </p>
                <div class="hero__cta">
                    <a class="btn btn--primary" href="https://wa.me/201000000000" target="_blank" rel="noopener">
                        <i class="fa-brands fa-whatsapp"></i> تواصل عبر واتساب
                    </a>
                    <a class="btn btn--outline" href="tel:+201000000000">
                        <i class="fa-solid fa-phone"></i> اتصال الآن
                    </a>
                </div>
                <div class="hero__badges">
                    <span><i class="fa-solid fa-shield-halved"></i> ضمان وموثوقية</span>
                    <span><i class="fa-solid fa-clipboard-check"></i> فحص تقارير CARFAX</span>
                    <span><i class="fa-solid fa-truck-fast"></i> شحن سريع وآمن</span>
                </div>
            </div>
            <div class="hero__image" aria-hidden="true">
                <div class="hero__car"></div>
            </div>
        </div>
    </div>

    <section id="brands" class="section section--light">
        <div class="container">
            <h2 class="section__title"><i class="fa-solid fa-star"></i> أبرز العلامات التجارية</h2>
            <p class="section__subtitle">نوفر خيارات واسعة من أشهر الماركات العالمية</p>
            <div class="brands__grid">
                <div class="brand-card" title="Toyota"><span class="brand-card__name">تويوتا</span></div>
                <div class="brand-card" title="Lexus"><span class="brand-card__name">لكزس</span></div>
                <div class="brand-card" title="Mercedes-Benz"><span class="brand-card__name">مرسيدس</span></div>
                <div class="brand-card" title="BMW"><span class="brand-card__name">بي إم دبليو</span></div>
                <div class="brand-card" title="Audi"><span class="brand-card__name">أودي</span></div>
                <div class="brand-card" title="Hyundai"><span class="brand-card__name">هيونداي</span></div>
                <div class="brand-card" title="Kia"><span class="brand-card__name">كيا</span></div>
                <div class="brand-card" title="Nissan"><span class="brand-card__name">نيسان</span></div>
                <div class="brand-card" title="Ford"><span class="brand-card__name">فورد</span></div>
                <div class="brand-card" title="Chevrolet"><span class="brand-card__name">شيفروليه</span></div>
            </div>
        </div>
    </section>

    <section id="services" class="section">
        <div class="container">
            <h2 class="section__title"><i class="fa-solid fa-screwdriver-wrench"></i> خدماتنا</h2>
            <div class="services__grid">
                <div class="service-card">
                    <i class="fa-solid fa-magnifying-glass-chart service-card__icon"></i>
                    <h3>استيراد حسب الطلب</h3>
                    <p>تحديد المواصفات والميزانية ونقوم بالمزايدة والشراء نيابة عنك بأفضل الشروط.</p>
                </div>
                <div class="service-card">
                    <i class="fa-solid fa-file-shield service-card__icon"></i>
                    <h3>فحص وتوثيق</h3>
                    <p>تقارير موثقة وفحص شامل للتاريخ والحالة لضمان الشفافية الكاملة.</p>
                </div>
                <div class="service-card">
                    <i class="fa-solid fa-ship service-card__icon"></i>
                    <h3>شحن وتخليص</h3>
                    <p>تنسيق الشحن البحري والتأمين والتخليص الجمركي حتى التسليم.</p>
                </div>
                <div class="service-card">
                    <i class="fa-solid fa-hand-holding-dollar service-card__icon"></i>
                    <h3>خيارات تمويل</h3>
                    <p>مساعدة في حلول تمويلية مرنة بالتعاون مع شركاء محليين.</p>
                </div>
                <div class="service-card">
                    <i class="fa-solid fa-shield service-card__icon"></i>
                    <h3>ضمان</h3>
                    <p>برامج ضمان على المحركات وناقل الحركة حسب حالة المركبة.</p>
                </div>
                <div class="service-card">
                    <i class="fa-solid fa-house-circle-check service-card__icon"></i>
                    <h3>تسليم حتى الباب</h3>
                    <p>تسليم سريع وآمن حتى موقعك مع متابعة مستمرة للحالة.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="section section--light">
        <div class="container about__content">
            <div>
                <h2 class="section__title"><i class="fa-solid fa-building"></i> عن إيليت موتورز</h2>
                <p>نمتلك خبرة عملية في شراء واستيراد السيارات من المزادات العالمية والمعارض الخارجية، مع حرص كامل على اختيار
                    المركبات الأنسب حسب ميزانيتك واحتياجاتك. هدفنا تقديم تجربة شراء سلسة وموثوقة تبدأ من الاستشارة وتنتهي
                    بتسليم السيارة جاهزة على الطريق.</p>
                <ul class="about__list">
                    <li><i class="fa-regular fa-circle-check"></i> التزام بالشفافية في كل خطوة</li>
                    <li><i class="fa-regular fa-circle-check"></i> شبكة موردين ووكلاء واسعة</li>
                    <li><i class="fa-regular fa-circle-check"></i> أسعار تنافسية وخيارات متعددة</li>
                </ul>
            </div>
        </div>
    </section>

    <section id="contact" class="section">
        <div class="container">
            <h2 class="section__title"><i class="fa-solid fa-headset"></i> تواصل معنا</h2>
            <p class="section__subtitle">نخدم جميع المحافظات — راسلنا الآن لتحصل على عرض مخصص</p>
            <div class="contact__grid">
                <a class="contact-card" href="https://wa.me/201234567890" target="_blank" rel="noopener">
                    <i class="fa-brands fa-whatsapp contact-card__icon"></i>
                    <div>
                        <h3>واتساب</h3>
                        <p>رد سريع خلال ساعات العمل</p>
                    </div>
                </a>
                <a class="contact-card" href="tel:+201234567890">
                    <i class="fa-solid fa-phone contact-card__icon"></i>
                    <div>
                        <h3>اتصال مباشر</h3>
                        <p>+20 100 000 0000</p>
                    </div>
                </a>
                <a class="contact-card" href="mailto:info@mhgazycars.com">
                    <i class="fa-regular fa-envelope contact-card__icon"></i>
                    <div>
                        <h3>البريد الإلكتروني</h3>
                        <p>info@mhgazycars.com</p>
                    </div>
                </a>
                <a class="contact-card" href="https://maps.google.com/" target="_blank" rel="noopener">
                    <i class="fa-solid fa-location-dot contact-card__icon"></i>
                    <div>
                        <h3>الموقع على الخريطة</h3>
                        <p>عرض موقع الشركة على خرائط غوغل</p>
                    </div>
                </a>
            </div>
        </div>
    </section>
@endsection