@extends('home.home_master')
@section('home')

    <!-- Start Hero Section -->
    @include('home.layout.slider')
    <!-- End Hero Section -->
    <!-- Start Features Section -->
    @include('home.layout.features')
    <!-- End Features Section -->
    <!-- Start Brands Section -->
    @include('home.layout.brands')
    <!-- End Brands Section -->
    <!-- Start Business Solution Section -->
    @include('home.layout.business_solution')
    <!-- End Business Solution Section -->
    <!-- Start CTA Section -->
    @include('home.layout.cta')
    <!-- End CTA Section -->
    <!-- Start Features Card Section -->
   @include('home.layout.features_two')
    <!-- End Features Card Section -->
    <!-- Start Testimonial Section -->
   @include('home.layout.testimonial')
    <!-- End Testimonial Section -->
    <!-- Start Pricing Section -->
   @include('home.layout.pricing')
    <!-- End Pricing Section --> 
    <!-- Start FAQ Section -->
    @include('home.layout.faq')
    <!-- End FAQ Section -->
    <!-- Start CTA Section -->
    @include('home.layout.cta_two')
    <!-- End CTA Section --> 

@endsection