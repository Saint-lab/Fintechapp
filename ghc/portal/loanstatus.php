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
 <div class="col-md-12 col-sm-12">
                        <div class="white-box stat-widget">
                          
                            <h5>Loan Records</h5>
                               <?php echo $profile->userLoanAction($userKey); ?>
                      
                        </div>
 
                    </div>
                  </div>



                   


                    </div>
                

   <?php if(isset($_GET['pay_fee'])){ ?>
  <div class="modal show" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <a href="?"><button type="button" class="close" aria-label="Close"><span aria-hidden="true"">&times;</span></button></a>
                                            <h4 class="modal-title" id="exampleModalLabel1">Pay Processing Fee: <?php echo $_GET['pay_fee'] ?></h4> </div>
                                     
                                            <div class="modal-body">
                                            
                                           
               <center><form>
    <script type="text/javascript" src="https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
    <button type="button" onClick="payWithRave()" class="btn btn-success btn-lg">PAY SECURELY ONLINE </button>
</form>

</center> 

<?php $sql=$db->query("SELECT * FROM loan WHERE  id = '$userKey' AND status=2 ");
$row = mysqli_fetch_assoc($sql); $trno = $row['trno']; $loan = $row['loan'];
 ?>
<script>
    const API_publicKey = "FLWPUBK-b60bb4aec8444bcc33133a2332b5b0d4-X";

    function payWithRave() {
        var x = getpaidSetup({
            PBFPubKey: API_publicKey,
            customer_email: "<?php echo $profile->userName('email') ?>",
            amount: "<?php echo $loan*PROFEE ?>",
            customer_phone: "<?php echo $profile->userName('phone') ?>",
            currency: "NGN",
            txref: "<?php echo $trno ?>",
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
                    window.location = "http://localhost/ghc/loanstatus.php?txref="+txref;
                } else {
                   window.location = "https://thegreatheights.com/user/payment-cancel.php?txref="+txref;
                }

                x.close(); // use this to close the modal immediately after payment.
            }
        });
    }
</script>
                             

                                  
                                   
                                   

                                            
                                   
                                      
              
           </div>
       </div>
   </div>
 <?php } ?>
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
