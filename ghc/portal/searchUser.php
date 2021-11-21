<?php
session_start(); ob_start();

include("library/connect.inc.php");
chkLogin();
if($profile->adminLevel() == FALSE){session_destroy(); header('location: ../'); }
if(isset($_GET['f'])){
    $user = $_GET['f'];
    $sql = $db->query("SELECT * FROM user WHERE sha1(user)='$user'");
    $row = $sql->fetch_assoc();

    $username = $row['id'];
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

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="white-box stat-widget">
                    <h4><?php echo $profile->wildUserNameKey($username).' ('.$profile->wildUserNameKey($username,'user').') Transaction History' ?></h4> <br/>
                    <h5>Loan History</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Loan Amount</th>
                                <th>Expected Repayment</th>
                                <th>Total Repayment</th>
                                <th>Period</th>
                                <th>Loan Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $sql = $db->query("SELECT * FROM loan WHERE id='$username'");
                            $row1 = $sql->fetch_assoc();
                            $btn = ($row1['status']>2)?'success':'default';
                            $btnname = ($row1['status']>2)?'Loan Active':'Loan In-Active';
                            ?>
                            <tr>
                                <td>₦<?php echo number_format($row1['loan']) ?></td>
                                <td>₦<?php echo number_format($row1['loan']+$row1['interest']) ?></td>
                                <td>₦<?php echo number_format(repyament($row1['trno'])); ?></td>
                                <td><?php echo $row1['instalment'] ?> Month(s)</td>
                                <td><button class="btn btn-<?php echo $btn ?>"><?php echo $btnname; ?></button></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div> 
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="white-box stat-widget">

                    <h5>Savings History</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Total Amount</th>
                                <th>Periodic Amount</th>
                                <th>Period</th>
<!--                                <th>Number of Savings</th>-->
                            </tr>
                            </thead>
                            <tbody>
                            <?php $sql = $db->query("SELECT * FROM savings WHERE userid='$username'");
                            $row2 = $sql->fetch_assoc();

                            $sql1 = $db->query("SELECT SUM(amount) AS sum, COUNT(*) AS count FROM savings2 WHERE userid='$username'");
                            $ro = $sql1->fetch_assoc();
                            ?>
                            <tr>
                                <td>₦<?php echo number_format($ro['sum']) ?></td>
                                <td>₦<?php echo number_format($row2['amount']) ?></td>
                                <td><?php echo $profile->sKeyToPeriod($row2['period']); ?></td>
<!--                                <td>--><?php //echo $ro['count'] ?><!-- </td>-->
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
            <div class="col-md-6">
                <div class="white-box stat-widget">

                    <h5>Investment History</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Invest Amount</th>
                                <th>Tenure</th>
                                <th>ROI</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <!--                                <th>Number of Savings</th>-->
                            </tr>
                            </thead>
                            <tbody>
                            <?php $sql = $db->query("SELECT * FROM invacc WHERE userid='$username'");
                            while($ro = $sql->fetch_assoc()){
                            ?>
                            <tr>
                                <td>₦<?php echo number_format($ro['amount']) ?></td>
                                <td><?php echo $ro['tenure'] ?> Months</td>
                                <td>₦<?php echo number_format($ro['roi']); ?></td>
                                <td><?php echo date("jS M, Y",$ro['cos']); ?></td>
                                <td><?php echo date("jS M, Y",$ro['tan']); ?></td>
                                <!--                                <td>--><?php //echo $ro['count'] ?><!-- </td>-->
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
        <?php if(isset($_GET['tr_k'])){ ?>
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
                                <?php if($profile->loanAccountStatus($_GET['tr_k'])==1){ ?>




                                    Specify Loan Amount
                                    <div class="input-group m-t-10">

                                        <span class="input-group-addon">₦</span><input type="number" id="example-input2-group2" name="approveloan" class="form-control" placeholder="Enter Amount" style="font-size: 18px; height: 40px" min="10000" max="200000" required value="<?php echo $profile->loanAccountStatus($_GET['tr_k'],'loan') ?>">
                                    </div>

                                    <div class="input-group m-t-10">  <select class="form-control" name="duration" required>
                                            <option value="">Repayment Period</option>
                                            <option value="1" <?php if($profile->loanAccountStatus($_GET['tr_k'],'instalment')==1){echo 'selected';} ?>>1 Month</option>
                                            <option value="2" <?php if($profile->loanAccountStatus($_GET['tr_k'],'instalment')==2){echo 'selected';} ?>>2 Months</option>
                                            <option value="3" <?php if($profile->loanAccountStatus($_GET['tr_k'],'instalment')==3){echo 'selected';} ?>>3 Months</option>
                                        </select>
                                                 <span class="input-group-btn">
                      <button type="submit" class="btn waves-effect waves-light btn-primary" name="ApproveLn" value="<?php echo $_GET['tr_k'] ?>">Approve Loan</button>
                      </span> </div>

                                    <?php // echo $profile->optionLoan();  ?>



                                <?php   } elseif($profile->loanAccountStatus($_GET['tr_k'])==2){ ?>
                                    <center>

                                        <h1 class="font-light" style="color: green;">
                                            Awaiting  <br>Acceptance</h1></center>

                                <?php   } elseif($profile->loanAccountStatus($_GET['tr_k'])==3){ ?>
                                    <form method="post">
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label for="recipient-name" class="control-label">Authorization Code:</label>
                                                <input type="password" class="form-control" name="adminCode" >
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" value="<?php echo $_GET['tr_k']; ?>" name="approveLoan">Approve & Disburse Loan</button>
                                        </div>
                                    </form>

                                <?php } else{
                                    echo $profile->loanRepayStatus(); ?>
                                <?php } ?>

                        </div>


                    </div>
                </div>
            </div>

        <?php } ?> </form>

        <!----Authorization Modal--->
        <?php if(isset($_POST['tranchS'])){ ?>
            <div class="modal show" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel1">Payment Confirmation</h4> </div>
                        <form method="post">
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Authorization Code:</label>
                                    <input type="password" class="form-control" name="adminCode" >
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" value="<?php echo $_POST['tranchS']; ?>" name="payLoanAdmin">Approve Payment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>


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
