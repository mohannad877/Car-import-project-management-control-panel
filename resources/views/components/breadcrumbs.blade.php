@props(['items' => []])

<nav style="margin-bottom: 20px;">
    <div
        style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap; font-size: 14px; color: var(--color-text-dim);">
        <a href="{{ route('home') }}"
            style="color: var(--color-text-dim); text-decoration: none; transition: color 0.2s;">
            <i class="fa-solid fa-house"></i> الرئيسية
        </a>

        @foreach($items as $item)
            <i class="fa-solid fa-chevron-left" style="font-size: 10px;"></i>
            @if(isset($item['url']))
                <a href="{{ $item['url'] }}"
                    style="color: var(--color-text-dim); text-decoration: none; transition: color 0.2s;">
                    {{ $item['label'] }}
                </a>
            @else
                <span style="color: var(--color-primary); font-weight: 600;">{{ $item['label'] }}</span>
            @endif
        @endforeach
    </div>
</nav>