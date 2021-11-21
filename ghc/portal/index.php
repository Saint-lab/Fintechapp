<?php
session_start(); ob_start();

include("library/connect.inc.php");
chkLogin();

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
                <div class="row colorbox-group-widget">
                    <div class="col-md-4 col-sm-6 info-color-box">
                        <div class="white-box">
                            <div class="media bg-primary">
                                <div class="media-body">
                                    <h3 class="info-count">₦<?php echo number_format($profile->loanStat()) ?> <span class="pull-right"><i class="mdi mdi-coin"></i></span></h3>
                                    <p class="info-text font-12">Current Accessed Loan</p>
                                    <p class="info-ot font-15" style="float: left;">Paid<span class="label label-rounded">₦<?php echo number_format($profile->loanStat(1)) ?></span></p>
                                    <p class="info-ot font-15">Debt<span class="label label-rounded">₦<?php echo number_format($profile->loanStat(2)) ?></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $sql = $db->query("SELECT * FROM invacc WHERE userid='$userKey' AND status=2"); $row=$sql->fetch_assoc(); ?>
                    <div class="col-md-4 col-sm-6 info-color-box">
                        <div class="white-box">
                            <div class="media bg-success">
                                <div class="media-body">
                                    <h3 class="info-count">₦<?php echo number_format($profile->investmentStat()) ?> <span class="pull-right"><i class="mdi mdi-comment-text-outline"></i></span></h3>
                                    <p class="info-text font-12">Current Investments</p>
                                    <p class="info-ot font-15" style="float: left;">ROI<span class="label label-rounded">₦<?php echo number_format($profile->investmentStat(1,'r')) ?> </span></p>
                                    <p class="info-ot font-15">End Date<span class="label label-rounded"><?php echo date("j M Y",$row['tan']) ?> </span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 info-color-box">
                        <div class="white-box">
                            <div class="media bg-danger">
                                <div class="media-body">
                                    <h3 class="info-count">₦<?php echo number_format($profile->totalSavings()) ?> <span class="pull-right"><i class="mdi mdi-coin"></i></span></h3>
                                    <p class="info-text font-12">Total Savings</p>
                                    <p class="info-ot font-15" style="float: left;">Period<span class="label label-rounded">₦<?php echo $profile->sKeyToPeriod($profile->totalSavings(2)) ?> </span></p>

                                    
                                    <p class="info-ot font-15">Amount<span class="label label-rounded">₦<?php echo number_format($profile->totalSavings(3)) ?> </span></p>
                                </div>
                            </div>
                        </div>
                    </div>
<!--                    <div class="col-md-3 col-sm-6 info-color-box">-->
<!--                        <div class="white-box">-->
<!--                            <div class="media bg-warning">-->
<!--                                <div class="media-body">-->
<!--                                    <h3 class="info-count">₦--><?php //echo number_format($profile->loanStat()) ?><!-- <span class="pull-right"><i class="mdi mdi-coin"></i></span></h3>-->
<!--                                    <p class="info-text font-12">Total Loan Accessed</p>-->
<!--                                    <p class="info-ot font-15" style="float: left;">No of Investment<span class="label label-rounded">₦--><?php //echo number_format($profile->loanStat(1)) ?><!--</span></p>-->
<!--                                   <p class="info-ot font-15">Debt<span class="label label-rounded">₦--><?php ////echo number_format($profile->loanStat(2)) ?><!--<!--</span></p>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
                </div>
            </div> 
            <!-- ===== Page-Container ===== 
            <div class="container-fluid">-->
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="white-box stat-widget">
                            <div class="row">
                                <div class="col-md-3 col-sm-3">
                                    <h4 class="box-title">Statistics</h4>
                                </div>
                               <div class="col-md-9 col-sm-9">
                                  <!--   <select class="custom-select">
                                        <option selected value="0">Feb 04 - Mar 03</option>
                                        <option value="1">Mar 04 - Apr 03</option>
                                        <option value="2">Apr 04 - May 03</option>
                                        <option value="3">May 04 - Jun 03</option>
                                    </select>  --->
                                    <ul class="list-inline">
                                        <li>
                                            <h6 class="font-15"><i class="fa fa-circle m-r-5 text-success"></i>Loan</h6>
                                        </li>
                                        <li>
                                            <h6 class="font-15"><i class="fa fa-circle m-r-5 text-primary"></i>Savings</h6>
                                        </li>
                                        <li>
                                            <h6 class="font-15"><i class="fa fa-circle m-r-5 text-warning"></i>Investment</h6>
                                        </li>
                                    </ul>
                                </div>
                                <div class="stat chart-pos"></div>
                            </div>
                        </div>
                    </div>
                </div>



      
             
            
            <!-- ===== Page-Container-End ===== -->
            <?php include("footer.php"); ?>
        </div>
        <!-- ===== Page-Content-End ===== -->
    </div>
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
   <!-- <script src="../plugins/components/sparkline/jquery.charts-sparkline.js"></script> -->
    <script src="../plugins/components/knob/jquery.knob.js"></script>
    <script src="../plugins/components/easypiechart/dist/jquery.easypiechart.min.js"></script>



    <script type="text/javascript">
  $(document).ready(function () {
      var sparklineLogin = function () {
         
          $('#sparkline16').sparkline([15, 23, 55, 35, 54, 45, 66, 47, 30], {
              type: 'line',
              width: '100%',
              height: '200',
              chartRangeMax: 50,
              resize: true,
              lineColor: '#00bbd9',
              fillColor: 'rgba(19, 218, 254, 0.3)',
              highlightLineColor: 'rgba(0,0,0,.1)',
              highlightSpotColor: 'rgba(0,0,0,.2)',
          });

         

          $('#sparklinedashdb').sparkline([<?php echo $profile->AllMonthEntryData() ?>], {
              type: 'bar',
              height: '40',
              barWidth: '4',
              resize: true,
              barSpacing: '16',
              barColor: '#00bbd9'
          });

         

      }
      var sparkResize;

      $(window).resize(function (e) {
          clearTimeout(sparkResize);
          sparkResize = setTimeout(sparklineLogin, 500);
      });
      sparklineLogin();

  });

    </script>


    <script type="text/javascript">
        $(function() {
    "use strict";

    /* ===== Knob chart initialization ===== */

   
    /* ===== Statistics chart ===== */

    var chart1 = new Chartist.Line('.stat', {
        labels: [<?php echo $profile->chartMonth() ?>],
        series: [
            [<?php echo $profile->monthSavingData() ?>],
            [<?php echo $profile->monthLoanData() ?>],
            [<?php echo $profile->monthlyPotential() ?>]
        ]
    }, {
        high: <?php echo $profile->maxMonthly() ?>,
        low: 0,
        height: '278px',
        showArea: false,
        fullWidth: true,
        axisY: {
            onlyInteger: true,
            showGrid: true,
            offset: 20,
        },
        plugins: [
            Chartist.plugins.tooltip()
        ]
    });

   
});

    </script>





    <!-- ===== Style Switcher JS ===== -->
    <script src="../plugins/components/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>
