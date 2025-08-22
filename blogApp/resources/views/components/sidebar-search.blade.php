<div>
    <aside class="single_sidebar_widget search_widget">
        <div class="">
            <form action="{{ route('search_posts') }}" method="GET">
                <input type="search" name="query" class="bg-white border-0 p-2 focus:outline-0 w-72 rounded-md" placeholder="Search Posts" autocomplete="off">
                <button type="submit">
                    <i class="fa fa-search ml-6"></i>
                </button>
            </form>
        </div>
        <div class="br"></div>
    </aside>
</div>
