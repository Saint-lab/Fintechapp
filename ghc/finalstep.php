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
        <?php if(isset($report)){echo $signup->Alert(); } ?>

<h5 class="m-t-30">Update Profile Photo</h5>
                                    <hr>
                                    <form method="post"  enctype="multipart/form-data">
                                    <div class="row">
                    <div class="col-sm-6 ol-md-6 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">Staff ID Card</h3>
                            <label for="input-file-max-fs">Maximum Size is 1kb</label>
                            <input type="file" name="image" id="input-file-max-fs" class="dropify" data-max-file-size="1K" required /> </div>
                    </div>
                </div>
                 <div class="form-group">
                                            <div class="col-sm-12">
                                                <button class="btn btn-success" name="uploaduseridcard">Update Photograph</button>
                                            </div>
                                        </div>


                                </div>
                                </form>
<!-- global $db,$report,$userKey; 

      $name = isset($_FILES['image']) ? $this->userName('user').$_FILES['image']['name'] : 'user.png';
      define('upload', 'photo/');
     $success = move_uploaded_file($_FILES['image']['tmp_name'], upload.$name);

$sqlw = $db->query("UPDATE user SET photo = '$name' WHERE id = '$userKey' ");
$report = 'User Profile Photo Successfully Update!';
return;
 -->

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
