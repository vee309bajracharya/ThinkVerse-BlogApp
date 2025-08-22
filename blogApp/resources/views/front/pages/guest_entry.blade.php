@extends('front.layout.guest-user-layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'ThinkVerse - A BlogApp')

@section('content')

    <div class="relative min-h-screen flex flex-col items-center justify-center text-[var(--second-white)] overflow-hidden">

        {{-- Video Background --}}
        <video autoplay muted loop playsinline class="absolute top-0 left-0 w-full h-full object-cover z-0">
            <source src="/frontend/vid/sample1.mp4" type="video/mp4">
        </video>

        {{-- Dark Gradient Overlay --}}
        <div class="absolute top-0 left-0 w-full h-full bg-black opacity-80 z-10"></div>

        {{-- Content --}}
        <div class="relative z-20 max-w-xl px-4 text-center" data-aos="fade-down" data-aos-duration="4000">
            <a href="{{ route('home') }}">
                <img src="/frontend/img/mainLogo.svg" alt="ThinkVerse Logo" class="mx-auto w-full h-96 object-contain">
            </a>
            <h1 class="text-5xl font-bold mb-6 text-[var(--primary-color)] w-full">Welcome to ThinkVerse</h1>
            <p class="mb-8 text-lg">
                Discover amazing blogs and share your thoughts. Please sign up or log in to get started.
            </p>

            {{-- buttons --}}
            <div class="flex gap-5 text-center justify-center">
                <a href="{{ route('explore') }}"
                    class="inline-block px-6 py-3 bg-[var(--primary-color)] font-semibold rounded-md 
                    hover:bg-[var(--hover)] hover:text-[var(--second-white)] transition-colors">
                    Explore ThinkVerse
                </a>
                <a href="{{ route('user.login') }}"
                    class="inline-block px-6 py-3 bg-[var(--second-white)] text-black font-semibold rounded-md">
                    Get Started
                </a>

            </div>
        </div>

    </div>

@endsection
