<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>@yield('pageTitle')</title>

    {{-- custom icon --}}
    <link rel="icon" type="image/svg+xml" href="{{ asset('backend/vendors/images/title-icon.svg') }}" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('backend/vendors/styles/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/vendors/styles/icon-font.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/vendors/styles/style.css') }}" />

    {{-- jQuery --}}
    <link rel="stylesheet" href="/extr-assets/jquery-ui-1.14.1/jquery-ui.min.css">
    <link rel="stylesheet" href="/extr-assets/jquery-ui-1.14.1/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="/extr-assets/jquery-ui-1.14.1/jquery-ui.theme.min.css">

    @vite('resources/css/app.css')

    {{-- custom css --}}
    @stack('stylesheets')

</head>

<body>

    <section class="header">
        {{-- search --}}
        <div class="header-left">
            <div class="menu-icon bi bi-list"></div>
        </div>

        {{-- details right --}}
        <div class="header-right">
            <div class="dashboard-setting user-notification">
                <div class="dropdown">
                    <a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
                        <i class="dw dw-settings2"></i>
                    </a>
                </div>
            </div>

            {{-- top user info --}}
            @livewire('user.top-user-info')

        </div>
    </section>

    {{-- toggle mode setings --}}
    <div class="right-sidebar">
        <div class="sidebar-title">
            <h3 class="weight-600 font-16 text-blue">
                Layout Settings
                <span class="btn-block font-weight-400 font-12">User Interface Settings</span>
            </h3>
            <div class="close-sidebar" data-toggle="right-sidebar-close">
                <i class="icon-copy ion-close-round"></i>
            </div>
        </div>
        <div class="right-sidebar-body customscroll">
            <div class="right-sidebar-body-content">
                <h4 class="weight-600 font-18 pb-10">Header Background</h4>
                <div class="sidebar-btn-group pb-30 mb-10">
                    <a href="javascript:void(0);" class="btn btn-outline-primary header-white">White</a>
                    <a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Dark</a>
                </div>

                <h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
                <div class="sidebar-btn-group pb-30 mb-10">
                    <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light">White</a>
                    <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark">Dark</a>
                </div>

                <div class="reset-options pt-30 text-center">
                    <button class="btn btn-danger" id="reset-settings">
                        Reset Settings
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- sidebar --}}
    <div class="left-side-bar">
        <div class="brand-logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('backend/vendors/images/mainLogo2.png') }}" alt="" class="dark-logo" />
                <img src="{{ asset('backend/vendors/images/mainLogo2.png') }}" alt="" class="light-logo" />
            </a>
            <div class="close-sidebar" data-toggle="left-sidebar-close">
                <i class="ion-close-round"></i>
            </div>
        </div>

        <section class="menu-block customscroll">
            <div class="sidebar-menu">
                <ul id="accordion-menu">
                    <li>
                        <a href="{{ route('user.dashboard') }}" class="dropdown-toggle no-arrow {{Route::is('user.dashboard') ? 'active' : ''}}">
                            <span class="micon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>
                            </span>
                            <span>Home</span>
                        </a>

                    </li>

                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle {{Route::is('user.add_post') || Route::is('user.posts') ? 'active' : ''}}">
                            <span class="micon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                                  </svg>

                            </span>
                            <span>Posts</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{route('user.add_post')}}" class="{{Route::is('user.add_post') ? 'active' : ''}}">New</a></li>
                            <li><a href="{{route('user.posts')}}" class="{{Route::is('user.posts') ? 'active' : ''}}">Posts</a></li>
                        </ul>
                    </li>


                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <div class="sidebar-small-cap">SETTINGS</div>
                    </li>
                    <li>
                        <a href="{{ route('user.profile') }}" class='dropdown-toggle no-arrow {{Route::is('user.profile') ? 'active' : ''}}'>
                            <span class="micon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </span>
                            <span class="mtext">Profile</span>
                        </a>
                </ul>
            </div>
        </section>
    </div>
    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                {{-- dynamic content here --}}
                <section class="">
                    @yield('content')

                </section>
            </div>
            <div class="footer-wrap pd-20 mb-20">
                ThinkVerse - A Web-based Blog Application | Developed by
                <a href="https://github.com/vee309bajracharya" target="_blank"
                    class="text-[var(--primary-color)] decoration-none">Veerin Bajracharya</a>
            </div>
        </div>
    </div>

    <!-- js -->
    <script src="{{ asset('backend/vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('backend/vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('backend/vendors/scripts/layout-settings.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="/extr-assets/jquery-ui-1.14.1/jquery-ui.min.js"></script>
   

    {{-- custom js --}}
    @stack('scripts')

</body>

</html>
