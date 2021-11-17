<header class="header-mobile d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="ml-3 header-mobile-inner">
                <a href="/admin_users">
                    <div class=" row  d-flex flex-row align-items-center text-center  justify-content-center ">
                        <img src="images/icon/bkf3_icon.png" alt="BKFMonit"/>
                        <h5 class="text-dark ml-2">BKFMonit</h5>
                    </div>

                </a>
                <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled rtl-side-bar">
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


            </ul>
        </div>
    </nav>
</header>



<script>
</script>
