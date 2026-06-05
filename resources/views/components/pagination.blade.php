@if ($paginator->hasPages())
<nav role="navigation" aria-label="Pagination Navigation" class="pagination-nav">

    {{-- Info text --}}
    <p class="pagination-info">
        Menampilkan
        <span class="font-semibold text-brand-500">{{ $paginator->firstItem() }}–{{ $paginator->lastItem() }}</span>
        dari <span class="font-semibold text-gray-900 dark:text-white">{{ $paginator->total() }}</span> properti
    </p>

    {{-- Controls --}}
    <div class="pagination-controls">

        {{-- Awal --}}
        @if ($paginator->onFirstPage())
            <span class="page-btn page-btn--nav disabled" aria-disabled="true">Awal</span>
        @else
            <a href="{{ $paginator->url(1) }}" class="page-btn page-btn--nav" aria-label="Halaman pertama">Awal</a>
        @endif

        {{-- Sebelumnya --}}
        @if ($paginator->onFirstPage())
            <span class="page-btn page-btn--nav disabled" aria-disabled="true">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="page-btn page-btn--nav" aria-label="Sebelumnya">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </a>
        @endif

        {{-- Page Numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="page-btn page-btn--dots" aria-hidden="true">…</span>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="page-btn page-btn--num page-btn--active" aria-current="page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="page-btn page-btn--num" aria-label="Halaman {{ $page }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Selanjutnya --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="page-btn page-btn--nav" aria-label="Selanjutnya">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
        @else
            <span class="page-btn page-btn--nav disabled" aria-disabled="true">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </span>
        @endif

        {{-- Akhir --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->url($paginator->lastPage()) }}" class="page-btn page-btn--nav" aria-label="Halaman terakhir">Akhir</a>
        @else
            <span class="page-btn page-btn--nav disabled" aria-disabled="true">Akhir</span>
        @endif

    </div>
</nav>

<style>
.pagination-nav {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 16px;
    margin-top: 40px;
}

.pagination-info {
    font-size: 0.8125rem;
    color: #9ca3af;
    text-align: center;
}

.dark .pagination-info { color: #6b7280; }

.pagination-controls {
    display: flex;
    align-items: center;
    gap: 6px;
    flex-wrap: wrap;
    justify-content: center;
}

/* Base button */
.page-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 38px;
    height: 38px;
    padding: 0 10px;
    border-radius: 50px;
    font-size: 0.8125rem;
    font-weight: 500;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1.5px solid transparent;
    line-height: 1;
    white-space: nowrap;
    user-select: none;
}

/* Number buttons */
.page-btn--num {
    width: 38px;
    padding: 0;
    color: #6b7280;
    background: transparent;
    border-color: transparent;
}
.dark .page-btn--num { color: #9ca3af; }

.page-btn--num:hover {
    background: rgba(234, 149, 29, 0.12);
    color: #ea951d;
    border-color: rgba(234, 149, 29, 0.25);
    transform: scale(1.08);
}
.dark .page-btn--num:hover {
    background: rgba(234, 149, 29, 0.15);
    color: #f5a623;
}

/* Active page */
.page-btn--active {
    background: linear-gradient(135deg, #ea951d 0%, #c97a10 100%);
    color: #fff !important;
    border-color: transparent;
    box-shadow: 0 4px 14px rgba(234, 149, 29, 0.45);
    transform: scale(1.1);
    font-weight: 700;
    pointer-events: none;
}

/* Nav buttons (Awal, Sebelumnya, Selanjutnya, Akhir) */
.page-btn--nav {
    color: #6b7280;
    background: transparent;
    border-color: #e5e7eb;
    padding: 0 14px;
    font-size: 0.8rem;
    letter-spacing: 0.01em;
}
.dark .page-btn--nav {
    color: #9ca3af;
    border-color: #374151;
}

.page-btn--nav:not(.disabled):hover {
    background: rgba(234, 149, 29, 0.1);
    color: #ea951d;
    border-color: rgba(234, 149, 29, 0.4);
    transform: translateY(-1px);
}
.dark .page-btn--nav:not(.disabled):hover {
    background: rgba(234, 149, 29, 0.15);
    color: #f5a623;
    border-color: rgba(245, 166, 35, 0.4);
}

/* Disabled state */
.page-btn.disabled {
    opacity: 0.35;
    cursor: not-allowed;
    pointer-events: none;
}

/* Dots separator */
.page-btn--dots {
    color: #9ca3af;
    background: transparent;
    border-color: transparent;
    width: 30px;
    min-width: 30px;
    pointer-events: none;
    font-size: 1rem;
    padding: 0;
}

/* Responsive - small screens */
@media (max-width: 480px) {
    .pagination-controls { gap: 4px; }
    .page-btn { min-width: 34px; height: 34px; font-size: 0.75rem; }
    .page-btn--num { width: 34px; }
    .page-btn--nav { padding: 0 10px; font-size: 0.72rem; }
}
</style>
@endif
