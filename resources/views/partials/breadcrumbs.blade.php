<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        @foreach($breadcrumbs as $breadcrumb)
            @if($loop->first)
                <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->name }} </a></li>
            @elseif($loop->last)
                <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb->name }}</li>
            @else
                <li class="breadcrumb-item">
                    <a href="{{ $breadcrumb->url }}"> {{ $breadcrumb->name }} </a>
                </li>
            @endif
        @endforeach
    </ol>
</nav>
