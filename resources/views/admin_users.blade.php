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
    <title>Users</title>

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
{{--    @include('layouts.msidebar' , ['page'=>'dashboard'])--}}


<!-- END HEADER MOBILE-->

    <!-- MENU SIDEBAR-->
@include('layouts.admin_sidebar' , ['page'=>'admin_users'])
<!-- END MENU SIDEBAR-->

    <!-- PAGE CONTAINER-->
    <div class="page-container">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="header-wrap ">
                        <form class="form-header">
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
        <div class="col main-content  ">
            <div class="row mr-5 ml-5 pull-right text-right">
                <button type="button" class="btn btn-outline-primary" id="add_user_button" >
                    <i class="fa fa-plus-circle"></i> اضافه کردن کاربر
                </button>
            </div>


            <div class="row mr-5 ml-5">
                <div class="table-responsive table-bordered table--no-card ">
                    <table class=" table table-borderless table-striped table-earning" id="systems_table"
                           style="direction: rtl">
                        <thead>
                        <tr>
                            <th class="text-center" style="padding: 20px;">نام کاربر</th>
                            <th class="text-center" style="padding: 20px;">نام کاربری</th>
                            <th class="text-center" style="padding: 20px;">تاریخ ثبت</th>
                            <th class="text-center" style="padding: 20px;">تاریخ انقضای اعتبار</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                </div>

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
    var admin ={!! $user !!};
    var users = admin.users;
    var table_tbody = document.getElementById('systems_table').getElementsByTagName('tbody')[0];
    var search_text = document.getElementById('search_text')
    search_text.value = admin.search

    var add_user_button = document.getElementById('add_user_button')
    add_user_button.addEventListener("click", function () {
        window.location.href = "/admin_add_user"
    })
    console.log(users)
    update_table(users)
    {{--    var users ={!! $user->users !!};--}}
    function update_table(users) {
        $("#systems_table tbody tr").remove()

        for (const user of users) {


            var new_row = table_tbody.insertRow();

            new_row.addEventListener("click", function () {
                window.location.href = "/admin_user?user_id="  + user.id
            })

            var cell0 = new_row.insertCell()
            cell0.classList.add('text-center')
            var cell1 = new_row.insertCell()
            cell1.classList.add('text-center')
            var cell2 = new_row.insertCell()
            cell2.classList.add('text-center')
            var cell3 = new_row.insertCell()
            cell3.classList.add('text-center')


            cell0.innerText = user.name
            cell1.innerText = user.username
            cell2.innerText = user.created_at
            cell3.innerHTML = user.account_expire_time


        }
    }


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
