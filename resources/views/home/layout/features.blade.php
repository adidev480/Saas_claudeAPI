
@php
  $project = App\Models\Project::latest()->limit(5)->get();
@endphp

<section class="cs_slider cs_style_1 cs_slider_gap_24">
      <div class="cs_bg_shape_1 cs_purple_bg cs_radius_15 position-absolute"></div>
      <div class="cs_height_125 cs_height_lg_80"></div>
      <div class="container position-relative z-1">
        <div class="cs_section_heading cs_style_1 cs_type_1 cs_mb_60">
          <div class="cs_section_heading_left">
            <h2 class="cs_section_title cs_fs_50 mb-0 wow fadeInLeft">Website Builder Project <br>Templates</h2>
          </div>
          <div class="cs_section_heading_right wow fadeInRight">
            <p class="mb-0">Discover the essential tools and functionalities designed to optimize your <br> customer management, improve sales efficiency, and enhance overall <br> business performance.</p>
          </div>
        </div>
        <div class="cs_slider_container" data-autoplay="0" data-loop="1" data-speed="800" data-center="0" data-variable-width="0" data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="2" data-lg-slides="3" data-add-slides="3">
          <div class="cs_slider_wrapper wow fadeInUp">
   
  @foreach ($project as $item) 
    <div class="cs_slide">
      <div class="cs_iconbox cs_style_1 cs_type_1 cs_heading_bg cs_center_column cs_radius_15 text-center">
        <span class="cs_iconbox_icon cs_center cs_radius_15 cs_accent_bg cs_mb_28">
        <img src="{{ asset('frontend/assets/img/icons/browser.svg') }}" alt="Browser icon">
        </span>
        <div class="cs_iconbox_info">
          <h3 class="cs_iconbox_title cs_fs_29 cs_normal cs_white_color">
            {{ $item->name }}</h3>
          <p class="cs_iconbox_subtitle cs_fs_18 cs_border_color cs_mb_17">Store and organize customer <br> information in a centralized, easily <br> accessible database.</p>
          <a href="{{ route('projects.previewhome', ['project' => $item->id]) }}" target="_blank" aria-label="Click to visit features page" class="cs_iconbox_btn cs_semibold cs_white_color">
          <span>Learn More</span>
          <span class="cs_btn_icon cs_center"><i class="fa-solid fa-arrow-right"></i></span>
          </a>
        </div>
      </div>
    </div>
      @endforeach
    


          </div>
          <div class="cs_height_70 cs_height_lg_50"></div>
          <div class="cs_pagination cs_style_1 wow fadeInDown"></div>
        </div>
      </div>
      <div class="cs_height_140 cs_height_lg_80"></div>
    </section>