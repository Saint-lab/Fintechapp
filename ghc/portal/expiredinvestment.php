<?php
session_start(); ob_start();

include("library/connect.inc.php");
chkLogin();
if($profile->adminLevel() == FALSE){session_destroy(); header('location: ../'); }


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
    <title>Greater Height Admin</title>
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
        <div class="page-wrapper">
         
<?php if(isset($report)){echo $signup->Alert(); } ?>


<!--     <div class="row">-->
<!-- <div class="col-md-12 col-sm-12">-->
<!--                        <div class="white-box stat-widget">-->
<!--                          -->
<!--                            <h5>Un-activated Investments</h5>-->
<!--                               --><?php //echo $profile->InvestApplications(1); ?>
<!--                     -->
<!--                        </div>-->
<!-- -->
<!--                    </div>-->
<!--                  </div>-->
<!---->
<!---->
<!---->
<!--                    <div class="row">-->
<!-- <div class="col-md-12 col-sm-12">-->
<!--                        <div class="white-box stat-widget">-->
<!--                          -->
<!--                            <h5>Active Investment</h5>-->
<!--                               --><?php //echo $profile->InvestApplications(2); ?>
<!--                      -->
<!--                        </div>-->
<!-- -->
<!--                    </div>-->
<!--                  </div>-->

                  <div class="row">
 <div class="col-md-12 col-sm-12">
                        <div class="white-box stat-widget">
                          
                            <h5>Expired Investment</h5>
                               <?php echo $profile->InvestApplications(3); ?>
                      
                        </div>
 
                    </div>
                  </div>

                

<?php if(isset($_GET['tr_k']) AND $profile->investAccountStatus($_GET['tr_k'])>1){  ?>
 <div class="row">
 <div class="col-md-12 col-sm-12">
                        <div class="white-box stat-widget">
                          
                            
                        </div>
 
                    </div>
                  </div>


                  <div class="modal show" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <a href="?"><button type="button" class="close" aria-label="Close"><span aria-hidden="true"">&times;</span></button></a>
                                            <h4 class="modal-title" id="exampleModalLabel1">Loan Status: <?php echo $_GET['tr_k'] ?></h4> </div>
                                     
                                            <div class="modal-body">
                                            
                                           
                      
                            <form method="post">
                                <?php if($profile->investAccountStatus($_GET['tr_k'])==2){ ?>

                                  
                                   
                                    
                                   <center>

<h1 class="font-light" style="color: green;"> <i class="fa fa-check"></i> <br>Investment <br>Activated</h1></center>
                              
                                
                             <?php   } ?>

                                        </div>
                                       
                              
                                    </div>
                                </div>
                            </div>

<?php } ?> </form>

<!----Authorization Modal--->
<?php if(isset($_GET['tr_k'])){ if($profile->investAccountStatus($_GET['tr_k'])==1){  ?>
 <div class="modal show" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <a href="?"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></a>
                                            <h4 class="modal-title" id="exampleModalLabel1">Payment Confirmation</h4> </div>
                                        <form method="post">
                                            <div class="modal-body">
                                            
                                                <div class="form-group">
                                                    <label for="recipient-name" class="control-label">Authorization Code:</label>
                                                    <input type="password" class="form-control" name="adminCode" >
                                                </div>

                                        </div>
                                        <div class="modal-footer">
                                            <a href="?"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></a>
                                            <button type="submit" class="btn btn-primary" value="<?php echo $_GET['tr_k']; ?>" name="payInvestAdmin">Approve Payment</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
<?php } } ?>
              
            
            <!-- ===== Page-Container-End ===== -->
            <?php include("footer.php"); ?>
        </div>
        <!-- ===== Page-Content-End ===== -->
  
    <!-- ===== Main-Wrapper-End ===== -->
    <!-- ==============================
        Required JS Files
    =============================== -->
    <!-- ===== jQuery ===== -->
    <script src="../plugins/components/jquery/dist/jquery.min.js"></script>
    <!-- ===== Bootstrap JavaScript ===== -->
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- ===== Slimscroll JavaScript ===== -->
    <script src="js/jquery.slimscroll.js"></script>
    <!-- ===== Wave Effects JavaScript ===== -->
    <script src="js/waves.js"></script>
    <!-- ===== Menu Plugin JavaScript ===== -->
    <script src="js/sidebarmenu.js"></script>
    <!-- ===== Custom JavaScript ===== -->
    <script src="js/custom.js"></script>
    <!-- ===== Plugin JS ===== -->
    <script src="../plugins/components/chartist-js/dist/chartist.min.js"></script>
    <script src="../plugins/components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="../plugins/components/sparkline/jquery.sparkline.min.js"></script>
    <script src="../plugins/components/sparkline/jquery.charts-sparkline.js"></script>
    <script src="../plugins/components/knob/jquery.knob.js"></script>
    <script src="../plugins/components/easypiechart/dist/jquery.easypiechart.min.js"></script>
   
    <!-- ===== Style Switcher JS ===== -->
    <script src="../plugins/components/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>
