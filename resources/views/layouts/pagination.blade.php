@if ($paginator->hasPages())
    <ul class="pagination">
        @foreach ($elements as $element)
            @if (is_string($element))
                <li><a href="{{ $url }}" class="disabled">{{ $element }}</a></li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><a href="#">{{ $page }}</a></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
    </ul>
@endif
