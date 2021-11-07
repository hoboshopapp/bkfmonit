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
    <title>User</title>

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
@include('layouts.admin_sidebar' , ['page'=>'admin_user'])
<!-- END MENU SIDEBAR-->

    <!-- PAGE CONTAINER-->
    <div class="page-container">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop d-none">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="header-wrap ">

                        <form class="form-header ">
                            <input class=" au-input au-input--xl" type="text" name="search" id="search_text"
                                   placeholder="Search User System ..."/>
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
        <div class="main-content  ">

            <div class="d-flex flex-column">

                <div class="au-card d-flex flex-row mr-5 ml-5 pull-right text-right " style="direction: rtl">
                    <div class="d-flex flex-column col-lg-4 col-4 col-md-4 col-sm-4 text-center" id="name"></div>
                    <div class="d-flex flex-column col-lg-4 col-4 col-md-4 col-sm-4 text-center" id="username"></div>
                    <div class="d-flex flex-column col-lg-4 col-4 col-md-4 col-sm-4 text-center" id="expire_time"></div>
                </div>

                <div class="row mr-5 ml-5 mt-3 mb-1" style="direction: rtl">
                    <div class="d-flex flex-column col-lg-4 col-12 col-md-12 col-sm-12  pull-right text-right p-2">
                        <button type="button" class="btn active btn-primary" id="add_system">
                            <i class="fa fa-plus-circle"></i> اضافه کردن دستگاه
                        </button>
                    </div>
                    <div class="d-flex flex-column col-lg-4 col-12 col-md-12 col-sm-12  pull-right text-right p-2">
                        <button type="button" class="btn btn-danger" id="delete_user">
                            <i class="fa fa-remove"></i>حذف کاربر
                        </button>
                    </div>
                    <div class="d-flex flex-column col-lg-4 col-12 col-md-12 col-sm-12 pull-right text-right p-2">
                        <button type="button" class="btn btn-dark" id="edit_user">
                            <i class="fa fa-pencil-alt"></i>ویرایش کاربر
                        </button>
                    </div>

                </div>


                <div class="d-flex flex-row mr-5 mt-3 ml-5">
                    <div class="table-responsive table-bordered table--no-card ">
                        <table class=" table table-borderless table-striped table-earning" id="systems_table"
                               style="direction: rtl">
                            <thead>
                            <tr>
                                <th class="text-center" style="padding: 20px;">نام دستگاه</th>
                                <th class="text-center" style="padding: 20px;">نوع دستگاه</th>
                                <th class="text-center" style="padding: 20px;">سریال دستگاه</th>
                                {{--                                <th class="text-center" style="padding: 20px;">تاریخ انقضای اعتبار</th>--}}
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>
                    </div>

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
    console.log(admin)
    var name_text = document.getElementById('name')
    var username_text = document.getElementById('username')
    var expire_text = document.getElementById('expire_time')

    var edit_button = document.getElementById('edit_user')
    var add_system_button = document.getElementById('add_system')

    add_system_button.addEventListener("click",  function () {
        window.location.href = "/admin_add_system?user_id="+admin.id
    })


    edit_button.addEventListener("click", function () {
        window.location.href = "/admin_edit_user?user_id="+admin.id
    })
    var delete_button = document.getElementById('delete_user')
    delete_button.addEventListener("click", function () {
        var confirmd = confirm('آیا مطمن هستید ؟؟؟ تمام دستگاه های کاربر نیز حذف خواهد شد')
        if (!confirmd) {
            return
        }
        $.post("/admin_api_delete_user/?user_id="+admin.id,
            function (status) {

            if (status === 'success'){
                window.location.href = "/admin_users"
            }
            else {
                alert('مشکلی در حذف به وجود آمده است')
            }
            // console.log(status ,data);

        });
        // window.location.href = "/admin_api_delete_user?user_id="+admin.id
    })

    name_text.innerText = 'نام : ' + admin.name
    username_text.innerText = 'نام کاربری : ' + admin.username
    expire_text.innerText = 'تاریخ انقضای اکانت : ' + admin.account_expire_time

    var table_tbody = document.getElementById('systems_table').getElementsByTagName('tbody')[0];
    {{--var search_text = document.getElementById('search_text')--}}
    {{--search_text.value = admin.search--}}
    {{--console.log(users)--}}
    var systems ={!! $user->systems !!};
    update_table(systems)

    function update_table(systems) {
        $("#systems_table tbody tr").remove()
        //
        for (const system of systems) {
            //
            //
            var new_row = table_tbody.insertRow();
            //
            new_row.addEventListener("click", function () {
                // window.location.href = "/admin_user?user_id=" + user.id
            })
            //
            var cell0 = new_row.insertCell()
            cell0.classList.add('text-center')
            var cell1 = new_row.insertCell()
            cell1.classList.add('text-center')
            var cell2 = new_row.insertCell()
            cell2.classList.add('text-center')
            // var cell3 = new_row.insertCell()
            // cell3.classList.add('text-center')
            //
            //
            cell0.innerText = system.name
            cell1.innerText = system.system_type == 1 ? 'setter' : 'hatcher'
            cell2.innerText = system.serial
            // cell3.innerHTML = user.account_expire_time
            //
            //
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
