<div class="widget">
    <h4 class="widget_title mt-2 text-white">Tags</h4>
    <ul class="list list-inline">
        @foreach (getTags() as $tag)
            <li class="list-inline-item mb-2">
                <a href="{{ route('tag_posts', urlencode($tag)) }}"
                style="border-radius:5px;"
                class="d-inline-block px-3 py-2 bg-white small text-dark text-decoration-none">{{ $tag }}</a>
            </li>
        @endforeach
    </ul>
</div>
