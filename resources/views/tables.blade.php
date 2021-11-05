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
    <title>Tables</title>

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
@include('layouts.msidebar' , ['page'=>'tables'])
    <!-- END HEADER MOBILE-->

    <!-- MENU SIDEBAR-->
@include('layouts.sidebar' , ['page'=>'tables'])
<!-- END MENU SIDEBAR-->

    <!-- PAGE CONTAINER-->
    <div class="page-container">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="header-wrap ">
                        <form class="form-header d-none" action="" method="POST">
                            <input class=" au-input au-input--xl" type="text" name="search"
                                   placeholder="Search for datas &amp; reports..."/>
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
        <div class="main-content ">
            <div class="container">
                <!--  SELECTOR DIV -->
                <div class="au-card text-center">
                    <ul class="d-flex flex-row justify-content-center nav nav-pills SS " id="systems_tab_list"
                        role="tablist">
                        @foreach($user->systems as $system)
                            @if($system->id == $user->selected_system->id)
                                <li class="nav-item">
                                    <a class="nav-link active" id="system{{$system->id}}button" data-toggle="pill"
                                       href="#pills-home"
                                       role="tab" aria-controls="pills-home"
                                       aria-selected="true">{{ $system->name }}</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" id="system{{$system->id}}button" data-toggle="pill"
                                       href="#pills-home"
                                       role="tab" aria-controls="pills-home"
                                       aria-selected="true">{{ $system->name }}</a>
                                </li>
                            @endif
                            <script>
                                var button = document.getElementById("system{!! $system->id !!}button");
                                button.addEventListener("click", function () {
                                    window.location.href = "/tables?system_id=" + {!! $system->id !!}
                                })
                                {{--document.getElementById("system{!! $system->id !!}button").addEventListener("click", function () {--}}
                                {{--    console.log({!! $system->name !!})--}}
                                {{--});--}}
                            </script>

                        @endforeach
                    </ul>

                    <ul class="d-flex flex-row justify-content-center nav nav-pills SS mt-3" id="pills-tab"
                        role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab_last" data-toggle="pill" href="#pills-home"
                               role="tab" aria-controls="pills-home"
                               aria-selected="true">تغییرات اخیر</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab_day" data-toggle="pill" href="#pills-profile"
                               role="tab" aria-controls="pills-profile"
                               aria-selected="false">روزانه</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab_week" data-toggle="pill" href="#pills-contact"
                               role="tab" aria-controls="pills-contact"
                               aria-selected="false">هفتکی</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab_month" data-toggle="pill" href="#pills-contact"
                               role="tab" aria-controls="pills-contact"
                               aria-selected="false">ماهانه</a>
                        </li>
                    </ul>
                    <div class="checkbox mt-3 text-right" >
                        <label for="checkbox2" class="form-check-label ">
                            <input type="checkbox" id="date_checkbox" name="checkbox2" value="option2" class="form-check-input"> انتخاب تاریخ
                        </label>
                    </div>

                    <div class="mt-2 flex-row justify-content-center d-none" id="dt_fo">

                        <p >از تاریخ  </p>


                        <button type="button" id="date_button" class="btn btn-primary m-3">تایید</button>

                        <input type="date"   id="date_picker" name="trip-start" style="color: #0c0a0a">



                    </div>




                </div>
                <!-- END SELECTOR DIV -->
<button class="btn btn-primary m-3" id="print">Print</button>
                <div class="mt-4 table-responsive table-bordered table--no-card m-b-40">
                    <table class=" table table-borderless table-striped table-earning" id="systems_table"
                           style="direction: ltr">
                        <thead>
                        <tr>
                            <th class="text-center" style="padding: 20px;">زمان</th>
                            <th class="text-center" style="padding: 20px;">دما جلو</th>
                            <th class="text-center" style="padding: 20px;">دما پشت</th>
                            <th class="text-center" style="padding: 20px;">رطوبت</th>
                            <th class="text-center" style="padding: 20px;">co2</th>
                            <th class="text-center " style="padding: 20px;">خطا</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                </div>

            {{--                <!--  CHARTS -->--}}
            {{--                <div class="au-card text-center mt-4">--}}
            {{--                    <div class="au-card-inner">--}}
            {{--                        <canvas id="temperature-chart"></canvas>--}}
            {{--                    </div>--}}

            {{--                </div>--}}

            <!--  END CHARTS -->


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
<script src="vendor/select2/select2.min.js"></script>

