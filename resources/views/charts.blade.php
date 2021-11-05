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
    <title>Charts</title>

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
    <script type="text/JavaScript" src="js/jquery.print.js"></script>

    <script src="js/sevenSeg.js"></script>


</head>

<body class="animsition">
<div class="page-wrapper">
    <!-- HEADER MOBILE-->
@include('layouts.msidebar' , ['page'=>'charts'])
<!-- END HEADER MOBILE-->

    <!-- MENU SIDEBAR-->
@include('layouts.sidebar' , ['page'=>'charts'])
<!-- END MENU SIDEBAR-->

    <!-- PAGE CONTAINER-->
    <div class="page-container" id="page_container">
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
                                    window.location.href = "/charts?system_id=" + {!! $system->id !!}
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
                               aria-selected="false">هفتگی</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab_month" data-toggle="pill" href="#pills-contact"
                               role="tab" aria-controls="pills-contact"
                               aria-selected="false">ماهانه</a>
                        </li>
                    </ul>

                    <div class="checkbox mt-3 text-right">
                        <label for="checkbox2" class="form-check-label ">
                            <input type="checkbox" id="date_checkbox" name="checkbox2" value="option2"
                                   class="form-check-input"> انتخاب تاریخ
                        </label>
                    </div>

                    <div class="mt-2 flex-row justify-content-center d-none" id="dt_fo">

                        <p>از تاریخ </p>


                        <button type="button" id="date_button" class="btn btn-primary m-3">تایید</button>

                        <input type="date" id="date_picker" name="trip-start" style="color: #0c0a0a">


                    </div>

                </div>
                <!-- END SELECTOR DIV -->


                <!--  CHARTS -->
                <div class="au-card text-center mt-4">
                    <div class="au-card-inner">
                        <canvas id="temperature-chart"></canvas>
                    </div>

                </div>
                <div class="au-card text-center mt-4">
                    <div class="au-card-inner">
                        <canvas id="humidity-chart"></canvas>
                    </div>

                </div>
                <div class="au-card text-center mt-4">
                    <div class="au-card-inner">
                        <canvas id="co2-chart"></canvas>
                    </div>

                </div>
                <div class="au-card text-center mt-4">
                    <div class="au-card-inner">
                        <canvas id="error-chart"></canvas>
                    </div>

                </div>

                <!--  END CHARTS -->


            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
    </div>

</div>

<!-- Jquery JS-->
<script src="vendor/jquery-3.2.1.min.js"></script>
<script type="text/JavaScript" src="js/jquery.print.js"></script>


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


