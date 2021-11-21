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
    <!-- ===== Animation CSS ===== -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- ===== Custom CSS ===== -->
    <link href="css/style.css" rel="stylesheet">
    <!-- ===== Color CSS ===== -->
    <link href="css/colors/default.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<?php include ("topnav.php"); ?>
        <!-- ===== Top-Navigation-End ===== -->
        <!-- ===== Left-Sidebar ===== -->
 <?php include ("aside.php"); ?> 
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <div id="wrapper">
        <!-- ===== Top-Navigation ===== -->
        
        <?php if(isset($report)){echo $signup->Alert();} ?>
                <!--./row-->
                <!--.row-->
                 <div class="row" style="margin:-20px, 0px, 0px -20px">
                    <div class="col-md-9 pull-right">
                        <div class="panel panel-info">
                            <div class="panel-heading">LOAN REGISTRATION PAGE</div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    <form method="post">
                                        <div class="form-body">
                                            <h3 class="box-title">Person Info</h3>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">State of Origin</label>
                                                        <input type="text" id="state" class="form-control" placeholder="Abia" name="state" required>  </div>
                                                </div>
                                               <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Marital Status </label>
                                                        <div class="radio-list">
                                                            <label class="radio-inline p-0">
                                                                <div class="radio radio-info">
                                                                    <input type="radio" name="radio" id="radio1" value="1" required>
                                                                    <label for="radio1">Single</label>
                                                                </div>
                                                            </label>
                                                            <label class="radio-inline">
                                                                <div class="radio radio-info">
                                                                    <input type="radio" name="radio" id="radio2" value="2" required>
                                                                    <label for="radio2">Married</label>
                                                                </div>
                                                            </label>
                                                            <label class="radio-inline">
                                                                <div class="radio radio-info">
                                                                    <input type="radio" name="radio" id="radio2" value="3" required>
                                                                    <label for="radio2">divorced</label>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                         
                                            <h3 class="box-title m-t-40">Next of Kin Details</h3>
                                            <hr>
                                           <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input type="text" class="form-control" name="kname" required> </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Phone No</label>
                                                        <input type="tel" class="form-control" name="kphone" required> </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Residential Address</label>
                                                        <input type="address" class="form-control" name="kaddress" required> </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Email  Address </label>
                                                        <input type="email" class="form-control" name="kemail" required> </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Relationship with next of Kin</label>
                                                        <input type="text" class="form-control" name="krelation" required> </div>
                                                </div>
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Place of Birth</label>
                                                        <input type="text" class="form-control" name="pob" required> </div>
                                                </div>
                                                <!--/span-->
                                            
                                                <!--/span-->
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Local Government Origin</label>
                                                        <input type="text" class="form-control" name="lgv" required> </div>
                                                </div>
                                             </div>
                                              <h3 class="box-title m-t-40">Employment Status</h3>
                                            <hr>
                                           <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Employment Category</label>
                                                        <select class="form-control" name="employ-cate" required>
                                                            <option>--Select Option--</option>
                                                            <option value="1">Full Staff</option>
                                                            <option value="2">Contract Staff</option>
                                                            <option value="3">Outsource Staff</option>
                                                             <option value="4">Public Servant</option>
                                                            <option value="5">Self Employed</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Date Employed</label>
                                                        <input type="date" class="form-control" name="employ-date" required> </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                             <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Position / Job Title</label>
                                                        <input type="text" class="form-control" name="position" required> </div>
                                                </div>
                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Department / Unit</label>
                                                        <input type="text" class="form-control" name="department" required> </div>
                                                </div>
                                             </div>
                                               <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Grade Level</label>
                                                        <input type="text" class="form-control" name="level" required> </div>
                                                </div>
                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Current net monthly Income</label>
                                                        <input type="number" class="form-control" name="income" required> </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Employers Name</label>
                                                        <input type="text" class="form-control" name="employ-name" required> </div>
                                                </div>
                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Employers Address</label>
                                                        <input type="tel" class="form-control" name="employ-address" required> </div>
                                                </div>
                                             </div>
                                              <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Office Mobile Number</label>
                                                        <input type="tel" class="form-control" name="office-num" required> </div>
                                                </div>
                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Valid means of Identification</label>
                                                        <select class="form-control" name="identification" required>
                                                            <option>--Select Option--</option>
                                                            <option value="1">National Drivers licsence</option>
                                                            <option value="2">International passport</option>
                                                            <option value="3">Voters card</option>
                                                             <option value="4">National iod card</option>
                                                         </select>
                                                    </div>
                                                </div>
                                             </div>
                                            <h3 class="box-title m-t-40">Disbursement Details</h3>
                                            <hr>
                                            <span class="help-block"> if your application is successful which bank account will you like to receive your loan? </span><br>
                                              <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Account Name</label>
                                                        <input type="text" class="form-control" name="acct-name" required> </div>
                                                </div>
                                                  <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Account Number</label>
                                                        <input type="number" class="form-control" name="acct-no" required> </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Bank Name</label>
                                                        <input type="text" class="form-control" name="bank-name" required> </div>
                                                </div>
                                             </div>


                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-success" name="accessloandata"> <i class="fa fa-check"></i> Save</button>
                                           
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--./row-->
                <!--.row-->
               
            <!-- /.container-fluid -->
            <footer class="footer t-a-c">
                © 2019 Greater Height
            </footer>
        </div>
        <!-- /#page-wrapper -->
    
    <!-- /#wrapper -->
    <!-- jQuery -->
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
    <script src="js/jasny-bootstrap.js"></script>
    <!--Style Switcher -->
    <script src="../plugins/components/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>
