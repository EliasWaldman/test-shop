<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('catalog.index') }}">Категории</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            @foreach($groups as $group)
                <li class="nav-item dropdown">
                    <a class="nav-link" href="{{ route('catalog.show', $group->id) }}" id="navbarDropdown{{ $group->id }}">
                        {{ $group->name }} ({{ $group->getTotalProductsCount() }})
                    </a>
                    <span class="dropdown-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="/img/arrow.png" alt="Arrow" class="arrow-icon">
                    </span>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown{{ $group->id }}">
                        @foreach($group->children as $child)
                            <a class="dropdown-item" href="{{ route('catalog.show', $child->id) }}">
                                {{ $child->name }} ({{ $child->getTotalProductsCount() }})
                            </a>
                        @endforeach
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownArrows = document.querySelectorAll('.dropdown-arrow');

        dropdownArrows.forEach(arrow => {
            const arrowIcon = arrow.querySelector('.arrow-icon');

            arrow.addEventListener('click', function(event) {
                event.preventDefault();
                event.stopPropagation();

                arrowIcon.classList.toggle('rotate');
            });
        });

        document.addEventListener('click', function(event) {
            if (!event.target.closest('.dropdown-arrow') && !event.target.closest('.dropdown-menu')) {
                dropdownArrows.forEach(arrow => {
                    const arrowIcon = arrow.querySelector('.arrow-icon');
                    arrowIcon.classList.remove('rotate');
                });
            }
        });
    });
</script>
