<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo text-center d-flex flex-row align-items-center justify-content-center">
        <a href="#">
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
                <li>
                    <a href="#">
                        <i class="fas fa-user"></i>حساب کاربری</a>
                </li>

                @if($page =='dashboard')
                    <li class="active has-sub">
                        <a class="js-arrow" href="#">
                            <i class="fas fa-tachometer-alt"></i>داشبورد</a>
                    </li>
                @else
                    <li class="has-sub">
                        <a class="js-arrow" href="/">
                            <i class="fas fa-tachometer-alt"></i>داشبورد</a>
                    </li>
                @endif

                @if($page == 'charts')
                        <li class="active">
                            <a href="#">
                                <i class="fas fa-chart-bar"></i>نمودار ها</a>
                        </li>
                @else
                        <li>
                            <a href="/charts">
                                <i class="fas fa-chart-bar"></i>نمودار ها</a>
                        </li>
                @endif

                <li>
                    <a href="#">
                        <i class="fas fa-table"></i>جدول ها</a>
                </li>
                <!--                        <li>-->
                <!--                            <a href="form.html">-->
                <!--                                <i class="far fa-check-square"></i>Forms</a>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <a href="calendar.html">-->
                <!--                                <i class="fas fa-calendar-alt"></i>Calendar</a>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <a href="map.html">-->
                <!--                                <i class="fas fa-map-marker-alt"></i>Maps</a>-->
                <!--                        </li>-->
                <!--                        <li class="has-sub">-->
                <!--                            <a class="js-arrow" href="#">-->
                <!--                                <i class="fas fa-copy"></i>Pages</a>-->
                <!--                            <ul class="list-unstyled navbar__sub-list js-sub-list">-->
                <!--                                <li>-->
                <!--                                    <a href="login.html">Login</a>-->
                <!--                                </li>-->
                <!--                                <li>-->
                <!--                                    <a href="register.html">Register</a>-->
                <!--                                </li>-->
                <!--                                <li>-->
                <!--                                    <a href="forget-pass.html">Forget Password</a>-->
                <!--                                </li>-->
                <!--                            </ul>-->
                <!--                        </li>-->
                <!--                        <li class="has-sub">-->
                <!--                            <a class="js-arrow" href="#">-->
                <!--                                <i class="fas fa-desktop"></i>UI Elements</a>-->
                <!--                            <ul class="list-unstyled navbar__sub-list js-sub-list">-->
                <!--                                <li>-->
                <!--                                    <a href="button.html">Button</a>-->
                <!--                                </li>-->
                <!--                                <li>-->
                <!--                                    <a href="badge.html">Badges</a>-->
                <!--                                </li>-->
                <!--                                <li>-->
                <!--                                    <a href="tab.html">Tabs</a>-->
                <!--                                </li>-->
                <!--                                <li>-->
                <!--                                    <a href="card.html">Cards</a>-->
                <!--                                </li>-->
                <!--                                <li>-->
                <!--                                    <a href="alert.html">Alerts</a>-->
                <!--                                </li>-->
                <!--                                <li>-->
                <!--                                    <a href="progress-bar.html">Progress Bars</a>-->
                <!--                                </li>-->
                <!--                                <li>-->
                <!--                                    <a href="modal.html">Modals</a>-->
                <!--                                </li>-->
                <!--                                <li>-->
                <!--                                    <a href="switch.html">Switchs</a>-->
                <!--                                </li>-->
                <!--                                <li>-->
                <!--                                    <a href="grid.html">Grids</a>-->
                <!--                                </li>-->
                <!--                                <li>-->
                <!--                                    <a href="fontawesome.html">Fontawesome Icon</a>-->
                <!--                                </li>-->
                <!--                                <li>-->
                <!--                                    <a href="typo.html">Typography</a>-->
                <!--                                </li>-->
                <!--                            </ul>-->
                <!--                        </li>-->
            </ul>
        </nav>
    </div>
</aside>

<script>
</script>
