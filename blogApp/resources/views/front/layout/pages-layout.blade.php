<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset('frontend/img/title-icon.svg')}}" type="image/png">
    <title>@yield('pageTitle')</title>

    @vite('resources/css/frontend-tailwind.css')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/frontend/css/bootstrap.css">
    <link rel="stylesheet" href="/frontend/css/font-awesome.min.css">
    <link rel="stylesheet" href="/frontend/vendors/jquery-ui/jquery-ui.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- main css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    {{-- custom styles --}}
    @stack('stylesheets')

    {{-- <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" /> --}}

</head>

<body>

    <!--================Header Menu Area =================-->
    <header class="shadow-md sticky top-0 z-[999] bg-[var(--dark-bg)]">
        <div class="max-w-[1400px] mx-auto px-1">
            <div class="flex items-center justify-between py-3">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="/frontend/img/ThinkVerse.png" alt="ThinkVerse" class="w-52">
                </a>

                <!-- Desktop Navigation -->
                <nav class="hidden md:block hover:decoration-none">
                    {!! navigations() !!}
                </nav>

                <!-- User Dropdown Menu -->
                @auth
                <div class="relative inline-block text-left">
                    <button type="button" class="flex items-center text-sm rounded-full focus:outline-none"
                        id="userDropdownToggle">
                        <img class="w-12 h-12 rounded-full object-cover"
                            src="{{ auth()->user()->picture }}" alt="user photo">
                    </button>
                
                    <div id="userDropdown"
                        class="hidden absolute right-0 mt-2 w-48 bg-[var(--primary-color)] text-white rounded-lg shadow-lg z-[9999]">
                        <ul class="py-2 space-y-1 text-sm">
                            <li>
                                <a href="{{ route('user.dashboard') }}"
                                    class="user-nav">Dashboard</a>
                            </li>
                            <li>
                                <a href="{{ route('author_posts',['username'=> Auth::user()->username]) }}"
                                    class="user-nav">Profile</a>
                            </li>
                            <li>
                                <form id="front-logout" action="{{ route('user.logout', ['source' => 'front']) }}"
                                    method="POST" class="w-full">
                                    @csrf
                                    <button type="submit"
                                        class="user-nav text-left w-full cursor-pointer">
                                        Sign out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                @endauth
                
            </div>
        </div>


    </header>


    <!--================ Header Menu Area =================-->

    {{-- dynamic content here --}}
    <section>
        <div>
            @yield('content')
        </div>
    </section>


    <!--================ start footer Area  =================-->
    <footer class="footer-area p-4 bg-[var(--dark-bg)]">
        <div class="container">

            <div class="footer-bottom footer_copy">
                <div>
                    <a href="{{ route('home') }}">
                        <img src="/frontend/img/ThinkVerse.png" alt="" class="mx-auto my-5">
                    </a>
                </div>
                <div class="footer-social">
                    <a href="#">
                        <i class="fa fa-facebook"></i>
                    </a>
                    <a href="#">
                        <i class="fa fa-twitter"></i>
                    </a>
                    <a href="#">
                        <i class="fa fa-dribbble"></i>
                    </a>
                    <a href="#">
                        <i class="fa fa-behance"></i>
                    </a>
                </div>

                <p class="col-lg-12 footer-text">
                    Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved | ThinkVerse
                </p>
            </div>
        </div>
    </footer>
    <!--================ End footer Area  =================-->

    <!-- ####################### Start Scroll to Top Area ####################### -->
    <div id="back-top">
        <a title="Go to Top" href="#">
            <i class="fa fa-angle-up"></i>
        </a>
    </div>
    <!-- ####################### End Scroll to Top Area ####################### -->
    <script>
        const toggleButton = document.getElementById('userDropdownToggle');
        const dropdownMenu = document.getElementById('userDropdown');
    
        toggleButton.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });
    
        // Optional: Hide dropdown on outside click
        window.addEventListener('click', (e) => {
            if (!toggleButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
      </script>
    

    <script src="/frontend/js/jquery-3.2.1.min.js"></script>
    <script src="/frontend/js/popper.js"></script>
    <script src="/frontend/js/bootstrap.min.js"></script>
    <script src="/frontend/vendors/jquery-ui/jquery-ui.js"></script>


    @stack('scripts')
</body>

</html>
