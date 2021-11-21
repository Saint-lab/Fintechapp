<?php
session_start(); ob_start();

include("library/connect.inc.php");
chkLogin();
if(isset($_GET['messages'])){
    $msgId = $_GET['messages'];
    global $db;
    $db->query("UPDATE msg SET active = 2 WHERE sha1(sn) = '$msgId'");
}
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
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title>Greater Height</title>
    <!-- ===== Bootstrap CSS ===== -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- ===== Plugin CSS ===== -->
    <link href="../plugins/components/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="../plugins/components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!-- ===== Animation CSS ===== -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- ===== Custom CSS ===== -->
    <link href="css/style.css" rel="stylesheet">
    <!-- ===== Color CSS ===== -->
    <link href="css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="mini-sidebar">
    <!-- ===== Main-Wrapper ===== -->
    <div id="wrapper">
     <!--   <div class="preloader">
            <div class="cssload-speeding-wheel"></div>
        </div>  --->
        <!-- ===== Top-Navigation ===== -->
<?php include ("topnav.php"); ?>
        <!-- ===== Top-Navigation-End ===== -->
        <!-- ===== Left-Sidebar ===== -->
 <?php include ("aside.php"); ?>
        <!-- ===== Left-Sidebar-End ===== -->
        <!-- ===== Page-Content ===== -->
         <?php if(isset($report)){echo $signup->Alert(); } ?>
         <div class="page-wrapper">
            <div class="container-fluid">
                <!-- row -->
                <div class="row">
                    <!-- Left sidebar -->
                    <div class="col-md-12">
                        <div class="white-box">
                            <div class="row">
                               
                                <?php global $db;

                                $sql = $db->query("SELECT * FROM msg WHERE sha1(sn) = '$msgId'");
                                $row = $sql->fetch_assoc();?>
                                <div class="col-lg-10 col-md-9 col-sm-8 col-xs-12 mail_listing">
                                    <div class="media m-b-30 p-t-20">
                                        <h4 class="font-bold m-t-0"><?php echo $row['subject']; ?></h4>
                                        <hr>
                                        <a class="pull-left" href="#"> <img class="media-object thumb-sm img-circle" src="../plugins/images/users/7.jpg" alt=""> </a>
                                        <div class="media-body"> <span class="media-meta pull-right"><?php echo date('d-m-Y h:iA',$row['ctime']); ?></span>
                                            <h4 class="text-danger m-0">GreaterHeight Admin</h4>  </div>
                                    </div>
                                    <?php echo $row['msg']; ?>
                                    <hr>
                                    
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


<!-- ===== Page-Container-End ===== -->
<?php include("footer.php"); ?>
        </div>
        <!-- ===== Page-Content-End ===== -->
    </div>

                <script src="../plugins/components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="js/sidebarmenu.js"></script>
    <!--slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.js"></script>
    <!--Style Switcher -->
    <script src="../plugins/components/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>