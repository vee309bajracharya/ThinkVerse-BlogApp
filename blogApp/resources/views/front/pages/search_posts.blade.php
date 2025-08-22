@extends('front.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'ThinkVerse - A BlogApp')
@section('content')

    <div class="max-w-[1400px] mx-auto my-0 py-[3rem] px-[2rem]">

        <div class="flex items-center my-3">
            <h3 class="text-2xl font-semibold">Search results for </h3>
            <span class="ml-2 font-bold text-2xl title-color">{{ $query }}</span>
        </div>

        <div class="row">
            @if ($posts->count())
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 my-3">
                    @foreach ($posts as $post)
                        <article class="rounded-md shadow-md cursor-pointer transition-colors">
                            <div class="mb-4">
                                <img src="{{ asset('images/posts/' . $post->featured_image) }}" alt=""
                                    class="w-full h-48 object-cover rounded-md rounded-br-none rounded-bl-none shadow-sm">
                            </div>

                            <div class="px-3 py-2">
                                <h5 class="mb-2 text-gray-800">
                                    <a href="{{ route('read_post', $post->slug) }}" class="text-xl font-semibold">
                                        {{ $post->title }}
                                    </a>
                                </h5>
                                <ul class="text-sm text-gray-500 dark:text-gray-400 space-y-1">
                                    <li>
                                        <i class="fa fa-calendar mr-1"></i> {{ date_formatter($post->created_at) }}
                                    </li>
                                    <li>
                                        <i class="fa fa-user mr-1"></i>
                                        <a href="{{ route('author_posts', $post->author->username) }}"
                                            class="hover:text-blue-500">
                                            {{ $post->author->name }}
                                        </a>
                                    </li>
                                    <li>
                                        <i class="fa fa-tag mr-1"></i>
                                        <a href="{{ route('category_posts', $post->post_category->slug) }}">{{ $post->post_category->name }}
                                        </a>
                                    </li>
    
                                </ul>

                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <p class="text-red-500 text-center font-semibold mt-6">No posts found</p>
            @endif

            <div class="mt-8">
                {{ $posts->links('vendor.pagination.tailwind_pagination') }}
            </div>
        </div>


    </div>
@endsection
