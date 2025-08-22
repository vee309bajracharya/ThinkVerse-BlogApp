@extends('back.layout.auth-layout')

@section('pageTitle', $pageTitle ?? 'Register - ThinkVerse')

@section('content')
    <section class="max-w-full bg-[var(--second-white)] rounded-xl shadow-md p-8">

        <h2 class="text-3xl font-bold mb-6 text-center text-[var(--primary-color)]">Create Account</h2>

        <form class="space-y-8" method="POST" action="{{ route('user.register.store') }}">
            <x-form-alerts></x-form-alerts>
            @csrf
        
            <section class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Name --}}
                <div>
                    <label class="block text-sm font-medium mb-1">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" 
                        class="w-full px-4 py-2 outline-none rounded-md border border-gray-300" autocomplete="off" />
                    @error('name')
                        <p class="error-msg text-sm text-[var(--danger)] font-medium mt-1">{{ $message }}</p>
                    @enderror
                </div>
        
                {{-- Username --}}
                <div>
                    <label class="block text-sm font-medium mb-1">Username</label>
                    <input type="text" name="username" value="{{ old('username') }}" 
                        class="w-full px-4 py-2 outline-none rounded-md border border-gray-300" autocomplete="off" />
                    @error('username')
                        <p class="error-msg text-sm text-[var(--danger)] font-medium mt-1">{{ $message }}</p>
                    @enderror
                </div>
        
                {{-- Email --}}
                <div>
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" 
                        class="w-full px-4 py-2 outline-none rounded-md border border-gray-300" autocomplete="off" />
                    @error('email')
                        <p class="error-msg text-sm text-[var(--danger)] font-medium mt-1">{{ $message }}</p>
                    @enderror
                </div>
        
                {{-- Password --}}
                <div>
                    <label class="block text-sm font-medium mb-1">Password</label>
                    <input type="password" name="password" value="{{ old('password') }}" 
                        class="w-full px-4 py-2 outline-none rounded-md border border-gray-300" autocomplete="off" />
                    @error('password')
                        <p class="error-msg text-sm text-[var(--danger)] font-medium mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </section>
        
            <div class="mt-6 text-center">
                <button type="submit" class="primaryBtn sm:w-auto md:w-60">
                    Sign Up
                </button>
            </div>
        
            {{-- login --}}
            <div class="mt-5 text-center">
                <span>Already have an account?</span>
                <a href="{{ route('user.login') }}" class="font-medium text-[var(--btn1)] cursor-pointer ml-1">Login</a>
            </div>
        </form>
        
    </section>
    <x-fade-error-script />

@endsection