<script>

    var selected_system ={!! $user->selected_system !!};
    var systems ={!! $user->systems !!};
    var systems_tab_list = document.getElementById('systems_tab_list');

    var date_button = document.getElementById('date_button')
    var date = document.getElementById('date_picker')
    var dt_fo = document.getElementById('dt_fo')



    chart_data = selected_system.from_date
    date.value = chart_data

    // console.log(chart_data)
    // console.log(date.value)
    date_button.addEventListener("click", function () {
        window.location.href = "/charts?system_id=" + selected_system.id + "&day=" + date.value
        // console.log(date.value)
    })

    var date_checkbox = document.getElementById('date_checkbox');
    date_checkbox.addEventListener('change', function () {
        if (this.checked) {
            dt_fo.classList.remove('d-none')
        } else {
            dt_fo.classList.add('d-none')
        }
    });

    var chart ={!! $user->selected_system !!};
    var last_chart = chart.last_charts;
    var day_chart = chart.today_charts;
    var week_chart = chart.week_charts;
    var month_chart = chart.month_charts;

    // console.log(day_chart.clock_chart)

    var clock_values = last_chart.clock_chart;
    var temp1_values = last_chart.temp1_chart;
    var temp2_values = last_chart.temp2_chart;
    var hum_values = last_chart.hum_chart;
    var co2_values = last_chart.co2_chart;
    var error_values = last_chart.error_chart;


    console.log(month_chart)
    // console.log(error_values);
    // set_data_to_charts(clock_values, temp1_values, temp2_values, hum_values, co2_values, error_values)

    var last_record_button = document.getElementById("tab_last")
    var day_button = document.getElementById("tab_day")
    var week_button = document.getElementById("tab_week")
    var month_button = document.getElementById("tab_month")

    last_record_button.addEventListener("click", function () {
        update_temp_chart(last_chart)
        update_hum_chart(last_chart)
        update_co2_chart(last_chart)
        update_error_chart(last_chart)
        console.log(last_chart)

        // temp_chart.update()
        // change_chart_type('last', chart)
    })

    day_button.addEventListener("click", function () {
        update_temp_chart(day_chart)
        update_hum_chart(day_chart)
        update_co2_chart(day_chart)
        update_error_chart(day_chart)

        // change_chart_type('day', chart)
    })

    week_button.addEventListener("click", function () {
        update_temp_chart(week_chart)
        update_hum_chart(week_chart)
        update_co2_chart(week_chart)
        update_error_chart(week_chart)

        // change_chart_type('day', chart)
    })
    month_button.addEventListener("click", function () {
        update_temp_chart(month_chart)
        update_hum_chart(month_chart)
        update_co2_chart(month_chart)
        update_error_chart(month_chart)

        // change_chart_type('day', chart)
    })

    function update_temp_chart(chart_values) {

        temp_chart.data.labels = chart_values.clock_chart
        temp_chart.data.datasets[0].data = chart_values.temp1_chart
        temp_chart.data.datasets[1].data = chart_values.temp2_chart
        temp_chart.update();
    }

    function update_hum_chart(chart_values) {

        hum_chart.data.labels = chart_values.clock_chart
        hum_chart.data.datasets[0].data = chart_values.hum_chart
        hum_chart.update();
    }

    function update_co2_chart(chart_values) {

        co2_chart.data.labels = chart_values.clock_chart
        co2_chart.data.datasets[0].data = chart_values.co2_chart
        co2_chart.update();
    }

    function update_error_chart(chart_values) {
        console.log(chart_values.error_chart);

        error_chart.data.datasets[0].data = chart_values.error_chart
        error_chart.update();
    }

    try {

        //temperature chart
        var temp_ctx = document.getElementById("temperature-chart");
        if (temp_ctx) {
            temp_ctx.height = 150;
            var temp_chart = new Chart(temp_ctx, {
                type: 'line',
                data: {
                    labels: clock_values,
                    type: 'line',
                    defaultFontFamily: 'Poppins',
                    datasets: [{
                        data: temp1_values,
                        label: "Temperature 1",
                        backgroundColor: 'transparent',
                        borderColor: 'rgba(0,103,255,0.5)',
                        borderWidth: 3.5,
                        pointStyle: 'circle',
                        pointRadius: 5,
                        pointBorderColor: 'transparent',
                        pointBackgroundColor: 'rgba(0,103,255,0.5)',
                    },
                        {
                            data: temp2_values,
                            label: "Temperature 2",
                            backgroundColor: 'transparent',
                            borderColor: 'rgb(255,0,111)',
                            borderWidth: 3.5,
                            pointStyle: 'circle',
                            pointRadius: 5,
                            pointBorderColor: 'transparent',
                            pointBackgroundColor: 'rgb(255,0,81)',
                        }
                    ]
                },
                options: {
                    responsive: true,
                    tooltips: {
                        mode: 'index',
                        titleFontSize: 12,
                        titleFontColor: '#000',
                        bodyFontColor: '#000',
                        backgroundColor: '#fff',
                        titleFontFamily: 'Poppins',
                        bodyFontFamily: 'Poppins',
                        cornerRadius: 3,
                        intersect: false,
                    },
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            fontFamily: 'Poppins',
                        },

//
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            scaleLabel: {
                                display: false,
                                labelString: 'Month'
                            },
                            ticks: {
                                fontFamily: "Poppins"
                            }
                        }],
                        yAxes: [{
                            display: true,
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'Temperature',
                                fontFamily: "Poppins"
                            },
                            ticks: {
                                min: 50,
                                max: 120,
                                fontFamily: "Poppins"
                            }
                        }]
                    },
                    title: {
                        display: false,
                    }
                }
            });
        }

    } catch (error) {
        console.log(error);
    }

    try {

        //Team chart
        var hum_ctx = document.getElementById("humidity-chart");
        if (hum_ctx) {
            hum_ctx.height = 150;
            var hum_chart = new Chart(hum_ctx, {
                type: 'line',
                data: {
                    labels: clock_values,
                    type: 'line',
                    defaultFontFamily: 'Poppins',
                    datasets: [{
                        data: hum_values,
                        label: "Humidity",
                        backgroundColor: 'transparent',
                        borderColor: 'rgb(200,0,255)',
                        borderWidth: 3.5,
                        pointStyle: 'circle',
                        pointRadius: 5,
                        pointBorderColor: 'transparent',
                        pointBackgroundColor: 'rgb(191,0,246)',
                    },
                    ]
                },
                options: {
                    responsive: true,
                    tooltips: {
                        mode: 'index',
                        titleFontSize: 12,
                        titleFontColor: '#000',
                        bodyFontColor: '#000',
                        backgroundColor: '#fff',
                        titleFontFamily: 'Poppins',
                        bodyFontFamily: 'Poppins',
                        cornerRadius: 3,
                        intersect: false,
                    },
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            fontFamily: 'Poppins',
                        },
                        //
                        //
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            scaleLabel: {
                                display: false,
                                labelString: 'Month'
                            },
                            ticks: {
                                fontFamily: "Poppins"
                            }
                        }],
                        yAxes: [{
                            display: true,
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'Humidity',
                                fontFamily: "Poppins"
                            },
                            ticks: {
                                min: 20,
                                max: 100,
                                fontFamily: "Poppins"
                            }
                        }]
                    },
                    title: {
                        display: false,
                    }
                }
            });
        }
        //
        //
    } catch (error) {
        console.log(error);
    }
    try {

        //Team chart
        var co2_ctx = document.getElementById("co2-chart");
        if (co2_ctx) {
            co2_ctx.height = 150;
            var co2_chart = new Chart(co2_ctx, {
                type: 'line',
                data: {
                    labels: clock_values,
                    type: 'line',
                    defaultFontFamily: 'Poppins',
                    datasets: [{
                        data: co2_values,
                        label: "CO2",
                        backgroundColor: 'transparent',
                        borderColor: 'rgb(1,10,59)',
                        borderWidth: 3.5,
                        pointStyle: 'circle',
                        pointRadius: 5,
                        pointBorderColor: 'transparent',
                        pointBackgroundColor: 'rgb(1,10,59)',
                    },
                    ]
                },
                options: {
                    responsive: true,
                    tooltips: {
                        mode: 'index',
                        titleFontSize: 12,
                        titleFontColor: '#000',
                        bodyFontColor: '#000',
                        backgroundColor: '#fff',
                        titleFontFamily: 'Poppins',
                        bodyFontFamily: 'Poppins',
                        cornerRadius: 3,
                        intersect: false,
                    },
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            fontFamily: 'Poppins',
                        },
                        //
                        //
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            scaleLabel: {
                                display: false,
                                labelString: 'Month'
                            },
                            ticks: {
                                fontFamily: "Poppins"
                            }
                        }],
                        yAxes: [{
                            display: true,
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'CO2',
                                fontFamily: "Poppins"
                            },
                            ticks: {
                                min: 20,
                                max: 100,
                                fontFamily: "Poppins"
                            }
                        }]
                    },
                    title: {
                        display: false,
                    }
                }
            });
        }
        //
        //
    } catch (error) {
        console.log(error);
    }
    try {

        //pie chart
        var error_ctx = document.getElementById("error-chart");
        if (error_ctx) {
            error_ctx.height = 100;
            var error_chart = new Chart(error_ctx, {
                type: 'pie',
                data: {
                    datasets: [{
                        data: error_values,
                        backgroundColor: [
                            "rgb(60,176,65)",
                            "rgb(255, 82, 82)",
                        ],
                        hoverBackgroundColor: [
                            "rgb(60,176,65)",
                            "rgb(255, 82, 82)",
                        ]
                        //
                    }],
                    labels: [
                        "OK",
                        "ERROR",
                    ]
                },
                options: {
                    legend: {
                        position: 'top',
                        labels: {
                            fontFamily: 'Poppins'
                        }
                        //
                    },
                    responsive: true
                }
            });
        }
        //
        //
    } catch (error) {
        console.log(error);

    }


    //
