<?php
session_start(); ob_start();

include("library/connect.inc.php");
chkLogin();
if(isset($_GET['messages'])){
     $msgId= $_GET['messages'];
     $_SESSION['msgid']=$_GET['messages'];
    
}
else{ $msgId = $_SESSION['msgid'];}
$page=1;
if(isset($_GET['page'])){$page = $_GET['page'];}else{$page=1;}

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
         <?php if(isset($report)){echo $signup->Alert(); } ?>
         <div class="page-wrapper">
            <div class="container-fluid">
 <!-- row -->
 <div class="row">
                    <!-- Left sidebar -->
                    <div class="col-md-12">
                        <div class="white-box">
                            <div class="row">
                                <div class="col-lg-2 col-md-3  col-sm-4 col-xs-12 inbox-panel">
                                    <div> <a href="chatting.php?message=<?php echo $msgId; ?>" class="btn btn-custom btn-block waves-effect waves-light">Refresh Page</a>
                                        <div class="list-group mail-list m-t-30"> <a href="index.php?unread=<?php echo $msgId; ?>" class="list-group-item active">Mark as Unread <span class="fa fa-envelope"></span></a> <a href="chatting.php?deleteSel=<?php echo $msgId.'&page='.$page; ?>" class="list-group-item ">Delete Selected</a> <a href="#" class="list-group-item">Draft <span class="label label-rouded label-warning pull-right">15</span></a> <a href="#" class="list-group-item">Sent Mail</a> <a href="#" class="list-group-item">Trash <span class="label label-rouded label-danger pull-right">55</span></a> </div>
                                        <h3 class="panel-title m-t-40 m-b-0">Labels</h3>
                                        <hr class="m-t-5">
                                        <div class="list-group b-0 mail-list"> <a href="#" class="list-group-item"><span class="fa fa-circle text-info m-r-10"></span>Work</a> <a href="#" class="list-group-item"><span class="fa fa-circle text-warning m-r-10"></span>Family</a> <a href="#" class="list-group-item"><span class="fa fa-circle text-purple m-r-10"></span>Private</a> <a href="#" class="list-group-item"><span class="fa fa-circle text-danger m-r-10"></span>Friends</a> <a href="#" class="list-group-item"><span class="fa fa-circle text-success m-r-10"></span>Corporate</a> </div>
                                    </div>
                                </div>
                                <?php  global $db;
                               
                                $sql= $db->query("SELECT * FROM msg WHERE sha1(sn) = '$msgId'");
                                $row = $row = $sql->fetch_assoc();
                                $recKey = $row['rec']; 
                                $senderKey = $row['sender'];
                                $db->query("UPDATE msg SET active = 2 WHERE sender = '$senderKey'");
                                   ?>
                                <div class="col-lg-6 col-md-6 col-sm-5 col-xs-8 mail_listing">
                                    <div class="media m-b-20 p-t-10">
                                        
                                        <a class="pull-left" href="#"> <img class="media-object thumb-sm img-circle" src="<?php echo userPhoto($row['sender']);?>" alt=""> </a>
                                        <div class="media-body"> 
                                            <h4 class="text-danger m-0"><?php echo userName($row['sender']);?> </div>
                                    </div>
                                    <?php global $db; $cuId = $_SESSION['user_id'];
                                    $sq = $db->query("SELECT * FROM msg WHERE sender = '$senderKey' AND rec = '$recKey' OR sender = '$cuId' AND rec = '$senderKey' LIMIT 1000");
                                    $totalMsg = mysqli_num_rows($sq); 
                                    $num_per_page = 15; 
                                    $totalPage = ceil($totalMsg/$num_per_page);
                                    $offset = ($totalPage-$page)*$num_per_page;  
                                    $query = $db->query("SELECT * FROM msg WHERE sender = '$senderKey' AND rec = '$recKey' OR sender = '$cuId' AND rec = '$senderKey' AND deleted = 0 LIMIT $offset, $num_per_page");
                                   ?>
                                   <div class="col-md-8 pull-left" style="color:blue;padding:5px;margin-top:10px;">
                                   <span class="<?php if($page>=$totalPage){echo 'disabled';}  ?>"><strong>
                                   <a href="<?php if($page >=$totalPage){echo '#';}else{echo 'chatting.php?message='.$msgId.'&page='.($page+1);} ?>">
                                   <?php if($page == $totalPage){echo '';}else{echo 'View Previous Messages';}  ?> </a></strong></span>
                                   </div>
                                   <?php
                                    while($chat = $query->fetch_assoc()):
                                    if(isset($_GET['deleteSel']) && isset($_GET['page'])):
                                    if($senderKey == $chat['sender']): ?>
                                    <form method="post">
                                    <div class="col-md-8">
                                    <h6 style="background:#e8ecf0;margin-bottom:10px;padding:2px;float:left;color#111">
                                    <?php echo $chat['msg'];?>  <small class="text-muted" style="color:#6c92c5"> <?php echo date('h:i A', $chat['ctime']);?></small>
                                </h6><div class="checkbox m-t-0 m-b-0" style="padding:9px;">
                                                                <input type="checkbox"  name="selector[]" value="<?php echo $chat['sn']; ?>">
                                                                <label for="ch1"></label>
                                                            </div>
                                </div>
                            <?php endif;  if($chat['sender'] == $cuId):?>
                                <div class="col-md-8 pull-right">
                                <h6 style="background:#a7cf90;padding:3px;float:right;color:#464c42;margin-bottom:10px">
                                <?php echo $chat['msg'];?>  
                                <small class="text-muted" style="color:#6c92c5"> <?php echo date('h:i A', $chat['ctime']);?></small></h6>
                                <div class="checkbox m-t-0 m-b-0" style="padding:9px;">
                                                                <input type="checkbox"  name="selector[]" value="<?php echo $chat['sn']; ?>">
                                                                <label for="ch1"></label>
                                                            </div>
                                </div>
                                
                                    <?php endif; else:
                                    if($senderKey == $chat['sender']): ?>
                                    <div class="col-md-8">
                                    <h6 style="background:#e8ecf0;margin-bottom:10px;padding:2px;float:left;color#111">
                                    <?php echo $chat['msg'];?>  <small class="text-muted" style="color:#6c92c5"> <?php echo date('h:i A', $chat['ctime']);?></small>
                                </h6>
                                </div>
                            <?php endif;  if($chat['sender'] == $cuId): ?>
                                <div class="col-md-8 pull-right">
                                <h6 style="background:#a7cf90;padding:3px;float:right;color:#464c42;margin-bottom:10px">
                                <?php echo $chat['msg'];  ?>  
                                <small class="text-muted" style="color:#6c92c5"> <?php echo date('h:i A', $chat['ctime']);?></small></h6>
                                </div>

                                <?php endif; endif; endwhile;?>
                                    <div class="col-md-8 pull-left" style="color:blue;padding:25px 10px 10px 5px;margin-top:-20px;">
                                   <span class="<?php if($page<=1){echo 'disabled';}  ?>"><strong>
                                   <a href="<?php if($page <=1){echo '#';}else{echo 'chatting.php?message='.$msgId.'&page='.($page-1);} ?>">
                                   <?php if($page == 1){echo '';}else{echo 'View Newer Messages';}  ?> </a></strong></span>
                                   </div>
                                    <?php if(isset($_GET['deleteSel'])) :?>
                                    <div class="col-md-3">
                                   <button class="btn btn-danger" name="deleteSelected">Delete</button></div></form><?php endif; ?>
                                    
                                    <div><form method="post">
                                    <input type="hidden" name="recKey" value="<?php echo $senderKey;?>" />
                                    <input type="hidden" name="recId" value="<?php echo $msgId;?>" />
                                        <textarea class="b-all p-20" style="width:100%;" placeholder="type here.." name="chatMessage"></textarea>
                                       <button class="btn btn-primary" style="float:right" name="chattingBtn">Send</button></form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>





            <?php include("footer.php"); ?>
        </div>
        <!-- ===== Page-Content-End ===== -->
    </div>

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
    <!--Style Switcher -->
    <script src="../plugins/components/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>