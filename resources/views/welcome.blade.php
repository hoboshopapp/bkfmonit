<!DOCTYPE html>
<html>

<head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
{{--    <script src="http://localhost/wp-content/themes/twentytwenty/js/jquery-ui.min.js"></script>--}}
    <script src="http://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js"></script>
{{--    <script src="http://localhost/wp-content/themes/twentytwenty/js/sevenSeg.js"></script>--}}
{{--    <script>--}}
{{--        $(document).ready(function(){--}}
{{--            $(".grid-container-master-s").hide();--}}
{{--            //$(".setter1").click(function(){--}}
{{--            // var id = $(this).attr('id');--}}
{{--            //$(".grid-container-master").hide();--}}
{{--            //$(".grid-container-master-s").show();--}}
{{--            //$(".grid-container-master").hide();--}}
{{--            //$(".grid-container-master4-black").hide();--}}
{{--            //$(".grid-container-master-white4").hide();--}}
{{--            //$(".grid-container-master-white3").hide();--}}
{{--            //});--}}
{{--            //   $(".hatcher1").click(function(){--}}
{{--            //var id = $(this).attr('id');--}}
{{--            //$(".grid-container-master").show();--}}
{{--            //$(".grid-container-master-s").hide();--}}
{{--            //$(".grid-container-master").hide();--}}
{{--            //$(".grid-container-master4-black").hide();--}}
{{--            //$(".grid-container-master-white4").hide();--}}
{{--            //$(".grid-container-master-white3").hide();--}}
{{--            //});--}}
{{--        });--}}
{{--    </script>--}}

    <style>

        body{
            background-color: #333333;
        }

        table{
            width: 100%;
            text-align: center;
        }
        .IncuTable {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            text-align: center;
            width: 100%;
            background-color: #FFFFFF;
        }

        .container {
            position: relative;
            height: 40px;
            border: 1px solid #000;
        }

        .container::before {
            content: "";
            /* background-image: url('your background'); */
            position: absolute;
            z-index: 1;
            background-color: #a9aaab;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .IncuTable td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .IncuTable tr:nth-child(even){
            background-color: #f2f2f2;

        }

        .IncuTable tr:hover {background-color: #ddd;}

        .IncuTable th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #4D9EFF;
            color: white;
        }

        .content {
            position: absolute;
            z-index: 2;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .resizableExample
        {

            height: 100px;
            width: 80px;
            padding: -7px 60px;
        }

        .outer-circle-alarm {
            background: #a9aaab;
            border-radius: 50%;
            height: 80px;
            width: 80px;
            position: relative;
            top: 43px;
            right: -87px
        }
        .inner-circle-alarm {
            position: absolute;
            background: red;
            border-radius: 50%;
            height: 70px;
            width: 70px;
            top: 50%;
            left: 50%;
            margin: -35px 0px 0px -35px;
            text-align:center
        }


        .outer-circle {
            background: #a9aaab;
            border-radius: 50%;
            height: 30px;
            width: 30px;
            position: relative;
            text-align:center

            /*
             Child elements with absolute positioning will be
             positioned relative to this div
            */
        }
        .inner-circle {
            position: absolute;
            background: #4a1719;
            border-radius: 50%;
            height: 25px;
            width: 25px;
            /*
             Put top edge and left edge in the center
            */
            top: 50%;
            left: 50%;
            margin: -12px 0px 0px -12px;
            text-align:center
        }


        .dot {
            position: absolute;
            height: 25px;
            width: 25px;
            background-color: red;
            border-radius: 50%;
            display: inline-block;
            margin-left: auto;
            margin-right: auto;
        }

        .grid-container-panel {
            display: grid;
            grid-template-columns: auto;
            grid-template-rows: 40px;
            grid-gap: 24px;
            background-color: black;
            padding: 12px 57px;;
            border: 2px solid white;
            border-radius: 10px;

            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .grid-container-panel > div {
            text-align: center;

            font-size: 30px;

        }

        .grid-container {
            display: grid;
            grid-template-columns: auto auto auto auto;
            grid-gap: 130px;
            background-color: black;
            padding: 53px 70px;
            border: 2px solid white;
            border-radius: 10px;
            margin-left: auto;
            margin-right: auto;
        }

        .grid-container > div {
            background-color: rgba(255, 255, 255, 0.8);
            text-align: center;
            padding: 20px 0;
            font-size: 30px;

        }

        .grid-container-turning {
            display: grid;
            grid-template-columns: auto auto;
            grid-gap: 62px;
            background-color: black;
            padding: 53px 70px;
            border: 2px solid white;
            border-radius: 10px;
            margin-left: auto;
            margin-right: auto;
        }

        .grid-container-turning > div {
            background-color: rgba(255, 255, 255, 0.8);
            text-align: center;
            padding: 20px 0;
            font-size: 30px;

        }

        .grid-container-master {
            border-radius: 10px 10px 0px 0px;
            display: grid;
            grid-template-columns: auto auto;
            grid-gap: 10px;
            background-color: black;
            padding: 20px 20px;

        }

        .grid-container-master > div {
            background-color: rgba(255, 255, 255, 0);
            text-align: center;

        }

        .grid-container-master-s {
            border-radius: 10px 10px 0px 0px;
            display: grid;
            grid-template-columns: auto auto auto;
            grid-gap: 10px;
            background-color: black;
            padding: 20px 20px;

        }

        .grid-container-master-s > div {
            background-color: rgba(255, 255, 255, 0);
            text-align: center;

        }

        .grid-container-master4 {
            border-radius: 10px 10px 0px 0px;
            display: grid;
            grid-template-columns: auto auto auto auto;
            grid-gap: 10px;
            background-color: black;
            padding: 50px 20px;
        }

        .grid-container-master4 > div {
            background-color: rgba(255, 255, 255, 0);
            text-align: center;

        }

        .grid-container-master4-black {
            border-radius: 10px 10px 0px 0px;
            display: grid;
            grid-template-columns: auto auto auto auto;
            grid-gap: 10px;
            background-color: black;
            padding: 10px 20px;
        }

        .grid-container-master4-black > div {
            background-color: rgba(255, 255, 255, 0);
            text-align: center;

        }

        .grid-container-master-white {
            display: grid;
            grid-template-columns: auto auto auto;
            grid-gap: 50px;
            background-color: white;
            padding: 50px 20px;
        }

        .grid-container-master-white > div {
            background-color: rgba(255, 255, 255, 0);
            text-align: center;

        }

        .grid-container-master-white4 {
            display: grid;
            grid-template-columns: auto auto auto auto;
            grid-gap: 50px;
            background-color: white;
            padding: 10px 20px;
        }

        .grid-container-master-white4 > div {
            background-color: rgba(255, 255, 255, 0);
            text-align: center;

        }

        .grid-container-master-white3 {
            display: grid;
            grid-template-columns: 33% 33% 33%;
            grid-gap: 50px;
            background-color: white;
            padding: 50px 20px;
        }

        .grid-container-master-white3 > div {
            background-color: rgba(255, 255, 255, 0);
            text-align: center;

        }

        .grid-container-master-green {
            display: grid;
            grid-template-columns: auto auto;
            grid-gap: 50px;
            background-color: green;
            padding: 0px;
            border: 2px solid gray;
        }

        .grid-container-master-green > div {
            background-color: rgba(255, 255, 255, 0);
            text-align: center;

        }

        .rectangle {
            height: 50px;
            width: 290px;
            background-color: #5c0600;
        }

        .pwhite{
            color:white;
            padding: 10px;
            position: absolute;
            top: 9px;
            right: 0px;
            width: 100%;
            text-align: center;
        }

        .pblack{
            color:black;
            padding: 10px;
            position: absolute;
            top: 59px;
            right: -9px;
            width: 100%;
            text-align: center;
        }
        #temp_push_wheel{
            position: relative;
        }

        #in_temp_push_wheel{
            background-color: black;
            width: 200px;
            height: 120px;
            position: absolute;
            top: 16px;
            right: -16px;
            border-radius: 4px;
        }

        h1{
            color: white;

        }

        #arm{
            display: block;
            margin-left: auto;
            margin-right: auto;

        }

        .button {
            background-color: #008CBA;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        #ErrorBox{
            background-color: red;
        }

        .overlay {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            right: 0;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0, 0.9);
            overflow-x: hidden;
            transition: 0.5s;
        }

        .overlay-content {
            position: relative;
            top: 25%;
            width: 100%;
            text-align: center;
            margin-top: 30px;
        }

        .overlay a {
            padding: 8px;
            text-decoration: none;
            font-size: 36px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .overlay a:hover, .overlay a:focus {
            color: #f1f1f1;
        }

        .overlay .closebtn {
            position: absolute;
            top: 20px;
            right: 45px;
            font-size: 60px;
        }

        .overlay2 {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0, 0.9);
            overflow-x: hidden;
            transition: 0.5s;
        }

        .overlay2 a {
            padding: 8px;
            text-decoration: none;
            font-size: 36px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .overlay2 a:hover, .overlay2 a:focus {
            color: #f1f1f1;
        }

        .overlay2 .closebtn {
            position: absolute;
            top: 20px;
            right: 45px;
            font-size: 60px;
        }

        @media (min-width: 768px) and (max-width: 1700px) {

            .grid-container-master-s {
                border-radius: 10px 10px 0px 0px;
                display: grid;
                grid-template-columns: auto auto;
                grid-gap: 50px;
                background-color: black;
                padding: 50px 20px;
            }

            .grid-container-master-s > div {
                background-color: rgba(255, 255, 255, 0);
                text-align: center;

            }
        }

        @media (min-width: 768px) and (max-width: 1370px) {

            .overlay a {font-size: 20px}
            .overlay .closebtn {
                font-size: 40px;
                top: 15px;
                right: 35px;
            }

            .grid-container {
                display: grid;
                grid-template-columns: auto auto auto auto;
                grid-gap: 62px;
                background-color: black;
                padding: 53px 57px;
                border: 2px solid white;
                border-radius: 10px;
                margin-left: auto;
                margin-right: auto;
            }

            .grid-container > div {
                background-color: rgba(255, 255, 255, 0.8);
                text-align: center;
                padding: 20px 0;
                font-size: 30px;

            }

            .grid-container-master {
                border-radius: 10px 10px 0px 0px;
                display: grid;
                grid-template-columns: auto auto;
                grid-gap: 50px;
                background-color: black;
                padding: 50px 20px;
            }

            .grid-container-master > div {
                background-color: rgba(255, 255, 255, 0);
                text-align: center;

            }
            .grid-container-master-white {
                display: grid;
                grid-template-columns: auto auto auto auto;
                grid-gap: 50px;
                background-color: white;
                padding: 50px 20px;
            }

            .grid-container-master-white > div {
                background-color: rgba(255, 255, 255, 0);
                text-align: center;

            }

            .grid-container-master4-black {
                border-radius: 10px 10px 0px 0px;
                display: grid;
                grid-template-columns: auto auto;
                grid-gap: 10px;
                background-color: black;
                padding: 10px 20px;
            }

            .grid-container-master4-black > div {
                background-color: rgba(255, 255, 255, 0);
                text-align: center;

            }


            #in_temp_push_wheel{
                background-color: black;
                width: 200px;
                height: 120px;
                position: absolute;
                top: 16px;
                right: 20px;
                border-radius: 4px;
            }

            .grid-container-panel {
                display: grid;
                grid-template-columns: auto;

                grid-gap: 30px;
                background-color: black;
                padding: 1px 52px 52px;
                border: 2px solid white;
                border-radius: 10px;
            }

            .grid-container-panel > div {
                text-align: center;
                display: block;
                margin-left: auto;
                margin-right: auto;
                font-size: 30px;

            }

            .grid-container-turning {
                display: grid;
                grid-template-columns: auto auto;
                grid-gap: 62px;
                background-color: black;
                padding: 45px 135px;
                border: 2px solid white;
                border-radius: 10px;
            }

            .grid-container-turning > div {
                background-color: rgba(255, 255, 255, 0.8);
                text-align: center;
                padding: 20px 0;
                font-size: 30px;

            }

            /* The container must be positioned relative: */
            .custom-select {
                position: relative;
                font-family: Arial;
            }

            .custom-select select {
                display: none; /*hide original SELECT element: */
            }

            .select-selected {
                background-color: DodgerBlue;
            }

            /* Style the arrow inside the select element: */
            .select-selected:after {
                position: absolute;
                content: "";
                top: 14px;
                right: 10px;
                width: 0;
                height: 0;
                border: 6px solid transparent;
                border-color: #fff transparent transparent transparent;
            }

            /* Point the arrow upwards when the select box is open (active): */
            .select-selected.select-arrow-active:after {
                border-color: transparent transparent #fff transparent;
                top: 7px;
            }

            /* style the items (options), including the selected item: */
            .select-items div,.select-selected {
                color: #ffffff;
                padding: 8px 16px;
                border: 1px solid transparent;
                border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
                cursor: pointer;
            }

            /* Style items (options): */
            .select-items {
                position: absolute;
                background-color: DodgerBlue;
                top: 100%;
                left: 0;
                right: 0;
                z-index: 99;
            }

            /* Hide the items when the select box is closed: */
            .select-hide {
                display: none;
            }

            .select-items div:hover, .same-as-selected {
                background-color: rgba(0, 0, 0, 0.1);
            }

            select {
                font-size: 20px;
                padding: 5px;
                background: #5c5c5c;
            }

        }
    </style>
</head>
<body>

<div id="myNav" class="overlay">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="overlay-content">
        <a href="#">نمایش بر خط</a>
        <a href="#">گزارش</a>
        <a href="#">نمودار</a>
        <a href="#">تماس با شرکت</a>
    </div>
</div>

<div id="myNav2" class="overlay2">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav2()">&times;</a>
    <div class="overlay-content">
        <a href="#">صدا</a>
        <a href="#">سریال</a>
    </div>
</div>

<span style="font-size:30px;cursor:pointer; color: white; float: right;" onclick="openNav()">&#9776; منو</span>
<span style="font-size:35px;cursor:pointer; color: white; float: left;" onclick="openNav2()">&#9881; تنظیمات</span>

<br>

<br>

<div id="details"></div>
</div>
</table>
<script type="text/javascript">
    function openNav() {
        document.getElementById("myNav").style.width = "100%";
    }

    function closeNav() {
        document.getElementById("myNav").style.width = "0%";
    }
    function openNav2() {
        document.getElementById("myNav2").style.width = "100%";
    }
    function closeNav2() {
        document.getElementById("myNav2").style.width = "0%";
    }

</script>

<script>
    $(document).ready(function() {
        var One_timer=setInterval(MyTimer,5000);
        var id;
        var sub_id;
        var sub_number_id;
        var One_timer;
        //$(".grid-container-master").hide();
        //  $(".result_table").click(function() {
        //  id = $(this).attr("id");
        //            alert(id);
        //  sub_id=id.substr(0,1);
        //  //sub_number_id=(7,1);
        // alert(id);

        //   $.post("http://localhost/detail.php",
        //     {
        //         FindDetail:id
        //     },
        //     function(data){
        //         $("#details").html(data);
        //      });

        // });

        function MyTimer(){
            //alert(id);
            if(id!=""){
                id="H1";
            }
            $.post("http://localhost/detail.php",
                {
                    FindDetail:id
                },
                function(data){
                    $("#details").html(data);
                });
        }
    });
</script>
<script>
    //$(document).ready(function() {
    //var One_timer=setInterval(MyTimer,5000);
    //var id;
    //function MyTimer(){
    //alert(id);
    //if(id!=""){
    //id="H1";
    // }
    // $.post("http://localhost/detail.php",
    //   {
    //      FindDetail:id
    //  },
    //  function(data){
    //      $("#details").html(data);
    //  });
    //}
    //});
</script>
</body>
</html>
