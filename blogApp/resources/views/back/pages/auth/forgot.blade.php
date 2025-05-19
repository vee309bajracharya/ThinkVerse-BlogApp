@extends('back.layout.auth-layout')

@section('pageTitle', $pageTitle ?? 'Forgot Password - ThinkVerse')

@section('content')

{{-- heading --}}
    <section class="w-full max-w-md bg-[var(--second-white)] shadow-md rounded-xl p-8 mx-auto">
        <div class="text-center mb-6">
            <h2 class="text-3xl font-bold text-center text-[var(--primary-color)] mb-6">Forgot Password</h2>
        </div>
        <h6 class="text-gray-600 mb-6 font-medium text-center">
            Provide the email address associated with your account
        </h6>

        {{-- form starts here --}}
        <form action="{{route('user.send_password_reset_link')}}" method="POST">
            <x-form-alerts></x-form-alerts>
            @csrf


            <label for="email" class="block text-sm font-medium mb-1">Email Address</label>
            <div class="form-input">
                <input type="email" class="w-full px-4 py-2 focus:outline-none text-sm" autocomplete="off" name="email" value="{{old('email')}}" />
            </div>
            @error('email')
            <p class="error-msg text-sm text-[var(--danger)] font-medium transition-opacity duration-500 mt-1">{{ $message }}</p>            
            @enderror

            <div class="my-6">
                <button type="submit" class="primaryBtn">
                    Send Reset Link
                </button>
            </div>

            {{-- Back to login --}}
            <div class="mt-5 w-full text-center">
                <span>Back to </span>
                <a href="{{ route('user.login') }}" class="font-medium text-[var(--btn1)] cursor-pointer">Login</a>
            </div>
        </form>
    </section>

    <x-fade-error-script />




@endsection
