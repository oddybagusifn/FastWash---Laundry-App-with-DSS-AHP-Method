{{-- FOOTER PAGINATION --}}
@if ($items->hasPages())
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center
               gap-3 pt-4 text-sm shrink-0">

        {{-- INFO --}}
        <div class="text-gray-400">
            <span class="font-semibold text-black">
                Menampilkan {{ $items->count() }} data
            </span><br>
            <span class="text-xs">
                Total {{ $items->total() }} data
            </span>
        </div>

        {{-- PAGINATION --}}
        <div class="flex items-center gap-1">

            {{-- PREV --}}
            <a href="{{ $items->previousPageUrl() ?? '#' }}"
               class="w-8 h-8 flex items-center justify-center rounded-[10px]
               {{ $items->onFirstPage()
                   ? 'bg-gray-100 text-gray-300 pointer-events-none'
                   : 'bg-gray-100 hover:bg-gray-200' }}">
                ‹
            </a>

            {{-- PAGE NUMBERS (DESKTOP ONLY) --}}
            <div class="hidden sm:flex gap-1">
                @foreach ($items->getUrlRange(1, $items->lastPage()) as $page => $url)
                    <a href="{{ $url }}"
                       class="w-8 h-8 flex items-center justify-center rounded-[10px]
                       {{ $page == $items->currentPage()
                           ? 'bg-[#EA821B] text-white'
                           : 'bg-gray-100 hover:bg-gray-200' }}">
                        {{ $page }}
                    </a>
                @endforeach
            </div>

            {{-- NEXT --}}
            <a href="{{ $items->nextPageUrl() ?? '#' }}"
               class="w-8 h-8 flex items-center justify-center rounded-[10px]
               {{ $items->hasMorePages()
                   ? 'bg-gray-100 hover:bg-gray-200'
                   : 'bg-gray-100 text-gray-300 pointer-events-none' }}">
                ›
            </a>
        </div>
    </div>
@endif
