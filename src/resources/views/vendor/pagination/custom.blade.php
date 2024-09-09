@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- 前のページ --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <!-- 左矢印 -->
                    <span aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li>
                    <!-- 左矢印 -->
                    <a class="pagination__link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- ページネーションの要素 --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- 数字、リンク --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        {{-- 現在のページ --}}
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- 次のページ --}}
            @if ($paginator->hasMorePages())
                <li>
                    <!-- 右矢印 -->
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <!-- 右矢印 -->
                    <span aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
