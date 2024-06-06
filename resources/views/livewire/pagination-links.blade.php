<div class="mt-3">
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($words->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            <li class="page-item">
                <button wire:click="previousPage" class="page-link" wire:loading.attr="disabled" rel="prev"
                    aria-label="@lang('pagination.previous')">&lsaquo;</button>
            </li>
        @endif

        {{-- Numerical Pagination Elements with Ellipsis --}}
        @php
            $numPages = $words->lastPage();
            $currentPage = $words->currentPage();
            $showEllipsis = false;
        @endphp

        @for ($i = 1; $i <= $numPages; $i++)
            @if ($i == $currentPage)
                <li class="page-item active" aria-current="page"><span class="page-link">{{ $i }}</span>
                </li>
            @elseif ($i == 1 || $i == $numPages || abs($i - $currentPage) <= 2)
                <li class="page-item"><button wire:click="gotoPage({{ $i }})"
                        class="page-link">{{ $i }}</button></li>
            @elseif (!$showEllipsis)
                @php $showEllipsis = true; @endphp
                <li class="page-item disabled"><span class="page-link">...</span></li>
            @endif
        @endfor

        {{-- Next Page Link --}}
        @if ($words->hasMorePages())
            <li class="page-item">
                <button wire:click="nextPage" class="page-link" wire:loading.attr="disabled" rel="next"
                    aria-label="@lang('pagination.next')">&rsaquo;</button>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">&rsaquo;</span>
            </li>
        @endif
    </ul>
</div>
