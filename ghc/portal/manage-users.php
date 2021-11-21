<?php
session_start(); ob_start();

include("library/connect.inc.php");
chkLogin();
if($profile->adminLevel() == FALSE){session_destroy(); header('location: ../'); }



$sql = $db->query("SELECT * FROM user ");
$all = mysqli_num_rows($sql);

if(array_key_exists('reset', $_POST)){unset($_SESSION['end']); }

$end = isset($_SESSION['end'])?$_SESSION['end']:50 ;

if(array_key_exists('prev', $_POST)){$_SESSION['end'] = $end-50; }
elseif(array_key_exists('next', $_POST)){if(!empty($_POST['page'])){if(((int)($all/50))<($_POST['page']-1)){$report='Specified page does not exist'; $count=1;}else{$_SESSION['end'] = $_POST['page']*50;}}else{$_SESSION['end'] = $end+50;} }

$end = isset($_SESSION['end'])?$_SESSION['end']:50 ;

$start = $end-49;
//$all = 0;
if($all<=$end){$end = $all;}

$showing = 'Showing '.$start.' to '.$end.' of '.$all.' Records';

if($start>1){$prev = TRUE;}else{$prev = FALSE;}
if($end<$all){$next = TRUE;}else{$next = FALSE;}




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
     <link rel="stylesheet" href="../plugins/components/dropify/dist/css/dropify.min.css">
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
 <?php //include ("aside.php"); ?>
        <!-- ===== Left-Sidebar-End ===== -->
        <!-- ===== Page-Content ===== -->
        <div class="page-wrapper">
         
   <?php if(isset($report)){echo $signup->Alert();} ?>

 
                       
<?php if(isset($_SESSION['searchid'])){ //echo $profile->userProfileDataWild(); }; 
echo $profile->userProfileDataSearch('data'); 
echo $profile->userProfileDataSearch('data2'); }?>
                   

            <div class="row">
                <div class="col-md-12 col-sm-12">
                   <!--  <div class="white-box stat-widget">
                        <form method="post" class="form-group">
                            <input type="text" placeholder="Search User..." name="user" class="form-control"/>
                            <center>
                                <button class="btn btn-default btn-sm" name="userSearch"><span class="glyphicon glyphicon-search"></span></button>
                                </center>
                        </form>
                    </div> -->
                </div>
            </div>

                         <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="white-box stat-widget">
                            <div class="row table-responsive">
                                <div class="col-md-12 col-sm-12">
                                    <h4 class="box-title text-center">REGISTERED USERS</h4>
                                </div>
                             
<table class="table table-sm table-hover table-responsive">
                                                        
                                                        <thead>
                                                            <tr>
                                                                
                                                                <th>SN</th>
                                                                <th>Name</th>
                                                                <th>Username</th>
                                                                <th>Email</th>
                                                                <th>Phone No</th>
                                                            </tr>
                                                        </thead>



                                            
                                    <tbody>
                                        <?php $i=$start; $start1=$start-1; $end1=$end-$start+1;  $sql = $db->query("SELECT * FROM user ORDER BY sn ASC LIMIT $start1, $end1 ");
                                        while($row = mysqli_fetch_assoc($sql)){  $e = $i++; 
                                            $user = $row['id'];
                                            if($row['status']==1){$st='used'; }else{$st='active';}
                                    echo '<tr>
                                      <td >'.$e.'</td>
                                      <td  >'.$row['firstname'].' '.$row['lastname'].'</td><form method="post">
                                      <td ><button value'.md5($row['sn']).'" name="userProfileDataSearch">'.$row['user'].'</button></td></form>
                                      <td >'.$row['email'].'</td>
                                      <td >'.$row['phone'].'</td>
                                    </tr>';
                                     }  ?>

                                </tbody>
                            </table>
                     
<form method="post">
  <input type="button" name="next" class="btn btn-info" value="<?php echo $showing; ?>" >
  
  <input type="<?php if($prev == TRUE){ echo 'submit'; }else{echo 'button';} ?>" name="prev" class="btn btn-primary" value="Previous">
<input type="text" name="page" placeholder="Page" class="btn"> 
  <input type="<?php if($next == TRUE){ echo 'submit'; }else{echo 'button';} ?>" name="next" class="btn btn-success" value="next">

   <input type="submit" name="reset" class="btn btn-warning" value="Reset"> 
   <a href="pin-mgt2.php" class="btn btn-default"> Print </a>

</form>
                                                                

                                                                              
                                                    
                                                    
                   <hr class="mt-0 mb-0">   

                              
                            </div>
                        </div>
                    </div>
                </div>


              
            
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
     <script src="../plugins/components/dropify/dist/js/dropify.min.js"></script>
     <script>
    $(function() {
        // Basic
        $('.dropify').dropify();
        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
            }
        });
        // Used events
        var drEvent = $('#input-file-events').dropify();
        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });
        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });
        drEvent.on('dropify.errors', function(event, element) {
            console.log('Has Errors');
        });
        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });
    </script>
   
    <!-- ===== Style Switcher JS ===== -->
    <script src="../plugins/components/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>
