<?php
session_start(); ob_start();

include("library/connect.inc.php");
chkLogin();
$sql = $db->query("SELECT * FROM user2");
$row = mysqli_fetch_assoc($sql);
$usid = $row['userid'];
$id = $row['identification'];
$type=''; $mar=''; $a = $row['marital'];
$cate = $row['ecategory']; $ident='';
if($cate==1){$type='Full Staff';}elseif ($cate==2) {
$type='Contract Staff';}elseif ($cate==3) {
$type='Outsource Staff';}elseif ($cate==4) {
$type='Public Servant';}elseif ($cate==5) {
$type='Self Employed';}

if($id==1){$ident='National Drivers licsence';}elseif ($id==2) {
$ident='International passport';}elseif ($id==3) {
$ident='Voters card';}elseif ($id==4) {
$ident='National iod card';}

if($a==1){$mar='Single';}elseif ($a==2) {
$mar='Married';}elseif ($a==3) {
$mar='divorced';}
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
    <title>Cubic Admin Template</title>
    <!-- ===== Bootstrap CSS ===== -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- ===== Plugin CSS ===== -->
    <!-- ===== Animation CSS ===== -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- ===== Custom CSS ===== -->
    <link href="css/style.css" rel="stylesheet">
    <!-- ===== Color CSS ===== -->
    <link href="css/colors/default.css" id="theme" rel="stylesheet">
    
