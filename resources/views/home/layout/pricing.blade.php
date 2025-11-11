 @php
   $plans = App\Models\Plan::orderBy('id')->get();
   $orderedPlans = collect([$plans->where('id',2)->first(), $plans->where('id',5)->first(), $plans->where('id',6)->first() ])->filter();

 @endphp
 
 <section class="position-relative">
      <div class="cs_bg_shape_1 cs_accent_bg cs_radius_15 position-absolute"></div>
      <div class="cs_height_125 cs_height_lg_70"></div>
      <div class="container position-relative z-1">
        <div class="cs_section_heading cs_style_1 cs_mb_42 text-center">
          <h2 class="cs_section_title cs_fs_50 mb-0 wow fadeInDown">Transparent pricing plans, find the <br> perfect fit for your needs</h2>
        </div>
        <ul class="cs_pricing_control cs_type_1 cs_center p-0 position-relative">
          <li class="active"><a href="monthly" aria-label="Pricing toggle button">Monthly</a><span class="cs_switch"></span></li>
          <li>
            <a href="yearly" aria-label="Pricing toggle button">Annually</a>
            <div class="cs_offer_info cs_type_1 cs_heading_color position-absolute">
              <svg width="64" height="27" viewBox="0 0 64 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M63.2728 3.31355C62.7609 2.99354 62.1574 2.63567 61.6072 2.40842C57.7794 0.50156 53.6369 -0.123714 49.2796 0.0309426C42.8353 0.300803 36.7947 1.93186 30.8527 4.36371C21.1406 8.38715 12.8326 14.7279 5.70033 22.6402C5.66202 22.7329 5.6237 22.8257 5.45538 22.9733C6.05891 23.3312 6.57075 23.6512 7.26597 24.047C6.08085 24.3175 4.98743 24.6259 3.894 24.9344C3.80231 24.8965 3.74893 24.7659 3.74893 24.7659C4.22376 23.8762 4.75197 23.1171 5.2268 22.2274C7.73785 18.487 10.2489 14.7465 12.7599 11.0061C12.8366 10.8206 12.8749 10.7278 12.9515 10.5423C12.8981 10.4117 12.8064 10.3738 12.7148 10.3359C10.9959 9.30018 10.9959 9.30018 9.67942 10.9281C7.0233 14.5 4.32887 18.1647 1.67275 21.7366C1.27455 22.4408 0.929723 23.2756 0.714902 24.0556C0.423455 25.021 0.782037 25.712 1.66064 26.1835C2.68432 26.8235 3.82294 27.1853 5.17638 26.7671C8.71667 25.732 12.3103 24.8276 15.9423 23.8304C16.3324 23.6658 16.7224 23.5011 17.1658 23.4671C17.2041 23.3743 17.1124 23.3365 17.1124 23.3365C15.6384 21.9675 14.0181 21.7326 12.2514 22.6316C11.5631 22.9987 10.768 23.1047 9.80453 23.3582C9.88116 23.1727 9.91947 23.0799 10.0495 23.025C15.9872 17.2254 22.3218 12.024 29.6336 8.09485C37.1137 4.0181 45.2111 1.82507 53.819 1.25449C56.441 1.14314 59.0015 1.4407 61.3623 2.74158C61.9658 3.09945 62.6843 3.17906 63.2344 3.4063L63.2728 3.31355Z" fill="#6C6C6C"/>
              </svg>
              <span>Save 20%</span>
            </div>
          </li>
        </ul>

   
        <div class="cs_pricing_table_wrapper_2">

    @foreach ($orderedPlans as $index => $plan) 
          <div class="cs_pricing_table cs_style_1 cs_type_3 cs_white_bg cs_radius_20 {{ $plan->name === 'Starter' ? 'active' : '' }}  position-relative {{ $index === 0 ? 'wow fadeInLeft' : ($index === 1 ? 'wow fadeInDown' : 'wow fadeInRight') }}  ">
            @if ($plan->name === 'Starter')
              <span class="cs_pricing_badge cs_fs_16 position-absolute">Most Popular</span>
            @endif

            <div class="cs_pricing_head cs_mb_14">
              <h2 class="cs_fs_38 mb-0">{{ $plan->name }}</h2>
              <p class="cs_mb_18">
                @if ($plan->name === 'Free')
                  Free for small team
                @elseif ($plan->name === 'Starter')
                  Most popular deal
                @else 
                For your large team
                @endif
              </p>
              <hr>
            </div>
            <h3 class="cs_fs_38 cs_mb_17">$<span class="monthlyPrice">{{ number_format($plan->price, 2) }}</span><span class="yearlyPrice">{{ number_format($plan->price * 12 * 0.8 , 2) }}</span>
              <small class="cs_fs_18 cs_normal cs_gray2_color">/
              <span class="monthlyText">month</span>
              <span class="yearlyText">year</span>
              </small>
            </h3>
            <ul class="cs_pricing_feature_list cs_mp_0">
              
              <li>
                <span class="cs_feature_icon cs_center cs_radius_100 cs_accent_bg cs_white_color"><i class="fa-solid fa-check"></i></span>
                Up to {{ $plan->template_limit }} Projects
              </li>
              <li>
                <span class="cs_feature_icon cs_center cs_radius_100 cs_accent_bg cs_white_color"><i class="fa-solid fa-check"></i></span>
                {{ $plan->token_limit }} Tokens
              </li>
              <li>
                <span class="cs_feature_icon cs_center cs_radius_100 cs_accent_bg cs_white_color"><i class="fa-solid {{ $plan->name === 'Free' ? 'fa-xmark' : 'fa-check' }} "></i></span>
                Unlimited cards
              </li>
              <li>
                <span class="cs_feature_icon cs_center cs_radius_100 cs_accent_bg cs_white_color"><i class="fa-solid fa-xmark"></i></span>
                Unlimited storage (10MB/file)
              </li>
              <li>
                <span class="cs_feature_icon cs_center cs_radius_100 cs_accent_bg cs_white_color"><i class="fa-solid fa-xmark"></i></span>
                Unlimited activity log
              </li>
              <li>
                <span class="cs_feature_icon cs_center cs_radius_100 cs_accent_bg cs_white_color"><i class="fa-solid {{ $plan->name === 'Free' ? 'fa-xmark' : 'fa-check' }} "></i></span>
                Assignee and due dates
              </li>
               
            </ul>
            <a href="{{ route('register') }}" aria-label="Buy service button" class="cs_pricing_btn cs_center cs_fs_16 cs_semibold">Choose Plan</a>
          </div>
        @endforeach

           
        </div>
      </div>
      <div class="cs_height_140 cs_height_lg_80"></div>
    </section>