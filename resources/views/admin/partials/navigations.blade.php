<!-- begin::navigation -->
<div class="navigation">
    <div class="navigation-icon-menu">
        <ul>
            <li data-toggle="tooltip" title="کاربران" @if(Request::is('admin/users') || Request::is('admin/users/*') || Request::is('admin/roles') || Request::is('admin/roles/*') || Request::is('admin/permissions') || Request::is('admin/permissions/*') || Request::is('admin/logs')  ) class="active" @endif>
                <a href="#users" title="مدیریت کاربران">
                    <i class="icon ti-user"></i>
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
    </div>
</div>
<!-- end::navigation -->
