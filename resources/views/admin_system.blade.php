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
    <title>System Status</title>

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


    <!-- END HEADER MOBILE-->

    <!-- MENU SIDEBAR-->
@include('layouts.admin_sidebar' , ['page'=>'admin_user'])
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
            <div class="d-flex flex-column">

                <div class="au-card d-flex flex-row mr-5 ml-5 pull-right text-right " style="direction: rtl">
                    <div class="d-flex flex-column col-lg-4 col-4 col-md-4 col-sm-4 text-center" id="name"></div>
                    <div class="d-flex flex-column col-lg-4 col-4 col-md-4 col-sm-4 text-center" id="type"></div>
                    <div class="d-flex flex-column col-lg-4 col-4 col-md-4 col-sm-4 text-center" id="serial"></div>
                </div>

                <div class="row mr-5 ml-5 mt-3 mb-1" style="direction: rtl">

                    <div class="d-flex flex-column col-lg-6 col-12 col-md-12 col-sm-12  pull-right text-right p-2">
                        <button type="button" class="btn btn-danger" id="delete_user">
                            <i class="fa fa-remove"></i>حذف دستگاه
                        </button>
                    </div>
                    <div class="d-flex flex-column col-lg-6 col-12 col-md-12 col-sm-12 pull-right text-right p-2">
                        <button type="button" class="btn btn-dark" id="edit_user">
                            <i class="fa fa-pencil-alt"></i>ویرایش دستگاه
                        </button>
                    </div>

                </div>


                <div class="d-flex flex-row mt-5">
                    <div class="section__content section__content--p30 ">
                        <div class="container-fluid">
                            <p class="title-2 text-right text-dark mb-4 " id="selected_system_name"
                               style=" font-size: 20px">{{ $system->name}} وضعیت فعلی دستگاه</p>

                            <div class="au-card text-center  mb-3  " style="background-color: #000">


                                <div class="container">


                                    <div class="row p-2 new-parent-center">


                                        <div
                                            class="d-flex flex-column col-12 col-sm-12 col-md-12 mt-3  col-lg-4 new-parent-center mr-lg-4  ">
                                            <p class="text-light row">
                                                SYSTEM ALARMS
                                            </p>

                                            <div class="row new-au-card pb-3 ">
                                                <div class="col-3  p-2">
                                                    <div class="new-parent">
                                                        <div class="led-box new-child">
                                                            <div class="" id="led_high_temp"></div>
                                                            <p class="text-light">HIGH TEMP</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3  p-2">
                                                    <div class="new-parent">
                                                        <div class="led-box new-child ">
                                                            <div class="" id="led_high_hum"></div>
                                                            <p class="text-light">HIGH HUM</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3  p-2">
                                                    <div class="new-parent">
                                                        <div class="led-box new-child ">
                                                            <div class="" id="led_main_or_door_open"></div>
                                                            <p class="text-light" id="text_main_or_door_open"></p>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3  p-2">
                                                    <div class="new-parent">
                                                        <div class="led-box new-child ">
                                                            <div class="" id="led_dry_wick"></div>
                                                            <p class="text-light">DRY WICK</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3  p-2">
                                                    <div class="new-parent">
                                                        <div class="led-box new-child ">
                                                            <div class="" id="led_low_temp"></div>

                                                            <p class="text-light">LOW TEMP</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3  p-2">
                                                    <div class="new-parent">
                                                        <div class="led-box new-child ">
                                                            <div class="" id="led_low_hum"></div>

                                                            <p class="text-light">LOW HUM</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3  p-2">
                                                    <div class="new-parent">
                                                        <div class="led-box new-child ">
                                                            <div class="" id="led_fan_failure"></div>

                                                            <p class="text-light">FAN FAILURE</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3  p-2">
                                                    <div class="new-parent">
                                                        <div class="led-box new-child ">
                                                            <div class="" id="led_program_error"></div>

                                                            <p class="text-light">PROGRAM ERROR</p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div
                                            class="d-flex flex-column col-12 col-sm-12 col-md-12 mt-3 col-lg-4 new-parent-center  mr-lg-4 ">
                                            <p class="text-light row">
                                                SYSTEM STATUS
                                            </p>
                                            <div class="row new-au-card pb-3">
                                                <div class="col-3  p-2">
                                                    <div class="new-parent">
                                                        <div class="led-box new-child">
                                                            <div class="" id="led_main_heater"></div>

                                                            <p class="text-light">MAIN HEATER</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3  p-2">
                                                    <div class="new-parent">
                                                        <div class="led-box new-child ">
                                                            <div class="" id="led_spray"></div>

                                                            <p class="text-light">SPRAY</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3  p-2">
                                                    <div class="new-parent">
                                                        <div class="led-box new-child ">
                                                            <div class="" id="led_damper_opening"></div>

                                                            <p class="text-light">DAMPER OPENING</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3  p-2">
                                                    <div class="new-parent">
                                                        <div class="led-box new-child ">
                                                            <div class="" id="led_damper_opened"></div>

                                                            <p class="text-light">DAMPER OPENED</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3  p-2">
                                                    <div class="new-parent">
                                                        <div class="led-box new-child ">
                                                            <div class="" id="led_aux_heater_or_blower"></div>
                                                            <p class="text-light" id="text_aux_heater_or_blower"></p>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3  p-2">
                                                    <div class="new-parent">
                                                        <div class="led-box new-child ">
                                                            <div class="" id="led_egg_turn_or_aux_heater"></div>
                                                            <p class="text-light" id="text_egg_turn_or_aux_heater"></p>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3  p-2">
                                                    <div class="new-parent">
                                                        <div class="led-box new-child ">
                                                            <div class="" id="led_damper_closing"></div>

                                                            <p class="text-light">DAMPER CLOSING</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3  p-2">
                                                    <div class="new-parent">
                                                        <div class="led-box new-child ">
                                                            <div class="" id="led_damper_closed"></div>

                                                            <p class="text-light">DAMPER CLOSED</p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div
                                            class="flex-column col-12 col-sm-12 col-md-12 mt-3 col-lg-2  new-parent-center"
                                            id="egg_turn_box">
                                            <p class="text-truncate text-light row">
                                                EGG STATUS
                                            </p>
                                            <div class="row new-au-card pb-3">
                                                <div class="col-6  p-2">
                                                    <div class="new-parent">
                                                        <div class="led-box new-child">
                                                            <div class="" id="led_egg_left"></div>

                                                            <p class="text-light">LEFT</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6  p-2">
                                                    <div class="new-parent">
                                                        <div class="led-box new-child ">
                                                            <div class="" id="led_egg_right"></div>

                                                            <p class="text-light">RIGHT</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6  p-2">
                                                    <div class="new-parent">
                                                        <div class="led-box new-child ">
                                                            <div class="" id="led_egg_turning"></div>

                                                            <p class="text-light">TURNING</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6  p-2">
                                                    <div class="new-parent">
                                                        <div class="led-box new-child ">
                                                            <div class="" id="led_egg_failure"></div>

                                                            <p class="text-light">FAILURE</p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                    </div>

                                </div>


                                <div class="row mt-5 flex justify-content-center align-items-center">


                                    <div class="col-lg-2 col-md-6 col-sm-12 new-parent-center d-flex flex-column mr-lg-2 ">
                                        <p class="text-truncate text-light"> TEMPRETURE 1</p>
                                        <div id="exampleArray" class="new-au-card au-card-seven-seg"
                                             style="width: 180px;"></div>

                                        <p class="text-light mt-2  small"
                                           id="set_temp_1">{{ $system!=null?$system->last_record->set_temp1:'' }} </p>

                                    </div>

                                    <div class="col-lg-2 col-md-6 col-sm-12 new-parent-center d-flex flex-column mr-lg-2 ">
                                        <p class="text-truncate text-light"> TEMPRETURE 2</p>
                                        <div id="exampleArray2" class="new-au-card au-card-seven-seg"
                                             style="width: 180px;"></div>

                                        <p class="text-light mt-2  small"
                                           id="set_temp_2">{{ $system!=null?$system->last_record->set_temp2:'' }} </p>

                                    </div>
                                    <div class="col-lg-2 col-md-6 col-sm-12 new-parent-center d-flex flex-column mr-lg-2 ">
                                        <p class="text-light"> HUMIDITY</p>
                                        <div id="exampleArray3" class="new-au-card au-card-seven-seg"
                                             style="width: 180px;"></div>

                                        <p class="text-light mt-2  small"
                                           id="set_hum">{{ $system!=null?$system->last_record->set_hum:'' }} </p>

                                    </div>
                                    <div class="col-lg-2 col-md-6 col-sm-12 new-parent-center d-flex flex-column mr-lg-2 ">
                                        <p class="text-light"> CO2 </p>

                                        <div id="exampleArray4" class="new-au-card au-card-seven-seg"
                                             style="width: 180px;"></div>
                                        <p class="text-light mt-2  small">_</p>

                                    </div>
                                    <div class="col-lg-2 col-md-6 col-sm-12 new-parent-center d-flex flex-column mr-lg-2 ">
                                        <div style="display: flex; justify-content: center;align-items: center;"
                                             class="text-center mt-3">

                                            <div class="col">
                                                <div style="width: 100px; height: 100px;" id="fan_control">
                                                    <img class="wings" src="images/icon/fan-icon.png" alt="">
                                                </div>

                                                <div class="mt-3" style="width: 100px" hidden>
                                                    <label class="form-switch ">
                                                        <input type="checkbox" checked id="fan_check">
                                                        <i></i>

                                                    </label>
                                                </div>
                                            </div>

                                        </div>

                                    </div>


                                </div>

                                <div class="row  text-center flex justify-content-center align-items-center mt-5 "
                                     id="error_message">
                                    <div class="alert new-au-card m-0 set_alarm_anim" style="width: 500px;color: white "
                                         role="alert">
                                        مشکلی در دستگاه به وجود آمده است
                                    </div>
                                </div>


                            </div>


                        </div>
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

