@extends('front.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'ThinkVerse - A BlogApp')
@section('content')

    <!--================ Main Blog Section =================-->
    <div class="max-w-[1400px] mx-auto my-0 py-[3rem] px-[2rem]">
        <div class="">
            <div class="row">
                <!-- blog left -->
                <div class="col-lg-8">

                    {{-- Home Banner (Featured Post) --}}
                    @if (!empty(latest_posts(0, 1)))
                        @foreach (latest_posts(0, 1) as $post)
                            <div class="mb-5" data-aos="zoom-in">
                                <img src="{{ $post->featured_image ? asset('images/posts/' . $post->featured_image) : asset('frontend/img/banner/home-banner.jpg') }}"
                                    alt="Post Banner" class="img-fluid rounded shadow-sm mb-3"
                                    style="height: 500px; object-fit: cover; width: 100%;">
                                <h2 class="font-weight-bold text-white">
                                    <a href="{{ route('read_post', $post->slug) }}" class="text-decoration-none">
                                        {{ $post->title }}
                                    </a>
                                </h2>
                                <ul class="list-inline text-muted small mb-3">
                                    <li class="list-inline-item"><i class="fa fa-user mr-1"></i>
                                        <a
                                            href="{{ route('author_posts', $post->author->username) }}">{{ $post->author->name }}</a>
                                    </li>
                                    <li class="list-inline-item"><i
                                            class="fa fa-calendar mr-1"></i>{{ date_formatter($post->created_at) }}</li>
                                    <li class="list-inline-item"><i class="fa fa-tag mr-1"></i>
                                        <a href="{{ route('category_posts', $post->post_category->slug) }}">{{ $post->post_category->name }}
                                        </a>
                                    </li>
                                    <li class="list-inline-item"><i class="fa fa-clock-o mr-1"></i>
                                        {{ readDuration($post->title, $post->content) }} @choice('min|mins', readDuration($post->title, $post->content))
                                    </li>
                                </ul>
                                <p class="text-muted">{!! Str::ucfirst(words($post->content, 45)) !!}</p>
                                <a href="{{ route('read_post', $post->slug) }}"
                                    class="btn btn-primary btn-sm rounded-pill px-4">Read More</a>
                            </div>
                        @endforeach
                    @endif

                    {{-- Latest Blog Posts --}}
                    <h3 class="mb-4 text-[#fa6f43]" data-aos="fade-down">Read the Latest Blogs</h3>
                    @if (!empty(latest_posts(0, 3)))
                        @foreach (latest_posts(0, 3) as $post)
                            <div class="card mb-4 shadow-sm border-0 flex-md-row" data-aos="fade-down">
                                <img src="{{ asset('images/posts/' . $post->featured_image) }}"
                                    class="img-fluid rounded-start d-none d-md-block"
                                    style="width: 250px; object-fit: cover;" alt="{{ $post->title }}">
                                <div class="card-body d-flex flex-column bg-[var(--category-bg)] text-white">
                                    <h5>
                                        <a href="{{ route('read_post', $post->slug) }}"
                                            class="text-decoration-none">
                                            {{ $post->title }}
                                        </a>
                                    </h5>
                                    <ul class="list-inline small text-muted">
                                        <li class="list-inline-item"><i class="fa fa-user mr-1"></i>
                                            <a
                                                href="{{ route('author_posts', $post->author->username) }}">{{ $post->author->name }}</a>
                                        </li>
                                        <li class="list-inline-item"><i
                                                class="fa fa-calendar mr-1"></i>{{ date_formatter($post->created_at) }}
                                        </li>
                                        <li class="list-inline-item"><i class="fa fa-tag mr-1"></i>
                                            <a
                                                href="{{ route('category_posts', $post->post_category->slug) }}">{{ $post->post_category->name }}</a>
                                        </li>
                                        <li class="list-inline-item"><i class="fa fa-clock-o mr-1"></i>
                                            {{ readDuration($post->title, $post->content) }} @choice('min|mins', readDuration($post->title, $post->content))
                                        </li>
                                    </ul>
                                    <p class="text-white">{!! Str::ucfirst(words($post->content, 20)) !!}</p>
                                    <a href="{{ route('read_post', $post->slug) }}"
                                        class="btn-primary rounded-md px-4 py-2 w-32">Read More</a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <!-- blog right Sidebar -->
                <div class="col-lg-4 mt-5 mt-lg-0" data-aos="zoom-in-left">
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
        </div>
    </div>
    <!--================ End Blog Section =================-->

@endsection
