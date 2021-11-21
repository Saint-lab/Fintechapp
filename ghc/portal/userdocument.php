<?php
session_start(); ob_start();

include("library/connect.inc.php");
chkLogin();
$sql = $db->query("SELECT * FROM user2");
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
                            <h3 class="box-title m-b-0">User Loan Data</h3>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Next of Kin</th>
                                            <th>Relationship</th>
                                            <th>Employment Category</th>
                                            <th>Office Address</th>
                                            <th>Position</th>
                                            <th>Level</th>
                                            <th>Income</th>
                                            <th>Identification</th>
                                            <th class="text-nowrap">Documents</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php while($row = $sql->fetch_assoc()) { $sn = $row['sn']; $type=''; $type='';
cate = $row['ecategory'];$cate = $row['ecategory']; $ident=''; $id=$row['identification'];
                                   $table=''; $id1 = $row['userid'];

                                     $table.='<tr>
                                            <td>'.$profile->userName1($id1).'</td>
                                            <td>'
                                                .$profile->userName2($sn,'kname').'
                                            </td>
                                            <td>'
                                            .$profile->userName2($sn,'krelation').'</td>
                                            <td>';
                                            if($cate==1){$type='Full Staff';}elseif ($cate==2) {
                                            $type='Contract Staff';}elseif ($cate==3) {
                                            $type='Outsource Staff';}elseif ($cate==4) {
                                            $type='Public Servant';}elseif ($cate==5) {
                                            $type='Self Employed';}
                                       $table.= $type.'</td>
                                            <td>'.$profile->userName2($sn,'eaddress').'</td>
                                            <td>'.$profile->userName2($sn,'position').'</td>
                                            <td>'.$profile->userName2($sn,'level').'</td>
                                            <td>'.number_format($profile->userName2($sn,'income')).'</td>
                                            <td>';
                                            if($id==1){$ident='National Drivers licsence';}elseif ($id==2) {
                                            $ident='International passport';}elseif ($id==3) {
                                            $ident='Voters card';}elseif ($id==4) {
                                            $ident='National iod card';}  
                                        $table.= $ident.'</td>
                                            <td class="text-nowrap">
                                               <button class="btn btn-primary" data-toggle="modal" data-target="#showdocument'.$sn.'" >Check</button>
                                            </td>
                                        </tr>';

                                     $table.= '<div class="modal fade" id="showdocument'.$sn.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="exampleModalLabel1">User Documnet</h4> </div>
                                        <?php   ?>
                                            <div class="modal-body">
                                            <div>
                                            <span>Staff ID</span><hr>
                                            <img src="photo/document/'.$profile->userName2($sn,'staffid').'" width="50%"> </div>
                            				<br><div>
                                            <span>Bills</span><hr><br>
                                            <img src="photo/document/'.$profile->userName2($sn,'bill').'" width="50%"></div><br>
                                            <div><span>Account Statement</span><hr><br><form method="post">
                                            <input type="hidden" value="'.$sn.'" name="sn">
                                            <button class="btn btn-inline btn-primary" name="DownloadStatement">Download Statement</button></form></div><br>
                                            <div><span>Employment Letter</span><hr><br>
                                           <form method="post">
                                            <input type="hidden" value="'.$sn.'" name="sn">
                                            <button class="btn btn-inline btn-primary" name="Downloadletter">Download Statement</button></form></div><br>
                                            <div><span>Cheque</span><hr><br>
                                            <img src="photo/document/'.$profile->userName2($sn,'cheque').'" width="50%"></div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            
                                        </div>
                                
                                    </div>
                                </div>
                            </div>';
               

                            	echo $table;
                                       } 
                                        ?>
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