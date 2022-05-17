<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SEO Meta Tags -->
    <meta name="description"
        content="Create a stylish landing page for your business startup and get leads for the offered services with this HTML landing page template.">
    <meta name="author" content="iman hashemi">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
    <meta property="og:site_name" content="" /> <!-- website name -->
    <meta property="og:site" content="" /> <!-- website link -->
    <meta property="og:title" content="" /> <!-- title shown in the actual shared post -->
    <meta property="og:description" content="" /> <!-- description shown in the actual shared post -->
    <meta property="og:image" content="" /> <!-- image link, make sure it's jpg -->
    <meta property="og:url" content="" /> <!-- where do you want your post to link to -->
    <meta property="og:type" content="article" />

    <!-- Website Title -->
    <title>watch shop</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,600,700,700i&amp;subset=latin-ext"
        rel="stylesheet">
    <link href="{{url('/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{url('/css/fontawesome-all.cs')}}s" rel="stylesheet">
    <link href="{{url('/css/swiper.css')}}" rel="stylesheet">
    <link href="{{url('/css/magnific-popup.css')}}" rel="stylesheet">
    <link href="{{url('/css/styles.css')}}" rel="stylesheet">

    <!-- Favicon  -->
    <link rel="icon" href="{{url('images/favicon.png')}}">
</head>

<body data-spy="scroll" data-target=".fixed-top">

    <!-- Preloader -->
    <div class="spinner-wrapper">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
    <!-- end of preloader -->



    <!-- Header -->
    <header id="header" class="header">
        <div class="header-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="text-container">
                           <h3> به این روزها بگو به احترام بودنت بایستند.

                            به این ساعت‌ها بگو آهسته‌تر بروند؛

                            می‌خواهم کنار دستهایت مقبره‌ای بسازم

                            و تمام ابرها را از تمام پاییزها،

                            تمام گنجشکها را از تمام درختها،

                            به صبح این خانه بیاورم،

                            ساعت را کوک کنم

                            و در انتظار «صبح ‌بخیر» تو دراز بکشم.
                        </h3>
                            @guest
                            <a class="btn-solid-lg page-scroll" href="{{route('login')}}">ورود</a>
                            <a class="btn-solid-lg page-scroll" href="{{route('register')}}">ثبت نام</a>
                            @endguest
                            @auth
                            @php $user =auth()->user(); @endphp
                            @if($user->hasRole(['ادمین']) || $user->id==1)
                            <a class="btn-solid-lg page-scroll" href="{{route('admin.panel')}}">پنل کاربری</a>
                            @endif
                            @endauth
                        </div> <!-- end of text-container -->
                    </div> <!-- end of col -->
                    <div class="col-lg-6">
                        <div class="image-container">
                            <img class="img-fluid" src="{{url('images/header-teamwork.svg')}}" alt="alternative">
                        </div> <!-- end of image-container -->
                    </div> <!-- end of col -->
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </div> <!-- end of header-content -->
    </header> <!-- end of header -->
    <!-- end of header -->


    <!-- Scripts -->
    <script src="{{url('/js/jquery.min.js')}}"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
    <script src="{{url('/js/popper.min.js')}}"></script> <!-- Popper tooltip library for Bootstrap -->
    <script src="{{url('/js/bootstrap.min.js')}}"></script> <!-- Bootstrap framework -->
    <script src="{{url('/js/jquery.easing.min.js')}}"></script>
    <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="{{url('/js/swiper.min.js')}}"></script> <!-- Swiper for image and text sliders -->
    <script src="{{url('/js/jquery.magnific-popup.js')}}"></script> <!-- Magnific Popup for lightboxes -->
    <script src="{{url('/js/validator.min.js')}}"></script>
    <!-- Validator.js - Bootstrap plugin that validates forms -->
    <script src="{{url('/js/scripts.js')}}"></script> <!-- Custom scripts -->
</body>

</html>
