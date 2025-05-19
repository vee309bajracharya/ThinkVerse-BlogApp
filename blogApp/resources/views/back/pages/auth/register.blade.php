@extends('back.layout.auth-layout')

@section('pageTitle', $pageTitle ?? 'Register - ThinkVerse')

@section('content')
    <section class="max-w-md mx-auto bg-[var(--second-white)] rounded-xl shadow-md p-8">

        <h2 class="text-3xl font-bold mb-6 text-center text-[var(--primary-color)]">Create Account</h2>

        <form class="space-y-8" method="POST" action="{{ route('user.register.store') }}">
            <x-form-alerts></x-form-alerts>
            @csrf
            <section>
                <section class="space-y-4">

                    <label class="block text-sm font-medium mb-1">Name</label>
                    <div class="form-input">
                        <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-2 outline-none"
                            autocomplete="off" />
                    </div>
                    @error('name')
                        <p class="error-msg text-sm text-[var(--danger)] font-medium transition-opacity duration-500 mt-1">
                            {{ $message }}</p>
                    @enderror

                    <label class="block text-sm font-medium mb-1">Username</label>
                    <div class="form-input">
                        <input type="text" name="username" value="{{ old('username') }}"
                            class="w-full px-4 py-2 outline-none" autocomplete="off" />
                    </div>
                    @error('username')
                        <p class="error-msg text-sm text-[var(--danger)] font-medium transition-opacity duration-500 mt-1">
                            {{ $message }}</p>
                    @enderror


                    <label class="block text-sm font-medium mb-1">Email</label>
                    <div class="form-input">
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full px-4 py-2 outline-none" autocomplete="off" />
                    </div>
                    @error('email')
                        <p class="error-msg text-sm text-[var(--danger)] font-medium transition-opacity duration-500 mt-1">
                            {{ $message }}</p>
                    @enderror


                    <label class="block text-sm font-medium mb-1">Password</label>
                    <div class="form-input">
                        <input type="password" name="password" value="{{ old('password') }}"
                            class="w-full px-4 py-2 outline-none" autocomplete="off" />
                    </div>
                    @error('password')
                    <p class="error-msg text-sm text-[var(--danger)] font-medium transition-opacity duration-500 mt-1">{{ $message }}</p>                    
                    @enderror


                </section>
            </section>

            <div class="mt-6">
                <button type="submit" class="primaryBtn">
                    Sign Up
                </button>
            </div>

            {{-- login --}}
            <div class="mt-5">
                <span class="">Already have an account?</span>
                <a href="{{ route('user.login') }}" class="font-medium text-[var(--btn1)] cursor-pointer">Login</a>
            </div>


        </form>
    </section>
    <x-fade-error-script />

@endsection
