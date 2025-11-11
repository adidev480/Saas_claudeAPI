@extends('home.home_master')
@section('home')
<div class="cs_height_100 cs_height_lg_80"></div>
    <!-- End Header Section -->
    <!-- Start Blog Details Section -->
    <section class="cs_blog_details">
      <div class="cs_height_66 cs_height_lg_60"></div>
      <div class="container">
        <div class="row cs_gap_y_60">
          <aside class="col-lg-3 offset-lg-1 order-lg-2 wow fadeInDown">
            <div class="cs_sidebar cs_style_1">
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
             
               
            </div>
          </aside>
          <div class="col-lg-8 order-lg-1 wow fadeInLeft">
            <div class="cs_post_details">
              <div class="cs_post_meta_wrapper cs_mb_13">
                <div class="cs_post_meta">By Jenifar</div>
                <div class="cs_post_meta">{{ $blog->created_at->format('j M Y') }}</div>
                <div class="cs_post_meta">0 Comments</div>
              </div>
              <h1>{{ $blog->title }}</h1>
              <img src="{{ asset($blog->image) }}" alt="Post banner">
               
              <article> 
                <p>{!! $blog->content !!} </p>
              </article> 
               
              <div class="cs_post_shares">
                 
                <div class="cs_socials_wrapper">
                  <h3>Shares:</h3>
                  <div class="cs_social_links cs_heading_color">
                    <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                  </div>
                </div>
              </div>
              <div class="cs_post_btns_wrapper">
                <button class="cs_prev">
                <span><i class="fa-solid fa-arrow-left-long"></i></span>
                <span>Prev Post</span>
                </button>
                <button class="cs_prev">
                <span>Next Post</span>
                <span><i class="fa-solid fa-arrow-right-long"></i></span>
                </button>
              </div>
            </div>
            <div class="cs_height_77 cs_height_lg_50"></div>
            <div class="cs_reply_comment">
              <div class="cs_mb_33">
                <h2 class="cs_fs_50 cs_mb_14">Leave A Reply</h2>
                <p class="mb-0">Your email address will not be published. Required fields are marked *</p>
              </div>
              <form action="#" class="cs_comment_form row cs_gap_y_24">
                <div class="col-sm-6">
                  <label for="fullname">Full Name*</label>
                  <input type="text" name="fullname" class="cs_form_field cs_radius_30" id="fullname" required>
                </div>
                <div class="col-sm-6">
                  <label for="email">Email*</label>
                  <input type="email" name="email" class="cs_form_field cs_radius_30" id="email" required>
                </div>
                <div class="col-sm-12">
                  <label for="website">Website*</label>
                  <input type="text" name="website" class="cs_form_field cs_radius_30" id="website" required>
                </div>
                <div class="col-sm-12">
                  <label for="comment">Write Your Comment*</label>
                  <textarea rows="5" name="comment" class="cs_form_field cs_radius_30" id="comment"></textarea>
                </div>
                <div class="col-sm-12">
                  <button type="button" aria-label="Post comment button" class="cs_btn cs_style_1 cs_purple_bg cs_accent_hover cs_white_color wow fadeInUp">
                  <span>Post Comment</span>
                  <span class="cs_btn_icon cs_center overflow-hidden">
                  <i class="fa-solid fa-arrow-right"></i>
                  </span>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="cs_height_140 cs_height_lg_80"></div>
    </section>
    <!-- End Blog Details Section -->
    <!-- Start Support Section -->
    <section class="cs_gray_bg_5">
      <div class="container">
        <div class="cs_support_content_wrapper">
          <div class="cs_support_text wow fadeInLeft">
            <img src="assets/img/support-img-group.png" alt="Group images">
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