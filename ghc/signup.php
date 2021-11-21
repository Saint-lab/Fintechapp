<?php
session_start(); ob_start();
include("portal/library/connect.inc.php");
//unset($_SESSION['signup']);
$signupx = isset($_SESSION['signup']) ? $_SESSION['signup'] : 1;

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
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png">
    <title>USER SIGNUP</title>
    <!-- ===== Bootstrap CSS ===== -->
    <link href="portal/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
     <link href="plugins/components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <!-- ===== Plugin CSS ===== -->
    <!-- ===== Animation CSS ===== -->
    <link href="portal/css/animate.css" rel="stylesheet">
    <!-- ===== Custom CSS ===== -->
    <link href="portal/css/style.css" rel="stylesheet">
    <!-- ===== Color CSS ===== -->
     <link rel="stylesheet" href="plugins/components/dropify/dist/css/dropify.min.css">
    <link href="portal/css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="mini-sidebar">
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <div id="wrapper">
        <!-- ===== Top-Navigation ===== -->
        <nav class="navbar navbar-default navbar-static-top m-b-0" style="background-color: green">
            <div class="navbar-header">
                <a class="navbar-toggle font-20 hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="top-left-part">
                    <a class="logo" href="portal/index.php">
                        <b>
                            <img src="plugins/images/logo.png" alt="home" />
                        </b>
                        <span>
                            GREATER HEIGHT
                        </span>
                    </a>
                </div>
                <ul class="nav navbar-top-links navbar-left hidden-xs">
                    <li>
                        <a href="javascript:void(0)" class="sidebartoggler font-20 waves-effect waves-light"><i class="icon-arrow-left-circle"></i></a>
                    </li>
                    <li>
                        <form role="search" class="app-search hidden-xs">
                            <font size="+2" color="#FFF"> User Registration</font>
                        </form>
                    </li>
                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">
                   
                    <li class="right-side-toggle">
                        <a class="right-side-toggler waves-effect waves-light b-r-0 font-20" href=".">
                             <font size="-1" color="white"> Login </font>
                        </a>
                    </li>

                    <li class="right-side-toggle">
                        <a class="right-side-toggler waves-effect waves-light b-r-0 font-20" href="?form=reset">
                             <font size="-1" color="white"> Reset </font>
                        </a>
                    </li>

                </ul>
            </div>
        </nav>
        <!-- ===== Top-Navigation-End ===== -->
        <!-- ===== Left-Sidebar ===== -->
        <aside class="sidebar" role="navigation">
            <div class="scroll-sidebar">
                <div class="user-profile">
                    <div class="dropdown user-pro-body">
                       
                        <p class="profile-text m-t-15 font-16"><a href="javascript:void(0);">Signup Navigation</a></p>
                    </div>
                </div>
                <nav class="sidebar-nav">
                    <ul id="side-menu">
                        
                         <li>
                            <a class="waves-effect" href="#login"><i class="icon-equalizer fa-fw"></i> <span class="hide-menu"> Create Login</span></a>
                           
                        </li>
                       
                        <li>
                            <a class="waves-effect" href="#register"><i class="icon-equalizer fa-fw"></i> <span class="hide-menu"> Registration</span></a>
                          
                        </li>

                        <li>
                            <a class="waves-effect" href="#login"><i class="icon-equalizer fa-fw"></i> <span class="hide-menu"> User Login</span></a>
                          
                        </li>
                        
                       
                    </ul>
                </nav>
               
            </div>
        </aside>
        <!-- ===== Left-Sidebar-End ===== -->
        <!-- Page Content -->
         <?php if(isset($report)){echo $signup->Alert(); } ?>
        <div class="page-wrapper">
          <!--  <div class="container-fluid">
                .row-->
              
                <!--./row-->





                
                
                
                
                
                
                
                
                
                
                <?php  if($signupx==1){ ?> 
                
                
                <!--.row-->
                <div class="row" id="login">
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading"> Create Login</div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    <form method="post" class="form-horizontal">
                                        <div class="form-body">
                                           
                                          <?php  if($signupx>1){ ?>
                                                <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Email: <?php echo $_SESSION['email'] ?></label>
                                                        <h3>Username: <?php echo $_SESSION['username'] ?></h3>
                                                </div>
                                                <!--/span-->
                                              
                                            </div>
                                         </div>
                                         
                                        
                                            <!--/row-->
                                           
                                        <div class="form-actions pull-right">
                                            <?php  if($signupx < 3){ ?>  <button type="submit" class="btn btn-primary" name="changeLogin"> <i class="fa fa-pencil" ></i> Change Login</button>  <?php } ?> 
                                           
                                        </div> </div>
                                                <?php }else{ ?>

                                            <div class="row">
                                                <div class="col-md-6 ">
                                                    <div class="form-group">
                                                        <label>E-mail</label>
                                                        <input type="email" required name="email" class="form-control"> </div>
                                                </div>
                                            
                                                <div class="col-md-6 ">
                                                    <div class="form-group">
                                                        <label>Phone Number</label>
                                                        <input type="text" required name="username" class="form-control"> </div>
                                                </div>
                                            </div>

                                            <!--/row-->



                                             <div class="row">
                                                <div class="col-md-6 ">
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input type="password" class="form-control" name="passw" required> </div>
                                                </div>
                                            
                                                <div class="col-md-6 ">
                                                    <div class="form-group">
                                                        <label>Confirm Password</label>
                                                        <input type="password" class="form-control" name="passw2" required> </div>
                                                </div>
                                            </div>


                                           
                                            <!--/row-->
                                        </div>
                                        <div class="form-actions pull-right">
                                           
                                                   
                                                            <button type="submit" class="btn btn-success" name="signupUserIni">Create Login</button>
                                                           
                                                      
                                             
                                        </div>

                                    <?php } ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--./row-->





                  <?php } elseif ($signupx==2) {
                  
                  ?>
                
                
                
                
                
                
                
                <!--.row-->
                <div class="row" id="register">
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading"> User Registration</div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="form-body">
                                            <h3 class="box-title">Personal Information</h3>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Surname</label>
                                                        <input type="text" id="firstName" name="firstname" class="form-control" placeholder="" required> </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Other Names</label>
                                                        <input type="text" id="lastName" name="lastname" class="form-control" placeholder="" required> </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                            <div class="row">
                                                 <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Date of Birth</label>
                                                        <input type="date" id="datepicker-autoclose" class="form-control mydatepicker" placeholder="dd/mm/yyyy" name="dob" required> </div>
                                                </div>
                                                <!--/span-->

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Gender</label>
                                                        <div class="radio-list">
                                                            <label class="radio-inline p-0">
                                                                <div class="radio radio-info">
                                                                    <input type="radio" name="sex" id="radio1" value="Male" required>
                                                                    <label for="radio1">Male</label>
                                                                </div>
                                                            </label>
                                                            <label class="radio-inline">
                                                                <div class="radio radio-info">
                                                                    <input type="radio" name="sex" id="radio2" value="Female">
                                                                    <label for="radio2">Female </label>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div></div>

                                                   
                                                <div class="col-md-12 ">
                                                    <div class="form-group">
                                                        <label>Phone Number</label>
                                                        <input type="text" class="form-control" name="phone" required> </div>
                                                </div>
                                            
                                                
                                               
                                            </div>
                                            <!--/row-->
                                         
                                            <h3 class="box-title m-t-40">Address</h3>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12 ">
                                                    <div class="form-group">
                                                        <label>Residential Address</label>
                                                        <input type="text" class="form-control" name="address" required> </div>
                                                </div>
                                            </div>

                                             <div class="row">
                                                <div class="col-md-12 ">
                                                    <div class="form-group">
                                                        <label>Office Address</label>
                                                        <input type="text" class="form-control" name="officeaddress"> </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>City</label>
                                                        <input type="text" class="form-control" name="city" required> </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>State</label>
                                                        <select class="form-control"  name="state" required>
                                                            <option value="">--Select state of residence--</option>
                                                            <option>Abia</option><option>
Adamawa</option><option>
Akwa-Ibom</option><option>
Anambra</option><option>
Bauchi</option><option>
Bayelsa</option><option>
Benue</option><option>
Borno</option><option>
Cross River</option><option>
Delta</option><option>
Ebonyi</option><option>
Edo</option><option>
Ekiti</option><option>
Enugu</option><option>
FCT</option><option>
Gombe</option><option>
Imo</option><option>
Jigawa</option><option>
Kaduna</option><option>
Kano</option><option>
Katsina</option><option>
Kebbi</option><option>
Kogi</option><option>
Kwara</option><option>
Lagos</option><option>
Nasarawa</option><option>
Niger</option><option>
Ogun</option><option>
Ondo</option><option>
Osun</option><option>
Oyo</option><option>
Plateau</option><option>
Rivers</option><option>
Sokoto</option><option>
Taraba</option><option>
Yobe</option><option>
Zamfara</option><option>
Outside Nigeria</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
 

   <h3 class="box-title m-t-40">Bank Account</h3>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6 ">
                                                    <div class="form-group">
                                                        <label>Name of Bank</label>
                                                        <input type="text" class="form-control" name="bank" required> </div>
                                                </div>

                                                <div class="col-md-6 ">
                                                    <div class="form-group">
                                                        <label>Account Name</label>
                                                        <input type="text" class="form-control" name="accname" required> </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                            
                                                <div class="col-md-6 ">
                                                    <div class="form-group">
                                                        <label>BVN</label>
                                                        <input type="text" class="form-control" name="bvn" required> </div>
                                                </div>
                                            
                                                <div class="col-md-6 ">
                                                    <div class="form-group">
                                                        <label>Account Number</label>
                                                        <input type="text" class="form-control" name="accountno" required> </div>
                                                </div>
                                            </div>
                                         
                                        </div>
                                        <div class="form-actions pull-right">
                                            <button type="submit" class="btn btn-success" name="updateSignup"> <i class="fa fa-check"></i> Submit Registration</button>
                                            
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--./row-->
                


                 <?php } elseif ($signupx==3) {
                  
                  ?>   

<div class="row" id="register">
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading"> Upload Photograph</div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="form-body">


<div class="row">
                    <div class="col-sm-6 ol-md-6 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">Passport Size Photograph</h3>
                            <label for="input-file-max-fs">Maximum Size is 200kb</label>
                            <input type="file" name="image" id="input-file-max-fs" class="dropify" data-max-file-size="200K" /> </div>
                    </div>
                </div>
                                         
                                        </div>
                                        <div class="form-actions pull-right">
                                            <button type="submit" class="btn btn-success" name="updateSignupPhoto"> <i class="fa fa-check"></i> Upload Photograph</button>
                                            
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--./row-->
                
           
                <?php } elseif($signupx==4){ ?> 


                   <!--.row-->
                <div class="row" id="payment">
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading"> Final Step</div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                   
                                        <div class="form-body">
                                           
<center>

<h1 class="font-light" style="color: green;"> <i class="fa fa-check"></i> <br>Registration <br>Successful</h1>

<br><br>

<form method="post">
    <button type="submit" name="LoginCont" class="btn btn-success">Login to Continue</button>
</form>
</center>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

     <?php } ?>

                
                
                
                
                
                
                                <!--./row-->
              
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
              



                <!--.row-->
              
                <!--./row-->
              

           </div>
            <!-- /.container-fluid -->
            <footer class="footer btn-primary" style="color:white;">
                Copyright © 2019 Greater Height
            </footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="plugins/components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="portal/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="portal/js/sidebarmenu.js"></script>
    <!--slimscroll JavaScript -->
    <script src="plugins/components/moment/moment.js"></script>
    <script src="portal/js/jquery.slimscroll.js"></script>
       <script src="plugins/components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!--Wave Effects -->
    <script src="portal/js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="portal/js/custom.js"></script>
    <script src="portal/js/jasny-bootstrap.js"></script>
    <!--Style Switcher -->

 <script src="plugins/components/dropify/dist/js/dropify.min.js"></script>
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
    <script src="plugins/components/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>
