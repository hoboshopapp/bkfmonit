<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo text-center d-flex flex-row align-items-center justify-content-center">
        <a href="/">
            <div class="row  d-flex flex-row align-items-center text-center  justify-content-center ">
                <img src="images/icon/bkf3_icon.png" alt="BKFMonit"/>
                <h5 class="text-dark ml-2">BKFMonit</h5>
            </div>

        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list rtl-side-bar">
{{--                <div>{{$page}}</div>--}}
                @if($page =='admin_users')
                    <li class="active has-sub">
                        <a class="js-arrow" href="#">
                            <i class="fas fa-users"></i>کاربران</a>
                    </li>
                @else
                    <li class="has-sub">
                        <a class="js-arrow" href="/admin_users">
                            <i class="fas fa-users"></i>کاربران</a>
                    </li>
                @endif


                <li>
                    <a href="/logout">
                        <i class="fas fa-remove"></i>خروج از حساب</a>
                </li>

{{--                @if($page =='admin_systems')--}}
{{--                    <li class="active has-sub">--}}
{{--                        <a class="js-arrow" href="#">--}}
{{--                            <i class="fas fa-tachometer-alt"></i>دستگاه ها</a>--}}
{{--                    </li>--}}
{{--                @else--}}
{{--                    <li class="has-sub">--}}
{{--                        <a class="js-arrow" href="/admin_systems">--}}
{{--                            <i class="fas fa-tachometer-alt"></i>دستگاه ها</a>--}}
{{--                    </li>--}}
{{--                @endif--}}


            </ul>
        </nav>
    </div>
</aside>

<script>
</script>
