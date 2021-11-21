<?php
//session_start(); ob_start();

//include("library/connect.inc.php");

?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">
    <title> Network Tree</title>
    <link rel="stylesheet" href="treant/Treant.css">
    <link rel="stylesheet" href="treant/examples/tree/basic-example.css">
    
</head>
<body>
    <div class="chart" id="basic-example"></div>
    <script src="treant/vendor/raphael.js"></script>
    <script src="treant/Treant.js"></script>
    
    <script type="text/javascript">
   
    <?php echo $profile->gTree();?> 
    
 </script>
    <script>
        new Treant( chart_config );
    </script>
      
</body>
</html>