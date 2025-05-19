@extends('back.layout.pages-layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Profile')

@section('content')
    <section class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Profile</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('user.dashboard')}}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Profile
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    {{-- livewire --}}
    @livewire('user.profile')
@endsection
