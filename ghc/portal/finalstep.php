<?php
session_start(); ob_start();

include("library/connect.inc.php");
chkLogin();
if(isset($_SESSION['firststep'])){$report = $_SESSION['firststep'];}  
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
    <title>User Profile</title>
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
            <div class="row" style="margin:-40px, 0px, 0px -40px">
                    <div class="col-md-9 pull-right">
                        <div class="panel panel-info">
                            <div class="panel-heading">LOAN REGISTRATION PAGE, FINAL STEP</div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                <h5 class="box-title">Staff ID Card</h5>
                                    <hr>
                        <form method="post"  enctype="multipart/form-data">
                                    <div class="row">
                             <div class="col-sm-6 ol-md-6 col-xs-12">
                            <div class="white-box">
                            <h3 class="m-t-30">ID Card</h3> 
                            <label for="input-file-max-fs">Maximum Size is 2kb</label>
                            <input type="file" name="staffid" id="input-file-max-fs" class="dropify" data-max-file-size="2M" required class="form-control"/> </div>
                    </div>
                </div>

                <h5 class="box-title">Utility Bill</h5>
                                    <hr>
                                    
                                    <div class="row">
                             <div class="col-sm-6 ol-md-6 col-xs-12">
                            <div class="white-box">
                            <h3 class="m-t-30">(PHCN bill or water rate) issued within 3months</h3>
                            <label for="input-file-max-fs">Maximum Size is 2kb</label>
                            <input type="file" name="bill" id="input-file-max-fs" class="dropify" data-max-file-size="2M" required class="form-control"/> </div>
                    </div>
                </div>
                  <h5 class="m-t-30">Statement of Account</h5>
                                    <hr>
                                   
                                    <div class="row">
                             <div class="col-sm-6 ol-md-6 col-xs-12">
                            <div class="white-box">
                            <h3 class="box-title">6months salary account statement</h3>
                            <label for="input-file-max-fs">Maximum Size is 20kb</label>
                            <input type="file" name="statement" id="input-file-max-fs" class="dropify" data-max-file-size="2M" required class="form-control"/> </div>
                    </div>
                </div>
                       <h5 class="m-t-30">Employment Letter </h5>
                                    <hr>
                                    
                                    <div class="row">
                             <div class="col-sm-6 ol-md-6 col-xs-12">
                            <div class="white-box">
                            <h3 class="box-title"></h3>
                            <label for="input-file-max-fs">Maximum Size is 2kb</label>
                            <input type="file" name="letter" id="input-file-max-fs" class="dropify" data-max-file-size="2M" required class="form-control"/> </div>
                    </div>
                </div>
                        <h5 class="m-t-30">Pre Signed Cheque </h5>
                                    <hr>
                                   
                                    <div class="row">
                             <div class="col-sm-6 ol-md-6 col-xs-12">
                            <div class="white-box">
                            <h3 class="box-title">no name no date just signed</h3>
                            <label for="input-file-max-fs">Maximum Size is 1kb</label>
                            <input type="file" name="cheque" id="input-file-max-fs" class="dropify" data-max-file-size="2M" required class="form-control" /> </div>
                    </div>
                </div>            <div class="form-group">
                                            <div class="col-sm-12">
                                                <button class="btn btn-success" name="uploaduserdocument">Upload Document</button>
                                            </div>
                                        </div>


                                </div>
                    </form>
                                </div></div></div></div></div></div>
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
    <!-- jQuery file upload -->
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
    <!--Style Switcher -->
    <script src="../plugins/components/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>