<script src="https://unpkg.com/jalali-moment/dist/jalali-moment.browser.js"></script>



<script>


    // $('#pdf_print').on('click',function(){
    // })



    var selected_system ={!! $user->selected_system !!};
    var systems ={!! $user->systems !!};

    var systems_tab_list = document.getElementById('systems_tab_list');
    var table_tbody = document.getElementById('systems_table').getElementsByTagName('tbody')[0];


    var date_button = document.getElementById('date_button')
    var date = document.getElementById('date_picker')


    chart_data = selected_system.from_date
    date.value =chart_data

    // console.log(chart_data)
    // console.log(date.value)
    date_button.addEventListener("click", function () {
        window.location.href = "/tables?system_id="  + selected_system.id+"&day="+date.value
        // console.log(date.value)
    })

    var date_checkbox = document.getElementById('date_checkbox');
    date_checkbox.addEventListener('change', function() {
        if (this.checked) {
            dt_fo.classList.remove('d-none')
        } else {
            dt_fo.classList.add('d-none')
        }
    });

    var table ={!! $user->selected_system !!};
    var last_table = table.last_table;
    var day_table = table.today_table;
    var week_table = table.week_table;
    var month_table = table.month_table;


    update_table(last_table)
    // set_data_to_charts(clock_values, temp1_values, temp2_values, hum_values, co2_values, error_values)

    var last_record_button = document.getElementById("tab_last")
    var day_button = document.getElementById("tab_day")
    var week_button = document.getElementById("tab_week")
    var month_button = document.getElementById("tab_month")

    last_record_button.addEventListener("click", function () {
        update_table(last_table)
        // update_temp_chart(last_chart)
        // update_hum_chart(last_chart)
        // update_co2_chart(last_chart)
        // update_error_chart(last_chart)
        // console.log(last_chart)

        // temp_chart.update()
        // change_chart_type('last', chart)
    })

    day_button.addEventListener("click", function () {
        update_table(day_table)
        // update_temp_chart(day_chart)
        // update_hum_chart(day_chart)
        // update_co2_chart(day_chart)
        // update_error_chart(day_chart)

        // change_chart_type('day', chart)
    })

    week_button.addEventListener("click", function () {
        update_table(week_table)
        // update_temp_chart(week_chart)
        // update_hum_chart(week_chart)
        // update_co2_chart(week_chart)
        // update_error_chart(week_chart)

        // change_chart_type('day', chart)
    })
    month_button.addEventListener("click", function () {
        update_table(month_table)
        // update_temp_chart(month_chart)
        // update_hum_chart(month_chart)
        // update_co2_chart(month_chart)
        // update_error_chart(month_chart)

        // change_chart_type('day', chart)
    })

    function update_table(table_values) {
        $("#systems_table tbody tr").remove()

        for (const table_value of table_values) {
            console.log(table_value)

            var new_row = table_tbody.insertRow();

            var cell0 = new_row.insertCell()
            cell0.classList.add('text-center')
            var cell1 = new_row.insertCell()
            cell1.classList.add('text-center')
            var cell2 = new_row.insertCell()
            cell2.classList.add('text-center')
            var cell3 = new_row.insertCell()
            cell3.classList.add('text-center')
            var cell4 = new_row.insertCell()
            cell4.classList.add('text-center')
            var cell5 = new_row.insertCell()
            cell5.classList.add('text-center')
            const m = moment(table_value.time.substring(0, 10), 'YYYY/MM/DD').locale('fa').format('YYYY/MM/DD'); // 1367/11/04



            cell0.innerText = m + table_value.time.substring(10, 19)
            cell1.innerText = table_value.temp1?table_value.temp1.toFixed(2):null
            cell2.innerText =table_value.temp2?table_value.temp2.toFixed(2):null
            cell3.innerHTML =table_value.hum?table_value.hum.toFixed(2):null
            cell4.innerHTML =table_value.co2?table_value.co2.toFixed(2):null
            cell5.innerHTML = table_value.error

        }
    }


    //
</script>
<!-- Main JS-->
<script src="js/main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.0/knockout-min.js"></script>
<script src="js/sevenSeg.js"></script>

s
</body>
</html>

<!-- end document-->