</script>
<!-- Main JS-->
<script src="js/main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.0/knockout-min.js"></script>
<script src="js/sevenSeg.js"></script>
{{--<script>--}}
{{--    var seven_seg1 = document.getElementById("exampleArray");--}}
{{--    var seven_seg2 = document.getElementById("exampleArray2");--}}
{{--    var seven_seg3 = document.getElementById("exampleArray3");--}}
{{--    var seven_seg4 = document.getElementById("exampleArray4");--}}
{{--    var set_temp1 = document.getElementById("set_temp_1");--}}
{{--    var set_temp2 = document.getElementById("set_temp_2");--}}
{{--    var set_hum = document.getElementById("set_hum");--}}


{{--    var selected_system = {!! $user->selected_system !!};--}}
{{--    var user_systems = {!! $user->systems !!};--}}

{{--    set_data_selected_system(selected_system)--}}
{{--    set_data_systems(user_systems)--}}


{{--    function set_led(led, value) {--}}
{{--        if (value == 1) {--}}
{{--            if (led.classList.contains('new-led-off')) {--}}
{{--                led.classList.remove('new-led-off');--}}
{{--            }--}}
{{--            if (!led.classList.contains('new-led-on')) {--}}
{{--                led.classList.add('new-led-on');--}}
{{--            }--}}
{{--        } else {--}}
{{--            if (led.classList.contains('new-led-on')) {--}}
{{--                led.classList.remove('new-led-on');--}}
{{--            }--}}
{{--            if (!led.classList.contains('new-led-off')) {--}}
{{--                led.classList.add('new-led-off');--}}
{{--            }--}}
{{--        }--}}
{{--        // console.log(value)--}}

{{--    }--}}

{{--    function set_data_selected_system(selected_system) {--}}
{{--        var system_type = selected_system.last_record.system_type;--}}

{{--        set_temp1.innerHTML = selected_system.last_record.set_temp1;--}}
{{--        set_temp2.innerHTML = selected_system.last_record.set_temp2;--}}
{{--        set_hum.innerHTML = selected_system.last_record.set_hum;--}}
{{--        selected_system_name.innerHTML = selected_system.name +' '+ (selected_system.type ==1? '(Setter)':'(Hatcher)' )+ "  وضعیت فعلی دستگاه   "--}}
{{--        // $(function() {--}}
{{--        set_led(led_high_temp, selected_system.last_record.high_temp)--}}
{{--        set_led(led_high_hum, selected_system.last_record.high_hum)--}}
{{--        set_led(led_dry_wick, selected_system.last_record.dry_wick)--}}
{{--        set_led(led_low_temp, selected_system.last_record.low_temp)--}}
{{--        set_led(led_low_hum, selected_system.last_record.low_hum)--}}
{{--        set_led(led_fan_failure, selected_system.last_record.fan_failure)--}}
{{--        set_led(led_program_error, selected_system.last_record.error_program)--}}

{{--        set_led(led_main_heater, selected_system.last_record.heater)--}}
{{--        set_led(led_spray, selected_system.last_record.spray)--}}
{{--        set_led(led_damper_opening, selected_system.last_record.damper_opening)--}}
{{--        set_led(led_damper_opened, selected_system.last_record.damper_open)--}}
{{--        set_led(led_damper_closing, selected_system.last_record.damper_closing)--}}
{{--        set_led(led_damper_closed, selected_system.last_record.damper_closed)--}}
{{--        // egg_turn_box.classList.add('invisible')--}}
{{--        // document.getElementById("egg_turn_box").classList.add("invisible")--}}

{{--        if (selected_system.last_record.fan_control == 1) {--}}
{{--            fan_control.classList.add('rotate')--}}
{{--        } else {--}}
{{--            fan_control.classList.remove('rotate')--}}
{{--        }--}}

{{--        if (selected_system.last_record.error == 1) {--}}
{{--            error_message.classList.remove('d-none')--}}
{{--        } else {--}}
{{--            error_message.classList.add('d-none')--}}
{{--        }--}}

{{--        if (system_type == 1) {--}}
{{--            set_led(led_main_or_door_open, selected_system.last_record.high_temp)--}}
{{--            set_led(led_aux_heater_or_blower, selected_system.last_record.auxlary_heater)--}}
{{--            set_led(led_egg_turn_or_aux_heater, selected_system.last_record.egg_turn)--}}
{{--            text_main_or_door_open.innerHTML = "MAIN"--}}
{{--            text_aux_heater_or_blower.innerHTML = "AUX HEATER"--}}
{{--            text_egg_turn_or_aux_heater.innerHTML = "EGG TURN"--}}

{{--            set_led(led_egg_left, selected_system.last_record.egg_left)--}}
{{--            set_led(led_egg_right, selected_system.last_record.egg_right)--}}
{{--            set_led(led_egg_turning, selected_system.last_record.turning)--}}
{{--            set_led(led_egg_failure, selected_system.last_record.egg_failure)--}}

{{--            egg_turn_box.classList.remove('d-none')--}}
{{--        } else {--}}
{{--            set_led(led_main_or_door_open, selected_system.last_record.door_open)--}}
{{--            set_led(led_aux_heater_or_blower, selected_system.last_record.blower)--}}
{{--            set_led(led_egg_turn_or_aux_heater, selected_system.last_record.auxlary_heater)--}}
{{--            text_main_or_door_open.innerHTML = "DOOR OPEN"--}}
{{--            text_aux_heater_or_blower.innerHTML = "BLOWER"--}}
{{--            text_egg_turn_or_aux_heater.innerHTML = "AUX HEATER"--}}

{{--            egg_turn_box.classList.add('d-none')--}}

{{--        }--}}
{{--        //     console.log()--}}
{{--        //--}}
{{--        // });--}}

{{--        $(seven_seg1).sevenSeg({digits: 5, value: selected_system.last_record.temp1});--}}
{{--        $(seven_seg2).sevenSeg({digits: 5, value: selected_system.last_record.temp2});--}}
{{--        $(seven_seg3).sevenSeg({digits: 5, value: selected_system.last_record.hum});--}}
{{--        $(seven_seg4).sevenSeg({digits: 5, value: selected_system.last_record.co2});--}}


{{--    }--}}

{{--    function set_data_systems(systems)--}}
{{--    {--}}
{{--        table_tbody = document.getElementById('systems_table').getElementsByTagName('tbody')[0];--}}
{{--        $("#systems_table tbody tr").remove()--}}
{{--        // systems.foreach(addrow())--}}
{{--        // function addrow(){--}}
{{--        // if (table_tbody.rows.length > 0) {--}}

{{--                // console.log(table_tbody.rows)--}}

{{--        // }--}}
{{--        // if (table_tbody.rows.length >0){--}}
{{--        //     table_tbody.children().remove()--}}
{{--        // }--}}

{{--        // for (const row of table_tbody.rows){--}}
{{--        //     table_tbody.delete--}}
{{--        // }--}}

{{--        // table_tbody.deleteRow(0)--}}
{{--        for (const system of systems) {--}}
{{--            // console.log(a)--}}
{{--            var new_row = table_tbody.insertRow();--}}
{{--            new_row.addEventListener("click", function () {--}}
{{--                window.location.href = "/?system_id="  + system.id--}}
{{--            })--}}
{{--            var cell0 = new_row.insertCell()--}}
{{--            var cell1 = new_row.insertCell()--}}
{{--            var cell2 = new_row.insertCell()--}}
{{--            var cell3 = new_row.insertCell()--}}
{{--            var cell4 = new_row.insertCell()--}}
{{--            var cell5 = new_row.insertCell()--}}
{{--            var cell6 = new_row.insertCell()--}}
{{--            var cell7 = new_row.insertCell()--}}
{{--            var cell8 = new_row.insertCell()--}}
{{--            var cell9 = new_row.insertCell()--}}
{{--            var cell10 = new_row.insertCell()--}}

{{--            cell0.innerText = +system.system_type === +1 ? 'setter ' + system.id : 'hatcher ' + system.id;--}}
{{--            cell1.innerText = system.last_record.temp1--}}
{{--            cell2.innerText = system.last_record.temp2--}}
{{--            cell3.innerHTML = system.last_record.high_temp == 1 ? "<div class=\"led-on\"></div>" : "<div class=\"led-off\"></div>"--}}
{{--            cell4.innerHTML = system.last_record.low_temp == 1 ? "<div class=\"led-on\"></div>" : "<div class=\"led-off\"></div>"--}}
{{--            cell5.innerHTML = system.last_record.high_hum == 1 ? "<div class=\"led-on\"></div>" : "<div class=\"led-off\"></div>"--}}
{{--            cell6.innerHTML = system.last_record.low_hum == 1 ? "<div class=\"led-on\"></div>" : "<div class=\"led-off\"></div>"--}}
{{--            cell7.innerHTML = system.last_record.door_open == 1 ? "<div class=\"led-on\"></div>" : "<div class=\"led-off\"></div>"--}}
{{--            cell8.innerHTML = system.last_record.fan_failure == 1 ? "<div class=\"led-on\"></div>" : "<div class=\"led-off\"></div>"--}}
{{--            cell9.innerHTML = system.last_record.dry_wick == 1 ? "<div class=\"led-on\"></div>" : "<div class=\"led-off\"></div>"--}}
{{--            cell10.innerHTML = system.last_record.error_program == 1 ? "<div class=\"led-on\"></div>" : "<div class=\"led-off\"></div>"--}}
{{--            // cell2.innerHTML = "New HI"--}}
{{--        }--}}
{{--        // }--}}


{{--    }--}}

{{--    setInterval(function () {--}}
{{--        $.get("/dashboard/{{ $user->selected_system->id }}", function (data, status) {--}}

{{--            set_data_selected_system(data.user.selected_system)--}}
{{--            set_data_systems(data.user.systems)--}}
{{--            // console.log(status ,data);--}}

{{--        });--}}


{{--    }, 3000)--}}


{{--</script>--}}

</body>
</html>

<!-- end document-->
