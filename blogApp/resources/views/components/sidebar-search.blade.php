<div>
    <aside class="single_sidebar_widget search_widget">
        <div>
            <form action="{{ route('search_posts') }}" method="GET">
                <input type="search" name="query" class="bg-[var(--search-bg)] border-0 p-2 focus:outline-0 w-80 rounded-md" placeholder="Search Posts" autocomplete="off">
                <button type="submit">
                    <i class="fa fa-search ml-2 bg-[var(--primary-color)] p-3 rounded-md"></i>
                </button>
            </form>
        </div>
        <div class="br"></div>
    </aside>
</div>
