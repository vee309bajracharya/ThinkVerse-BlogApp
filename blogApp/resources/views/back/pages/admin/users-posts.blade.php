@extends('back.layout.admin-layout')

@section('adminPageTitle', isset($pageTitle) ? $pageTitle : 'Users Posts List')

@section('content')

{{-- intro section --}}
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Users Posts List</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.admin-dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Users Posts List
                    </li>
                </ol>
            </nav>
        </div>
    </div>

{{-- users list here --}}
@livewire('admin.users-post-list')

@endsection
