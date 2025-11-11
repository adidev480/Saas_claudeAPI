
@php
  $slider = App\Models\Slider::find(1);
@endphp

<section class="cs_hero cs_style_1 cs_type_3 position-relative" id="home">
      <div class="container">
        <div class="cs_hero_content">
          <div class="row align-items-center cs_gap_y_40">
            <div class="col-lg-5 order-lg-2">
              <div class="cs_hero_thumbnail cs_radius_15 position-relative wow fadeInRight">

                <img id="appImage" src="{{ asset($slider->image) }}" alt="Hero Image" style="cursor: pointer">
                @if (auth()->check())
 <input type="file" id="uploadImage" style="display:none">                  
                @endif

                <div class="cs_hero_shape_vector position-absolute">
                  <img src="{{ asset('frontend/assets/img/quarter-circle.svg') }}" alt="Vector Shape">
                </div>
                <div class="cs_volume_report cs_white_bg cs_radius_15 position-absolute">
                  <img src="{{ asset('frontend/assets/img/volume.jpg') }}" alt="Volume report chart">
                </div>
                <div class="cs_sells_report cs_white cs_radius_20 position-absolute">
                  <img src="{{ asset('frontend/assets/img/sells-report.jpg') }}" alt="Sells report chart">
                </div>
              </div>
            </div>
            <div class="col-lg-7 order-lg-1">
              <div class="cs_hero_text position-relative z-2">
                
  <h1 class="cs_hero_title cs_fs_68 wow fadeInDown editable-title" contenteditable={{ auth()->check() && auth()->user()->role === 'admin' ? 'true' : 'false' }} data-id="{{ $slider->id }}"> {{ $slider->title }} <span class="position-relative">
    
    <img src="{{ asset('frontend/assets/img/vector.svg') }}" alt="Vector line" class="cs_line_1 position-absolute">
    <img src="{{ asset('frontend/assets/img/vector-2.svg') }}" alt="Vector line" class="cs_line_2 position-absolute">
    </span>
  </h1>

  <p class="cs_hero_subtitle editable-description" contenteditable={{ auth()->check() && auth()->user()->role === 'admin' ? 'true' : 'false' }} data-id="{{ $slider->id }}">{{ $slider->description }}</p>

                <div class="cs_btn_group position-relative">
                  <a href="{{ $slider->link }}" aria-label="Sign in button" class="cs_btn cs_style_1 cs_purple_bg cs_white_color wow fadeInLeft"><span>Get a Demo</span></a>
                  <a href="register.html" aria-label="Register free button" class="cs_btn cs_style_1 cs_outline cs_semibold cs_heading_color wow fadeInRight">
                  <span class="cs_player_text">Get Started Free</span>
                  </a>
                </div>
                <div class="cs_blob_5 position-absolute"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    {{-- CSRF Token  --}}
  <meta name="csrf-token" content="{{ csrf_token() }}" >

  <script>
   document.addEventListener("DOMContentLoaded", function(){
     
     function saveChanges(element) {
       let appId = element.dataset.id;
       let field = element.classList.contains("editable-title") ? "title" : "description";
       let newValue = element.innerText.trim();

       fetch(`/update-slider/${appId}`,{
         method: "POST",
         headers: {
           "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),"Content-Type": "application/json"
         },
         body: JSON.stringify({ [field]:newValue })
       })
       .then(response => response.json())
       .then(data => {
         if(data.success) {
           console.log(`${field} updated successfully`);
         }
       })
       .catch(error => console.error("Error:", error)); 
     }

     // Auto save on Enter Key
     document.addEventListener("keydown", function(e){
       if (e.key === "Enter") {
         e.preventDefault();
         saveChanges(e.target);
       }
     });

     // Auto save on losing foucs
     document.querySelectorAll(".editable-title, .editable-description").forEach(el => {
       el.addEventListener("blur", function() {
         saveChanges(el);
       });
     });

     
     /// IMAGE UPLOADED FUNCTION START
     let imageElement = document.getElementById("appImage");
     let uploadInput = document.getElementById("uploadImage");

     imageElement.addEventListener("click", function(){
      @if (auth()->check())
      uploadInput.click();        
      @endif
     });

     uploadInput.addEventListener("change", function(){
      let file = this.files[0];
      if (!file) return;

      let formData = new FormData();
      formData.append("image",file);
      formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute("content"));

      fetch("/update-slider-image/1",{
        method: "POST",
        body: formData
      })
      .then(response => response.json())
      .then(data => {
          if(data.success) {
            imageElement.src = data.image_url;
            console.log(`Image updated successfully`);
          }
        })
        .catch(error => console.error("Error:", error)); 

     }); 
   
   });
  </script>