<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">

    </div>
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    <img alt="user-img" class="avatar avatar-xl brround"
                         src="{{URL::asset('assets/img/faces/useravatar.png')}}"><span
                        class="avatar-status profile-status bg-green"></span>
                </div>
                <div class="user-info">
                    <h4 class="font-weight-semibold mt-3 mb-0">{{Auth()->user()->name}}</h4>
                    <span class="mb-0 text-muted">Admin</span>
                </div>
            </div>
        </div>
        <ul class="side-menu">


            <li class="slide">
                <a class="side-menu__item" href="{{route('dashboard')}}">

                    <p class="side-menu__icon"><i class="la la-home"></i></p>

                    <span>الرئيسية</span></a>
            </li>

            <li class="slide">
                <a class="side-menu__item" >

                    <p class="side-menu__icon"><i class="la la-home"></i></p>

                    <span>الصفقات</span></a>
            </li>
            <li class="slide">
                <a class="side-menu__item" href="{{route('client.index')}}">
                    <p class="side-menu__icon"><i class="la la-home"></i></p>

                    <span>العملاء</span></a>

            </li>
            <li class="slide">
                <a class="side-menu__item" href="{{route('lead.index')}}">
                    <p class="side-menu__icon"><i class="la la-home"></i></p>

                    <span> العملاء المحتملين </span></a>

            </li>
            <li class="slide">
                <a class="side-menu__item" href="{{route('company.index')}}" >
                    <p class="side-menu__icon"><i class="la la-home"></i></p>

                    <span>الشركات</span></a>

            </li>
            <li class="slide">
                <a class="side-menu__item"  href="{{route('product.index')}}">
                    <p class="side-menu__icon"><i class="la la-home"></i></p>

                    <span>المنتجات</span></a>

            </li>
            <li class="slide">
                <a class="side-menu__item" >
                    <p class="side-menu__icon"><i class="la la-home"></i></p>

                    <span>نماذج الرحلة</span></a>

            </li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" >
                    <p class="side-menu__icon"><i class="la la-home"></i></p>

                    <span class="side-menu__label">المستخدمين والادوار</span><i class="angle fe fe-chevron-down"></i>

                </a>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{route('user.index')}}">المستخدمين</a></li>
                            <li><a class="slide-item" href="{{route('role.index')}}">الادوار</a></li>
                        </ul>


            </li>
            <li class="slide">
                <a class="side-menu__item"  >
                    <p class="side-menu__icon"><i class="la la-home"></i></p>

                    <span>الاعدادات</span></a>

            </li>


        </ul>
    </div>
</aside>
<!-- main-sidebar -->
