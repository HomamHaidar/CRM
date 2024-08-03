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
                    <span class="mb-0 text-muted">{{Auth()->user()->getRoleNames()->first()}}</span>
                </div>
            </div>
        </div>
        <ul class="side-menu">


            <li class="slide">
                <a class="side-menu__item" href="{{route('dashboard')}}">

                    <p class="side-menu__icon"><i class="la la-home"></i></p>

                    <span>الرئيسية</span></a>
            </li>
            @can('index deal')
            <li class="slide">
                <a class="side-menu__item"  href="{{route('deal.index')}}" >

                    <p class="side-menu__icon"><i class="las la-coins"></i></p>

                    <span>الصفقات</span></a>
            </li>
            @endcan
            @can('index client')
            <li class="slide">
                <a class="side-menu__item" href="{{route('client.index')}}">
                    <p class="side-menu__icon"><i class="far fa-address-book"></i></p>


                    <span>العملاء</span></a>

            </li>
            @endcan
            @can('index lead')
            <li class="slide">
                <a class="side-menu__item" href="{{route('lead.index')}}">
                    <p class="side-menu__icon"><i class="la la-user-plus"></i></p>

                    <span> العملاء المحتملين </span></a>

            </li>
            @endcan
            @can('index task')
            <li class="slide">
                <a class="side-menu__item" href="{{route('activity.index')}}">
                    <p class="side-menu__icon"><i class="la la-tasks "></i></p>

                    <span> المهام </span></a>

            </li>
            @endcan
            @can('index company')
                <li class="slide">
                    <a class="side-menu__item" href="{{route('company.index')}}" >
                        <p class="side-menu__icon"><i class="la la-building"></i></p>

                        <span>الشركات</span></a>

                </li>
            @endcan
            @can('index product')
            <li class="slide">
                <a class="side-menu__item"  href="{{route('product.index')}}">
                    <p class="side-menu__icon"><i class="fe fe-box"></i></p>

                    <span>المنتجات</span></a>

            </li>
            @endcan
            @can('index journey')
            <li class="slide">
                <a class="side-menu__item" href="{{route('journey.index')}}" >
                    <p class="side-menu__icon">   <i class="fe fe-map"></i></p>

                    <span>نماذج الرحلة</span></a>

            </li>
            @endcan
            @can('index user')
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" >
                        <p class="side-menu__icon"><i class="las la-user"></i></p>

                        <span class="side-menu__label">المستخدمين والادوار</span><i class="angle fe fe-chevron-down"></i>

                    </a>
                            <ul class="slide-menu">
                                <li><a class="slide-item" href="{{route('user.index')}}">المستخدمين</a></li>
                                <li><a class="slide-item" href="{{route('role.index')}}">الادوار</a></li>
                            </ul>


                </li>
            @endcan
            @can('index archive')
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" >
                        <p class="side-menu__icon"> <i class="las la-archive"></i></p>

                        <span class="side-menu__label">الارشيف</span><i class="angle fe fe-chevron-down"></i>

                    </a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" href="{{route('index.archive.lead')}}">العملاء</a></li>
                        <li><a class="slide-item" href="{{route('index.archive.deal')}}">الصفقات</a></li>
                    </ul>


                </li>
            @endcan

        </ul>
    </div>
</aside>
<!-- main-sidebar -->
