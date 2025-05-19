@extends('back.layout.auth-layout')

@section('pageTitle', $pageTitle ?? 'Login-ThinkVerse')

@section('content')

    <section class="bg-[var(--second-white)] shadow-md rounded-xl p-8 w-full max-w-md mx-auto">
        <h2 class="text-3xl font-bold text-center text-[var(--primary-color)] mb-6">Login as User</h2>

        <form action="{{ route('user.login_handler') }}" method="POST">

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
                <p class="error-msg text-sm text-[var(--danger)] font-medium transition-opacity duration-500 mt-1">
                    {{ $message }}</p>
            @enderror

            {{-- Password --}}
            <div class="my-4">
                <label for="password" class="block text-sm font-medium">Password</label>
                <div class="form-input">
                    <input type="password" name="password" class="w-full px-4 py-2 outline-none" autocomplete="off" />
            
                </div>
            </div>
            @error('password')
                <p class="error-msg text-sm text-[var(--danger)] font-medium transition-opacity duration-500 mt-1">
                    {{ $message }}</p>
            @enderror

            {{-- Remember & Forgot --}}
            <div class="flex justify-between items-center text-sm my-6">
                <label class="flex items-center gap-2">
                    <input type="checkbox"
                        class="appearance-none w-4 h-4 rounded-sm bg-white border border-gray-300 checked:bg-[var(--primary-color)] checked:border-transparent focus:outline-none relative peer" />Remember
                    Me
                    <svg class="absolute w-4 h-4 text-white pointer-events-none hidden peer-checked:block"
                        viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M20.285 6.709l-11.022 11.022-5.657-5.657 1.414-1.414 4.243 4.243 9.608-9.608z" />
                    </svg>
                </label>
                <a href="{{ route('user.forgot') }}" class="text-[var(--primary-color)] font-medium">Forgot
                    Password?</a>
            </div>

            {{-- Login button --}}
            <button type="submit" class="primaryBtn">Login</button>

            {{-- Register --}}
            <div class="mt-5">
                <span class="">Not a member?</span>
                <a href="{{ route('user.register') }}" class="font-medium text-[var(--btn1)] cursor-pointer">Signup</a>
            </div>

            {{-- Admin login route --}}
            <div class="mt-4 text-center">
                <a href="{{ route('admin.login') }}" class="text-sm text-[var(--primary-color)] font-medium">
                    Login as Admin
                </a>
            </div>


        </form>
    </section>
    <x-fade-error-script />



@endsection
