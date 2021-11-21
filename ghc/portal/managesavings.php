<?php
session_start(); ob_start();

include("library/connect.inc.php");
chkLogin();
 if(array_key_exists('userKeyx', $_POST)){ $_SESSION['userKeyx']=$_POST['userKeyx']; }
$userKeyx = isset($_SESSION['userKeyx'])?$_SESSION['userKeyx']:'';


$sql=$db->query("SELECT * FROM savings WHERE userid='$userKeyx' ");

 $row = mysqli_fetch_assoc($sql);
    $amount = $row['amount'];
    $period = $row['period'];
    $start = $row['startdate'];
    $day = 60*60*24;
    $today = time();
    $i=0;
    $range = $today - $start;
    $period = $row['period'];

     if($period == 1){
    $days = (int)($range/$day)+1;
}elseif ($period == 2) {
    $days = (int)($range/$day)+1;
    $days = (int)($days/7); }  
    elseif ($period == 3) {
    $days = (int)($range/$day)+1;
    $days = (int)($days/30);}


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
    <link href="../plugins/components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <!-- ===== Animation CSS ===== -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- ===== Custom CSS ===== -->
    <link href="css/style.css" rel="stylesheet">
    <!-- ===== Color CSS ===== -->
    <link href="css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html
    5shiv/3.7.0/html5shiv.js"></script>
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
         <?php if(isset($report)){echo $signup->Alert(); unset($_SESSION['pay_status']);} ?>
        <div class="page-wrapper">
            <!--<div class="container-fluid">
                
             ===== Page-Container ===== -->
            <div class="container-fluid">


                <div class="row">

                    <div class="col-md-3 col-sm-12">
                        <div class="white-box">
                            <h5 class="box-title">Select User</h5>
                               <div class="row">
                                <form method="post">
<select name="userKeyx" class="form-control" onchange="submit()" required>
    <option></option>
    <?php $sql=$db->query("SELECT * FROM savings ");
 while($row = mysqli_fetch_assoc($sql)){ echo '<option value="'.$row['userid'].'">'.$profile->wildUserNameKey($row['userid']).'</option>'; } ?>
    
</select></form>
                               </div>
                           </div>
                       </div>

                    <div class="col-md-9 col-sm-12">
                        <div class="white-box">
                            <h5 class="box-title">Periodic Savings Schedule for <?php echo $profile->wildUserNameKey($userKeyx) ; ?> [<?php echo $profile->wildUserNameKey($userKeyx,'user') ; ?>]</h5>
                               <div class="row">
                                <form method="post">
                                   
                                    
                                    <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th width="30">
                                                            <div class="checkbox m-t-0 m-b-0 ">
                                                                <input id="checkbox0" type="checkbox" class="checkbox-toggle" value="check all">
                                                                <label for="checkbox0"></label>
                                                            </div>
                                                        </th>
                                                        <th>
                                                           Periodic Amount
                                                        </th>
                                                        <th>
                                                            Expeced Payment Date
                                                        </th>

                                                        <th>
                                                           Status
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                <?php     while($i<$days){$e=$i++; 

                                                if($period == 1){ $trackdate = $start+$day*$e; }
                                                elseif($period == 2){ $trackdate = $start+$day*$e*7; }
                                                elseif($period == 3){ $trackdate = $start+$day*$e*30; }



                                                  $newdate = date('Y-M-d', $trackdate); 
                                                $status = ($profile->trackPaid($userKeyx,$trackdate)==0)?'Pending':'Paid'; 
                                                if($profile->attStatus($userKeyx,$trackdate)==0){ ?>
                                                    <tr class="unread">
                                                        <td>
                                                            <div class="checkbox m-t-0 m-b-0">
                                                                <input type="checkbox"  name="selector[]" value="<?php echo $trackdate; ?>">
                                                                <label for="ch1"></label>
                                                            </div>
                                                        </td>
                                                        <td>₦<?php echo number_format($amount); ?></td>
                                                      
                                                        <td> <?php echo $newdate; ?></td>
                                                        
                                                        <td> <?php echo $status;  ?> </td>
                                                    </tr>
                                                <?php }} ?>
                                                   
                                                </tbody>
                                            </table>
                                            <input type="hidden" name="amount" value="<?php echo $amount; ?>">
                                            <input type="hidden" name="userKey" value="<?php echo $userKeyx; ?>">
                                            <button class="btn btn-success btn-lg pull-right" name="PayMultiple" value="<?php echo $userKeyx; ?>">PAY FOR SELECTED DAYS</button>
                                </form>
                                   </div>
                                </div>
                            </div>


                   




                   


                    </div>
                


<div class="modal fade" id="deleteinv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="exampleModalLabel1">Delete Savings Schedule</h4> </div>
                                        <form method="post">
                                            <div class="modal-body">
                                            Are you sure you want to delete this Schedule?

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger" value="<?php echo $row['trno']; ?>" name="DeleteUserSav">Yes, Delete</button>
                                        </div>
                                    </form>
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

    <script src="../plugins/countdown/js/jquery.countdown.min.js"></script>



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
            [<?php echo $profile->monthEntryData() ?>],
            [<?php echo $profile->monthUserSponsor() ?>]
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

<script type="text/javascript">
        $(function () {
            $("#datepicker1").datepicker({ dateFormat: "dd/mm/yy" }).val()
        });

    </script>



    <!-- ===== Style Switcher JS ===== -->
    <script src="../plugins/components/styleswitcher/jQuery.style.switcher.js"></script>
    <script src="../plugins/components/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
</body>

</html>
