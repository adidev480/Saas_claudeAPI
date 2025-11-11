<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Gosaas - SaaS & Software Landing Page HTML Template">
    <meta name="author" content="Laralink">
    <!-- Favicon Icon -->
    <link rel="icon" href="assets/img/favicon.png">
    <!-- Site Title -->
   <title>Easy Website Builder Application </title>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/odometer.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/slick.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
  </head>
  <body>
    <!-- Start Preloader -->
    <div class="cs_preloader cs_white_bg">
      <div class="cs_preloader_in position-relative">
       <span></span>
       <span></span>
      </div>
      </div>
    <!-- End Preloader -->
    <!-- Start Header Section -->
    @include('home.body.header')
    <!-- End Header Section -->
    @yield('home')
    <!-- Start Footer Section -->
    @include('home.body.footer')
    <!-- End Footer Section -->
    <!-- Start Scroll Up Button -->
    <!-- Start Scroll Up Button -->
    <button type="button" aria-label="Scroll to top button" class="cs_scrollup cs_purple_bg cs_white_color cs_radius_100">
      <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 10L1.7625 11.7625L8.75 4.7875V20H11.25V4.7875L18.225 11.775L20 10L10 0L0 10Z" fill="currentColor" />
      </svg>
      </button>
    <!-- End Scroll Up Button -->
    <!-- Script -->
    <script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.slick.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/odometer.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
  </body>
</html>