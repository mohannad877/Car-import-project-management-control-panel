@extends('layouts.public')

@section('content')
    <style>
        .contact-section {
            padding: 60px 0;
        }

        .contact-header {
            text-align: center;
            margin-bottom: 48px;
        }

        .contact-title {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .contact-subtitle {
            color: var(--color-text-dim);
            font-size: 18px;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: start;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .info-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 14px;
            padding: 24px;
            display: flex;
            gap: 20px;
        }

        .info-card__icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            background: rgba(63, 163, 255, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: var(--color-primary);
            flex-shrink: 0;
        }

        .info-card__content h3 {
            margin-bottom: 8px;
            font-size: 18px;
        }

        .info-card__content p {
            color: var(--color-text-dim);
        }

        .contact-form {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 14px;
            padding: 32px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 700;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            color: var(--color-text);
            font-family: inherit;
        }

        .form-group textarea {
            min-height: 150px;
            resize: vertical;
        }

        @media (max-width: 968px) {
            .contact-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <section class="contact-section">
        <div class="container">
            <div class="contact-header">
                <h1 class="contact-title"><i class="fa-solid fa-envelope"></i> اتصل بنا</h1>
                <p class="contact-subtitle">نحن هنا للإجابة على جميع استفساراتكم</p>
            </div>

            <div class="contact-grid">
                <div class="contact-info">
                    <div class="info-card">
                        <div class="info-card__icon">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div class="info-card__content">
                            <h3>رقم الهاتف</h3>
                            <p>+20 100 000 0000</p>
                            <p style="font-size: 14px; margin-top: 4px;">متاح من 9 صباحاً - 9 مساءً</p>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-card__icon">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <div class="info-card__content">
                            <h3>واتساب</h3>
                            <p>+20 100 000 0000</p>
                            <a href="https://wa.me/201000000000" target="_blank" class="btn btn--primary"
                                style="margin-top: 12px; padding: 8px 16px; font-size: 14px;">
                                فتح المحادثة <i class="fa-solid fa-arrow-left"></i>
                            </a>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-card__icon">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div class="info-card__content">
                            <h3>البريد الإلكتروني</h3>
                            <p>info@mhgazycars.com</p>
                            <p style="font-size: 14px; margin-top: 4px;">نرد خلال 24 ساعة</p>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-card__icon">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div class="info-card__content">
                            <h3>العنوان</h3>
                            <p>مصر - القاهرة</p>
                            <p style="font-size: 14px; margin-top: 4px;">نخدم جميع المحافظات</p>
                        </div>
                    </div>
                </div>

                <div class="contact-form">
                    <h2 style="margin-bottom: 24px; font-size: 24px;">أرسل لنا رسالة</h2>

                    @if(session('contact_success'))
                        <div
                            style="padding: 12px; background: rgba(21,194,122,0.1); border: 1px solid rgba(21,194,122,0.3); border-radius: 10px; color: #15c27a; margin-bottom: 20px;">
                            <i class="fa-solid fa-circle-check"></i> {{ session('contact_success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div
                            style="padding: 12px; background: rgba(255,59,48,0.1); border: 1px solid rgba(255,59,48,0.3); border-radius: 10px; color: #ff3b30; margin-bottom: 20px;">
                            <ul style="margin: 0; padding-right: 20px;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contact.store') }}">
                        @csrf

                        <div class="form-group">
                            <label>الاسم *</label>
                            <input type="text" name="name" value="{{ old('name') }}" required>
                        </div>

                        <div class="form-group">
                            <label>البريد الإلكتروني *</label>
                            <input type="email" name="email" value="{{ old('email') }}" required>
                        </div>

                        <div class="form-group">
                            <label>رقم الهاتف</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}">
                        </div>

                        <div class="form-group">
                            <label>الرسالة *</label>
                            <textarea name="message" required>{{ old('message') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn--primary" style="width: 100%; justify-content: center;">
                            <i class="fa-solid fa-paper-plane"></i> إرسال الرسالة
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection