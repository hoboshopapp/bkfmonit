<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Add System</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous"> -->

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
    <script src="js/kuma-gauge.jquery.js"></script>

    <!-- SevenSeg  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.0/knockout-min.js"></script>
    <script src="js/sevenSeg.js"></script>


</head>

<body class="animsition">
<div class="page-wrapper">
    <!-- HEADER MOBILE-->
@include('layouts.admin_msidebar' ,['page'=>'dashboard'])


<!-- END HEADER MOBILE-->

    <!-- MENU SIDEBAR-->
@include('layouts.admin_sidebar' , ['page'=>'admin_user'])
<!-- END MENU SIDEBAR-->

    <!-- PAGE CONTAINER-->
    <div class="page-container">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop d-none">
            <div class="section__content --p30">
                <div class="container-fluid">
                    <div class="header-wrap ">
                        <form class="form-header d-none ">
                            <input class=" au-input au-input--xl" type="text" name="search" id="search_text"
                                   placeholder="Search User ..."/>
                            <button class="au-btn--submit" type="submit">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>
        <!-- HEADER DESKTOP-->

        <!-- MAIN CONTENT-->
        <div class="main-content  d-flex justify-content-center" style="direction: rtl;">


            <div class="col-lg-6">
                <div class="card text-right">
                    <div class="card-header">اضافه کردن دستگاه به کاربر</div>
                    <div class="card-body card-block">
                        <form action="/admin_api_add_system" method="post" class="">
                            <input name="user_id" value="{{$user_id}}" hidden>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <input type="text" id="name" name="name" placeholder="نام دستگاه" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-server"></i>
                                    </div>
                                    <input type="text" id="serial" name="serial" placeholder="سریال دستگاه"
                                           class="form-control">
                                </div>
                            </div>
                            <a>نوع سیستم</a>
                            <select class="form-select form-control mt-2" aria-label="Default select example" name="system_type">
{{--                                <option selected>نوع سیستم</option>--}}
                                <option selected value="2">Hatcher</option>
                                <option value="1">Setter</option>
                            </select>
                            <div class="form-actions form-group mt-3">
                                <button type="submit" class="btn btn-success btn-sm">اضافه کردن</button>
                            </div>
                        </form>
                    </div>
                </div>

                @if(session('status'))
                    @if(session('status') == 'success')
                        <div class="alert alert-success mt-5 text-center">
                            {{  session()->get('message') }}
                        </div>
                    @else
                        <div class="alert alert-danger mt-5 text-center">
                            {{  session()->get('message') }}
                        </div>
                    @endif

                @endif
            </div>

        </div>


        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
    </div>

</div>

<!-- Jquery JS-->
<script src="vendor/jquery-3.2.1.min.js"></script>

<!-- Bootstrap JS-->
<script src="vendor/bootstrap-4.1/popper.min.js"></script>
<script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
<!-- Vendor JS       -->
<script src="vendor/slick/slick.min.js">
</script>
<script src="vendor/wow/wow.min.js"></script>
<script src="vendor/animsition/animsition.min.js"></script>
<script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
</script>
<script src="vendor/counter-up/jquery.waypoints.min.js"></script>
<script src="vendor/counter-up/jquery.counterup.min.js">
</script>
<script src="vendor/circle-progress/circle-progress.min.js"></script>
<script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="vendor/chartjs/Chart.bundle.min.js"></script>
<script src="vendor/select2/select2.min.js">
</script>

<script>


</script>
<!-- Main JS-->
<script src="js/main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.0/knockout-min.js"></script>
<script src="js/sevenSeg.js"></script>
<script>

</script>

</body>
</html>

<!-- end document-->
