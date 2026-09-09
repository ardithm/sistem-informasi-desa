@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Navigasi Halaman" class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 w-full">
        
        {{-- Summary (Kiri) --}}
        <div class="text-[12px] font-medium text-adm-text-muted">
            Menampilkan
            @if ($paginator->firstItem())
                <span class="font-semibold text-adm-text-main tabular-nums">{{ $paginator->firstItem() }}</span>
                sampai
                <span class="font-semibold text-adm-text-main tabular-nums">{{ $paginator->lastItem() }}</span>
            @else
                <span class="font-semibold text-adm-text-main tabular-nums">{{ $paginator->count() }}</span>
            @endif
            dari
            <span class="font-semibold text-adm-text-main tabular-nums">{{ $paginator->total() }}</span>
            hasil
        </div>

        {{-- Button Group (Kanan) --}}
        <div class="flex items-center gap-1.5 flex-wrap">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}"
                      class="inline-flex h-9 items-center gap-1.5 px-3 rounded-[8px] border border-adm-border bg-slate-50/75 text-[12px] font-medium text-adm-text-muted/40 cursor-not-allowed select-none">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    <span class="hidden sm:inline">Sebelumnya</span>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="{{ __('pagination.previous') }}"
                   class="inline-flex h-9 items-center gap-1.5 px-3 rounded-[8px] border border-adm-border bg-white text-[12px] font-medium text-adm-text-body transition-colors hover:bg-slate-50 hover:text-adm-primary shadow-sm">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    <span class="hidden sm:inline">Sebelumnya</span>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span aria-disabled="true" class="inline-flex h-9 min-w-[36px] items-center justify-center px-2 text-[13px] font-medium text-adm-text-muted select-none">
                        {{ $element }}
                    </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page"
                                  class="inline-flex h-9 min-w-[36px] items-center justify-center px-3 rounded-[8px] bg-adm-primary text-[13px] font-semibold text-white shadow-[0_4px_12px_rgba(29,114,254,0.3)] tabular-nums cursor-default select-none">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" aria-label="{{ __('Go to page :page', ['page' => $page]) }}"
                               class="inline-flex h-9 min-w-[36px] items-center justify-center px-3 rounded-[8px] border border-adm-border bg-white text-[13px] font-medium text-adm-text-body tabular-nums transition-colors hover:bg-slate-50 hover:text-adm-primary shadow-sm">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="{{ __('pagination.next') }}"
                   class="inline-flex h-9 items-center gap-1.5 px-3 rounded-[8px] border border-adm-border bg-white text-[12px] font-medium text-adm-text-body transition-colors hover:bg-slate-50 hover:text-adm-primary shadow-sm">
                    <span class="hidden sm:inline">Selanjutnya</span>
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            @else
                <span aria-disabled="true" aria-label="{{ __('pagination.next') }}"
                      class="inline-flex h-9 items-center gap-1.5 px-3 rounded-[8px] border border-adm-border bg-slate-50/75 text-[12px] font-medium text-adm-text-muted/40 cursor-not-allowed select-none">
                    <span class="hidden sm:inline">Selanjutnya</span>
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            @endif

        </div>
    </nav>
@endif
