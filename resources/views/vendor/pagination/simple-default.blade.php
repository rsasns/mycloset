@if ($paginator->hasPages())
    <nav class="mx-auto" style="width: 100px;">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled mr-4" aria-disabled="true"><span>@lang('pagination.previous')</span></li>
            @else
                <li><a class="link text-dark mr-4" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a></li>
            @endif
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li><a class="link text-dark" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a></li>
            @else
                <li class="disabled" aria-disabled="true"><span>@lang('pagination.next')</span></li>
            @endif
        </ul>
    </nav>
@endif
