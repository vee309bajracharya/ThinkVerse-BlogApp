@extends('back.layout.auth-layout')

@section('adminPageTitle', $pageTitle ?? 'Login-ThinkVerse')

@section('content')

    <section class="bg-[var(--second-white)] shadow-md rounded-xl p-8 w-full max-w-md mx-auto">
        <h2 class="text-3xl font-bold text-center text-[var(--primary-color)] mb-6">Login as Admin</h2>

        <form action="{{ route('admin.login_handler') }}" method="POST">

            {{-- insert form alerts and passing csrf token --}}
            <x-form-alerts></x-form-alerts>
            @csrf


            {{-- Username or Email --}}
            <div class="my-4">
                <label for="username" class="block text-sm font-medium mb-1">Username or Email</label>
                <div class="form-input">
                    <input type="text" name="login_id" value="{{ old('login_id') }}" class="w-full px-4 py-2 outline-none"
                        autocomplete="off" />
                </div>
            </div>
            @error('login_id')
                <p class="error-msg text-sm text-[var(--danger)] font-medium transition-opacity duration-500 mt-1">{{ $message }}</p>
            @enderror

            {{-- Password --}}
            <div class="my-4">
                <label for="password" class="block text-sm font-medium">Password</label>
                <div class="form-input">
                    <input type="password" name="password" class="w-full px-4 py-2 outline-none" autocomplete="off" />
                </div>
            </div>
            @error('password')
                <p class="error-msg text-sm text-[var(--danger)] font-medium transition-opacity duration-500 mt-1">{{ $message }}</p>
            @enderror

            {{-- Login button --}}
            <button type="submit" class="primaryBtn mt-5">Login</button>

            {{-- User login route --}}
            <div class="mt-4 text-center">
                <a href="{{ route('user.login') }}" class="text-sm text-[var(--primary-color)] font-medium">
                    Back to User Login
                </a>
            </div>
        </form>
    </section>

    <x-fade-error-script />


@endsection
