<!-- begin::navigation -->
<div class="navigation">
    <div class="navigation-icon-menu">
        <ul>
            <li data-toggle="tooltip" title="کاربران" @if(Request::is('admin/users') || Request::is('admin/users/*') || Request::is('admin/roles') || Request::is('admin/roles/*') || Request::is('admin/permissions') || Request::is('admin/permissions/*') || Request::is('admin/logs')  ) class="active" @endif>
                <a href="#users" title="مدیریت کاربران">
                    <i class="icon ti-user"></i>
                </a>
            </li>
            <li data-toggle="tooltip" title=" محصولات" @if(Request::is('admin/categories') || Request::is('admin/categories/*') ) class="active" @endif>
                <a href="#products" title="محصولات ">
                    <i class="icon ti-folder"></i>
                </a>
            </li>
            <li data-toggle="tooltip" title=" سفارشات" @if(Request::is('admin/orders') ) class="active" @endif>
                <a href="#orders" title="سفارشات ">
                    <i class="icon ti-folder"></i>
                </a>
            </li>
        </ul>
        <ul>
            <li data-toggle="tooltip" title="ویرایش پروفایل">
                <a href="{{route('dashboard')}}" class="go-to-page">
                    <i class="icon ti-settings"></i>
                </a>
            </li>
            <li data-toggle="tooltip" title="خروج">

                <form name="myform" action="{{route('logout')}}" method="post">
                    @csrf
                    <input type='hidden' name='query' />
                    <a href="javascript: submitform()"  class="go-to-page">
                        <i class="icon ti-power-off"></i>
                    </a>
                </form>
            </li>
        </ul>
    </div>
    <div class="navigation-menu-body">
        <ul id="users" @if(Request::is('admin/users') || Request::is('admin/users/*') || Request::is('admin/roles') || Request::is('admin/roles/*') || Request::is('admin/permissions') || Request::is('admin/permissions/*') || Request::is('admin/logs')  ) class="navigation-active" @endif>
            <li @if(Request::is('admin/users/*') || Request::is('admin/users')) class="open" @endif>
                <a href="#">مدیریت کاربران</a>
                <ul>
                    <li><a href="{{route('users.create')}}" @if(Request::is('admin/users/create')) class="active" @endif >ایجاد کاربر</a></li>
                    <li><a href="{{route('users.index')}}" @if(Request::is('admin/users')) class="active" @endif>لیست کاربران</a></li>
                </ul>
            </li>
            <li @if(Request::is('admin/roles/*') || Request::is('admin/roles')) class="open" @endif>
                <a href="#">نقش ها</a>
                <ul>
                    <li><a href="{{route('roles.create')}}"  @if(Request::is('admin/roles/create')) class="active" @endif>ایجاد نقش</a></li>
                    <li><a href="{{route('roles.index')}}"  @if(Request::is('admin/roles')) class="active" @endif >لیست نقش ها</a></li>
                </ul>
            </li>
            <li @if(Request::is('admin/permissions/*') || Request::is('admin/permissions')) class="open" @endif>
                <a href="#">مجوز ها</a>
                <ul>
                    <li><a href="{{route('permissions.create')}}" @if(Request::is('admin/permissions/create')) class="active" @endif>ایجاد مجوزها</a></li>
                    <li><a href="{{route('permissions.index')}}" @if(Request::is('admin/permissions')) class="active" @endif>لیست مجوزها</a></li>
                </ul>
            </li>
            <li @if(Request::is('admin/logs')) class="open" @endif>
                <a href="#">لاگ ها</a>
                <ul>
                    <li><a href="{{route('logs.index')}}" @if(Request::is('admin/logs')) class="active" @endif>لاگ سیستم</a></li>
                </ul>
            </li>
        </ul>
         <ul id="products" @if(Request::is('admin/categories') || Request::is('admin/categories/*') || Request::is('admin/products/*') || Request::is('admin/products') || Request::is('admin/property_group/*') || Request::is('admin/property_group') || Request::is('admin/sliders/*') || Request::is('admin/sliders') || Request::is('admin/brands/*') || Request::is('admin/brands') || Request::is('admin/colors/*') || Request::is('admin/colors') || Request::is('admin/properties/*') || Request::is('admin/properties') || Request::is('admin/comments/*') || Request::is('admin/create_product_properties/*') || Request::is('admin/create_product_gallery/*') ) class="navigation-active" @endif>
            <li @if(Request::is('admin/categories/*') || Request::is('admin/categories')) class="open" @endif>
                <a href="#">دسته بندی </a>
                <ul>
                    <li><a href="{{route('categories.create')}}" @if(Request::is('admin/brands/create')) class="active" @endif >ایجاد دسته بندی</a></li>
                    <li><a href="{{route('categories.index')}}" @if(Request::is('admin/brands')) class="active" @endif>لیست دسته بندی ها</a></li>
                </ul>
            </li>
            <li @if(Request::is('admin/sliders/*') || Request::is('admin/sliders')) class="open" @endif>
                <a href="#"> اسلایدر ها </a>
                <ul>
                    <li><a href="{{route('sliders.create')}}" @if(Request::is('admin/sliders/create')) class="active" @endif >ایجاد اسلایدر </a></li>
                    <li><a href="{{route('sliders.index')}}" @if(Request::is('admin/sliders')) class="active" @endif>لیست   اسلایدرها</a></li>
                </ul>
            </li>
            <li @if(Request::is('admin/brands/*') || Request::is('admin/brands')) class="open" @endif>
                <a href="#"> برند ها </a>
                <ul>
                    <li><a href="{{route('brands.create')}}" @if(Request::is('admin/brands/create')) class="active" @endif >ایجاد برند </a></li>
                    <li><a href="{{route('brands.index')}}" @if(Request::is('admin/brands')) class="active" @endif>لیست   برندها</a></li>
                </ul>
            </li>
            <li @if(Request::is('admin/colors/*') || Request::is('admin/colors')) class="open" @endif>
                <a href="#">  رنگ ها </a>
                <ul>
                    <li><a href="{{route('colors.create')}}" @if(Request::is('admin/colors/create')) class="active" @endif > ایجاد رنگ   </a></li>
                    <li><a href="{{route('colors.index')}}" @if(Request::is('admin/colors')) class="active" @endif>لیست   رنگ ها</a></li>
                </ul>
            </li>
            <li @if(Request::is('admin/products/*') || Request::is('admin/products')) class="open" @endif>
                <a href="#">  محصولات </a>
                <ul>
                    <li><a href="{{route('products.create')}}" @if(Request::is('admin/products/create')) class="active" @endif > ایجاد محصول  </a></li>
                    <li><a href="{{route('products.index')}}" @if(Request::is('admin/products')) class="active" @endif>لیست   محصولات</a></li>
                </ul>
            </li>
            <li @if(Request::is('admin/property_group/*') || Request::is('admin/property_group')) class="open" @endif>
                <a href="#">   گروه ویژگی </a>
                <ul>
                    <li><a href="{{route('property_group.create')}}" @if(Request::is('admin/property_group/create')) class="active" @endif >ایجاد گروه ویژگی </a></li>
                    <li><a href="{{route('property_group.index')}}" @if(Request::is('admin/property_group')) class="active" @endif>لیست گروه ویژگی های </a></li>
                </ul>
            </li>
            <li @if(Request::is('admin/properties/*') || Request::is('admin/properties')) class="open" @endif>
                <a href="#">  ویژگی محصولات</a>
                <ul>
                    <li><a href="{{route('properties.create')}}" @if(Request::is('admin/properties/create')) class="active" @endif >ایجاد  ویژگی محصول</a></li>
                    <li><a href="{{route('properties.index')}}" @if(Request::is('admin/properties')) class="active" @endif>لیست  ویژگی های محصول</a></li>
                </ul>
            </li>
            <li @if(Request::is('admin/comments/*') || Request::is('admin/comments')) class="open" @endif>
                <a href="#">   نظرات</a>
                <ul>
                    <li><a href="{{route('comments.index')}}" @if(Request::is('admin/comments')) class="active" @endif>لیست  نظرها</a></li>
                </ul>
            </li>
        </ul>
        <ul id="orders" @if(Request::is('admin/orders')) class="navigation-active" @endif>
            <li @if( Request::is('admin/orders')) class="open" @endif>
                <a href="#">سفارشات</a>
                <ul>
                    <li><a href="{{route('orders.index')}}" @if(Request::is('admin/orders')) class="active" @endif>لیست سفارشات</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- end::navigation -->
