@extends('front.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'ThinkVerse - A BlogApp')
@section('content')

    <div class="max-w-[1400px] mx-auto my-0 py-[3rem] px-[2rem]">

        {{-- container --}}
        <div class="flex flex-col justify-between gap-4 my-3">
            
            {{-- User Profile --}}
            <div class="text-center">
                <img src="{{ $author->picture }}" alt="User pic" class="w-48 h-48 rounded-full rounded-br-none rounded-bl-none object-cover shadow-md mx-auto">
    
                <h3 class="mt-4 text-5xl font-semibold text-gray-800 font-bebas">
                    {{ $author->name }}
                </h3>
                <p class="text-gray-600 mt-2 font-semibold">{{ $author->username }}</p>
                <p class="text-gray-700 max-w-xl mx-auto font-roboto">{{ $author->bio }}</p>
    
                @if ($author->social_links)
                    <div class="flex justify-center space-x-4 mt-4 text-xl text-gray-600 dark:text-gray-300">
                        @if ($author->social_links->fb_url)
                            <a href="{{ $author->social_links->fb_url }}" target="_blank" title="Facebook"
                                class="text-gray-900 hover:text-blue-600">
                                <i class="fa fa-facebook-square"></i>
                            </a>
                        @endif
                        @if ($author->social_links->insta_url)
                            <a href="{{ $author->social_links->insta_url }}" target="_blank" title="Instagram"
                                class="hover:text-pink-500">
                                <i class="fa fa-instagram"></i>
                            </a>
                        @endif
                        @if ($author->social_links->github_url)
                            <a href="{{ $author->social_links->github_url }}" target="_blank" title="GitHub"
                                class="hover:text-gray-800">
                                <i class="fa fa-github"></i>
                            </a>
                        @endif
                    </div>
                @endif
            </div>

            {{-- posts section --}}
            <section class="pt-1">
                <div class="max-w-[1400px] mx-auto px-4">
                    <h3 class="text-2xl font-semibold mb-6 text-gray-800">Posts by
                        <span class="title-color">{{ $author->name }}</span></h3>
        
                    <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mt-3">
                        @forelse ($posts as $post)
                            <article class="rounded-lg shadow transition hover:shadow-md">
                                <div class="mb-4">
                                    <img src="{{ asset('images/posts/' . $post->featured_image) }}" alt=""
                                        class="w-full h-48 object-cover rounded-md shadow-sm">
                                </div>
                                <div class="py-1 px-3">
                                    <h5 class="text-lg font-bold text-gray-800 dark:text-white mb-2 font-roboto">
                                        <a href="{{ route('read_post', $post->slug) }}" class="hover:underline">
                                            {{ $post->title }}
                                        </a>
                                    </h5>
                                    <ul class="text-sm text-gray-500 dark:text-gray-400 space-y-1">
                                        <li>
                                            <i class="fa fa-calendar mr-1"></i> {{ date_formatter($post->created_at) }}
                                        </li>
                                        <li>
                                            <i class="fa fa-tag mr-1"></i>
                                            <a href="{{ route('category_posts', $post->post_category->slug) }}"
                                                class="hover:text-blue-500">
                                                {{ $post->post_category->name }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                        
                            </article>
                        @empty
                            <div class="col-span-full text-center text-red-500 font-semibold">
                                No posts found
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>

        </div>
    </div>


    <section class="mt-6">
        <div class="container mx-auto px-4">
            {{ $posts->appends(request()->input())->links('custom_pagination') }}
        </div>
    </section>
@endsection
