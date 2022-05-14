
@section('content')
    <!-- main start  -->
    <div id="main">
    <!-- wrapper-->
        <div id="wrapper">
            <!-- content-->
            <div class="content">
                <!--  section  -->
                <section class="parallax-section dashboard-header-sec gradient-bg" data-scrollax-parent="true">
                    <div class="container">
                        <!--Tariff Plan menu-->
{{--                        <div   class="tfp-btn"><span>طرح تعرفه : </span> <strong>تمدید شده</strong></div>--}}
                        <div class="tfp-det">
                            <p>شما در حال <a href="#">تمدید هستید </a> . برای مشاهده جزئیات یا به روزرسانی از لینک زیر استفاده کنید. </p>
                            <a href="#" class="tfp-det-btn color2-bg">جزئیات</a>
                        </div>
                        <!--Tariff Plan menu end-->
                        <div class="dashboard-header_conatiner fl-wrap dashboard-header_title">
                            <h1>خوش آمدید  : <span>{{auth()->user()->name}}</span></h1>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="dashboard-header fl-wrap" style="height: 100px;">
                        <div class="container">
                            <div class="dashboard-header_conatiner fl-wrap">
                                <div class="dashboard-header-avatar">
                                    <img src="{{ url('images/'.auth()->user()->profile_photo_path)}}" alt="profile">
                                    <a href="{{url('/user/profile')}}" class="color-bg edit-prof_btn"><i class="fal fa-edit"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gradient-bg-figure" style="right:-30px;top:10px;"></div>
                    <div class="gradient-bg-figure" style="left:-20px;bottom:30px;"></div>
                    <div class="circle-wrap" style="left:120px;bottom:120px;" data-scrollax="properties: { translateY: '-200px' }">
                        <div class="circle_bg-bal circle_bg-bal_small"></div>
                    </div>
                    <div class="circle-wrap" style="right:420px;bottom:-70px;" data-scrollax="properties: { translateY: '150px' }">
                        <div class="circle_bg-bal circle_bg-bal_big"></div>
                    </div>
                    <div class="circle-wrap" style="left:420px;top:-70px;" data-scrollax="properties: { translateY: '100px' }">
                        <div class="circle_bg-bal circle_bg-bal_big"></div>
                    </div>
                    <div class="circle-wrap" style="left:40%;bottom:-70px;"  >
                        <div class="circle_bg-bal circle_bg-bal_middle"></div>
                    </div>
                    <div class="circle-wrap" style="right:40%;top:-10px;"  >
                        <div class="circle_bg-bal circle_bg-bal_versmall" data-scrollax="properties: { translateY: '-350px' }"></div>
                    </div>
                    <div class="circle-wrap" style="right:55%;top:90px;"  >
                        <div class="circle_bg-bal circle_bg-bal_versmall" data-scrollax="properties: { translateY: '-350px' }"></div>
                    </div>
                </section>
                <!--  section  end-->
                <!--  section  -->
                <section class="gray-bg main-dashboard-sec" id="sec1">
                    <div class="container">
                        <!--  dashboard-menu-->
                        <div class="col-md-3">
                            <div class="mob-nav-content-btn color2-bg init-dsmen fl-wrap"><i class="fal fa-bars"></i> منوی داشبورد</div>
                            <div class="clearfix"></div>
                            <div class="fixed-bar fl-wrap" id="dash_menu">
                                <div class="user-profile-menu-wrap fl-wrap block_box">
                                    <!-- user-profile-menu-->
                                    <div class="user-profile-menu">
                                        <h3>اصلی</h3>
                                        <ul class="no-list-style">
                                            <li><a href="{{route('dashboard')}}"><i class="fal fa-chart-line"></i>داشبورد</a></li>
                                            <li><a href="{{route('profile.show')}}"><i class="fal fa-user-edit"></i> ویرایش پروفایل</a></li>
                                        </ul>
                                    </div>
                                    <!-- user-profile-menu end-->
                                    <form action="{{route('logout')}}" method="post">
                                        @csrf
                                        <button class="logout_btn color2-bg">خروج <i class="fas fa-sign-out"></i></button>
                                    </form>
                                </div>
                            </div>
                            <a class="back-tofilters color2-bg custom-scroll-link fl-wrap" href="#dash_menu">بازگشت<i class="fas fa-caret-up"></i></a>
                        </div>
                        <!-- dashboard-menu  end-->
                        <!-- dashboard content-->
                        <div class="col-md-9">
                            <div class="dashboard-title fl-wrap">
                                <h3>آمار شما</h3>
                            </div>
                            <!-- list-single-facts -->
                            <div class="list-single-facts fl-wrap">
                                <div class="row">
                                    <div class="col-md-4">
                                        <!-- inline-facts -->
                                        <div class="inline-facts-wrap gradient-bg ">
                                            <div class="inline-facts">
                                                <i class="fal fa-chart-bar"></i>
                                                <div class="milestone-counter">
                                                    <div class="stats animaper">
                                                        <div class="num" data-content="0" data-num="0">0</div>
                                                    </div>
                                                </div>
                                                <h6>تعداد بازدید ها </h6>
                                            </div>
                                            <div class="stat-wave">
                                                <svg viewbox="0 0 100 25">
                                                    <path fill="#fff" d="M0 30 V12 Q30 17 55 2 T100 11 V30z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <!-- inline-facts end -->
                                    </div>
                                    <div class="col-md-4">
                                        <!-- inline-facts  -->
                                        <div class="inline-facts-wrap gradient-bg ">
                                            <div class="inline-facts">
                                                <i class="fal fa-comments-alt"></i>
                                                <div class="milestone-counter">
                                                    <div class="stats animaper">
                                                        <div class="num" data-content="0" data-num="0">0</div>
                                                    </div>
                                                </div>
                                                <h6>تعداد نظرات</h6>
                                            </div>
                                            <div class="stat-wave">
                                                <svg viewbox="0 0 100 25">
                                                    <path fill="#fff" d="M0 30 V12 Q30 6 55 12 T100 11 V30z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <!-- inline-facts end -->
                                    </div>
                                    <div class="col-md-4">
                                        <!-- inline-facts  -->
                                        <div class="inline-facts-wrap gradient-bg ">
                                            <div class="inline-facts">
                                                <i class="fal fa-envelope-open-dollar"></i>
                                                <div class="milestone-counter">
                                                    <div class="stats animaper">
                                                        <div class="num" data-content="0" data-num="0">0</div>
                                                    </div>
                                                </div>
                                                <h6>تعداد مطلب </h6>
                                            </div>
                                            <div class="stat-wave">
                                                <svg viewbox="0 0 100 25">
                                                    <path fill="#fff" d="M0 30 V12 Q30 12 55 5 T100 11 V30z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <!-- inline-facts end -->
                                    </div>
                                </div>
                            </div>
                            <!-- list-single-facts end -->

                            <!-- dashboard-list-box-->
                            <div class="dashboard-list-box  fl-wrap">
                                <!-- dashboard-list end-->
                                <div class="dashboard-list fl-wrap">
                                    <div class="dashboard-message">
                                        <span class="new-dashboard-item"><i class="fal fa-times"></i></span>
                                        <div class="dashboard-message-text">
                                            <i class="far fa-check green-bg"></i>
                                            <p>تبلیغ شما <a href="#">فروشگاه زنجیره ای</a> تأیید شده است! </p>
                                        </div>
                                        <div class="dashboard-message-time"><i class="fal fa-calendar-week"></i> 28 اسفند 1399</div>
                                    </div>
                                </div>
                                <!-- dashboard-list end-->
                            </div>
                            <!-- dashboard-list-box end-->
                        </div>
                        <!-- dashboard content end-->
                    </div>
                </section>
                <!--  section  end-->
                <div class="limit-box fl-wrap"></div>
            </div>
            <!--content end-->
        </div>
    <!-- wrapper end-->
        @include('front.partials.footer')
        <a class="to-top"><i class="fas fa-caret-up"></i></a>
    </div>
    <!-- Main end -->
@endsection
