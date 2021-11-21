<?php
session_start(); ob_start();

include("library/connect.inc.php");
chkLogin();
if(isset($_SESSION['pay_status'])){$report = $_SESSION['pay_status']; 
}
if(isset($_SESSION['document'])){$report = $_SESSION['document'];}

$loan = isset($_SESSION['loan'])?$_SESSION['loan']:'';
$duration = isset($_SESSION['duration'])?$_SESSION['duration']:'';
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
    <title>Loan Processing</title>
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
         <?php if(isset($report)){echo $signup->Alert(); unset($_SESSION['pay_status']);
        unset($_SESSION['document']);} ?>
        <div class="page-wrapper">
            <!--<div class="container-fluid">
                
             ===== Page-Container ===== -->
            <div class="container-fluid">

         <?php if($profile->unpaidLoan()>0){  ?>     
 <div class="row">
              <div class="col-md-12 col-sm-12">
                        <div class="white-box stat-widget">
                           
                                
                                <div class="col-md-8 col-sm-12">    <h4 class="box-title">Loan Repayment Schedule</h4></div>
<div class="col-md-4 col-sm-12"> <h3><small>Countdown to Next Payment</small><br><?php echo $profile->nextCountdown(); ?>
</h3></div>
<?php if(isset($_SESSION['payloan'])){  ?>
<center><h3 class="font-light">PAY WITH CREDIT/DEBIT CARD</h3>
                                            <hr class="m-t-0 m-b-40">
                          
                            <font size="+1" color="#009900">Pay <?php echo $profile->nextCountdown(2); ?> Tranch: ₦<?php echo number_format($profile->nextCountdown(1)); ?></font><br>Transaction Charges: ₦<?php echo number_format($profile->nextCountdown(6)); ?><br> 
Click the button below to make payment <br>
 <br> 
<?php 

$email = $profile->userName('email');
?>
   <form action="http://localhost/bfnet/myadmin/accessloan.php?trk_reference=<?php echo $ref; ?>" method="POST" >
  <script
    src="https://js.paystack.co/v1/inline.js" 
    data-key="pk_test_892db4557aaa33f139a9b0df2a5aa7541b352001"
    data-email="<?php echo $email; ?>"
    data-amount="<?php echo ($profile->nextCountdown(1)+$profile->nextCountdown(6)); ?>00"
    data-ref="<?php $_SESSION['random'] = win_hashs(12); echo $_SESSION['random']; ?>"
 >
  </script>
</form></center>


  <?php } ?> 
                                <form method="post">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Instalment</th><th>Pay By</th><th>Amount</th><th>Pay Loan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php echo $profile->loanRepayment();  ?>
                                        </tbody>
                                </table>
                               </form>
                                
                            </div>
                        </div>
                    </div>
<?php }else{  ?> 



                <div class="row">

                    <div class="col-md-4 col-sm-12">
                        <div class="white-box">
                            <h5 class="box-title">Request Loan</h5>
                               <div class="row">
                                <form method="post">
                                   
                                    
                                    Specify Loan Amount
                                      <div class="input-group m-t-10">
                                        
                                                <span class="input-group-addon">₦</span><input type="number" id="example-input2-group2" name="selectLoan" class="form-control" placeholder="Enter Amount" style="font-size: 18px; height: 40px" min="10000" max="200000" required value="<?php echo $loan ?>">
                                              </div>

                                              <div class="input-group m-t-10">  <select class="form-control" name="duration" required>
                                                    <option value="">Repayment Period</option>
                                                    <option value="1" <?php if($duration==1){echo 'selected';} ?>>1 Month</option>
                                                    <option value="2" <?php if($duration==2){echo 'selected';} ?>>2 Months</option>
                                                    <option value="3" <?php if($duration==3){echo 'selected';} ?>>3 Months</option>
                                                </select>
                                                 <span class="input-group-btn">
                      <button type="submit" class="btn waves-effect waves-light btn-primary">Submit</button>
                      </span> </div>
                                   
                                       <?php // echo $profile->optionLoan();  ?>
                                        
                              
                                 </form>
                                 <form method="post">
                                <?php echo $profile->selectLoan(1);  ?>
                                </form>
                                   </div>
                                </div>
                            </div>


                    <div class="col-md-8 col-sm-12">
                        <div class="white-box stat-widget">
                            <div class="row">
                                
                                    <h4 class="box-title">Repayment Schedule</h4>

                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Instalment</th><th>Payment Date</th><th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php echo $profile->selectLoan();  ?>
                                        </tbody>
                                </table>
                               <?php // echo $profile->loanStatus();  ?>
                                
                            </div>
                        </div>

                        <?php if(!empty($_SESSION['loan'])){  ?>  


 <!-- <div class="col-md-4 col-sm-12">
                        <div class="white-box stat-widget">
                          
                                
                                 <div class="row">

                                    <table class="table ">
                                      <thead> <tr>
                                                <th>Request OTP </th>
                                            </tr></thead>
                                            <tbody>
                                       <tr><td class="font-12">Click the button below only once to request OTP. Requested One Time Password will be forwarded as sms to your registered phone number. Authenticate the OTP to complete your loan request</td></tr
                                        ><tr><td><form method="post"> <button type="submit" class="btn btn-primary" name="requestOTP">Request OTP</button></form></td></tr>

                                       </tbody>
                                </table>
                       
                                </div>
                       
                        </div>
                    </div> -->
                        <div class="white-box stat-widget">
                            <div class="row">
                                <form method="post">
                                    <h5 class="box-title">Loan Processing</h5>

 <table class="table">
                                      <thead> <tr>
                                                <th>Loan Terms </th>
                                            </tr></thead>
                                            <tbody>
                                              <tr><td>
                                       1. Are you really sure you  need this loan?<br>
<div class="form-group">
                                                       
                                                        <div class="radio-list">
                                                            <label class="radio-inline p-0">
                                                                <div class="radio radio-success">
                                                                    <input type="radio" name="q1" id="radio1" value="1" required>
                                                                    <label for="radio1">Yes</label>
                                                                </div>
                                                            </label>
                                                            <label class="radio-inline">
                                                                <div class="radio radio-danger">
                                                                    <input type="radio" name="q1" id="radio2" value="0">
                                                                    <label for="radio2">No </label>
                                                                </div>
                                                            </label>
                                                        </div>


                                                        2. Do you agree to repay this loan according schedule?<br>
<div class="form-group">
                                                       
                                                        <div class="radio-list">
                                                            <label class="radio-inline p-0">
                                                                <div class="radio radio-success">
                                                                    <input type="radio" name="q2" id="radio1" value="1" required>
                                                                    <label for="radio1">Yes</label>
                                                                </div>
                                                            </label>
                                                            <label class="radio-inline">
                                                                <div class="radio radio-danger">
                                                                    <input type="radio" name="q2" id="radio2" value="0">
                                                                    <label for="radio2">No </label>
                                                                </div>
                                                            </label>
                                                        </div>

                                                           3. Late repayment of loan attracts penalty. Do you agree to 20% interest per month on the loan if you fail to repay the loan according to shedule?<br>
<div class="form-group">
                                                       
                                                        <div class="radio-list">
                                                            <label class="radio-inline p-0">
                                                                <div class="radio radio-success">
                                                                    <input type="radio" name="q3" id="radio1" value="1" required>
                                                                    <label for="radio1">Yes</label>
                                                                </div>
                                                            </label>
                                                            <label class="radio-inline">
                                                                <div class="radio radio-danger">
                                                                    <input type="radio" name="q3" id="radio2" value="0">
                                                                    <label for="radio2">No </label>
                                                                </div>
                                                            </label>
                                                        </div>
                                                      </td></tr>

                                   </tbody>
                                </table>

                                        <table class="table">
                                          <thead>

                                              <tr>  <th colspan="2">Authenticate Application</th></tr>
                                            </thead><tbody>
                                       <tr><td><input type="password" class="form-control" placeholder="Enter Password" name="enterOTP" required></td><td><button class="btn btn-primary" name="processLoanIni">Authenticate & Submit Loan Application</button></td></tr></tbody>
                                </table>
                              
                                </form>
                                
                            </div>
                        </div>
               


                     

<?php }  ?>
                    </div>
</div>


<?php  } 
//unset($_SESSION['pay_status']); ?>

                   


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
