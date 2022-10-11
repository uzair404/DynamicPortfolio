<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Uzair Asif - Programming Enthusiastic</title>
  <meta content="Uzair Asif - Programming Enthusiastic" name="description">
  <meta content="Uzair Asif - Programming Enthusiastic" name="keywords">

  <!-- jquery -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <!-- toastr -->
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <!-- Favicons -->
  @php
    $fav_icon = 'uploads/herosection/'.$nav_heading->fav_icon;
  @endphp
  <link href="{{ asset($fav_icon) }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <script src="https://kit.fontawesome.com/55da33b8b0.js" crossorigin="anonymous"></script>


  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body>

  {{-- alerts  --}}
    @if ($errors->any())
      <script>
        @foreach ($errors->all() as $error)
        toastr.error('Failed', '{{ $error }}');
        @endforeach
      </script>
    @endif

    @if(session()->has('success'))
    <script>
      toastr.success('Success', '{{ session()->get('success') }}');
    </script>
    @endif
  {{-- alerts end --}}
  
  {{-- all sections --}}
  @php
  $nav_status = $sections->where('name', 'navbar')->first()->status;
  $hero_status = $sections->where('name', 'hero')->first()->status;
  $about_status = $sections->where('name', 'about')->first()->status;
  $services_status = $sections->where('name', 'services')->first()->status;
  $work_status = $sections->where('name', 'work')->first()->status;
  $testimonials_status = $sections->where('name', 'testimonials')->first()->status;
  $blog_status = $sections->where('name', 'blog')->first()->status;
  $contact_status = $sections->where('name', 'contact')->first()->status;
  $counter_status = $sections->where('name', 'counter')->first()->status;
  @endphp
  {{-- all sections end --}}

  <!-- ======= Header ======= -->
  @if($nav_status == 1)
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="{{url('/')}}">{{$nav_heading->heading}}</a></h1>

      <nav id="navbar" class="navbar">
        <ul>
          @foreach($nav_section as $nav)
          <li><a class="nav-link scrollto" href="{{$nav->link}}">{{$nav->heading}}</a></li>
          {{-- <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#services">Services</a></li>
          <li><a class="nav-link scrollto " href="#work">Work</a></li>
          <li><a class="nav-link scrollto " href="#blog">Blog</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li> --}}
          @endforeach
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
      <!-- .navbar -->
      
    </div>
  </header>
  <script>
    $(".nav-link").first().hide();
  </script>
  @endif
  <!-- End Header -->

  @php
  $hero_file = 'uploads/herosection/'.$hero_section->file;
  @endphp
  <!-- ======= Hero Section ======= -->
  @if($hero_status == 1)
  <div id="hero" class="hero route bg-image" style="background-image: url({{$hero_file}})">
    <div class="overlay-itro"></div>
    <div class="hero-content display-table">
      <div class="table-cell">
        <div class="container">
          <!--<p class="display-6 color-d">Hello, world!</p>-->
          <h1 class="hero-title mb-4">{{$hero_section->heading}}</h1>
          <p class="hero-subtitle"><span class="typed" data-typed-items="{{$hero_section->sub_heading}}"></span></p>
          <!-- <p class="pt-3"><a class="btn btn-primary btn js-scroll px-4" href="#about" role="button">Learn More</a></p> -->
        </div>
      </div>
    </div>
  </div>
  @endif
  <!-- End Hero Section -->

  <main id="main">

    <!-- ======= About Section ======= -->
    @if($about_status == 1)
    <section id="about" class="about-mf sect-pt4 route">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="box-shadow-full">
              <div class="row">
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-sm-6 col-md-5">

                      @php
                      $about_file = 'uploads/aboutsection/'.$about_section->about_file;
                      @endphp
                      <div class="about-img">
                        <img src="{{url($about_file)}}" class="img-fluid rounded b-shadow-a" alt="">
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-7">
                      <div class="about-info">
                        <p><span class="title-s">Name: </span> <span>{{$about_section->name}}</span></p>
                        <p><span class="title-s">Profile: </span> <span>{{$about_section->profile}}</span></p>
                        <p><span class="title-s">Email: </span> <span>{{$about_section->email}}</span></p>
                        <p><span class="title-s">Phone: </span> <span>{{$about_section->phone}}</span></p>
                      </div>
                    </div>
                  </div>
                  <div class="skill-mf">
                    <p class="title-s">Skills</p>                  
                    @foreach($skills as $skill)
                    <span>{{strtoupper($skill->name)}}</span> <span class="pull-right">{{$skill->percent}}%</span>
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" style="width: {{$skill->percent}}%;" aria-valuenow="{{$skill->percent}}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    @endforeach
                  </div>


                </div>
                <div class="col-md-6">
                  <div class="about-me pt-4 pt-md-0">
                    <div class="title-box-2">
                      <h5 class="title-left">
                        About me
                      </h5>
                    </div>
                    <div id="Aboutme">
                     {!! $about_section->about_me !!}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    @endif
    <!-- End About Section -->

    <!-- ======= Services Section ======= -->
    @if($services_status == 1)
    <section id="services" class="services-mf pt-5 route">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="title-box text-center">
              <h3 class="title-a">
                Services
              </h3>
              {{-- <p class="subtitle-a">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit.
              </p> --}}
              <div class="line-mf"></div>
            </div>
          </div>
        </div>
        <div class="row">
          @foreach($services as $service)
          <div class="col-md-6">
              <div class="service-box">
                <div class="service-ico">
                  <span class="ico-circle"><i class="{{$service->icon}}"></i></span>
                </div>
                <div class="service-content">
                  <h2 class="s-title">{{$service->heading}}</h2>
                  <p class="s-description text-center">
                    {{$service->text}}
                  </p>
                </div>
              </div>
            </div>
            @endforeach
          
        </div>
      </div>
    </section>
    @endif
    <!-- End Services Section -->

    <!-- ======= Counter Section ======= -->
    @if($counter_status == 1)
    <div class="section-counter paralax-mf bg-image" style="background-image: url(assets/img/counters-bg.jpg)">
      <div class="overlay-mf"></div>
      <div class="container position-relative">
        <div class="row">
          <div class="col-sm-3 col-lg-3">
            <div class="counter-box counter-box pt-4 pt-md-0">
              <div class="counter-ico">
                <span class="ico-circle"><i class="bi bi-check"></i></span>
              </div>
              <div class="counter-num">
                <p data-purecounter-start="0" data-purecounter-end="450" data-purecounter-duration="1" class="counter purecounter"></p>
                <span class="counter-text">WORKS COMPLETED</span>
              </div>
            </div>
          </div>
          <div class="col-sm-3 col-lg-3">
            <div class="counter-box pt-4 pt-md-0">
              <div class="counter-ico">
                <span class="ico-circle"><i class="bi bi-journal-richtext"></i></span>
              </div>
              <div class="counter-num">
                <p data-purecounter-start="0" data-purecounter-end="25" data-purecounter-duration="1" class="counter purecounter"></p>
                <span class="counter-text">YEARS OF EXPERIENCE</span>
              </div>
            </div>
          </div>
          <div class="col-sm-3 col-lg-3">
            <div class="counter-box pt-4 pt-md-0">
              <div class="counter-ico">
                <span class="ico-circle"><i class="bi bi-people"></i></span>
              </div>
              <div class="counter-num">
                <p data-purecounter-start="0" data-purecounter-end="550" data-purecounter-duration="1" class="counter purecounter"></p>
                <span class="counter-text">TOTAL CLIENTS</span>
              </div>
            </div>
          </div>
          <div class="col-sm-3 col-lg-3">
            <div class="counter-box pt-4 pt-md-0">
              <div class="counter-ico">
                <span class="ico-circle"><i class="bi bi-award"></i></span>
              </div>
              <div class="counter-num">
                <p data-purecounter-start="0" data-purecounter-end="48" data-purecounter-duration="1" class="counter purecounter"></p>
                <span class="counter-text">AWARD WON</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif
    <!-- End Counter Section -->

    <!-- ======= Portfolio Section ======= -->
    @if($work_status == 1)
    <section id="work" class="portfolio-mf sect-pt4 route">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="title-box text-center">
              <h3 class="title-a">
                Portfolio
              </h3>
              {{-- <p class="subtitle-a">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit.
              </p> --}}
              <div class="line-mf"></div>
            </div>
          </div>
        </div>
        <div class="row">
          @foreach($works as $work)
          @php
          $img = 'uploads/herosection/'.$work->file;
          @endphp
          <div class="col-md-4">
            <div class="work-box">
              <a href="{{$img}}" data-gallery="portfolioGallery" class="portfolio-lightbox">
                <div class="work-img">
                  <img src="{{$img}}" alt="" class="img-fluid">
                </div>
              </a>
              <div class="work-content">
                <div class="row">
                  <div class="col-sm-8">
                    <h2 class="w-title">{{$work->heading}}</h2>
                    <div class="w-more">
                      <span class="w-ctegory">{{$work->category}}</span> / <span class="w-date">{{$work->date}}</span>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="w-like">
                      <a href="{{$work->link }}"> <span class="bi bi-plus-circle"></span></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>
    @endif
    <!-- End Portfolio Section -->

    <!-- ======= Testimonials Section ======= -->
    @if($testimonials_status == 1)
    <div id="testimonials" class="testimonials paralax-mf bg-image" style="background-image: url(assets/img/overlay-bg.jpg)">
      <div class="overlay-mf"></div>
      <div class="container">
        <div class="row">
          <div class="col-md-12">

            <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
              <div class="swiper-wrapper">

                <div class="swiper-slide">
                  <div class="testimonial-box">
                    <div class="author-test">
                      <img src="assets/img/testimonial-2.jpg" alt="" class="rounded-circle b-shadow-a">
                      <span class="author">Xavi Alonso</span>
                    </div>
                    <div class="content-test">
                      <p class="description lead">
                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Lorem ipsum dolor sit amet,
                        consectetur adipiscing elit.
                      </p>
                    </div>
                  </div>
                </div><!-- End testimonial item -->

                <div class="swiper-slide">
                  <div class="testimonial-box">
                    <div class="author-test">
                      <img src="assets/img/testimonial-4.jpg" alt="" class="rounded-circle b-shadow-a">
                      <span class="author">Marta Socrate</span>
                    </div>
                    <div class="content-test">
                      <p class="description lead">
                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Lorem ipsum dolor sit amet,
                        consectetur adipiscing elit.
                      </p>
                    </div>
                  </div>
                </div><!-- End testimonial item -->
              </div>
              <div class="swiper-pagination"></div>
            </div>

            <!-- <div id="testimonial-mf" class="owl-carousel owl-theme">
          
        </div> -->
          </div>
        </div>
      </div>
    </div>@endif
    <!-- End Testimonials Section -->

    <!-- ======= Blog Section ======= -->
    @if($blog_status == 1)
    <section id="blog" class="blog-mf sect-pt4 route">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="title-box text-center">
              <h3 class="title-a">
                Blog
              </h3>
              <p class="subtitle-a">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit.
              </p>
              <div class="line-mf"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="card card-blog">
              <div class="card-img">
                <a href="blog-single.html"><img src="assets/img/post-1.jpg" alt="" class="img-fluid"></a>
              </div>
              <div class="card-body">
                <div class="card-category-box">
                  <div class="card-category">
                    <h6 class="category">Travel</h6>
                  </div>
                </div>
                <h3 class="card-title"><a href="blog-single.html">See more ideas about Travel</a></h3>
                <p class="card-description">
                  Proin eget tortor risus. Pellentesque in ipsum id orci porta dapibus. Praesent sapien massa, convallis
                  a pellentesque nec,
                  egestas non nisi.
                </p>
              </div>
              <div class="card-footer">
                <div class="post-author">
                  <a href="#">
                    <img src="assets/img/testimonial-2.jpg" alt="" class="avatar rounded-circle">
                    <span class="author">Morgan Freeman</span>
                  </a>
                </div>
                <div class="post-date">
                  <span class="bi bi-clock"></span> 10 min
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-blog">
              <div class="card-img">
                <a href="blog-single.html"><img src="assets/img/post-2.jpg" alt="" class="img-fluid"></a>
              </div>
              <div class="card-body">
                <div class="card-category-box">
                  <div class="card-category">
                    <h6 class="category">Web Design</h6>
                  </div>
                </div>
                <h3 class="card-title"><a href="blog-single.html">See more ideas about Travel</a></h3>
                <p class="card-description">
                  Proin eget tortor risus. Pellentesque in ipsum id orci porta dapibus. Praesent sapien massa, convallis
                  a pellentesque nec,
                  egestas non nisi.
                </p>
              </div>
              <div class="card-footer">
                <div class="post-author">
                  <a href="#">
                    <img src="assets/img/testimonial-2.jpg" alt="" class="avatar rounded-circle">
                    <span class="author">Morgan Freeman</span>
                  </a>
                </div>
                <div class="post-date">
                  <span class="bi bi-clock"></span> 10 min
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-blog">
              <div class="card-img">
                <a href="blog-single.html"><img src="assets/img/post-3.jpg" alt="" class="img-fluid"></a>
              </div>
              <div class="card-body">
                <div class="card-category-box">
                  <div class="card-category">
                    <h6 class="category">Web Design</h6>
                  </div>
                </div>
                <h3 class="card-title"><a href="blog-single.html">See more ideas about Travel</a></h3>
                <p class="card-description">
                  Proin eget tortor risus. Pellentesque in ipsum id orci porta dapibus. Praesent sapien massa, convallis
                  a pellentesque nec,
                  egestas non nisi.
                </p>
              </div>
              <div class="card-footer">
                <div class="post-author">
                  <a href="#">
                    <img src="assets/img/testimonial-2.jpg" alt="" class="avatar rounded-circle">
                    <span class="author">Morgan Freeman</span>
                  </a>
                </div>
                <div class="post-date">
                  <span class="bi bi-clock"></span> 10 min
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>@endif
    <!-- End Blog Section -->

    <!-- ======= Contact Section ======= -->
    @if($contact_status == 1)
    <section id="contact" class="paralax-mf footer-paralax bg-image sect-mt4 route" style="background-image: url(assets/img/overlay-bg.jpg)">
      <div class="overlay-mf"></div>
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="contact-mf">
              <div id="contact" class="box-shadow-full">
                <div class="row">
                  <div class="col-md-6">
                    <div class="title-box-2">
                      <h5 class="title-left">
                        Send Message Us
                      </h5>
                    </div>
                    <div>
                      <form action="{{url('/contact')}}" method="post" role="form" class="php-email-form">@csrf
                        <div class="row">
                          <div class="col-md-12 mb-3">
                            <div class="form-group">
                              <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                            </div>
                          </div>
                          <div class="col-md-12 mb-3">
                            <div class="form-group">
                              <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                            </div>
                          </div>
                          <div class="col-md-12 mb-3">
                            <div class="form-group">
                              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                            </div>
                          </div>
                          <div class="col-md-12 text-center my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                          </div>
                          <div class="col-md-12 text-center">
                            <button type="submit" class="button button-a button-big button-rouded">Send Message</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="title-box-2 pt-4 pt-md-0">
                      <h5 class="title-left">
                        Get in Touch
                      </h5>
                    </div>
                    <div class="more-info">
                      <p class="lead">
                        {{$contact_section->get_in_touch_text}}
                      </p>
                      <ul class="list-ico">
                        <li><span class="bi bi-geo-alt"></span> {{$contact_section->address}}</li>
                        <li><span class="bi bi-phone"></span> {{$contact_section->phone}}</li>
                        <li><span class="bi bi-envelope"></span> {{$contact_section->email}}</li>
                      </ul>
                    </div>
                    <div class="socials">
                    @php
                      $facebook = $social_links->where('name', 'facebook')->first();
                      $instagram = $social_links->where('name', 'instagram')->first();
                      $linkedin = $social_links->where('name', 'linkedin')->first();
                      $twitter = $social_links->where('name', 'twitter')->first();
                    @endphp
                      <ul>
                        @if($facebook->status == 0)
                        <li><a href="{{$facebook->link}}"><span class="ico-circle"><i class="bi bi-facebook"></i></span></a></li>
                        @endif
                        @if($instagram->status == 0)
                        <li><a href="{{$instagram->link}}"><span class="ico-circle"><i class="bi bi-instagram"></i></span></a></li>
                        @endif
                        @if($twitter->status == 0)
                        <li><a href="{{$twitter->link}}"><span class="ico-circle"><i class="bi bi-twitter"></i></span></a></li>
                        @endif
                        @if($linkedin->status == 0)
                        <li><a href="{{$linkedin->link}}"><span class="ico-circle"><i class="bi bi-linkedin"></i></span></a></li>
                        @endif
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>@endif
    <!-- End Contact Section -->

  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  <!-- <footer>
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="copyright-box">
            <p class="copyright">&copy; Copyright <strong>DevFolio</strong>. All Rights Reserved</p>
            <div class="credits"> -->
              <!--
              All the links in the footer should remain intact.
              You can delete the links only if you purchased the pro version.
              Licensing information: https://bootstrapmade.com/license/
              Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=DevFolio
            -->
              <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer> -->
  <!-- End  Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/typed.js/typed.min.js"></script>
  {{-- <script src="assets/vendor/php-email-form/validate.js"></script> --}}

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>