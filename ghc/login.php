<?php
session_start(); ob_start();
include("portal/library/connect.inc.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png">
    <title>GREATER HEIGHT LOGIN</title>
    <!-- ===== Bootstrap CSS ===== -->
    <link href="portal/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- ===== Plugin CSS ===== -->
    <!-- ===== Animation CSS ===== -->
    <link href="portal/css/animate.css" rel="stylesheet">
    <!-- ===== Custom CSS ===== -->
    <link href="portal/css/style.css" rel="stylesheet">
    <!-- ===== Color CSS ===== -->
    <link href="portal/css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="mini-sidebar">
     <?php if(isset($report)){echo $signup->Alert(); } ?>
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <section id="wrapper" class="login-register">
        <div class="login-box">
             <?php
      
          // execInBackground($cmd); // file($smsapi); ?>

            <h2 class="m-b-40 text-center">GREATER HEIGHT</h2>
            <div class="white-box">
                <form class="form-horizontal form-material" id="loginform" method="post" >
                    <h3 class="box-title m-b-20">Sign In</h3>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" name="usern" required="" placeholder="Username">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="passwo" required="" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="checkbox checkbox-primary pull-left p-t-0">
                                <input id="checkbox-signup" type="checkbox">
                                <label for="checkbox-signup"> Remember me </label>
                            </div>
                           <!--- <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Forgot pwd?</a>----> </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" name="LoginUsers" type="submit">Log In</button>
                        </div>
                    </div>
                   
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <p>Don't have an account? <a href="signup.php" class="text-primary m-l-5"><b>Sign Up</b></a></p>
                        <?php  ?></div>
                    </div>
                </form>
                <form class="form-horizontal" id="recoverform" action="portal/index.html">
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <h3>Recover Password</h3>
                            <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- jQuery -->
    <script src="plugins/components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="portal/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="portal/js/sidebarmenu.js"></script>
    <!--slimscroll JavaScript -->
    <script src="portal/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="portal/js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="portal/js/custom.js"></script>
    <!--Style Switcher -->
    <script src="plugins/components/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>
