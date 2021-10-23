<!DOCTYPE html>
<html lang="en">
<head>
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        #main_logo_container {
            text-align: center;
        }

        .header {
            height: 80px;
            background: #e5e5e5;
        }

        #main_logo {
            margin: 10px;
            width: 90px;
        }

        #login_container {
            background: #e5e5e5;

        }
    </style>

</head>

<body>
<header class="header">
    <div id="main_logo_container">
        <img
            id="main_logo"
            src="images/icon/bkf3_100.png"
            alt="profile Pic">
    </div>


</header>

<div class="">

    <section>
        <div class="container mt-5">
            <div class="row justify-content-center ">
                <div class="col-lg-5 col-md-12 col-sm-12  p-5 m-2" id="login_container">
                    <form method="post" action="/check_login">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input id="username" class="form-control" type="text" name="username"/>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" class="form-control" type="password" name="password"/>
                        </div>

                        <button class="btn btn-primary btn-block mt-4" type="submit">
                            Login
                        </button>
                    </form>
                </div>

            </div>


            @if(session('status'))
                <div class="alert alert-danger mt-5 text-center">
                    {{  session()->get('status') }}
                </div>
            @endif


        </div>
    </section>


</div>


</body>

</html>
