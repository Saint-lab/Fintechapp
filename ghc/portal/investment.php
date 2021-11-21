<?php
session_start(); ob_start();

include("library/connect.inc.php");
chkLogin();
if(isset($_SESSION['pay_status'])){$report = $_SESSION['pay_status']; 
}
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

                    <div class="col-md-4 col-sm-12">
                        <div class="white-box">
                            <h5 class="box-title">Initiate Investment</h5>
                               <div class="row">
                                <form method="post">
                                   
                                    
                                    Specify Investment Amount
                                      <div class="input-group m-t-10">
                                        
                                                <span class="input-group-addon">₦</span><input type="number" id="example-input2-group2" name="amount" class="form-control" placeholder="Enter Amount" style="font-size: 18px; height: 40px" min="10000" max="200000" required value="<?php echo $loan ?>">
                                              </div>

                                              <div class="input-group m-t-10">  <select class="form-control" name="duration" required>
                                                    <option value="">Investment Period</option>
                                                    <option value="3" <?php if($duration==3){echo 'selected';} ?>>3 Months</option>
                                                    <option value="6" <?php if($duration==6){echo 'selected';} ?>>6 Months</option>
                                                    <option value="9" <?php if($duration==9){echo 'selected';} ?>>9 Months</option>
                                                    <option value="12" <?php if($duration==12){echo 'selected';} ?>>12 Months</option>
                                                    <option value="24" <?php if($duration==24){echo 'selected';} ?>>24 Months</option>
                                                </select>
                                                 <span class="input-group-btn">
                      <button type="submit" name="InitiateInvestment" class="btn waves-effect waves-light btn-primary">Submit</button>
                      </span> </div>
                                   
                                       <?php // echo $profile->optionLoan();  ?>
                                        
                              
                                 </form>
                                 <form method="post">
                                <?php //echo $profile->selectLoan(1);  ?>
                                </form>
                                   </div>
                                </div>
                            </div>


                    <div class="col-md-8 col-sm-12">
                        <div class="white-box stat-widget">
                            <div class="row">
                                
                                    <h4 class="box-title">Investment Schedule</h4>

                                    <table class="table ">
                                        <thead>
                                            <tr>
                                                <th>Investment Amount</th><th>Tenure</th><th>ROI</th><th>Total Return</th><th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php $sql=$db->query("SELECT * FROM invacc WHERE userid='$userKey' AND status = 1 ");
                                           while($row=mysqli_fetch_assoc($sql)){
                                            echo '<tr><td>₦'.number_format($row['amount']).'</td>
                                            <td>'.$row['tenure'].' Months</td>
                                            <td>₦'.number_format($row['roi']).'</td>
                                            <td>₦'.number_format($row['amount']+$row['roi']).'</td>
                                            <td><form method="post" style="display:inline"><button  data-toggle="modal" data-target="#deleteinv"  class="btn btn-danger" type="button" >Delete</button></form> </td>
                                            </tr>';

                                           }  ?>
                                        </tbody>
                                </table>

                                <center>
                                    <form  style="display:inline">
    <script type="text/javascript" src="https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
    <button type="button" onClick="payWithRave()" class="btn btn-success">PAY SECURELY ONLINE </button>
</form>
                                </center>

<?php $sql=$db->query("SELECT * FROM invacc WHERE userid='$userKey' AND status = 1 ");
                            $row=mysqli_fetch_assoc($sql); ?>
                                <script>
    const API_publicKey = "FLWPUBK-b60bb4aec8444bcc33133a2332b5b0d4-X";

    function payWithRave() {
        var x = getpaidSetup({
            PBFPubKey: API_publicKey,
            customer_email: "<?php echo $profile->userName('email') ?>",
            amount: "<?php echo $row['amount'] ?>",
            customer_phone: "<?php echo $profile->userName('phone') ?>",
            currency: "NGN",
            txref: "<?php echo $row['trno'] ?>",
            meta: [{
                metaname: "AccountINV",
                metavalue: "AI123"
            }],
            onclose: function() {},
            callback: function(response) {
                var txref = response.tx.txRef; // collect txRef returned and pass to a          server page to complete status check.
                console.log("This is the response returned after a charge", response);
                if (
                    response.tx.chargeResponseCode == "00" ||
                    response.tx.chargeResponseCode == "0"
                ) {
                    window.location = "https://thegreatheights.com/portal/confirm.php?txref="+txref;
                } else {
                   window.location = "https://thegreatheights.com/portal/transaction-fail.php";
                }

                x.close(); // use this to close the modal immediately after payment.
            }
        });
    }
</script>
                               <?php // echo $profile->loanStatus();  ?>
                                
                            </div>
                        </div>


                    </div>
</div>




                   


                    </div>
                


<div class="modal fade" id="deleteinv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="exampleModalLabel1">Delete Investment</h4> </div>
                                        <form method="post">
                                            <div class="modal-body">
                                            Are you sure you want to delete this investment?

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger" value="<?php echo $row['trno']; ?>" name="DeleteUserInv">Yes, Delete</button>
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
