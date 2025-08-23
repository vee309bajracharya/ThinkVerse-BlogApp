<div>
    <aside class="single_sidebar_widget popular_post_widget">
        <h3 class="widget_title text-white">Popular Posts</h3>

        @foreach (sidebar_latest_posts() as $item)
            <div class="media post_item flex">
                <img class="w-42 rounded-md" src="{{ asset('images/posts/' . $item->featured_image) }}" alt="post"
                    loading="lazy">
                <div class="media-body">
                        <a href="{{ route('read_post', $item->slug) }}">
                            <strong class="text-[14px] font-normal text-white tracking-normal">{{ $item->title }}</strong> <br>
                        </a>
                        <i class="fa fa-user mr-1"></i>
                        <a href="{{ route('author_posts', $item->author->username) }}"
                            class="font-semibold mr-5">{{ $item->author->name }}</a>
                        <i class="fa fa-calendar mr-1">
                            <span class="font-roboto">{{ date_formatter($item->created_at) }}</span>
                        </i>
                </div>
        </div>
        @endforeach
        <div class="br"></div>
    </aside>
</div>
