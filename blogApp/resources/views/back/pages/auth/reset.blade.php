@extends('back.layout.auth-layout')

@section('pageTitle', $pageTitle ?? 'Reset Password - ThinkVerse')

@section('content')
    <section class="w-full max-w-md bg-[var(--second-white)] shadow-md rounded-xl p-8 mx-auto">

        <div class="text-center mb-6">
            <h2 class="text-3xl font-bold text-center text-[var(--primary-color)] mb-6">Reset Password</h2>
        </div>

        <h6 class="text-gray-600 mb-6 font-medium text-center">
            Enter a new password to recover your account
        </h6>

        {{-- form starts here --}}
        <form action="{{ route('user.reset_password_handler', ['token'=>$token]) }}" method="POST">
            <x-form-alerts></x-form-alerts>
            @csrf

            <label for="new_password" class="block text-sm font-medium mb-2">New Password</label>
            <div class="form-input mb-5">
                <input type="password" class="w-full px-4 py-2 focus:outline-none text-sm" autocomplete="off" name="new_password"
                    value="" />
            </div>
            @error('new_password')
            <p class="error-msg text-sm text-[var(--danger)] font-medium transition-opacity duration-500 mt-1">{{ $message }}</p>            
            @enderror

            <label for="confirm_new_password" class="block text-sm font-medium mt-3">Confirm New Password</label>
            <div class="form-input mb-5">
                <input type="password" class="w-full px-4 py-2 focus:outline-none text-sm" autocomplete="off"
                    name="confirm_new_password" value="" />
            </div>
            @error('confirm_new_password')
            <p class="error-msg text-sm text-[var(--danger)] font-medium transition-opacity duration-500 mt-1">
            {{ $message }}</p>            
            @enderror


            <div class="my-6">
                <button type="submit" class="primaryBtn">
                    Change Password
                </button>
            </div>
        </form>
    </section>

    <x-fade-error-script />


@endsection
