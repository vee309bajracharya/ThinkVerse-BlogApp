<div>
    <aside class="single_sidebar_widget post_category_widget">
        <h4 class="widget_title text-white">Post Categories</h4>
        <ul class="list cat-list">
            @foreach (sidebar_categories() as $item)
                <li>
                    <a href="{{ route('category_posts', $item->slug) }}" class="d-flex justify-content-between text-white">
                        <p>{{ $item->name }}</p>
                        <p>{{ $item->posts->count() }}</p>
                    </a>
                </li>
            @endforeach

        </ul>
    </aside>
    <div class="br"></div>

</div>