</head>
<?php include ("topnav.php"); ?>
        <!-- ===== Top-Navigation-End ===== -->
        <!-- ===== Left-Sidebar ===== -->
 <?php include ("aside.php"); ?> 
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
     <?php if(isset($report)){echo $signup->Alert(); } ?>
    <div id="wrapper">
 <div class="row">
                    <div class="col-sm-10" style="margin-left:250px;">
                        <div class="white-box">
                            <h3 class="box-title m-b-0"></h3>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                      <h3>  Personal Information</h3>
                                    </thead>
                                    <tbody>
                                    <tr><td><b>Name</b><br><br><?php echo $profile->userName1($usid);?></td>
                                    <td><b>Phone No</b><br><br><?php echo $profile->userName1($usid,'phone');?></td>
                                    <td><b>Email</b><br><br><?php echo $profile->userName1($usid,'email');?></td>
                                    <td><b>Residesial Address</b><br><br><?php echo $profile->userName1($usid,'address');?></td>
                                    <td><b>Date of Birth</b><br><br><?php echo $profile->userName1($usid,'dob');?></td>
                                   </tr>
                                   <tr><td><b>Place of Birth</b><br><br><?php echo $profile->userName2($usid,'pob');?></td>
                                    <td><b>Marital Status</b><br><br><?php echo $mar;?></td>
                                    <td><b>State of Origin</b><br><br><?php echo $profile->userName2($usid,'state');?></td>
                                    <td><b>LGA of Origin</b><br><br><?php echo $profile->userName2($usid,'lg');?></td>
                                    <td><b>Picture</b><br><br><img src="photo/<?php echo $profile->userName1($usid,'photo');?>" height="40px"></td>
                                   </tr>
                                    </tbody>
                                    <table class="table table-bordered">
                                    <thead>
                                      <h3>  Employment Information</h3>
                                    </thead>
                                    <tbody>
                                    <tr><td><b>Employment Category</b><br><br><?php echo $type;?></td>
                                    <td><b>Date of Employment</b><br><br><?php echo $profile->userName2($usid,'edate');?></td>
                                    <td><b>Position/Job Title</b><br><br><?php echo $profile->userName2($usid,'position');?></td>
                                    <td><b>Department</b><br><br><?php echo $profile->userName2($usid,'department');?></td>
                                    <td><b>Grade/Level</b><br><br><?php echo $profile->userName2($usid,'level');?></td>
                                   </tr>
                                   <tr><td><b>Net Monthly Income</b><br><br><?php echo number_format($profile->userName2($usid,'income'));?></td>
                                    <td><b>Employers Name</b><br><br><?php echo $profile->userName2($usid,'ename');?></td>
                                    <td><b>Employer Address</b><br><br><?php echo $profile->userName2($usid,'eaddress');?></td>
                                    <td><b>Office Mobile Number</b><br><br><?php echo $profile->userName2($usid,'omn');?></td>
                                    <td><b>Valid means of Identification</b><br><br><?php echo $ident;?></td>
                                   </tr>
                                    </tbody>
                                </table>

                                <table class="table table-bordered">
                                    <thead>
                                      <h3>  Nest of Kin Information</h3>
                                    </thead>
                                    <tbody>
                                    <tr><td><b>Name</b><br><br><?php echo $profile->userName2($usid,'kname');?></td>
                                    <td><b>Phone No</b><br><br><?php echo $profile->userName2($usid,'kphone');?></td>
                                    <td><b>Residensial Address</b><br><br><?php echo $profile->userName2($usid,'kaddress');?></td>
                                    <td><b>Email Address</b><br><br><?php echo $profile->userName2($usid,'kemail');?></td>
                                    <td><b>Relatioship</b><br><br><?php echo $profile->userName2($usid,'krelation');?></td>
                                   </tr>
                                   
                                    </tbody>
                                </table>
                                <table class="table table-bordered">
                                    <thead>
                                      <h3>  Disbursement Account Details</h3>
                                    </thead>
                                    <tbody>
                                    <tr><td><b>Account Name</b><br><br><?php echo $profile->userName2($usid,'acctname');?></td>
                                    <td><b>Phone No</b><br><br><?php echo $profile->userName2($usid,'kphone');?></td>
                                    <td><b>Account Number</b><br><br><?php echo $profile->userName2($usid,'acctnum');?></td>
                                    <td><b>BVN</b><br><br><?php echo $profile->userName1($usid,'bvn');?></td>
                                    <td><b>Bank Name</b><br><br><?php echo $profile->userName2($usid,'bankname');?></td>
                                   </tr>
                                   
                                    </tbody>
                                </table><br>
                                <table class="table table-bordered">
                                    <thead>
                                      <h3>  UPLOADED DOCUMENT</h3>
                                    </thead>
                                    <tbody>
                                    <tr><td><b>Staff ID</b><br><img src="photo/document/<?php echo $profile->userName2($usid,'staffid');?>" width="300px"><br>
                                    </td></tr>
                                    <tr><td><b>Utility Bill<br></b><img src="photo/document/<?php echo $profile->userName2($usid,'bill');?>" width="300px"><br>
                                    </td></tr>
                                     <tr><td><b>Account Statement<br></b><img src="photo/document/<?php echo $profile->userName2($usid,'statement');?>" width="300px"><br>
                                    </td></tr>
                                     <tr><td><b>Employment Letter<br></b><img src="photo/document/<?php echo $profile->userName2($usid,'letter');?>" width="300px"><br>
                                    </td></tr>
                                     <tr><td><b>Cheque</b><br><img src="photo/document/<?php echo $profile->userName2($usid,'cheque');?>" width="300px"><br>
                                    </td></tr>
                                    <tr><td><b>Staff ID 2</b><br><img src="photo/document/<?php echo $profile->userName2($usid,'cheque');?>" width="300px"><br>
                                    </td></tr>
                                    <tr><td><b>Utility Bill 2</b><br><img src="photo/document/<?php echo $profile->userName2($usid,'cheque');?>" width="300px"><br>
                                    </td></tr>
                                    <tr><td><b>Account Statement 2</b><br><img src="photo/document/<?php echo $profile->userName2($usid,'cheque');?>" width="300px"><br>
                                    </td></tr>
                                    <tr><td><b>Employment Letter 2</b><br><img src="photo/document/<?php echo $profile->userName2($usid,'cheque');?>" width="300px"><br>
                                    </td></tr>
                                    <tr><td><b>Cheque 2</b><br><img src="photo/document/<?php echo $profile->userName2($usid,'cheque');?>" width="300px"><br>
                                    </td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                </div>












                

                 <?php include("footer.php"); ?>
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
   <script src="../plugins/components/dropify/dist/js/dropify.min.js"></script>
</body>

</html>