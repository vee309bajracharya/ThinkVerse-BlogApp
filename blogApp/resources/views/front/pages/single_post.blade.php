@extends('front.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'ThinkVerse - A BlogApp')
@section('content')

    <div class="max-w-[1400px] mx-auto my-0 py-[3rem] px-[2rem]">

        {{-- container --}}
        <div class="flex sm:flex-col md:flex-row justify-between gap-5" data-aos="zoom-in">

            {{-- left- post section --}}
            <div class="flex flex-col col-lg-8">
                {{-- post title --}}
                <h1 class="text-xl text-[var(--primary-color)]">{{ $post->title }}</h1>
                {{-- post details --}}
                <ul class="list-inline text-muted my-3">
                    <li class="list-inline-item">
                        <i class="fa fa-user mr-1"></i>
                        <a href="{{ route('author_posts', $post->author->username) }}">{{ $post->author->name }}
                        </a>
                    </li>

                    <li class="list-inline-item"><i class="fa fa-calendar mr-1"></i>{{ date_formatter($post->created_at) }}
                    </li>
                    <li class="list-inline-item"><i class="fa fa-tag mr-1"></i>
                        <a href="{{ route('category_posts', $post->post_category->slug) }}">{{ $post->post_category->name }}
                        </a>
                    </li>
                    <li class="list-inline-item"><i class="fa fa-clock-o mr-1"></i>
                        {{ readDuration($post->title, $post->content) }} @choice('min|mins', readDuration($post->title, $post->content))
                    </li>
                </ul>

                <figure class="w-full">
                    <img src="{{ asset('images/posts/' . $post->featured_image) }}" alt="Post Image"
                        class="rounded-md object-cover w-full h-[400px]" />
                </figure>

                <p class="w-full text-justify text-2xl font-medium font-roboto">{!! $post->content !!}</p>

                {{-- medias share --}}

                <div class="flex justify-center gap-5 space-x-2 mt-4 text-xl text-gray-600 dark:text-gray-300">
                    <p class="text-gray-700 font-semibold text-xl font-roboto">Share</p>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('read_post', $post->slug)) }} &amp;text={{ urlencode($post->title) }}"
                        target="_blank" title="Facebook" class="text-gray-900 hover:text-blue-600">
                        <i class="fa fa-facebook-square"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('read_post', $post->slug)) }}&amp;text={{ urlencode($post->title) }}"
                        target="_blank" title="Twitter" class="text-gray-900 hover:text-blue-400">
                        <i class="fa fa-twitter-square"></i>
                    </a>


                </div>


                {{-- post navigation --}}
                <div class="flex justify-between items-center">
                    <div>
                        @if ($prevPost)
                            <div>
                                <i class="fa fa-arrow-left"></i>
                                <span class="font-semibold font-roboto">Previous</span>
                                <p>
                                    <a href="{{ route('read_post', $prevPost->slug) }}"
                                        class="font-medium">{{ $prevPost->title }}</a>
                                </p>
                            </div>
                        @endif
                    </div>

                    <div>
                        @if ($nextPost)
                            <div>
                                <span class="font-semibold font-roboto">Next</span>
                                <i class="fa fa-arrow-right"></i>
                                <p>
                                    <a href="{{ route('read_post', $nextPost->slug) }}"
                                        class="font-medium">{{ $nextPost->title }}</a>
                                </p>
                            </div>
                        @endif
                    </div>

                </div>

            </div>

            {{-- right - sidebar components --}}
            <div>
                <div class="blog_right_sidebar">
                    {{-- sidebar search here --}}
                    <x-sidebar-search></x-sidebar-search>

                    {{-- sidebar latest posts --}}
                    <x-sidebar-latest-posts></x-sidebar-latest-posts>

                    {{-- categories here --}}
                    <x-sidebar-categories></x-sidebar-categories>

                    {{-- tags here --}}
                    <x-tags-categories></x-tags-categories>

                </div>

            </div>

        </div>

        {{-- Recommended posts section --}}
        @if ($relatedPosts && $relatedPosts->count() > 0)
            <h4 class="mt-5 text-2xl font-semibold">You Might Also Like</h4>
            <div class="grid md:grid-cols-3 gap-6 mt-4" >
                @foreach ($relatedPosts as $rec)
                    <div class="rounded-lg shadow hover:shadow-md transition duration-300 bg-[var(--category-bg)]" data-aos="fade-down" data-aos-duration="4000">
                        {{-- Featured Image --}}
                        <a href="{{ route('read_post', $rec->slug) }}">
                            <img src="{{ asset('images/posts/' . $rec->featured_image) }}" alt="{{ $rec->title }}"
                                class="rounded-md w-full h-40 object-cover mb-3" />
                        </a>

                        <div class="p-3">
                            {{-- Post Title --}}
                            <a href="{{ route('read_post', $rec->slug) }}">
                                <h5 class="text-xl font-extrabold text-[var(--primary-color)]">
                                    {{ $rec->title }}
                                </h5>
                            </a>

                            {{-- Post Content Preview --}}
                            <p class="text-gray-600 text-sm my-3">
                                {{ Str::limit(strip_tags($rec->content), 100) }}
                            </p>

                            {{-- author --}}
                            <i class="fa fa-user mr-1"></i>
                            <a href="{{ route('author_posts', $rec->author->username) }}">{{ $rec->author->name }}</a>
                            <br>

                            {{-- Category --}}
                            <i class="fa fa-tag mr-1"></i>
                            <a href="{{ route('category_posts', $rec->post_category->slug) }}"
                                class="hover:text-blue-500">
                                {{ $rec->post_category->name ?? 'Uncategorized' }}
                            </a>


                        </div>

                    </div>
                @endforeach
            </div>
        @endif


        @auth
            {{-- comments using disqus platform only for registered users --}}
            <div class="my-5">
                <div id="disqus_thread"></div>
            </div>
            <script>
                var disqus_config = function() {
                    this.page.url = "{{ route('read_post', $post->id) }}";
                    this.page.identifier = "PID_" + "{{ $post->id }}";
                };

                (function() {
                    var d = document,
                        s = d.createElement('script');
                    s.src = 'https://thinkverse-1.disqus.com/embed.js';
                    s.setAttribute('data-timestamp', +new Date());
                    (d.head || d.body).appendChild(s);
                })
                ();
            </script>
        @endauth

    </div>
@endsection