<!-- Main JS-->
<script src="js/main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.0/knockout-min.js"></script>
<script src="js/sevenSeg.js"></script>
<script>
    var name_text = document.getElementById('name')
    var type_text = document.getElementById('type')
    var serial_text = document.getElementById('serial')


    var seven_seg1 = document.getElementById("exampleArray");
    var seven_seg2 = document.getElementById("exampleArray2");
    var seven_seg3 = document.getElementById("exampleArray3");
    var seven_seg4 = document.getElementById("exampleArray4");
    var set_temp1 = document.getElementById("set_temp_1");
    var set_temp2 = document.getElementById("set_temp_2");
    var set_hum = document.getElementById("set_hum");


    var selected_system = @json($system);
    console.log(selected_system)

    name_text.innerText =  'نام دستگاه : ' +selected_system.name
    type_text.innerText =   selected_system.system_type == 1 ? "Setter":"Hatcher"
    serial_text.innerText =  'سریال دستگاه : ' +selected_system.serial

{{--    var user_systems = {!! $user->systems !!};--}}

    set_data_selected_system(selected_system)
{{--    set_data_systems(user_systems)--}}

    var delete_button = document.getElementById('delete_user')

    var edit_button = document.getElementById('edit_user')
    edit_button.addEventListener("click", function () {
        window.location.href = "/admin_edit_system?system_id="+selected_system.id
    })


    delete_button.addEventListener("click", function () {
        var confirmd = confirm('آیا مطمن هستید ؟؟؟ تمام رکوردهای دستگاه کاربر نیز حذف خواهد شد')
        if (!confirmd) {
            return
        }
        $.post("/admin_api_delete_system/?system_id="+selected_system.id,
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

    function set_led(led, value) {
        if (value == 1) {
            if (led.classList.contains('new-led-off')) {
                led.classList.remove('new-led-off');
            }
            if (!led.classList.contains('new-led-on')) {
                led.classList.add('new-led-on');
            }
        } else {
            if (led.classList.contains('new-led-on')) {
                led.classList.remove('new-led-on');
            }
            if (!led.classList.contains('new-led-off')) {
                led.classList.add('new-led-off');
            }
        }
        // console.log(value)
    }

    function set_data_selected_system(selected_system) {
        var system_type = selected_system.last_record.system_type;
    //
        set_temp1.innerHTML = selected_system.last_record.set_temp1;
        set_temp2.innerHTML = selected_system.last_record.set_temp2;
        set_hum.innerHTML = selected_system.last_record.set_hum;
        selected_system_name.innerHTML = selected_system.name + "  وضعیت فعلی دستگاه   "
    //     // $(function() {
        set_led(led_high_temp, selected_system.last_record.high_temp)
        set_led(led_high_hum, selected_system.last_record.high_hum)
        set_led(led_dry_wick, selected_system.last_record.dry_wick)
        set_led(led_low_temp, selected_system.last_record.low_temp)
        set_led(led_low_hum, selected_system.last_record.low_hum)
        set_led(led_fan_failure, selected_system.last_record.fan_failure)
        set_led(led_program_error, selected_system.last_record.error_program)
    //
        set_led(led_main_heater, selected_system.last_record.heater)
        set_led(led_spray, selected_system.last_record.spray)
        set_led(led_damper_opening, selected_system.last_record.damper_opening)
        set_led(led_damper_opened, selected_system.last_record.damper_open)
        set_led(led_damper_closing, selected_system.last_record.damper_closing)
        set_led(led_damper_closed, selected_system.last_record.damper_closed)
        // egg_turn_box.classList.add('invisible')
        // document.getElementById("egg_turn_box").classList.add("invisible")

        if (selected_system.last_record.fan_control == 1) {
            fan_control.classList.add('rotate')
        } else {
            fan_control.classList.remove('rotate')
        }

        if (selected_system.last_record.error == 1) {
            error_message.classList.remove('d-none')
        } else {
            error_message.classList.add('d-none')
        }

        if (system_type == 1) {
            set_led(led_main_or_door_open, selected_system.last_record.high_temp)
            set_led(led_aux_heater_or_blower, selected_system.last_record.auxlary_heater)
            set_led(led_egg_turn_or_aux_heater, selected_system.last_record.egg_turn)
            text_main_or_door_open.innerHTML = "MAIN"
            text_aux_heater_or_blower.innerHTML = "AUX HEATER"
            text_egg_turn_or_aux_heater.innerHTML = "EGG TURN"

            set_led(led_egg_left, selected_system.last_record.egg_left)
            set_led(led_egg_right, selected_system.last_record.egg_right)
            set_led(led_egg_turning, selected_system.last_record.turning)
            set_led(led_egg_failure, selected_system.last_record.egg_failure)

            egg_turn_box.classList.remove('d-none')
        } else {
            set_led(led_main_or_door_open, selected_system.last_record.door_open)
            set_led(led_aux_heater_or_blower, selected_system.last_record.blower)
            set_led(led_egg_turn_or_aux_heater, selected_system.last_record.auxlary_heater)
            text_main_or_door_open.innerHTML = "DOOR OPEN"
            text_aux_heater_or_blower.innerHTML = "BLOWER"
            text_egg_turn_or_aux_heater.innerHTML = "AUX HEATER"

            egg_turn_box.classList.add('d-none')

        }
        //     console.log()
        //
        // });

        $(seven_seg1).sevenSeg({digits: 5, value: selected_system.last_record.temp1});
        $(seven_seg2).sevenSeg({digits: 5, value: selected_system.last_record.temp2});
        $(seven_seg3).sevenSeg({digits: 5, value: selected_system.last_record.hum});
        $(seven_seg4).sevenSeg({digits: 5, value: selected_system.last_record.co2});


    }
//
//     function set_data_systems(systems)
//     {
//         table_tbody = document.getElementById('systems_table').getElementsByTagName('tbody')[0];
//         $("#systems_table tbody tr").remove()
        // systems.foreach(addrow())
        // function addrow(){
        // if (table_tbody.rows.length > 0) {
//
                // console.log(table_tbody.rows)
//
        // }
        // if (table_tbody.rows.length >0){
        //     table_tbody.children().remove()
        // }
//
        // for (const row of table_tbody.rows){
        //     table_tbody.delete
        // }
//
        // table_tbody.deleteRow(0)
        // for (const system of systems) {
        //     console.log(a)
            // var new_row = table_tbody.insertRow();
            // new_row.addEventListener("click", function () {
            //     window.location.href = "/?system_id="  + system.id
            // })
            // var cell0 = new_row.insertCell()
            // var cell1 = new_row.insertCell()
            // var cell2 = new_row.insertCell()
            // var cell3 = new_row.insertCell()
            // var cell4 = new_row.insertCell()
            // var cell5 = new_row.insertCell()
            // var cell6 = new_row.insertCell()
            // var cell7 = new_row.insertCell()
            // var cell8 = new_row.insertCell()
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

    {{--setInterval(function () {--}}
    {{--    $.get("/dashboard/{{ $user->selected_system->id }}", function (data, status) {--}}

    {{--        set_data_selected_system(data.user.selected_system)--}}
    {{--        set_data_systems(data.user.systems)--}}
    {{--        // console.log(status ,data);--}}

    {{--    });--}}


    {{--}, 3000)--}}


</script>

</body>
</html>

<!-- end document-->
