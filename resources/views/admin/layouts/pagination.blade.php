@if ($paginator->hasPages())
    <ul class="f-pagination">
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="f-page-item disabled">{{ $element }}</li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="f-page-item f-page-active">
                            <a class="f-page-link">{{ $page }}</a>
                        </li>
                    @else
                        <li class="f-page-item">
                            <a class="f-page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach
    </ul>
@endif
