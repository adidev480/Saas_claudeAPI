<header class="cs_site_header cs_style_1 cs_sticky_header">
      <div class="cs_main_header cs_fs_18 cs_heading_color">
        <div class="container">
          <div class="cs_main_header_in">
            <div class="cs_main_header_left">
              <a class="cs_site_branding" href="{{ url('/') }}" aria-label="Home page link">
              <img src="{{ asset('frontend/assets/img/logo.svg') }}" alt="Logo">
              </a>
            </div>
            <div class="cs_main_header_center">
              <div class="cs_nav">
<ul class="cs_nav_list"> 
    <li><a href="{{ url('/') }}" aria-label="Menu link">Home</a></li>
    <li><a href="{{ route('pricing') }}" aria-label="Menu link">Pricing</a></li>
    <li><a href="{{ route('blog') }}" aria-label="Menu link">Blog</a></li> 
    <li><a href="contact.html" aria-label="Menu link">Contact</a></li>
</ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>