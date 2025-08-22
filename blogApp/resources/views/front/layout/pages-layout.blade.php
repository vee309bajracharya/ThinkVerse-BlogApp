<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="frontend/img/title-icon.svg" type="image/png">
    <title>@yield('pageTitle')</title>

    @vite('resources/css/frontend-tailwind.css')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/frontend/css/bootstrap.css">
    <link rel="stylesheet" href="/frontend/vendors/linericon/style.css">
    <link rel="stylesheet" href="/frontend/css/font-awesome.min.css">
    <link rel="stylesheet" href="/frontend/vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="/frontend/vendors/lightbox/simpleLightbox.css">
    <link rel="stylesheet" href="/frontend/vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="/frontend/vendors/animate-css/animate.css">
    <link rel="stylesheet" href="/frontend/vendors/jquery-ui/jquery-ui.css">
    <!-- main css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    {{-- custom styles --}}
    @stack('stylesheets')


</head>

<body class="bg-[#F8F8FF]">

    <!--================Header Menu Area =================-->
	<header class="shadow-md sticky top-0 z-50 bg-gray-100">
		<div class="container mx-auto px-4">
			<div class="flex items-center justify-between py-3">
				<!-- Logo -->
				<a href="{{ route('home') }}" class="flex items-center">
					<img src="/frontend/img/ThinkVerse.png" alt="ThinkVerse" class="w-52">
				</a>
	
				<!-- Desktop Navigation -->
				<nav class="hidden md:block hover:decoration-none">
					{!! navigations() !!}
				</nav>
	
				<!-- Mobile Menu Button -->
				<button id="mobile-menu-button" class="md:hidden p-2 focus:outline-none">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
					</svg>
				</button>
			</div>
	
			<!-- Mobile Menu (Hidden by default) -->
			<div id="mobile-menu" class="hidden md:hidden bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
				{!! navigations(true) !!}
			</div>
		</div>
	</header>
	
	<script>
		document.getElementById('mobile-menu-button').addEventListener('click', function() {
			const menu = document.getElementById('mobile-menu');
			menu.classList.toggle('hidden');
		});
	</script>


    <!--================ Header Menu Area =================-->

    {{-- dynamic content here --}}
    <section>
        <div>
            @yield('content')
        </div>
    </section>


    <!--================ start footer Area  =================-->
    <footer class="footer-area p-4">
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

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="/frontend/js/jquery-3.2.1.min.js"></script>
    <script src="/frontend/js/popper.js"></script>
    <script src="/frontend/js/bootstrap.min.js"></script>
    <script src="/frontend/js/stellar.js"></script>
    <script src="/frontend/js/mail-script.js"></script>
    <script src="/frontend/js/wow.min.js"></script>
    <script src="/frontend/js/theme.js"></script>
    @stack('scripts')
</body>

</html>
