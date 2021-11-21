<?php
session_start(); ob_start();
	//	error_reporting(0); 
	//@ini_set('display_error', 0);  
//session_start(); ob_start();
include("library/connect.inc.php");

	
	
	
		class abc{
	
		function findUser($user){
global $db;		
		$sql=$db->query("SELECT * FROM user WHERE sn = '$user' " )or die(mysqli_error()); 
$num=mysqli_num_rows($sql);
if($num==0){$res = FALSE; }else{$res = TRUE; }
return $res;
	}
	
	function Downline($user){
		global $db;
		$sql=$db->query("SELECT * FROM user WHERE a1 = '$user' " )or die(mysqli_error()); 
$num=mysqli_num_rows($sql);
return $num;
	}
	
	
	
		function Register($sponsor,$user){
		global $db, $name, $signup;
$que=$db->query("SELECT * FROM user WHERE sn = '$user' " )or die(mysqli_error());
					$ro=mysqli_fetch_array($que);
					$a1 = $ro['sn'];
					$a2 = $ro['a1'];
					$a3 = $ro['a2'];
					$a4 = $ro['a3'];
					$a5 = $ro['a4'];
					$a6 = $ro['a5'];
					$a7 = $ro['a6'];
					$a8 = $ro['a7'];
					$a9 = $ro['a8'];
					$a10 = $ro['a9'];
					$a11 = $ro['a10'];
					$pass = md5(123);
					$id = $signup->win_hash(32);
					
				$reg = $db->query("INSERT INTO user (id,firstname,sponsor,a1,a2,a3,a4,a5,a6,a7,a8,a9,a10,a11,user,pass)
VALUES('$id','$name','$sponsor','$a1','$a2','$a3','$a4','$a5','$a6','$a7','$a8','$a9','$a10','$a11','$name','$pass')") or die(mysqli_error());

$down=$db->query("select * FROM user WHERE a1 = '$user' " )or die(mysqli_error());
$nd=mysqli_num_rows($down);
$upd = $db->query("UPDATE user SET active = '$nd' WHERE sn = '$user' ");
return;
	}



function nextUpline(){
	global $db, $sponsor,$ge,$user;
	 $gen = 'a'.$ge; 
	 
				$que=$db->query("select * FROM user WHERE $gen = '$sponsor' AND active < 5 ORDER BY sn ASC LIMIT 1" )or die(mysqli_error());
					$ro=mysqli_fetch_array($que);
					$find = mysqli_num_rows($que);
					 $user = $ro['sn'];
					 if($find < 1){ $ge = $ge+1; $this->nextUpline2(); }
					return $user;
					}
					
function nextUpline2(){
	global $db, $sponsor,$ge,$user;
	 $gen = 'a'.$ge; 
	 
				$que=$db->query("select * FROM user WHERE $gen = '$sponsor' AND active < 5 ORDER BY sn ASC LIMIT 1" )or die(mysqli_error());
					$ro=mysqli_fetch_array($que);
					$find = mysqli_num_rows($que);
					 $user = $ro['sn'];
					 if($find < 1){ $ge = $ge+1; $this->nextUpline(); }
					return $user;
					}	
			
			function userName($user){
				global $db;
			$que=$db->query("select * FROM user WHERE sn = '$user' " )or die(mysqli_error());
					$ro=mysqli_fetch_array($que);	
				return $ro['firstname'];
			}
			
			
			
			function Reward($user){
				global $db;
			$que=$db->query("select * FROM user WHERE sponsor = '$user' " )or die(mysqli_error());
			$num = mysqli_num_rows($que);	
			$reward1 = $num*1000;
			
			$a = 1;  $nu = 0;
			while($a<=10){$b = $a++; $gen = 'a'.$b; 
			$qu=$db->query("select * FROM user WHERE $gen = '$user' " )or die(mysqli_error());
			$nu = $nu + mysqli_num_rows($qu);	
			}
			$reward2 = $nu*1000;
			$reward = $reward1+$reward2;
			if($reward>0){return '₦'.number_format($reward);} else{return;   }
			}
			
			function Sponsor($user){
				global $db;
			$que=$db->query("select * FROM user WHERE sponsor = '$user' " )or die(mysqli_error());
			$num = mysqli_num_rows($que);	
			return $num;	
			}
			
			
			function Downlines($user){
				global $db;
			$a = 1;  $nu = 0;
			while($a<=10){$b = $a++; $gen = 'a'.$b; 
			$qu=$db->query("select * FROM user WHERE $gen = '$user' " )or die(mysqli_error());
			$nu = $nu + mysqli_num_rows($qu);	
			}
			return $nu;	
			}
		
		function downKeys(){
				global $db,$key;
				$randomKey = 1;//$this->userName('sn');
				$key=$randomKey.",";
			$a = 1;  $nu = 0;
			while($a<=10){$b = $a++; $gen = 'a'.$b; 
			$qu=$db->query("SELECT * FROM user WHERE $gen = '$randomKey' " )or die(mysqli_error());
			while($row = mysqli_fetch_assoc($qu)){
				$key .= $row['sn'].",";
			}	
			}
			$key = explode(",", $key);
			$count = count($key)-2;
			$rand = ($count<10) ? rand(0,$count) : (int)rand(0,($count/3));
			$key = $key[$rand];
			return $key;	
			}



			



		}
		
		$ab = new abc;
				
					
					
					
if(array_key_exists('start', $_POST)){
	$name = $_POST['name'];
	$sponsor = $_POST['sponsor'];
$ab->Register(0,0);
}
	
	
if(array_key_exists('clear', $_POST)){
	$db->query("TRUNCATE user");
}	
	
	
	
	
	
	
	
		
	
if(array_key_exists('signup', $_POST)){
	$name = ucwords($_POST['name']);
	$sponsor = trim($_POST['sponsor']);
	


if($ab->findUser($sponsor)==TRUE){	


			if($ab->Downline($sponsor)<5){	
			$user = $sponsor;
			$ab->Register($sponsor,$user);			

				$erp1="User Successfully registered directly under ".$ab->userName($user);
				}        
			else{	
						$ge = 1;
					$user = $ab->nextUpline();
					$ab->Register($sponsor,$user);
				$erp1="User registered directly under ".$ab->userName($user);
	
				}

         }else{
			 
			 $erp1="User Does not Exist";
		      }

}

//$que=$db->query("select * FROM mdata ORDER BY rand() LIMIT 1 " )or die(mysqli_error());
				//	$ro=mysqli_fetch_array($que);

$namex = "daniel,wahab,wale,sope,godwin,bose,kola,damilare,bola,are,simi,fola,jacob,john,godwin,alfred,samuel,james,peter,kenedy,raymond,salisu,sandra,segun,seun,shedrack,kenny,badmus,kadna,felix,phlip";
$namex = explode(",", $namex);
$count = count($namex)-1;
$pick = rand(0,$count);
$pick2 = rand(0,$count);
$name = $namex[$pick].' '.$namex[$pick2];	

?>

<!DOCTYPE html>
<html class=" ">
    <head>
        <!-- 
         * @Package: Complete Admin - Responsive Theme
         * @Subpackage: Bootstrap
         * @Version: 2.2
         * This file is part of Complete Admin Theme.
        -->
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title>TEST</title>
     <style type="text/css">
	 input{width:150px; height:30px;}
	 td{border-bottom:thin solid #999;}
	 </style>
    </head>
    <!-- END HEAD -->

    <!-- BEGIN BODY -->
    <body>

        <h3 style="font-weight:bold; font-family:Arial, Helvetica, sans-serif"><center>DEMO TEST</center></h3> 


<h4><font color="red"><?php $erp = isset($erp)?$erp:'';  $erp1 = isset($erp1)?$erp1:''; echo $erp; ?></font><font color="green"><?php echo $erp1; ?></font></h4>
        <form name="demo"  method="post">
            <p class="submit">
            <input name="name" placeholder="Name" value="<?php echo ucwords($name); ?>">
            <input type="number" name="sponsor" placeholder="Sponsor ID" value="<?php echo $ab->downKeys(); ?>" required>
                <input type="submit" name="signup" value="Register User" /><input type="submit" name="start" value="Start" /><input type="submit" name="clear" value="Clear" />
            </p>
        </form>


<table>
<tr><th>Name</th><th>ID</th><th>SP</th><th>DIRECT UPLINE</th><th>UPLINE 2</th><th>UPLINE 3</th><th>UPLINE 4</th><th>UPLINE 5</th><th>UPLINE 6</th><th>UPLINE 7</th><th>ACTIVE</th><th>Sponsored</th><th>Downlines</th></tr>
<?php $sql = $db->query("SELECT * FROM user ORDER BY sn DESC"); 
		while($row=mysqli_fetch_assoc($sql)){  
echo '<tr style="border-bottom:solid thin #F60"><td>'.$row['firstname'].'</td><td>'.$row['sn'].'</td><td>'.$ab->userName($row['sponsor']).'</td><td>'.$ab->userName($row['a1']).'</td><td>'.$ab->userName($row['a2']).'</td><td>'.$ab->userName($row['a3']).'</td><td>'.$ab->userName($row['a4']).'</td><td>'.$ab->userName($row['a5']).'</td><td>'.$ab->userName($row['a6']).'</td><td>'.$ab->userName($row['a7']).'</td><td>'.$row['active'].'</td><td>'.$ab->Sponsor($row['sn']).'</td><td>'.$ab->Downlines($row['sn']).'</td></tr>';        
         }  ?>
         </table>
         <?php //echo $ab->waitingList(9); ?>
</body>
</html>



