 @php
   $review = App\Models\Review::latest()->limit(5)->get();
 @endphp
 <section>
      <div class="cs_height_120 cs_height_lg_70"></div>
      <div class="container">
        <div class="cs_section_heading cs_style_1 text-center cs_mb_55">
          <h2 class="cs_fs_50 mb-0 wow fadeInDown">Customer Reviews and <br> Success Stories</h2>
        </div>
      </div>
      <div class="cs_slider cs_style_1 cs_slider_gap_24">
        <div class="cs_slider_container" data-autoplay="0" data-loop="1" data-speed="800" data-center="1" data-variable-width="1" data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="2" data-lg-slides="4" data-add-slides="4">
          <div class="cs_slider_wrapper">
            
          @foreach ($review as $item) 
            <div class="cs_slide">
              <div class="cs_testimonial cs_style_1 cs_radius_15 position-relative">
                <div class="cs_avatar cs_style_1 cs_mb_41">
                  <span class="cs_avatar_icon cs_center cs_radius_100">
                  <img src="{{ asset($item->image) }}" alt="Avatar">
                  </span>
                  <div class="cs_avatar_info">
                    <h3 class="cs_fs_21 fw-normal">{{ $item->name }}</h3>
                    <p class="mb-0">{{ $item->post }}</p>
                  </div>
                </div>
                <blockquote>{{ $item->message }}</blockquote>
                <div class="cs_rating" data-rating="5">
                  <div class="cs_rating_percentage"></div>
                </div>
                <span class="cs_quote_icon position-absolute">                
                </span>
              </div>
            </div>
            @endforeach 

           
          </div>
          <div class="cs_height_70 cs_height_lg_50"></div>
          <div class="cs_pagination cs_style_1 wow fadeInUp"></div>
        </div>
      </div>
      <div class="cs_height_140 cs_height_lg_80"></div>
    </section>