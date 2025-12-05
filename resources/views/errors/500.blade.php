@extends('layouts.public')

@section('content')
    <style>
        .error-page {
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 40px 20px;
        }

        .error-content {
            max-width: 600px;
        }

        .error-code {
            font-size: 120px;
            font-weight: 900;
            background: linear-gradient(135deg, #ff3b30 0%, #ff9500 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
            margin-bottom: 20px;
        }

        .error-title {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 16px;
        }

        .error-message {
            color: var(--color-text-dim);
            margin-bottom: 32px;
            font-size: 18px;
        }

        @media (max-width: 768px) {
            .error-code {
                font-size: 80px;
            }

            .error-title {
                font-size: 24px;
            }
        }
    </style>

    <div class="error-page">
        <div class="error-content">
            <div class="error-code">500</div>
            <h1 class="error-title">خطأ في الخادم</h1>
            <p class="error-message">عذراً، حدث خطأ غير متوقع. نحن نعمل على إصلاحه.</p>
            <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('home') }}" class="btn btn--primary">
                    <i class="fa-solid fa-house"></i> الصفحة الرئيسية
                </a>
                <button onclick="window.location.reload()" class="btn btn--outline">
                    <i class="fa-solid fa-rotate-right"></i> إعادة المحاولة
                </button>
            </div>
        </div>
    </div>
@endsection