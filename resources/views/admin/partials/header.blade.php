<!-- begin::header -->
<div class="header">
    <!-- begin::header logo -->
    <div class="header-logo">
        <a href="{{route('admin.panel')}}">
            <img class="large-logo" src="{{url('panel/assets/media/image/logo.png')}}" alt="image">
        </a>
    </div>
    <!-- end::header logo -->
    <!-- begin::header body -->
    <div class="header-body">
        <div class="header-body-left">
            <!-- begin::breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.panel')}}">داشبورد</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
                </ol>
            </nav>
            <!-- end::breadcrumb -->
        </div>
    </div>
    <!-- end::header body -->
</div>
<!-- end::header -->
