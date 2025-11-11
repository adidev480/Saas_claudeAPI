@extends('home.home_master')
@section('home')

<div class="cs_height_100 cs_height_lg_80"></div>
    <!-- End Header Section -->
    <!-- Start Blog Section -->
    <section>
      <div class="cs_height_52 cs_height_lg_50"></div>
      <div class="container">
        <div class="text-center ">
          <h2 class="cs_fs_50 cs_mb_15 wow fadeInDown">Latest Insights & Updates</h2>
          <p class="mb-0 wow fadeInUp">Stay informed with our latest articles and updates, covering <br> trends, tips, and insights to help you grow.</p>
        </div>
        <div class="cs_height_64 cs_height_lg_50"></div>
        <div class="row cs_gap_y_60">
          <div class="col-lg-3 order-lg-2 wow fadeInRight">
            <aside class="cs_sidebar cs_style_1">
              <div class="cs_sidebar_widget">
                <form action="#" class="cs_search_form position-relative">
                  <span class="cs_search_icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                  <input type="search" placeholder="Search.." class="cs_form_field cs_radius_30">
                </form>
              </div>
              <div class="cs_sidebar_widget">
                <h3 class="cs_widget_title cs_fs_29 cs_normal cs_mb_16">Categories</h3>
                <ul class="cs_category_list cs_mp_0">
                  <li><a href="#" aria-label="Post category link">Agency (0)</a></li>
                  <li><a href="#" aria-label="Post category link">Business (2)</a></li>
                  <li><a href="#" aria-label="Post category link">SEO (2)</a></li>
                  <li><a href="#" aria-label="Post category link">Corporate (5)</a></li>
                  <li><a href="#" aria-label="Post category link">Artificial Intelligence (1)</a></li>
                  <li><a href="#" aria-label="Post category link">Application (3)</a></li>
                </ul>
              </div>
              
               
            </aside>
          </div>
          <div class="col-lg-9 order-lg-1 wow fadeInLeft">
   
   @foreach ($blog as $item) 
   
   <article class="cs_post cs_style_1 cs_mb_40">
        <a href="blog-details.html" aria-label="Read post details link" class="cs_post_thumbnail cs_radius_10">
        <img src="{{ asset($item->image) }}" alt="Post thumbnail">
        </a>
        <div class="cs_post_content">
        <div class="cs_post_meta_wrapper cs_mb_8">
            <div class="cs_post_meta">By Admin</div>
  <div class="cs_post_meta"> {{ $item->created_at->format('j M Y') }} </div>
            <div class="cs_post_meta">0 Comments</div>
        </div>
        <h3 class="cs_post_title cs_fs_38 cs_mb_15">
            <a href="blog-details.html" aria-label="Read post details link">
            {{ $item->title }}</a>
            </h3>
        <p class="cs_post_subtitle cs_mb_33">
            {!! Str::limit($item->content, 150, '...') !!}</p>
        <a href="{{ route('blog.details',$item->id) }}" aria-label="Read post button" class="cs_btn cs_style_1 cs_purple_bg cs_accent_hover cs_white_color cs_fs_16 cs_semibold cs_radius_30"><span> Read more</span></a>
        </div>
    </article>
    @endforeach

           
          </div>
        </div>
      </div>
    </section>
    <!-- End Blog Section -->
    <!-- Start CTA Section -->
    <section>
      <div class="cs_height_122 cs_height_lg_70"></div>
      <div class="container">
        <div class="cs_center_column text-center">
          <h2 class="cs_fs_68 cs_mb_57 wow fadeInDown">Ready to enhance your sales & <br> customer satisfaction?</h2>
          <form action="#" class="cs_newsletter_form cs_type_1 cs_mb_21 position-relative wow fadeInUp">
            <input type="text" class="cs_newsletter_input cs_radius_50 text-capitalize" placeholder="Enter your email address">
            <button type="submit" aria-label="Subscribe button" class="cs_btn cs_style_1 cs_purple_bg cs_fs_16 cs_semibold cs_white_color">
            <span>Sign Up Free</span>
            </button>
          </form>
          <ul class="cs_list cs_style_2 cs_mp_0">
            <li class="cs_heading_color">
              <i class="fa-solid fa-check cs_accent_color"></i>
              No credit card needed
            </li>
            <li class="cs_heading_color">
              <i class="fa-solid fa-check cs_accent_color"></i>
              Free 14-day trial
            </li>
          </ul>
        </div>
      </div>
      <div class="cs_height_135 cs_height_lg_80"></div>
    </section>
    <!-- End CTA Section -->
    <!-- Start Support Section -->
    <section class="cs_gray_bg_5">
      <div class="container">
        <div class="cs_support_content_wrapper">
          <div class="cs_support_text">
            <img src="assets/img/support-img-group.png" alt="Group images" class="wow zoomIn">
            <h3 class="cs_fs_29 cs_normal mb-0">Any Questions? Our support team is available 24/7</h3>
          </div>
          <button type="button" aria-label="Open chat button" class="cs_btn cs_style_1 cs_heading_bg cs_purple_hover cs_fs_16 cs_white_color cs_semibold mt-0 wow fadeInRight">
          <span>Live Chat Now</span>
          <span class="cs_btn_icon cs_center overflow-hidden">
          <i class="fa-solid fa-arrow-right"></i>
          </span>
          </button>
        </div>
      </div>
    </section>







@endsection