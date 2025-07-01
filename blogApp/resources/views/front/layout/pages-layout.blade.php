<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="frontend/img/title-icon.svg" type="image/png">
	<title>@yield('pageTitle')</title>
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

<body>

	<!--================Header Menu Area =================-->
	<header class="header_area">
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<a class="navbar-brand logo_h" href="index.html">
						<img src="/frontend/img/ThinkVerse.png" alt="ThinkVerse" class="logo">
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						<ul class="nav navbar-nav menu_nav justify-content-center mx-auto">
							<li class="nav-item">
								<a class="nav-link" href="index.html">Home</a>
							</li>

							{!! navigations() !!}


							{{-- <li class="nav-item submenu dropdown active">
								<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
								 aria-expanded="false">Pages</a>
								<ul class="dropdown-menu">
									<li class="nav-item">
										<a class="nav-link" href="elements.html">Elements</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="single-blog.html">Post Details</a>
									</li>
								</ul>
							</li> --}}


							<li class="nav-item">
								<a class="nav-link" href="contact.html">Contact</a>
							</li>
						</ul>
						{{-- <ul class="nav navbar-nav ml-auto search">
								<li class="nav-item d-flex align-items-center mr-10">
									<div class="menu-form">
										<form>
											<div class="form-group">
												<input type="text" class="form-control" placeholder="Search here">
											</div>
										</form>
									</div>
									<button type="submit" class="search-icon">
										<i class="lnr lnr-magnifier"></i>
									</button>
								</li>
							</ul> --}}
					</div>
				</div>
			</nav>
		</div>
	</header>
	<!--================ Header Menu Area =================-->
    
    {{-- dynamic content here --}}
    <section>
        <div class="">
            @yield('content')
        </div>
    </section>


	<!--================ start footer Area  =================-->
	<footer class="footer-area section-gap">
		<div class="container">
			<div class="single-footer-widget footer_middle">
				<img src="/frontend/img/ThinkVerse.png" alt="">
				<p class="mt-50">Stay updated with our latest trends</p>
				<div id="mc_embed_signup">
					<form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
					 method="get" class="subscribe_form relative">
						<div class="input-group d-flex flex-row">
							<input name="EMAIL" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '"
							 required="" type="email">
							<button class="btn sub-btn">
								<span class="lnr lnr-arrow-right"></span>
							</button>
						</div>
						<div class="mt-10 info"></div>
					</form>
				</div>
			</div>
			<div class="footer-bottom footer_copy">
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
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | ThinkVerse</p>
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
	<script src="/frontend/vendors/lightbox/simpleLightbox.min.js"></script>
	<script src="/frontend/vendors/nice-select/js/jquery.nice-select.min.js"></script>
	<script src="/frontend/vendors/isotope/imagesloaded.pkgd.min.js"></script>
	<script src="/frontend/vendors/isotope/isotope-min.js"></script>
	<script src="/frontend/vendors/owl-carousel/owl.carousel.min.js"></script>
	<script src="/frontend/vendors/jquery-ui/jquery-ui.js"></script>
	<script src="/frontend/js/jquery.ajaxchimp.min.js"></script>
	<script src="/frontend/js/mail-script.js"></script>
	<script src="/frontend/js/wow.min.js"></script>
	<script src="/frontend/https://maps.googleapis.com/maps/api/js?key=***REMOVED***"></script>
	<script src="/frontend/js/theme.js"></script>
    @stack('scripts')
</body>

</html>