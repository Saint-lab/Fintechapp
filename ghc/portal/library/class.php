<?php

function win_hashs($length){ 
return substr(str_shuffle(str_repeat('1234567890abcdefghijklmnopqrstuvwxyz',$length)),0,$length);	
}
function win_hash($length){
return substr(str_shuffle(str_repeat('123456789',$length)),0,$length);	
}


class Signup{ 
			
    /* Class constructor */
   function Signup(){ 
	
	   if(array_key_exists('findSponsor', $_POST)){ $this->findSponsor(); }
	   elseif(array_key_exists('changeSponsor', $_POST)){ $_SESSION['signup']=NULL; }
	    elseif(array_key_exists('changeLogin', $_POST)){ $_SESSION['signup']=2; }
     elseif(isset($_GET['form'])){ if($_GET['form']=='reset'){session_destroy(); 
        header('location: signup.php');} }
	   elseif(array_key_exists('payWithPin', $_POST)){ $this->payWithPin(); }
	   elseif(isset($_GET['trk_referenc'])){ $this->payWithCard(); }
	    

	    elseif(isset($_SESSION['r'])){ $this->refLink(); }

	   elseif(array_key_exists('resetPass', $_POST)){ $this->resetPass(); }
	   elseif(array_key_exists('updateSignup', $_POST)){ $this->updateSignup(); }
	   elseif(array_key_exists('updateSignupPhoto', $_POST)){ $this->updateSignupPhoto(); }
	   elseif(array_key_exists('resetPassConfirm', $_POST)){ $this->resetPassConfirm(); }
	   elseif(array_key_exists('signupUserIni', $_POST)){ $this->signupUserIni(); }
	   elseif(array_key_exists('userSearch', $_POST)){ $this->userSearch(); }

	   elseif(array_key_exists('LoginCont', $_POST)){ $this->LoginCont(); }
	  return;
	  }



function LoginCont(){
session_destroy(); header('location: login.php');
return;
}

function userSearch(){
    global $db,$report,$count;

    $user = $_POST['user'];

    $sql = $db->query("SELECT * FROM user WHERE user='$user' OR email='$user'");
    $row = $sql->fetch_assoc();
    if($sql->num_rows < 1){
        $count = 1;
        $report = "User Does Not Exists, Check and Try Again";
    }
    else {
        header('Location:searchUser.php?f='.sha1($user));
    }

}

function win_hash($length){
return substr(str_shuffle(str_repeat('123456789',$length)),0,$length);	
}

function refLink(){
$this->findSponsor($_SESSION['r']);
	return;
}	 


function findSponsor($user1=''){ 
		global $db,$report,$count;
$user = isset($_POST['sponsor']) ? $_POST['sponsor'] : $user1;
 $user = strtolower($user);
     if($this->validateUser($user)==FALSE){ 
         $report = 'You have entered an invalid sponsor ID. Please Try Again'; $count=1; 
        } else{
            $_SESSION['signup']=2;
            $_SESSION['sponsorUsername'] = $user; 
           
        $_SESSION['sponsor'] = $this->validateUser($user,1); 
          $_SESSION['sponsorId'] = $this->validateUser($user,2); 
        $report = 'Sponsor Successfully Validated';
        
 }
unset($_SESSION['r']);
return;
	}



	function validateUser($username,$info=''){
		global $db,$report,$count;
            $sql=$db->query("SELECT * FROM user WHERE user = '$username' OR email = '$username' " )or 
            die(mysqli_error()); 
$num=mysqli_num_rows($sql);
$row=mysqli_fetch_assoc($sql);
if($num==0){$res = FALSE; }else{$res = TRUE; }	
if($info==1){$res=$row['firstname'].' '.$row['lastname'];}
if($info==2){$res=$row['sn'];}
return $res;
	}




function signupUserIni(){
	global $db, $report, $count;
	$report='';
	
$_SESSION['email'] = $email = strtolower($this->valEmpty($_POST['email'],'E-mail'));

$_SESSION['username'] = $username = strtolower($this->valEmpty($_POST['username'],'Username'));
$_SESSION['pwd'] = $this->valPass($_POST['passw']);
$_SESSION['pwd2'] = $_POST['passw2'];

if($_SESSION['pwd'] != $_SESSION['pwd2']){$report .= "<br>Password confirmation failed, Try again"; $error = 1; }
if($this->userExist($_SESSION['username'],$_SESSION['email'])==TRUE){
$report .= "<br>A user with this username/E-mail already exist. Try again."; 
 $error = 1;}

if(!empty($error)){ $count = 1; }else{
$id=win_hashs(8); $_SESSION['idMsg']=$id;
$pwd = flip_tick($_SESSION['pwd']);
$sql = $db->query("INSERT INTO user (id,email,phone,user,pass)
VALUES('$id','$email','$username','$username','$pwd')") or die('Cannot Connect to Server');
$sql2 = $db->query("INSERT INTO user2 (userid)
VALUES('$id')") or die('Cannot Connect to Server');
  
$report = "<br>Login Information successfully submitted"; 
$_SESSION['signup']=2;
//header('location: #payment');
}


return;
}


function valEmpty($field,$fname){
	global $report, $error;
	$field = trim($field);
if($field==''){$report .= "<br>".$fname." field is required! "; $error=1; return;}
elseif(strlen($field)<3){$report .= "<br>".$fname." entered is too short! "; $error=1; return;}else{
return $field; }
}

function valPhone($field){
	global $report, $error;
	$field = trim($field);
if($field==''){$report .= "<br>Phone Number field is required! "; $error=1; return;}elseif(strlen($field)<11){$report .= "<br>Phone Number entered is invalid! "; $error=1; return;}else{
return $field; }
}

function valPass($field){
	global $report, $error;
if($field==''){$report .= "<br>Password field is required! "; $error=1; return;}elseif(strlen($field)<4){$report .= "<br>Password cannot be less than 4 characters! "; $error=1; return;}else{
return $field; }
}


function verifyPinInvestor($pin){
	global $db;
$sql=$db->query("SELECT * FROM pin WHERE pin = '$pin' " )or die(mysqli_error()); 
$row = mysqli_fetch_assoc($sql);
$num=mysqli_num_rows($sql);
if($num==1){
if($row['investor']==0){}else{ 
    $this->findSponsor($row['investor']); 
     } 
 }
return;
}

function payWithPin(){
global $db,$count,$report,$username,$pin;
$pin = strtoupper($_POST['epin']);
//$this->verifyPinInvestor($pin);
$sql=$db->query("SELECT * FROM pin WHERE pin = '$pin' AND mode=1 " )or die(mysqli_error()); 
$row = mysqli_fetch_assoc($sql);
$num=mysqli_num_rows($sql);
if($num==1){
if($row['status']==1){$report = 'This E-PIN has already been used by: '.$this->userName2($row['id']).' as at '.$row['created']; $count=1; }elseif($row['status']==0){ 
	if(strlen($row['investor']) > 1){$this->findSponsor($row['investor']); }
	$this->signupUser(); 
	$sql=$db->query("UPDATE pin SET status = 1, id = '$username' WHERE pin = '$pin' " )or die(mysqli_error()); 
} 
	}else{

		$report = 'You have entered an invalid E-PIN, verify your E-PIN and try again';  $count=1;
	
}

return;
}



function payWithCard(){
global $db,$count,$report,$username,$pin;

$sql=$db->query("SELECT * FROM pin WHERE status = 0 AND mode=2 LIMIT 1 " )or die(mysqli_error()); 
$row = mysqli_fetch_assoc($sql);
$pin = $row['pin'];

if($_GET['trk_referenc']==$_SESSION['ref']){
	$this->signupUser(); 
	$sql=$db->query("UPDATE pin SET status = 1, id = '$username' WHERE pin = '$pin' " )or die(mysqli_error()); 
	header("location: ?status=Payment-Successful#payment");

	}else{

		$report = 'Sorry! Payment Not Successful';  $count=1;
	
}

return;
}



	 function signupUser(){
	 global $report, $count, $pwd, $username, $email;
	 
	 /*$firstname = $_SESSION['firstname'];
	 $lastname = $_SESSION['lastname'];
	 $address = $_SESSION['address'];
	 $state = $_SESSION['state'];
	 $city = $_SESSION['city'];
	 $phone = $_SESSION['phone'];
	 */
$email = $_SESSION['email'];

$username = $_SESSION['username'];
$pwd = flip_tick($_SESSION['pwd']);

$sponsor = $_SESSION['sponsorId']; 

if($this->userExist($username,$email)==TRUE){
$report="A user with this username/E-mail already exist. Try another Username. If you have registered before, go to login area and do password recovery ";	
 $error = 1;}else{

if($this->findUser($sponsor)==TRUE){	


			if($this->Downline($sponsor)<MATRIX){	
			$user = $sponsor;
			$this->Register($sponsor,$user);

						$report="You have been successfully registered directly under ".$this->userName($user);


				}        
			else{	
						$ge = 1;
					$user = $this->nextUpline($ge);
					$this->Register($sponsor,$user);
			
				$report="You have been successfully registered directly under ".$this->userName($user);
	
				}

         }else{
			 
			 $report="Sponsor Does not Exist"; $count = 1;
		      }
			  
}


//}

return;
   }
	
	
	
	
			function userName($user,$col=''){
				global $db;
			$que=$db->query("select * FROM user WHERE sn = '$user' " )or die(mysqli_error());
					$ro=mysqli_fetch_array($que);
					if(!empty($col)){return $ro[$col];}else{	
				return $ro['firstname'].' '.$ro['lastname'];}
			}	

			function userName2($user){
				global $db;
			$que=$db->query("select * FROM user WHERE user = '$user' " )or die(mysqli_error());
					$ro=mysqli_fetch_array($que);
					if(!is_null($ro['firstname'])){return $ro['firstname'].' '.$ro['lastname'];}
					else{return $ro['user']; }
				
			}	
	
	
		function findUser($user){
		global $db;
		$sql=$db->query("select * FROM user WHERE sn = '$user' " )or die(mysqli_error()); 
$num=mysqli_num_rows($sql);
if($num==0){$res = FALSE; }else{$res = TRUE; }
return $res;
	}
	
	function userExist($username,$email){
		global $db,$report,$count;
			$sql=$db->query("SELECT * FROM user WHERE user = '$username' OR email = '$email' " )or die(mysqli_error()); 
$num=mysqli_num_rows($sql);
if($num==0){$res = FALSE; }else{$res = TRUE; }	
return $res;
	}




	
	
	
	function Downline($user){
		global $db;
		$sql=$db->query("select * FROM user WHERE a1 = '$user' " )or die(mysqli_error()); 
$num=mysqli_num_rows($sql);
return $num;
	}
	

		//Total Sponsored by User				
	function Qualify($sponsorid){
			global $db;
			$qu=$db->query("select * FROM user WHERE sponsor = '$sponsorid' " )or die(mysqli_error());
			$nu = mysqli_num_rows($qu);	
			if($nu==4){$res=TRUE;}else{$res=FALSE;}
			return $res;	
			}

	
	

function message($id,$msg,$subject){
global $db;
$ctime = CTIME;
$msg = $db->query("INSERT INTO msg (rec,subject,msg,ctime)
VALUES('$id','$subject','$msg','$ctime')") or die(mysqli_error());

	return;
}





function nextUpline($ge){
	global $db;
$sponsor = $_SESSION['sponsorId']; 
	 $gen = 'a'.$ge; 
	 
	 $matrix = MATRIX;
				$que=$db->query("SELECT * FROM user WHERE $gen = '$sponsor' AND active < '$matrix' ORDER BY sn ASC LIMIT 1" )or die(mysqli_error());
					$ro=mysqli_fetch_array($que);
					$find = mysqli_num_rows($que);
					 $user = $ro['sn'];
					 if($find < 1){ $ge = $ge+1; $user = $this->nextUpline2($ge); }
					return $user;
					}
					
function nextUpline2($ge){
	global $db;
	$sponsor = $_SESSION['sponsorId']; 
	 $gen = 'a'.$ge; 
	 $matrix = MATRIX;
	 
				$que=$db->query("select * FROM user WHERE $gen = '$sponsor' AND active < '$matrix' ORDER BY sn ASC LIMIT 1" )or die(mysqli_error());
					$ro=mysqli_fetch_array($que);
					$find = mysqli_num_rows($que);
					 $user = $ro['sn'];
					 if($find < 1){ $ge = $ge+1; $user = $this->nextUpline($ge); }
					return $user;
					}	
			

			


function resetPass(){
	global $db,$report,$count;
	$email = strtolower(trim($_POST['emailreset']));
$sql=$db->query("SELECT * FROM user WHERE email = '$email' " )or die('Could not initiate password reset');
$row=mysqli_fetch_array($sql);
$reset_order = $this->win_hash(41);
$find = mysqli_num_rows($sql);
if($find==0){$report='This email does not exist in our system, check and try again'; $error=1;}
elseif($find==1){
	$sql=$db->query("UPDATE user SET code='$reset_order' WHERE email = '$email' " )or die('Could not initiate password reset');
$message = 'You have requested for a password reset. Follow the link below to reset your password:<br>';
$message .= 'https://www.covisclub.com/resetpassword?reset-order='.$reset_order;
$subject='COVIS Password Recovery';
$this->emailerAll($email,$message,$subject);
	$report='We have sent you an e-mail containing your password reset link. Follow the link to reset your password';
}

if(!empty($error)){ $count = count($error); }
return;
}




function updateSignup(){
	global $db,$report;
    $username = $_SESSION['username'];
    $id = $_SESSION['idMsg']; 
$firstname=ucwords(strtolower($this->valEmpty($_POST['firstname'],'Surname')));
$lastname=ucwords(strtolower($this->valEmpty($_POST['lastname'],'Other Names')));

$state=$_POST['state'];
$city=ucwords(strtolower($this->valEmpty($_POST['city'],'City')));
$address=addslashes(ucwords(strtolower($this->valEmpty($_POST['address'],'Address'))));
//$phone=$this->valPhone($_POST['phone']);
$bank=ucwords(strtolower($this->valEmpty($_POST['bank'],'Bank')));
$accountno=$this->valEmpty($_POST['accountno'],'Account Number');
$bvn=$this->valEmpty($_POST['bvn'],'Bank Verification Number-BVN');

$dob=$this->valEmpty($_POST['dob'],'Date of Birth');
$sex=$_POST['sex'];
$accname=ucwords(strtolower($this->valEmpty($_POST['accname'],'Account Name')));
$officeaddress=addslashes(ucwords(strtolower($_POST['officeaddress'])));

//$photo = isset($_FILES['image']) ? str_replace(' ', '-', $username).$_FILES['image']['name'] : 'user.png';
	 //  define('upload', 'portal/photo/');
	 // $success = move_uploaded_file($_FILES['image']['tmp_name'], upload.$photo);
	



$db->query("UPDATE user SET state='$state', city='$city', address='$address', bank='$bank', accountno='$accountno', bvn='$bvn', firstname='$firstname', lastname='$lastname', sex='$sex', dob='$dob', accname='$accname', officeaddress='$officeaddress' WHERE user = '$username' "); 
$sms='Your registration is successful. Your username is '.$username.'. Thank you for joining the Greater Height. Call '.CPHONE.'for more information.';
//sendSms($sms,$phone,$username);
$subject = 'Successful Registration';
$this->userMsg($id,$subject,$sms);
$report = 'User Information Successfully Updated!';
$_SESSION['signup']=3;

	return;
}

function userMsg($id,$sub,$msg)
{
    global $db;
$ctime = CTIME;
$sql = $db->query("INSERT INTO usermsg (id,sub,msg,ctime)
VALUES('$id','$sub','$msg','$ctime')") or die(mysqli_error());

	return;
}



function updateSignupPhoto(){
	global $db,$report;
	$username = $_SESSION['username']; 


$photo = isset($_FILES['image']) ? 'sp'.str_replace(' ', '-', $username).$_FILES['image']['name'] : 'user.png';
	  define('upload', 'portal/photo/');
	 $success = move_uploaded_file($_FILES['image']['tmp_name'], upload.$photo);

$db->query("UPDATE user SET photo='$photo' WHERE user = '$username' "); 

$report = 'User Photo Successfully Updated!';
$_SESSION['signup']=4;

	return;
}








function resetPassOrder(){
global $db;
$order = isset($_GET['reset-order']) ? $_GET['reset-order']:'';
$sql=$db->query("SELECT * FROM user WHERE code = '$order' " );
$find = mysqli_num_rows($sql);
if($find==1){return TRUE;}else{return FALSE;}
}


function resetPassConfirm(){
	global $db,$report,$count;
	$pwd1 = flip_tick($_POST['pwd1']);
	$pwd2 = $_POST['pwd2'];
	$reset_order = $this->win_hash(41);
	$code = $this->resetPassOrder() ? $_GET['reset-order'] : 0;
if(password_verify($pwd2,$pwd1)){
$db->query("UPDATE user SET pass='$pwd1', code='$reset_order' WHERE code = '$code' "); $_SESSION['report'] = 'User Password Successfully Changed! You can now login to your account';
header('location: ./login.php'); }else{$report='New Password Mismatch, Try Again'; $error = 1;}

	  if(isset($error)){$count = count($error); }
	  return;
}









function Alert(){
	global $report,$count;
	if($count == 0){
 echo '<div class="alert alert-success alert-dismissible" style="position:fixed; top:10px; right:10px; z-index:10000">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-check"></i> <strong style="color:white">Alert!</strong> &nbsp;&nbsp;'. $report .'&nbsp;&nbsp;&nbsp;&nbsp;
              </div>';	
	}
	else{
	 echo '<div class="alert alert-danger alert-dismissible" style="position:fixed; top:10px; right:10px; z-index:10000">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-ban"></i>  <strong style="color:white">Alert!</strong> &nbsp;&nbsp;'. $report .' &nbsp;&nbsp;&nbsp;
              </div>';		
	}
	return;
}


function emailer($email,$message,$subject){
	global $firstname;
$headers = 'From: BELIEVERS FAMILY <admin@thegreatheights.com>' . "\r\n";
$headers .= 'Reply-To: admin@thegreatheights.com' . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

$send =mail($email,$subject,$message,$headers);
return;
	}	





			
		}
		
$signup = new Signup;
		//End of abc class


		
		
		


















//User Profile Class

		if(isset($_SESSION['user_id'])){	
$userKey = $_SESSION['user_id'];
}	

	
class Profile{
	var $amount = 10000;  //Registration Fee
	var $pointrate = 1000;// Rate in Naira per point
	var $sponsorpoint = 3;// Each person you sponsor gives you 3 points
	var $downlinepoint = 1; // Each downline gives you 1 point// may not be used
	


private function layerKey(){
return $_SESSION['user_id'];
}
	
	
	//User Array Keys 
	/* Class constructor */
	   function Profile(){
	 if(array_key_exists('changePassword', $_POST)){ $this->changePassword(); }
	  if(array_key_exists('updateUser', $_POST)){ $this->updateUser(); }
	   if(array_key_exists('updatePhoto', $_POST)){ $this->updatePhoto(); }
	      if(array_key_exists('updatePhotoWild', $_POST)){ $this->updatePhotoWild(); }
	   if(array_key_exists('LoginUsers', $_POST)){ $this->LoginUsers(); }
	    if(array_key_exists('approveLoan', $_POST)){ $this->approveLoan(); }
	    if(array_key_exists('ApproveLn', $_POST)){ $this->ApproveLn(); }
	     if(array_key_exists('requestOTP', $_POST)){ $this->requestOTP(); }
	     if(isset($_GET['pin-operations'])){ $this->generateEpins(); }
	     if(isset($_GET['txref'])){ $this->automateProFee(); }
	     if(array_key_exists('selectLoan', $_POST)){ $this->selectLoan(); }
	       if(array_key_exists('processLoanIni', $_POST)){ $this->processLoanIni(); }
	       if(array_key_exists('updateUserData', $_POST)){ $this->updateUserData(); }
	        if(array_key_exists('updateUserDataWild', $_POST)){ $this->updateUserDataWild(); }
	       	   if(isset($_GET['trk_reference'])){ $this->payTranch(); }
	       	  if(array_key_exists('payLoanAdmin', $_POST)){ $this->payTranchAdmin(); }
	       	  if(array_key_exists('InitiateInvestment', $_POST)){ $this->InitiateInvestment(); }
	       	  if(array_key_exists('DeleteUserInv', $_POST)){ $this->DeleteUserInv(); }
	       	   if(array_key_exists('DeleteUserSav', $_POST)){ $this->DeleteUserSav(); }
	       	  if(array_key_exists('payInvestAdmin', $_POST)){ $this->payInvestAdmin(); }
	       	   if(array_key_exists('InitiateSavings', $_POST)){ $this->InitiateSavings(); }
	       	    if(array_key_exists('PayMultiple', $_POST)){ $this->PayMultiple(); }
	       	   if(array_key_exists('userProfileDataSearch', $_POST)){$this->userProfileDataSearch($a='');}
	     
	     if(array_key_exists('payLoan', $_POST)){ $this->payLoan(); }


	      if(isset($_GET['process'])){if($_GET['process'] =='logout'){ session_destroy(); header('location: ../login.php'); exit; }}
	      if(array_key_exists('accessloandata', $_POST)){$this->accessloandata();}
	      if(array_key_exists('uploaduserdocument', $_POST)){$this->uploaduserdocument();}
	      if(array_key_exists('DownloadStatement', $_POST)){$this->DownloadStatement();}
          if(array_key_exists('Downloadletter', $_POST)){$this->Downloadletter();}
          if(array_key_exists('chattingBtn', $_POST)){$this->chattingBtn();}
          if(array_key_exists('deleteSelected', $_POST)){$this->deleteSelected();}
	 return;
      }
      function deleteSelected()
      { global $db, $report, $count;
      	$id = $_POST['selector'];
      	$num = count($id); $deleteid=0;
      	for($i=0; $i<$num; $i++)
      	{
      		$deleteid = $id[$i]; //$x+= $id[$i];
      		$sql = $db->query("UPDATE msg SET deleted = 1 WHERE sn = '$deleteid'");
      		if($sql === TRUE){$report = $num.' Selected message successfully deleted';}
      	}
      	return ; 
      }

      function chattingBtn() 
      {
          global $db; $sender='';
          $sender = $_SESSION['user_id']; 
          $chatMessage='';$rec=''; $recId='';
          $chatMessage = $_POST['chatMessage'];
         $recId = $_POST['recId'];
          $ctime = CTIME;
          $rec = $_POST['recKey'];
          $status = 1;
          if(!empty($chatMessage) && !empty($rec)){
          $db->query("INSERT INTO msg (msg,sender,rec,ctime,active) 
          VALUES('$chatMessage','$sender','$rec','$ctime','$status')") or die(mysqli_error());
          //$lastId = $db->insertd_id;
         return header('location:chatting.php?messages='.$recId.'&page=1');
          }else{echo 'Error due to network problem';}
      }
      function userMsg($id,$sub,$msg)
      {
          global $db;
      $ctime = CTIME;
      $sql = $db->query("INSERT INTO usermsg (id,sub,msg,ctime)
      VALUES('$id','$sub','$msg','$ctime')") or die(mysqli_error());
      
          return;
      }	  
function uploaduserdocument()
{
	global $db,$report,$userKey; 
 define('upload', 'photo/');
      $staffid = isset($_FILES['staffid']) ? $this->userName('user').$_FILES['staffid']['name'] : 'user.png';
     $success = move_uploaded_file($_FILES['staffid']['tmp_name'], upload.'document/'.$staffid);
 $bill = isset($_FILES['bill']) ? $this->userName('user').$_FILES['bill']['name'] : 'user.png';
    $success = move_uploaded_file($_FILES['bill']['tmp_name'], upload.'document/'.$bill);
$statement = isset($_FILES['statement']) ? $this->userName('user').$_FILES['statement']['name'] : 'user.png';
 $success = move_uploaded_file($_FILES['statement']['tmp_name'], upload.'document/'.$statement);     
$letter = isset($_FILES['letter']) ? $this->userName('user').$_FILES['letter']['name'] : 'user.png';
$success = move_uploaded_file($_FILES['letter']['tmp_name'], upload.'/document'.$letter);
$cheque = isset($_FILES['cheque']) ? $this->userName('user').$_FILES['cheque']['name'] : 'user.png';
$success = move_uploaded_file($_FILES['cheque']['tmp_name'], upload.'document/'.$cheque);


$sqlw = $db->query("UPDATE user2 SET staffid='$staffid', bill='$bill', statement='$statement', letter='$letter', cheque='$cheque' WHERE userid = '$userKey' ");
$_SESSION['document'] = 'Document Successfully Uploaded!';
header('location:accessloan.php');

return;
}
function existData()
{
	global $db,$userKey;
	$con = $db->query("SELECT * FROM user2 WHERE userid = '$userKey'");
	$num = mysqli_num_rows($con);
	if($num==1){return TRUE;}else{return FALSE;}
		return;
}
function LoginUsers(){
	global $db,$report,$signup,$count;
	$username = $_POST['usern'];
	$password = $_POST['passwo'];
	$sql = $db->query("SELECT * FROM user WHERE user='$username'");
	$num = mysqli_num_rows($sql);

	if($num==1){
		$row = mysqli_fetch_assoc($sql);
		$pass = $row['pass'];
		// if($pass==$password){
		// if(password_verify($password, $pass)){
		
		if(is_null($row['firstname'])){ $_SESSION['username']=$row['user']; 
		$_SESSION['email']=$row['email']; 
		$sponsorID = $this->wildUserName($row['sponsor'],'user');
		$signup->findSponsor($sponsorID);  
		$_SESSION['signup']=4;
		header('location:signup.php#register');
	}else{
		$_SESSION['user_id'] = $row['id']; 
		$_SESSION['signup'] = '';
		header('location:portal/'); }
	// }else{$report='Invalid Login details, Try again'; $error=1;}
	}else{$report='Invalid Login details, Try again'; $error=1;}
 
  
  return;
}


function validLayer(){
if(strlen($this->layerKey()) != 32){
		unset($_SESSION['user_id']);
	}else{}
	return;
}








function updateUser(){
	global $db,$report,$userKey;
$state=$_POST['state'];
$city=$_POST['city'];
$address=addslashes($_POST['address']);
//$phone=$_POST['phone'];
$bank=$_POST['bank'];
$accountno=$_POST['accountno'];
$bvn=$_POST['bvn'];


$db->query("UPDATE user SET state='$state', city='$city', address='$address', bank='$bank', accountno='$accountno', bvn='$bvn' WHERE id = '$this->layerKey()' "); 
$report = 'User Information Successfully Update!';

	return;
}

function DeleteUserInv(){
	global $db,$report,$userKey;
$trno=$_POST['DeleteUserInv'];

$db->query("DELETE FROM invacc  WHERE userid = '$userKey' AND trno='$trno' AND status=1 "); 
$report = 'Operation Successful!';

	return;
}

function DeleteUserSav(){
	global $db,$report,$count,$userKey;
$trno=$_POST['DeleteUserSav'];
 if($this->trackSavingsPay($userKey)==0){
$db->query("DELETE FROM savings  WHERE userid = '$userKey' AND trno='$trno'  "); 
$report = 'Operation Successful!';
}else{$report='Cannot delete savings schedule, its already activated'; $count=1;}
	return;
}






function updateUserData(){
	global $db,$report,$userKey,$signup;
	//$username = $_SESSION['username']; 
$firstname=ucwords(strtolower($signup->valEmpty($_POST['firstname'],'Surname')));
$lastname=ucwords(strtolower($signup->valEmpty($_POST['lastname'],'Other Names')));

$state=$_POST['state'];
$city=ucwords(strtolower($signup->valEmpty($_POST['city'],'City')));
$address=addslashes(ucwords(strtolower($signup->valEmpty($_POST['address'],'Address'))));
//$phone=$signup->valPhone($_POST['phone']);
$bank=ucwords(strtolower($signup->valEmpty($_POST['bank'],'Bank')));
$accountno=$signup->valEmpty($_POST['accountno'],'Account Number');
$bvn=$signup->valEmpty($_POST['bvn'],'Bank Verification Number-BVN');

$dob=$signup->valEmpty($_POST['dob'],'Date of Birth');
$sex=$_POST['sex'];
$accname=ucwords(strtolower($signup->valEmpty($_POST['accname'],'Account Name')));
$officeaddress=addslashes(ucwords(strtolower($_POST['officeaddress'])));


$db->query("UPDATE user SET state='$state', city='$city', address='$address', bank='$bank', accountno='$accountno', bvn='$bvn', firstname='$firstname', lastname='$lastname', sex='$sex', dob='$dob', accname='$accname', officeaddress='$officeaddress' WHERE id = '$userKey' "); 
$report = 'User Information Successfully Updated!';
	return;
}



function updateUserDataWild(){
	global $db,$report,$signup;
	$user_ref = $_GET['user-ref']; 
$firstname=ucwords(strtolower($signup->valEmpty($_POST['firstname'],'Surname')));
$lastname=ucwords(strtolower($signup->valEmpty($_POST['lastname'],'Other Names')));

$state=$_POST['state'];
$city=ucwords(strtolower($signup->valEmpty($_POST['city'],'City')));
$address=addslashes(ucwords(strtolower($signup->valEmpty($_POST['address'],'Address'))));
$phone=$signup->valPhone($_POST['phone']);
$bank=ucwords(strtolower($signup->valEmpty($_POST['bank'],'Bank')));
$accountno=$signup->valEmpty($_POST['accountno'],'Account Number');
$bvn=$signup->valEmpty($_POST['bvn'],'Bank Verification Number-BVN');

$dob=$signup->valEmpty($_POST['dob'],'Date of Birth');
$sex=$_POST['sex'];
$accname=ucwords(strtolower($signup->valEmpty($_POST['accname'],'Account Name')));
$officeaddress=addslashes(ucwords(strtolower($_POST['officeaddress'])));


$db->query("UPDATE user SET state='$state', city='$city', phone='$phone', address='$address', bank='$bank', accountno='$accountno', bvn='$bvn', firstname='$firstname', lastname='$lastname', sex='$sex', dob='$dob', accname='$accname', officeaddress='$officeaddress' WHERE md5(sn) = '$user_ref' "); 
$report = 'User Information Successfully Updated!';
	return;
}




function updatePhoto(){
	global $db,$report,$userKey; 

	  $name = isset($_FILES['image']) ? $this->userName('user').$_FILES['image']['name'] : 'user.png';
	  define('upload', 'photo/');
	 $success = move_uploaded_file($_FILES['image']['tmp_name'], upload.$name);

$sqlw = $db->query("UPDATE user SET photo = '$name' WHERE id = '$userKey' ");
$report = 'User Profile Photo Successfully Update!';
return;
}


function updatePhotoWild(){
	global $db,$report; 
$user_ref= $_GET['user-ref'];
	  $name = isset($_FILES['image']) ? 'user-'.$_FILES['image']['name'] : 'user.png';
	  define('upload', 'photo/');
	 $success = move_uploaded_file($_FILES['image']['tmp_name'], upload.$name);

$sqlw = $db->query("UPDATE user SET photo = '$name' WHERE md5(sn) = '$user_ref' ");
$report = 'User Profile Photo Successfully Update!';
return;
}


function changePassword(){
	global $db,$report,$count,$userKey;
	$pa = $this->userName('pass');
	  $currentpass = $_POST['currentpass'];
	  $newpass = $_POST['newpass'];
	  $newpass2 = $_POST['newpass2'];
	  $pass = flip_tick($newpass);
	  
	  //if($pa==$currentpass)
	  	if(password_verify($currentpass, $pa)){
		  if($newpass==$newpass2){$db->query("UPDATE user SET pass='$pass' WHERE id = '$userKey' "); $report = 'User Password Successfully Changed!';}else{$report='New Password Mismatch, Try Again'; $count = 1;}
		  
	  }else{$report='Password Mismatch, Try Again'; $count = 1;}
return;	  
}

function accessloandata()
{  global $db,$report,$count,$userKey;
	$state = ucwords(strtolower($_POST['state']));
	$radio = $_POST['radio'];
	$kname = ucwords(strtolower($_POST['kname']));
	$kphone = $_POST['kphone'];
	$kaddress = ucwords(strtolower($_POST['kaddress']));
	$kemail = ucwords(strtolower($_POST['kemail']));
	$krelation = ucwords(strtolower($_POST['krelation']));
	$pob = ucwords(strtolower($_POST['pob']));
	$lgv = ucwords(strtolower($_POST['lgv']));
	$employ = $_POST['employ-cate'];
	$edate = $_POST['employ-date'];
	$position = ucwords(strtolower($_POST['position']));
	$department = ucwords(strtolower($_POST['department']));
	$level = ucwords(strtolower($_POST['level']));
	$income = $_POST['income'];
	$ename = ucwords(strtolower($_POST['employ-name']));
	$eaddress = ucwords(strtolower($_POST['employ-address']));
	$omn = $_POST['office-num'];
	$identification = $_POST['identification'];
	$acctname = ucwords(strtolower($_POST['acct-name']));
	$acctno = $_POST['acct-no'];
	$bankname = ucwords(strtolower($_POST['bank-name']));
$db->query("UPDATE user2 SET state='$state', marital='$radio', kname='$kname', kphone='$kphone', kaddress='$kaddress', kemail='$kemail', krelation='$krelation', pob='$pob', lg='$lgv', ecategory='$employ', edate='$edate', position='$position', department='$department', level='$level', income='$income', ename='$ename', eaddress='$eaddress', omn='$omn', identification='$identification', acctname='$acctname', acctnum='$acctno', bankname='$bankname' WHERE userid = '$userKey'");
$_SESSION['firststep'] = 'User Information Successfully Uploaded!'; 
header('location:finalstep.php');

	return;


}


	//Genrating Row Data
function userName($col=''){ 
				global $db,$userKey;
				
			$que=$db->query("select * FROM user WHERE id = '$userKey' " )or die(mysqli_error());
					$ro=mysqli_fetch_array($que);	
				if(!empty($col)){return $ro[$col];}
				else{return htmlspecialchars($ro['firstname'].' '.$ro['lastname']);}
}

function userName1($id, $col=''){ 
				global $db;
				
			$que=$db->query("select * FROM user WHERE id = '$id' " )or die(mysqli_error());
					$ro=mysqli_fetch_array($que);	
				if(!empty($col)){return $ro[$col];}
				else{return htmlspecialchars($ro['firstname'].' '.$ro['lastname']);}
}
function userName2($sn, $col=''){ 
				global $db;
				
			$que=$db->query("select * FROM user2 WHERE userid = '$sn' " )or die(mysqli_error());
					$ro=mysqli_fetch_array($que);	
				if(!empty($col)){return $ro[$col];}
				else{return htmlspecialchars($ro['firstname'].' '.$ro['lastname']);}
}	

 function DownloadStatement()
    {
        global $db, $report;
        $sn = $_POST['sn'];
        $sql = $db->query("SELECT * FROM user2 WHERE sn='$sn'");
        $row = $sql->fetch_assoc();

        $path = 'photo/document/' . $row['statement'];
        $new_name = $row['statement'] . '.' . pathinfo($row['statement'], PATHINFO_EXTENSION);
//        $report = $path;
        if (file_exists($path)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . $new_name);
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length:' . filesize('photo/document/' . $row['statement']));
            readfile('photo/document/' . $row['statement']);

            //$newcount = $row['downloads'] + 1;
            //$db->query("UPDATE material SET downloads='$newcount' WHERE sn='$id'");

        }

    }

   function Downloadletter()
    {
        global $db, $report;
        $sn = $_POST['sn'];
        $sql = $db->query("SELECT * FROM user2 WHERE sn='$sn'");
        $row = $sql->fetch_assoc();

        $path = 'photo/document/' . $row['letter'];
        $new_name = $row['letter'] . '.' . pathinfo($row['letter'], PATHINFO_EXTENSION);
//        $report = $path;
        if (file_exists($path)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . $new_name);
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length:' . filesize('photo/document/' . $row['letter']));
            readfile('photo/document/' . $row['letter']);

            //$newcount = $row['downloads'] + 1;
            //$db->query("UPDATE material SET downloads='$newcount' WHERE sn='$id'");

        }

    } 


function wildUserName($key,$col=''){
				global $db;
				
			$que=$db->query("select * FROM user WHERE sn = '$key' " )or die(mysqli_error());
					$ro=mysqli_fetch_array($que);	
				if(!empty($col)){return $ro[$col];}
				else{return htmlspecialchars($ro['firstname'].' '.$ro['lastname']);}
}

function wildUserNameKey($key,$col=''){
				global $db;
				
			$que=$db->query("select * FROM user WHERE id = '$key' " )or die(mysqli_error());
					$ro=mysqli_fetch_array($que);	
				if(!empty($col)){return $ro[$col];}
				else{return htmlspecialchars($ro['firstname'].' '.$ro['lastname']);}
}	
	
	
	//Total Downlines
		function Downlines(){
				global $db,$userKey;
				$randomKey = $this->userName('sn');
			$a = 1;  $nu = 0;
			while($a<=10){$b = $a++; $gen = 'a'.$b; 
			$qu=$db->query("select * FROM user WHERE $gen = '$randomKey' " )or die(mysqli_error());
			$nu += mysqli_num_rows($qu);	
			}
			return $nu;	
			}


	//Total Downlines
		function matrixEarning(){
				global $db;
				$randomKey = $this->userName('sn');
			$a = 1;  $nu = 0;
			while($a<=10){$b = $a++; $gen = 'a'.$b; 
			$qu=$db->query("SELECT * FROM user WHERE $gen = '$randomKey' " )or die(mysqli_error());
			$nu += mysqli_num_rows($qu);	
			}
			return $nu;	
			}


			function wildDownlines($key){
				global $db;
			
			$a = 1;  $nu = 0;
			while($a<=10){$b = $a++; $gen = 'a'.$b; 
			$qu=$db->query("select * FROM user WHERE $gen = '$key' " )or die(mysqli_error());
			$nu += mysqli_num_rows($qu);	
			}
			return $nu;	
			}
			
		//Total Sponsored by User				
	function Sponsored(){
			global $db,$userKey;
			$randomKey = $this->userName('sn');
			$qu=$db->query("select * FROM user WHERE sponsor = '$randomKey' " )or die(mysqli_error());
			$nu = mysqli_num_rows($qu);	
			return $nu;	
			}


				function recentSponsored(){
			global $db;
			$li = '';
			$bl = array('info','warning','primary','danger','success'); $a = 0;
			$randomKey = $this->userName('sn');
			$qu=$db->query("SELECT * FROM user WHERE sponsor = '$randomKey' ORDER BY sn DESC LIMIT 5 " )or die(mysqli_error());
			while($nu = mysqli_fetch_assoc($qu)){
				$point = $this->wildPoint($nu['sn']);
				$b=$a++;
				$c = $b%5;
			$li .= '<li>
                                            <a href="javascript:void(0);" class="btn btn-'.$bl[$c].' font-16" data-toggle="tooltip" data-placement="top" title="'.$nu['firstname'].' '.$nu['lastname'].', '.$point.' points" data-original-title="Steave"><i class="icon-user"></i></a>
                                        </li>';
			}	
			return $li;	
			}
			
			function wildSponsored($key){
			global $db;
			$qu=$db->query("select * FROM user WHERE sponsor = '$key' " )or die(mysqli_error());
			$nu = mysqli_num_rows($qu);	
			return $nu;	
			}
			//Points Generated By User
	function Point(){
		return ($this->Sponsored()*$this->sponsorpoint) + $this->Downlines();
	}

	function wildPoint($key){
		return ($this->wildSponsored($key)*$this->sponsorpoint) + $this->wildDownlines($key);
	}

function teamPoint(){
		return $this->Downlines();
	}


	function sponsorPoint(){
		return $this->Sponsored()*$this->sponsorpoint;
	}
	
	function levelRate(){
		if($this->Level()==0 OR $this->Sponsored()<5){$rate=0;}elseif($this->Level()==1){
			$rate=$this->pointrate;
		}elseif($this->Level()==2){
			$rate=$this->pointrate+100;
		}
		elseif($this->Level()==3){
			$rate=$this->pointrate+200;
		}else{
			$rate=$this->pointrate+200;
		}
		return $rate;
	}

	//Loanable Amount
	function Potential(){
		return $this->Point()*$this->levelRate();
	}



	
	function Gen($e){
		global $db,$userKey;
		$randomKey = $this->userName('sn');
		$gen = 'a'.$e;
		$q=$db->query("select * FROM user WHERE $gen ='$randomKey' " )or die(mysqli_error());
		return mysqli_num_rows($q);
	}

function Level($t=''){
		global $db,$userKey;
				$randomKey = $this->userName('sn');

				$sql=$db->query("select * FROM user WHERE a1 = '$randomKey' " )or die(mysqli_error());
			$num = mysqli_num_rows($sql);	

			$a = 1;  $nu = 0;
			while($a<=10){$b = $a++; $gen = 'a'.$b; $target = (5*$b)*5;
			$qu=$db->query("select * FROM user WHERE $gen = '$randomKey' " )or die(mysqli_error());
			$nu = mysqli_num_rows($qu);	
			if($num<5){$level=0; $targ=5;}elseif($nu==$target){$level=$b; $targ=$target;}
			}
			if($t==1){return 5*($level+1)*5;}else{ return $level;}

}

function wildLevel($key,$t=''){
		global $db;
			
				$sql=$db->query("SELECT * FROM user WHERE a1 = '$key' " )or die(mysqli_error());
			$num = mysqli_num_rows($sql);	

			$a = 1;  $nu = 0;
			while($a<=10){$b = $a++; $gen = 'a'.$b; $target = (5*$b)*5;
			$qu=$db->query("SELECT * FROM user WHERE $gen = '$key' " )or die(mysqli_error());
			$nu = mysqli_num_rows($qu);	
			if($num<5){$level=0; $targ=5;}elseif($nu==$target){$level=$b; $targ=$target;}
			}
			if($t==1){return 5*($level+1)*5;}else{ return $level;}
}




	function chartMonth(){
		$range = '';
		$cm = date('m',time());
		$a = $cm-5; 
			while($a<=$cm){ $b=$a++; $c = date("M", mktime(0, 0, 0, $b, 10));
			$range .= "'".$c."', ";
			}

			return $range;
	}


//chart data of total entry per


    function monthSavingData(){
        $range = '';
        $cm = date('m',time());
        $a = $cm-5;
        while($a<=$cm){  $c = $this->monthSavings($a);
            $range .= $c.', ';
            $a=$a+1;
        }

        return $range;
    }
    function monthLoanData(){
        $range = '';
        $cm = date('m',time());
        $a = $cm-5;
        while($a<=$cm){  $c = $this->monthLoans($a);
            $range .= $c.', ';
            $a=$a+1;
        }

        return $range;
    }
	function monthEntryData(){
		$range = '';
		$cm = date('m');
		$a = $cm-5; 
			while($a<=$cm){ $b=$a++; $c = $this->monthDownlines($b);
			$range .= $c.', ';
			}

			return $range;
	}


	//chart monthly Loan Potential 
	function monthlyPotential(){
		$range = '';
		$cm = date('m');
		$a = $cm-5; 
			while($a<=$cm){ $b=$a++; $c = $this->monthPotential($b);
			$range .= $c.', ';
			}

			return $range;
	}


	function allMonthEntryData(){
		$range = '';
		$cm = date('m');
		$a = 1; 
			while($a<=12){ $b=$a++; $c = $this->monthDownlines($b);
			$range .= $c.', ';
			}

			return $range;
	}





	//chart data of total entry per 
	function monthEntryDataTotal(){
		$range = '';
		$cm = date('m');
		$a = $cm-5; 
			while($a<=$cm){ $b=$a++; $c = $this->entryPerMonth($b);
			$range .= $c.', ';
			}

			return $range;
	}


//chart data of user monthly sponsor
		function monthUserSponsor(){
		$range = '';
		$cm = date('m');
		$a = $cm-5; 
			while($a<=$cm){ $b=$a++; $c = $this->sponsorPerMonth($b);
			$range .= $c.', ';
			}

			return $range;
	}

//maximum monthly entry// $tim = max(explode(",", $profile->monthUserSponsor()));
	function maxMonthly(){
		$max = max(explode(",", $this->monthEntryData()));
		return $max;
	}



	//maximum monthly entry total for all users //
	function maxMonthlyTotal(){
		$max = max(explode(",", $this->monthEntryDataTotal()));
		return $max;
	}

//Calculate total monthly entry
function entryPerMonth($month){
	global $db;
	$num = 0;
	$sql=$db->query("select * FROM user " )or die(mysqli_error());
	while($row = mysqli_fetch_assoc($sql)){
$tim = (int)substr($row['created'],5,2); 
if($tim==$month){$num += 1;	}
}
return $num;
}



		function monthDownlines($month){
				global $db,$userKey;
				$randomKey = $this->userName('sn');
			$a = 1;  $num = 0;
			while($a<=10){$b = $a++; $gen = 'a'.$b; 
			$sql=$db->query("select * FROM user WHERE $gen = '$randomKey' " )or die(mysqli_error());
			while($row = mysqli_fetch_assoc($sql)){
$tim = (int)substr($row['created'],5,2); 
if($tim==$month){$num += 1;	}
}	
			}
			return $num;	
			}

    function monthSavings($month){
        global $db,$userKey;
        $num = 0;
        $sql=$db->query("select * FROM savings2 WHERE userid = '$userKey' " )or die(mysqli_error());
        while($row = mysqli_fetch_assoc($sql)){
            $tim = date('m',$row['paid']);
            if($month == $tim){$num += $row['amount'];	}
        }
        return $num;
    }
    function monthLoans($month){
        global $db,$userKey;
        $num = 0;
            $sql=$db->query("select * FROM loantranch WHERE id = '$userKey' AND paid != 0 " )or die(mysqli_error());
            while($row = mysqli_fetch_assoc($sql)){
                $tim = (int)substr($row['created'],5,2);
                if($month == $tim){$num += $row['tranch'];	}
            }
        return $num;
    }

	function monthPotential($month){
				global $db;
				if($month<10){$month='0'.$month;}
				$month = date('Y').$month;
				$randomKey = $this->userName('sn');
			$a = 1;  $num = 0;
			while($a<=10){$b = $a++; $gen = 'a'.$b; 
			$sql=$db->query("select * FROM user WHERE $gen = '$randomKey' " )or die(mysqli_error());
			while($row = mysqli_fetch_assoc($sql)){
$tim = date('Ym',strtotime($row['created'])); 
if($tim<=$month){$num += 1;	}
if($tim<=$month AND $row['sponsor']==$randomKey){$num += 3;	}
}	
			}
			return number_format(($num*0.1*($this->levelRate()/1000)),1);	
			}






//Calculate the amunt of members sponsored by a user monthly
function sponsorPerMonth($month){
	global $db;
	$randomKey = $this->userName('sn');
	$num = 0;
	$sql=$db->query("SELECT * FROM user WHERE sponsor = '$randomKey' " )or die(mysqli_error());
	while($row = mysqli_fetch_assoc($sql)){
$tim = (int)substr($row['created'],5,2); 
if($tim==$month){$num += 1;	}
}
return $num;
}

	//user Rank		
			
	function Rank($user){
			if($this->Downlines()<3){$rank = 0;}elseif($this->Downlines()<12){$rank = 1;}elseif($this->Downlines()<39){$rank = 2;}elseif($this->Downlines()<120){$rank = 3;}elseif($this->Downlines()<363){$rank = 4;}elseif($this->Downlines()<1092){$rank = 5;}elseif($this->Downlines()<3279){$rank = 6;}elseif($this->Downlines()<9840){$rank = 7;}elseif($this->Downlines()<29523){$rank = 8;}elseif($this->Downlines()<88572){$rank = 9;}else{$rank = 10;}
	return $rank;
	}
	
	//Bonus Types
	function matrixB(){
		global $id;
	return $this->Downlines()*$this->percent()/$this->dola;	
	}
	
	function referalB(){
	global $id;
		return $this->Sponsored()*$this->percent()/$this->dola;	
	}
	
		function pointB(){
	global $id;
		return $this->Point()*$this->percent(1)/$this->dola;	
	}
	
	function percent($p=5){
	return	$this->amount*$p/100;
	}

	//Withdrawal Methods

function totalEarning(){
	return $this->referalB()+$this->matrixB();
}

function confirmedWithdraw(){
	global $db,$userKey,$key;
	$key = md5($userKey);
	$status = STATUSALPHA;
	
	$sql = $db->query("SELECT amount FROM withdraw WHERE id2 = '$key' AND status = '$status' ");
	$amt = 0;
	while($row = mysqli_fetch_assoc($sql)){
		$amt += $row['amount'];
	}
	return $amt; 
}





function userWithdraw(){
	
	return $this->confirmedWithdraw()+$this->pendingWithdraw(); 
}


function pendingWithdraw(){
global $db,$userKey;
	$key = md5($userKey);
	$status = STATUSBETA;
	
	$sql = $db->query("SELECT amount FROM withdraw WHERE id2 = '$key' AND status = '$status' ");
	$amt = 0;
	while($row = mysqli_fetch_assoc($sql)){
		$amt += $row['amount'];
	}
	return $amt; 
}

function accountBalance(){
	return $this->totalEarning()-$this->confirmedWithdraw()-$this->pendingWithdraw();
}


	function possibleEpin(){
		return (int)($this->accountBalance()/$this->dolafee);
	}

function loanStatus(){
global $db,$userKey;

$sql = $db->query("SELECT * FROM loan WHERE id='$userKey' ORDER BY sn DESC LIMIT 1"); 
$num = mysqli_num_rows($sql);
if($num>0){
$row = mysqli_fetch_assoc($sql);
$res = $row['status'];
}else{$res=0;}

	return $res;
}

function loanAccountStatus($acc,$opt='status'){
global $db;

$sql = $db->query("SELECT * FROM loan WHERE trno='$acc' "); 
$row = mysqli_fetch_assoc($sql);
return $row[$opt];
}

function investAccountStatus($acc,$opt='status'){
global $db;

$sql = $db->query("SELECT * FROM invacc WHERE trno='$acc' "); 
$row = mysqli_fetch_assoc($sql);
return $row[$opt];
}

function loanInst($loan){
if($loan<=50000){ $instalment = 6;  }  //4 months
elseif($loan<=100000){$instalment = 10;} //6 months
elseif($loan<=300000){$instalment = 14;} //8 months
elseif($loan<=500000){$instalment = 22;} //12 months
elseif($loan<=1000000){$instalment = 34;} //18 months
else{$instalment = 46;} //24 months
	return $instalment;
}


function ApproveLn(){
	global $db,$report;
$loan = $_POST['approveloan'];
$duration = $_POST['duration'];
$trno = $_POST['ApproveLn'];

$interest = $this->loanInterest($loan,$duration);

 
$sql = $db->query("UPDATE loan SET loan='$loan', instalment='$duration', interest='$interest', status=2 WHERE trno='$trno' "); 
$report = 'Your loan of NGN'.number_format($loan).' has been approved. Pay the processing fee to get the loan';
//sendSms($report,$phone,$userID);
return;
}


function approveLoan(){
	global $db,$report,$count;
$trno = $_POST['approveLoan'];
$adminCode = $_POST['adminCode'];
	$sql=$db->query("SELECT * FROM loan WHERE trno = '$trno' ");
	$row = mysqli_fetch_assoc($sql);
	$loan = $row['loan'];
	$interest = $row['interest'];
	$userID = $row['id'];
	$phone = $this->wildUserNameKey($userID,'phone');
$instalment = $row['instalment'];
$interval = 60*60*24*30; //do days
$repayment = $loan+$interest;

$tranch = $repayment/$instalment;
$tranch = (int)($tranch/100)*100;
$fillup = $repayment-($tranch*$instalment);
$date = CTIME;

$pass = $this->userName('pass');
		if(password_verify($adminCode, $pass)){

for ($a=1; $a<=$instalment; $a++){
	$payon = $date+$interval+($interval*$a);
	$tranch = ($a==$instalment) ? $tranch+$fillup : $tranch;
	
$sql=$db->query("INSERT INTO loantranch (trno,id,loan,tranch,instal,start) VALUES ('$trno','$userID','$loan','$tranch','$a','$payon')");
} 
$sqll = $db->query("UPDATE loan SET start='$date', status=4 WHERE trno='$trno' "); 
$report = 'Your loan of NGN'.number_format($loan).' has been approved and credited to your bank account.';
//sendSms($report,$phone,$userID);
}
else{
	$report='Admin authentication failed';
	$count=1;
}
return;
}



function countUserInv1($id){
	global $db;
	$sql=$db->query("SELECT * FROM invacc WHERE userid='$id' AND status = 1 ");
    return mysqli_num_rows($sql);
}

function InitiateInvestment(){
	global $db,$report,$count,$userKey;
$amount = $_POST['amount'];
$period = $_POST['duration'];
$roi = $amount*$period*INVESTINT;

$trno = win_hash(12);

if($this->countUserInv1($userKey)==0){

	
$sql=$db->query("INSERT INTO invacc (trno,amount,roi,userid,tenure) VALUES ('$trno','$amount','$roi','$userKey','$period')"); 
if($sql){
$report = 'Your investment of NGN'.number_format($amount).' has been successfully initiated. Proceed to make payment online or contact administrator to make direct payment';
//sendSms($report,$phone,$userID);
}else{$report='unable to process request'; $count=1;}
}else{$report='You need to make payment for investment already initiated before you can initiate a new one'; $count=1;}
return;
}


function sKeyToPeriod($key){$p ='';
	if($key==1){$p ='Daily';}
	elseif($key==2){$p ='Weekly';}
	elseif($key==3){$p ='Monthly';}
	return $p;
}

function InitiateSavings(){
	global $db,$report,$count,$userKey; 
$amount = $_POST['amount'];
$period = $_POST['duration'];
$startdate = strtotime($_POST['startdate']);
$enddate = strtotime($_POST['enddate']);
//$roi = $amount*$period*INVESTINT;

$trno = win_hash(12);

//if($this->countUserInv1($userKey)==0){

	
$sql=$db->query("INSERT INTO savings (trno,amount,period,userid,startdate,enddate) VALUES ('$trno','$amount','$period','$userKey','$startdate','$enddate')"); 
if($sql){
$report = 'Your savings of NGN'.number_format($amount).' '.$this->sKeyToPeriod($period).', has been successfully initiated';
//sendSms($report,$phone,$userID);
}else{$report='unable to process request'; $count=1;}
//}
//else{$report='You need to make payment for investment already initiated before you can initiate a new one'; $count=1;}
return;
}

function trackPaid($userKey,$trackdate)
{
  global $db;

  $sql = $db->query("SELECT * FROM savings2 WHERE userid='$userKey' AND date = '$trackdate'");
return mysqli_num_rows($sql);
}

function trackSavings($userKey)
{
  global $db;

  $sql = $db->query("SELECT * FROM savings WHERE userid='$userKey' ");
return mysqli_num_rows($sql);
}

function trackSavingsPay($userKey)
{
  global $db;

  $sql = $db->query("SELECT * FROM savings2 WHERE userid='$userKey' ");
return mysqli_num_rows($sql);
}

     function attStatus($id,$ymd){
       global $db;
$qur=$db->query("SELECT * FROM savings2 WHERE userid='$id' AND date = '$ymd' ")or die(mysqli_error());
        $r=mysqli_num_rows($qur);   
    return $r;   
     }

function PayMultiple(){
	global $db,$report,$count;

	$userKey = $_POST['userKey'];
$id = $_POST['selector'];
//$userid = $_POST['PayMultiple'];
$amount = $_POST['amount'];

$time = CTIME;
$N = count($id);
for($i=0; $i < $N; $i++)
{

  $idx = $id[$i];
  if($this->attStatus($userKey,$idx)==0){
$sql=$db->query("INSERT INTO savings2 (amount,date,paid,userid) VALUES ('$amount','$idx','$time','$userKey')"); 
}
}

$report='successfully completed Transaction for '.$N.' days'; 

return;
}



function processLoan($loan){
	global $db,$userKey;
$instalment = $_SESSION['duration'];
$interest = $this->loanInterest($loan,$instalment);

$date = CTIME;
$trno = win_hash(12);
$subject='Loan Application';
$msg = 'Loan application successfully submitted for approval. You will be notified as soon as it is approved';
$this->userMsg($userKey,$subject,$msg);
$sql=$db->query("INSERT INTO loan (trno,id,loan,instalment,interest) VALUES ('$trno','$userKey','$loan','$instalment','$interest')");
//$sqll = $db->query("UPDATE user SET a19='', a20='' WHERE id='$userKey' ");
/*
for ($a=1; $a<=$instalment; $a++){
	$payon = $date+($interval*$a);
	$tranch = ($a==$instalment) ? $tranch+$fillup : $tranch;
	
$sql=$db->query("INSERT INTO loantranch (trno,id,loan,tranch,instal,start) VALUES ('$trno','$userKey','$loan','$tranch','$a','$payon')");
}  */
unset($_SESSION['loan']);
return;
}

    function totalSavings($opt=1){
        global $db,$userKey;
        $amount = 0;

        if($opt==1) {
            $sql = $db->query("SELECT * FROM savings2 WHERE userid='$userKey'");
            while ($row = mysqli_fetch_assoc($sql)) {
                $amount += $row['amount'];
            }
        }
        elseif($opt==2){
            $sql = $db->query("SELECT * FROM savings WHERE userid='$userKey'");
            $row = $sql->fetch_assoc();
            $amount = $row['period'];

        }
        elseif($opt==3){
            $sql = $db->query("SELECT * FROM savings WHERE userid='$userKey'");
            $row = $sql->fetch_assoc();
            $amount = $row['amount'];

        }


        return $amount;
    }
    function investmentStat($opt=1,$col='a'){
        global $db,$userKey;
        $amount = 0;
        $roi = 0;
        $val = '';
        if($opt==1) {
            $sql = $db->query("SELECT * FROM invacc WHERE userid='$userKey' AND status = 2 ");
            while ($row = mysqli_fetch_assoc($sql)) {
                $amount += $row['amount'];
                $roi += $row['roi'];
            }
        }elseif($opt==2) {
            $sql = $db->query("SELECT * FROM invacc WHERE status=2");
            while ($row = mysqli_fetch_assoc($sql)) {
                $amount += $row['amount'];
                $roi += $row['roi'];
            }
        }

        $val = ($col=='a')?$amount:$roi;

        return $val;
    }

function loanStat($opt=''){
global $db,$userKey;
$loan = 0;
$sql = $db->query("SELECT * FROM loan WHERE id='$userKey' AND start != 0 "); 
while($row = mysqli_fetch_assoc($sql)){
$loan += $row['loan'];
}

$unpaid = $this->unpaidLoan();
$paid = $loan-$unpaid;

if($opt==1){	return $paid; }elseif($opt==2){	return $unpaid; }else{return $loan;}
}


function loanKeys($trno,$opt='id'){
global $db;

$sql = $db->query("SELECT * FROM loan WHERE trno='$trno' "); 
$row = mysqli_fetch_assoc($sql);
$option = $row[$opt];

return $option; 
}


function unpaidLoan($opt=''){
global $db,$userKey;
$unpaid = 0;
$sql = $db->query("SELECT * FROM loantranch WHERE id='$userKey' AND paid = 0 "); 
while($row = mysqli_fetch_assoc($sql)){
$unpaid += $row['tranch'];
} 
	return $unpaid;
}


function wildPaidLoan($trno){
global $db;
$paid = 0;
$sql = $db->query("SELECT * FROM loantranch WHERE trno='$trno' AND paid > 100000000 "); 
while($row = mysqli_fetch_assoc($sql)){
$paid += $row['tranch'];
} 
	return $paid;
}




function payTranch(){
global $db,$count,$report,$userKey;
$paid = CTIME;
if($_GET['trk_reference']==$_SESSION['ref']){
	$tranchno = $this->nextCountdown(3); 
	$reference = $_SESSION['random'];
	$sql=$db->query("UPDATE loantranch SET paid = '$paid', reference = '$reference' WHERE sn = '$tranchno' " )or die(mysqli_error()); 
	$_SESSION['pay_status']='Last Payment Transaction was successful';
	header("location: ?status=Payment-Successful");
	}else{ 	$_SESSION['pay_status']='Sorry! Payment Not Successful';
	$report = 'Sorry! Payment Not Successful';  $count=1;}
return;
}


function payTranchAdmin(){
global $db,$count,$report,$userKey;
$paid = CTIME;
	$tranchno = $_POST['payLoanAdmin'];
	$adminCode = $_POST['adminCode']; 
	$reference = $userKey;
	$pass = $this->userName('pass');
		if(password_verify($adminCode, $pass)){
	$sql=$db->query("UPDATE loantranch SET paid = '$paid', reference = '$reference' WHERE sn = '$tranchno' " )or die(mysqli_error()); 	
	$report='Last Payment Transaction was successful';
}
else{ $report = 'Sorry! Payment Not Successful';  $count=1;}
return;
}


function payInvestAdmin(){
global $db,$count,$report,$userKey;
$paid = CTIME;
	$trno = $_POST['payInvestAdmin'];
	$adminCode = $_POST['adminCode']; 
	$reference = $userKey;
	$tan = $paid + $this->investAccountStatus($trno,'tenure')*60*60*24*30;
	$pass = $this->userName('pass');
		if(password_verify($adminCode, $pass)){
	$sql=$db->query("UPDATE invacc SET status = 2, cos = '$paid', tan='$tan' WHERE trno = '$trno' " )or die(mysqli_error()); 	
	$report='Payment Transaction was successful';
}
else{ $report = 'Authentication Failed! Payment Not Successful ';  $count=1;}
return;
}




function unapprovedLoan($opt=''){
global $db,$userKey;
$unpaid = 0;
$sql = $db->query("SELECT * FROM loan WHERE id='$userKey' AND start = 0 "); 
$num = mysqli_num_rows($sql);

if($num>0){$res=TRUE;}else{$res=FALSE;}
	return $res;

}

///Loan Management
	function selectLoan($opt=''){
		global $report, $count;
if(!isset($_SESSION['loan'])){$_SESSION['loan'] = 0;} 
$loan = isset($_POST['selectLoan']) ? $_POST['selectLoan'] : $_SESSION['loan'];
if(isset($_POST['duration'])){$_SESSION['duration'] = $_POST['duration'];}
elseif(isset($_SESSION['duration'])){$_SESSION['duration'] = $_SESSION['duration'];}
else{$_SESSION['duration']=1;}

$loan = (int)($loan/1000)*1000;
$_SESSION['loan'] = $loan; 
$duration = $_SESSION['duration'];  
$accessible = 200000;//(int)($this->Potential()/1000)*1000;
$table = '';
if($this->Potential()>0){ $table='You are not yet eligible for loan! increase your referral points to 15 to start accessing loan'; $report='You are not yet eligible for loan! increase your referral points to qualify'; $count=1;}
elseif($loan<10000){$report='You have entered an invalid amount. The minimum accessible loan is ₦10,000'; $count=1; $table='';}
elseif($this->unpaidLoan()>0){$report='You have unpaid loan of ₦'.number_format($this->unpaidLoan()).'. You have to clear all unpaid loan before you can access new loan'; $count=1; $table='You have to clear all unpaid loan before you can access new loan'; $_SESSION['loan']=0;}
elseif($this->unapprovedLoan()==TRUE){$report='Your last loan application is awaiting approval. Processing may take up to 48 hours. Please be patient'; $count=1; $table='Your last loan application is awaiting approval.'; $_SESSION['loan']=0;}
elseif($loan > $accessible){$report='You have entered an invalid amount. your maximum accessible loan is ₦'.number_format($accessible); $count=1; $table='';}
else{
$instalment = $duration;//$this->loanInst($loan);
$interval = 60*60*24*30; //two weeks
$repayment = $loan+$this->loanInterest($loan,$duration);

$tranch = $repayment/$instalment;
$tranch = (int)($tranch/100)*100;


$fillup = $repayment-($tranch*$instalment);
$date = CTIME;

for ($a=1; $a<=$instalment; $a++){
   $payon = $date+($interval*$a);
	$tranch = ($a==$instalment) ? $tranch+$fillup : $tranch;
	$table .= '<tr><td>'.$this->Th($a).'</td><td>'.date('d M, Y',$payon).'</td><td>₦'.number_format($tranch).'</td></tr>';

}
$table .= '<tr><td colspan="2">Total Repayment</td><td>₦'.number_format($repayment).'</td></tr>';
if($opt==1){
	$table = '<br><strong>Loan Statistics</strong>
	<table class="table table-hover"><tr><td>Requested Loan</td><td> ₦'.number_format($loan).'</td></tr>
			  <tr><td>Interest on Loan</td><td> ₦'.number_format($this->loanInterest($loan,$duration)).'</td></tr>
			  <tr><td>Expected Repayment</td><td> ₦'.number_format($repayment).'</td></tr>
			  <tr><td>No of Instalments</td><td> '.$instalment.' </td></tr>
			  <tr><td>Instalment Intervals</td><td> 30 Days</td></tr>
			  <tr><td>Repayment Period</td><td> '.$instalment.' Month(s)</td></table>';

}
}

return $table;
	}

function loanInterest($loan,$duration){
return $loan*$duration*LOANINT;
}
	function loanRepayment(){
	global $db,$userKey;
	$trId = $this->nextCountdown(4);
	$loan = $this->nextCountdown(5);
	$unpaid = $this->unpaidLoan();
	$paid = $loan-$unpaid;
$table = ''; $sum=0;
$sql = $db->query("SELECT * FROM loantranch WHERE id='$userKey' AND paid = 0 "); 
while($row = mysqli_fetch_assoc($sql)){ $sum += $row['tranch'];
$table .= '<tr><td>'.$this->Th($row['instal']).'</td><td>'.date('d M, Y',$row['start']).'</td><td>₦'.number_format($row['tranch']).'</td><td><button class="btn btn-primary btn-sm" name="payLoan" >Pay</button></td></tr>';
} 

$sql = $db->query("SELECT * FROM loantranch WHERE id='$userKey' AND trno = '$trId' AND paid > 100000000 "); 
while($row = mysqli_fetch_assoc($sql)){ $sum += $row['tranch'];
$table .= '<tr><td>'.$this->Th($row['instal']).'</td><td>'.date('d M, Y',$row['start']).'</td><td>₦'.number_format($row['tranch']).'</td><td>Paid on '.date('d M, Y',$row['paid']).'</td></tr>';
} 
$table .= '<tr><th colspan="4">Loan Statistics</th></tr>
<tr><td>Loan</td><td colspan="3">₦'.number_format($sum).'</td></tr>
<tr><td>Paid</td><td colspan="3">₦'.number_format($sum-$unpaid).'</td></tr>
<tr><td>Balance</td><td colspan="3">₦'.number_format($unpaid).'</td></tr>';
return $table;
	}


function timeToDays($diff){
$days = $diff/86400;
return (int)$days;
}

function loanReminder(){
	global $db;

$sql = $db->query("SELECT * FROM loantranch WHERE paid=0 "); 
while($row = mysqli_fetch_assoc($sql)){
	$name = $this->wildUserNameKey($row['id']);
	$phone = $this->wildUserNameKey($row['id'],'phone');
	$tranch = $this->Th($row['instal']);
	$diff = $row['start']-CTIME;
	$status = ($diff>0) ? TRUE : FALSE;
	if($status==TRUE AND $this->timeToDays($diff)<=3){ $sms = 'Dear '.$name.', the '.$tranch.' tranch (NGN'.number_format($row['tranch']).') of your loan will be due for payment by '.date('M d, Y',$row['start']).'. Pls pay before this date. BFN '.CPHONE;
	sendSms($sms,$phone,$row['id']);
	 }elseif($status==FALSE){$sms = 'Dear '.$name.', we have been expecting payment of the '.$tranch.' tranch (NGN'.number_format($row['tranch']).') of your loan since '.date('M d, Y',$row['start']).'. Pls pay on time. BFN '.CPHONE ;
sendSms($sms,$phone,$row['id']);
}
//if(isset($sms)){sendSms($sms,$phone,$row['id']); }
}
return;
}




	function nextCountdown($opt=''){
		global $db,$userKey;

$sql = $db->query("SELECT * FROM loantranch WHERE id='$userKey' AND paid = 0 ORDER BY sn ASC LIMIT 1"); 
$row = mysqli_fetch_assoc($sql);
$lapse = $row['start']-CTIME;
$abs = abs($lapse);
$tr_charges = ($row['tranch']*0.015)+100;
if($lapse>0){ $col = 'primary'; $left = ' left';}else{$col='danger'; $left = ' late';} 
$span = '<span  class="text-'.$col.'">'.time_left($abs).'<small>'.$left.'</small></span>';
if($opt==1){return $row['tranch']; }elseif($opt==2){return $this->Th($row['instal']); }elseif($opt==3){return $row['sn']; }elseif($opt==4){return $row['trno']; }elseif($opt==5){return $row['loan']; }elseif($opt==6){return $tr_charges; }else{return $span; }
}


function Th($opt){
if($opt==1){$th='First';}elseif($opt==2){$th='Second';}elseif($opt==3){$th='Third';}elseif($opt==4){$th='Fourth';}elseif($opt==5){$th='Fifth';}elseif($opt==6){$th='Sixth';}elseif($opt==7){$th='Seventh';}elseif($opt==8){$th='Eight';}elseif($opt==9){$th='Ninth';}elseif($opt==10){$th='Tenth';}elseif($opt==11){$th='Eleventh';}elseif($opt==12){$th='Twelfth';} else{ if($opt==21 OR $opt ==31 OR $opt==41){$th=$opt.'st';}elseif($opt==22 OR $opt ==32 OR $opt==42){$th=$opt.'nd';} elseif($opt==231 OR $opt ==33 OR $opt==43){$th=$opt.'rd';} else{$th=$opt.'th';}  }
return $th;
}



function automateProFee(){
	global $db,$userKey;
	$acc = $_GET['txref'];
	$sql = $db->query("UPDATE loan SET status=3 WHERE trno='$acc' "); 
	header("location: loanstatus.php");
}

// Authenticate OTP and request loan
function processLoanIni(){
    global $db, $report,$count; $userKey;
    
	$term = (($_POST['q1']+$_POST['q2']+$_POST['q3'])==3) ? TRUE : FALSE;
	$authentic = $this->userName('pass');
$loan = $_SESSION['loan'];
if($term==FALSE){$report='Sorry, you need to agree with our terms to access this loan'; $count=1; }
elseif(checkPass($_POST['enterOTP'])){$this->processLoan($loan);
$report = 'Loan application successfully submitted for approval. You will be notified as soon as it is approved';

}
 else{
$report='Sorry, authentication failed. You can try again or call our customer care on '.CPHONE; $count=1; 
}
return;
}



///request OTP
//
function requestOTP(){
	global $db,$report,$userKey;
$otp = win_hashs(4);
$int = 54000;  //Expire in 15 minutes time
$expiry = CTIME+900;
$expirydate = date('d-m-Y h:iA',$expiry);
$phone = $this->userName('phone');
$loan = $_SESSION['loan'];
$sms = 'Your requested OTP for processing NGN'.number_format($loan).' loan is '.$otp.'. This OTP will expire by: '.$expirydate ;
$sql = $db->query("UPDATE user SET a19='$expiry', a20='$otp' WHERE id='$userKey' ");
sendSms($sms,$phone,$userKey);
$report = 'The requested One Time Password (OTP) has been sent to '.substr($phone,0,5).'******. Note that it will expire in 15 minutes time';
return;
}






function loanApplications($opt=1){
	global $db;
		$sql=$db->query("SELECT * FROM loan WHERE  status = '$opt' ");
	//if($opt==2){$sql=$db->query("SELECT * FROM loan WHERE start = 0 AND status = '$opt' ");}
	//elseif($opt==3){$sql=$db->query("SELECT * FROM loan WHERE start = 0 AND status = '$opt' ");}
	//elseif($opt==4){$sql=$db->query("SELECT * FROM loan WHERE start != 0 AND status = '$opt' ");}

	$a = 1;
	$table = '<table class="table"><thead>
	<tr><th>SN</th><th>Application No</th><th>Loan</th><th>User</th><th>Account No</th><th>Bank</th><th>Account Name</th><th>Action</th></tr>
	</thead><tbody>';
while($row = mysqli_fetch_assoc($sql)){  $b=$a++;		
	$btn = ($opt=='') ? '<button class="btn btn-primary" name="approveLoan" value="'.$row['trno'].'">Approve Loan</button>' : '₦'.number_format($this->wildPaidLoan($row['trno']));


	$table .= '<tr><td>'.$b.'</td><td><a href="?tr_k='.$row['trno'].'">'.$row['trno'].'</a></td><td>₦'.number_format($row['loan']).'</td><td>'.$this->wildUserNameKey($row['id']).'</td><td>'.$this->wildUserNameKey($row['id'],'accountno').'</td><td>'.$this->wildUserNameKey($row['id'],'bank').'</td><td>'.$this->wildUserNameKey($row['id'],'accname').'</td><td> <form method="post">'.$btn.'</form></td></tr>'; 
}
$table .= '</tbody></table>';
return $table; 
}


function InvestApplications($opt=1){
	global $db;
		$sql=$db->query("SELECT * FROM invacc WHERE  status = '$opt' ");
	//if($opt==2){$sql=$db->query("SELECT * FROM loan WHERE start = 0 AND status = '$opt' ");}
	//elseif($opt==3){$sql=$db->query("SELECT * FROM loan WHERE start = 0 AND status = '$opt' ");}
	//elseif($opt==4){$sql=$db->query("SELECT * FROM loan WHERE start != 0 AND status = '$opt' ");}

	$a = 1;
	$table = '<table class="table"><thead>
	<tr><th>SN</th><th>Applicatioin No</th><th>Investment Amount</th><th>Tenure</th><th>ROI</th><th>Total Return</th><th>Customer Name</th><th>Phone Number</th></tr>
	</thead><tbody>';
while($row = mysqli_fetch_assoc($sql)){  $b=$a++;		
	$btn = ($opt=='') ? '<button class="btn btn-primary" name="approveLoan" value="'.$row['trno'].'">Approve Loan</button>' : '₦'.number_format($this->wildPaidLoan($row['trno']));


	$table .= '<tr><td>'.$b.'</td><td><a href="?tr_k='.$row['trno'].'">'.$row['trno'].'</a></td><td>₦'.number_format($row['amount']).'</td><td>'.$row['tenure'].' months</td><td>₦'.number_format($row['roi']).'</td><td>₦'.number_format($row['amount']+$row['roi']).'</td><td>'.$this->wildUserNameKey($row['userid']).'</td><td>'.$this->wildUserNameKey($row['userid'],'phone').'</td></tr>'; 
}
$table .= '</tbody></table>';
return $table; 
}


function loanSt($st){
	if($st==1){$status='Awaiting Approval';}
	elseif($st==2){$status='Awaiting Aceeptance';}
	elseif($st==3){$status='Awaiting Disbursement';}
	elseif($st==4){$status='Loan Disbursed';}
	elseif($st==5){$status='Loan Expired';}
return $status;
}

function userLoanAction($id){
	global $db;
		$sql=$db->query("SELECT * FROM loan WHERE  id = '$id' ORDER BY sn DESC ");
	
	$a = 1;
	$table = '<table class="table"><thead>
	<tr><th>SN</th><th>Date</th><th>Loan</th><th>Interest</th><th>Repayment</th><th>Process Fee</th><th>Tenure</th><th>Status</th><th>Action</th></tr>
	</thead><tbody>';
while($row = mysqli_fetch_assoc($sql)){  $b=$a++;		
	$btn = ($row['status']==2) ? '<a href="?pay_fee='.rand().'" class="btn btn-primary" name="payProcessFee" value="'.$row['trno'].'">Pay Processing Fee</a>' : '₦'.number_format($this->wildPaidLoan($row['trno']));


	$table .= '<tr><td>'.$b.'</td><td>'.$row['created'].'</td><td>₦'.number_format($row['loan']).'</td><td>₦'.number_format($row['interest']).'</td><td>₦'.number_format($row['interest']+$row['loan']).'</td><td>₦'.number_format($row['loan']*PROFEE).'</td><td>'.$row['instalment'].' Month(s)</td><td>'.$this->loanSt($row['status']).'</td><td> <form method="post">'.$btn.'</form></td></tr>'; 
}
$table .= '</tbody></table>';
return $table; 
}




	function loanRepayStatus(){
	global $db;
	$trId = isset($_GET['tr_k']) ? $_GET['tr_k'] : '';
	$id = $this->loanKeys($trId);
	$loan = $this->loanKeys($trId,'loan');
	$paid = 0;
	$sum=0;

$table = 'Beneficiary: '.$this->wildUserNameKey($id);
$table .= '<table class="table table-hover"><thead>
	<tr><th>Instalment</th><th>Due Date</th><th>Amount</th><th>Action</th></tr>
	</thead><tbody>';
$sql = $db->query("SELECT * FROM loantranch WHERE trno='$trId' AND paid = 0 "); 
while($row = mysqli_fetch_assoc($sql)){ $sum += $row['tranch'];
$table .= '<tr><td>'.$this->Th($row['instal']).'</td><td>'.date('d M, Y',$row['start']).'</td><td>₦'.number_format($row['tranch']).'</td><td><button class="btn btn-primary btn-xs" value="'.$row['sn'].'" name="tranchS" >Pay Loan</button></td></tr>';
} 

$sql = $db->query("SELECT * FROM loantranch WHERE trno = '$trId' AND paid > 100000000 "); 
while($row = mysqli_fetch_assoc($sql)){
	$paid += $row['tranch'];
$table .= '<tr><td>'.$this->Th($row['instal']).'</td><td>'.date('d M, Y',$row['start']).'</td><td>₦'.number_format($row['tranch']).'</td><td>Paid on '.date('d M, Y',$row['paid']).'</td></tr>';
} 
$table .= '<tr><td colspan="4">Total: ₦'.number_format($sum).' | Paid: ₦'.number_format($paid).' | Balance: ₦'.number_format($sum-$paid).'</td></tr>';

$table .= '</tbody></table>';

return $table;
	}



function payLoan(){
$_SESSION['payloan']=TRUE;
}






function adminLevel(){

	if($this->userName('sn')==1){
		return TRUE;
	}else{return FALSE;}
}
	function decryptKey($key){
		global $db;
	$que=$db->query("select * FROM user WHERE sha1(sn) = '$key' " )or die(mysqli_error());
					$ro=mysqli_fetch_array($que);
					return $ro['sn'];	
	}

	

	function gTree(){
global $db,$key;
$level = $this->Level();
//if($level==0){$show = 1;}elseif($level<=2){$show = 2;}else{
	$show = 2;
//}

				$randomKey = isset($_GET['tree']) ? $this->decryptKey($_GET['tree']) : $this->userName('sn');
				$waiting = ($this->wildSponsored($randomKey)<5) ? 'userw.png' : 'user.png';//Indicate waiting user with < 5 sponsored
				

				$code='chart_config = [
        config, a'.$randomKey.', ';

				$tree='var config = {
        container: "#basic-example",
        
        connectors: {
            type: "step"
        },
        node: {
            HTMLclass: "nodeExample1"
        }
    },';
				$tree.='a'.$randomKey.' = {
        text: {
            name: "'.$this->wildUserName($randomKey,'user').'",
           title: "Points: '.$this->wildPoint($randomKey).'",
            contact: "Level: '.$this->wildLevel($randomKey).'",
        },
        link: {
            href: ""
        },
        image: "../images/'.$waiting.'"
    },';  

			$a = 1; $x = 1; $c=0; $nu = 0;
			while($a<=$show){$b = $a++; $gen = 'a'.$b; 
			$qu=$db->query("SELECT * FROM user WHERE $gen = '$randomKey' " )or die(mysqli_error());
			while($row = mysqli_fetch_assoc($qu)){
			$user = $row['sn'];
			//$stage = $this->wildLevel2($row['sn'],2);
			$wait = ($this->wildSponsored($row['sn'])<5) ? 'userw.png' : 'user.png';//Indicate waiting user with < 5 sponsored
			$name = $this->wildUserName($row['sn'],'user');
			$code .= 'a'.$row['sn'].', ' ;
				$tree .= 'a'.$row['sn'].' = {
        parent: a'.$row['a1'].',
        text:{
            name: "'.$name.'",
            title: "Points: '.$this->wildPoint($row['sn']).'",
            contact: "Level: '.$this->wildLevel($row['sn']).'",
        },
        link: {
            href: "?tree='.sha1($row['sn']).'"
        },
    
        image: "../images/'.$wait.'"
    }, ';
				
			}	
			}
			$code .='];';
			
			return $tree.$code;
			}


	function investorExist($username){
		global $db,$report,$count;
			$sql=$db->query("SELECT * FROM user WHERE user = '$username' " )or die(mysqli_error()); 
$num=mysqli_num_rows($sql);
if($num==0){$res = FALSE; }else{$res = TRUE; }	
return $res;
	}



function createPin(){
	global $db,$signup,$userKey;
	$mode=(isset($_GET['mode']) && $_GET['mode']==32) ? 2 : 1;
	$investor=isset($_GET['investor']) ? $_GET['investor'] : '';
	$investuser=($this->investorExist($investor)==TRUE) ? $investor : 0;
	if(!empty($userKey)){
	$pin = strtoupper(win_hashs(10));
	$sql = $db->query("INSERT INTO pin(pin,rep,mode,investor) VALUES('$pin','$userKey','$mode','$investuser') ");
	}
	return; 
}

function  createMultiplePin(){
	global $report,$count;

$num=$_GET['pin-operations'];
for ($a = 1; $a<=$num; $a++){ 
	$this->createPin();
}
$report = $num.' PINs Created';
return;
}


function generateEpins(){
	$this->createMultiplePin();
	return;
}
	


function userProfileData($a){
    global $db; $id=$_SESSION['user_id'];
   //isset($_GET['user-ref'])?$id = $_GET['user-ref']:'';
	$sql=$db->query("SELECT * FROM user WHERE id = '$id' " )or die(mysqli_error()); 
$row=mysqli_fetch_assoc($sql);

$data = '                    <div class="col-md-4 col-xs-12">
                        <div class="white-box">
                            <div class="user-bg"> <img width="100%" alt="user" src="photo/'.$row['photo'].'"> </div>
                            <div class="user-btm-box">
                                <!-- .row -->
                                <div class="row text-center m-t-10">
                                    <div class="col-md-6 col-xs-6 b-r"><strong>Name</strong>
                                        <p>'.$row['firstname'].' '.$row['lastname'].'</p>
                                    </div>
                                    <div class="col-md-6 col-xs-6"><strong>Username</strong>
                                        <p>'.$row['user'].'</p>
                                    </div>
                                </div>
                                <!-- /.row -->
                                
                               
                                <!-- 
                                <hr>
                                <div class="row text-center m-t-10">
                                    <div class="col-md-6 col-xs-6 b-r"><strong>Sponsor</strong>
                                        <p>'.$this->wildUserName($row['sponsor']).'</p>
                                    </div>
                                    <div class="col-md-6 col-xs-6"><strong>Upline</strong>
                                        <p>'.$this->wildUserName($row['a1']).'</p>
                                    </div>
                                </div>
                                 -->

                                <hr>
                                <!-- .row -->
                                <div class="row text-center m-t-10">
                                    <div class="col-md-12"><strong>Email</strong>
                                        <p>'.$row['email'].'</p>
                                    </div>
                                </div>

                                <!-- <hr>
                                <div class="col-md-4 col-xs-4 text-center">
                                    <p class="text-purple">Level</p>
                                    <h2>'.$this->Level().'</h2> </div>
                                <div class="col-md-4 col-xs-4 text-center">
                                    <p class="text-blue">Points</p>
                                    <h2>'.$this->Point().'</h2> </div>
                                <div class="col-md-4 col-xs-4 text-center">
                                    <p class="text-danger">Team</p>
                                    <h2>'.$this->Downlines().'</h2> </div>-->
                            </div>
                        </div>
                    </div>';



                    $data2 = '<div class="col-md-8 col-xs-12">
                        <div class="white-box">
                            <!-- .tabs -->
                            <ul class="nav nav-tabs tabs customtab">
                                <li class="tab">
                                    <a href="#home" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-home"></i></span> <span class="hidden-xs">History</span> </a>
                                </li>
                                <li class="active tab">
                                    <a href="#profile" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-user"></i></span> <span class="hidden-xs">Profile</span> </a>
                                </li>
                                <li class="tab">
                                    <a href="#settings" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-cog"></i></span> <span class="hidden-xs">Edit Profile</span> </a>
                                </li>
                            </ul>
                            <!-- /.tabs -->
                            <div class="tab-content">
                                <!-- .tabs 1 -->
                                <div class="tab-pane" id="home">
                                <div id="messages">
          

            
                                   </div>
                                   </div>

                                <!-- /.tabs1 -->
                                <!-- .tabs2 -->
                                <div class="tab-pane active" id="profile">
                                    
                                    <h6 class="m-t-30">Profile Information</h6>
                                   <hr>
                                 
                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12"><b>Phone Number</b></div>
                                    <div class="col-md-7 col-xs-12">'.$row['phone'].'</div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12"><b>Gender</b></div>
                                    <div class="col-md-7 col-xs-12">'.$row['sex'].'</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12"><b>Birthday</b></div>
                                    <div class="col-md-7 col-xs-12">'.$row['dob'].'</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12"><b>Residential Address</b></div>
                                    <div class="col-md-7 col-xs-12">'.$row['address'].'</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12"><b>Office Address</b></div>
                                    <div class="col-md-7 col-xs-12">'.$row['officeaddress'].'</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12"><b>City/State</b></div>
                                    <div class="col-md-7 col-xs-12">'.$row['city'].', '.$row['state'].'</div>
                                    </div>
                                    <hr>

                                   

                                    <div class="row">
                                    <div class="col-md-12 col-xs-12"><h6 class="m-t-30"><b>Bank Account Details</b></h6></div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12"><b>Bank Name</b></div>
                                    <div class="col-md-7 col-xs-12">'.$row['bank'].'</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12"><b>Account Nunmber</b></div>
                                    <div class="col-md-7 col-xs-12">'.$row['accountno'].'</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12"><b>BVN</b></div>
                                    <div class="col-md-7 col-xs-12">'.$row['bvn'].'</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12"><b>Account Name</b></div>
                                    <div class="col-md-7 col-xs-12">'.$row['accname'].'</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-12 col-xs-12"><h6 class="m-t-30"><b>Referral Information</b></h6></div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12"><b>Referral ID</b></div>
                                    <div class="col-md-7 col-xs-12">'.$row['user'].'</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12"><b>Referral Link</b></div>
                                    <div class="col-md-7 col-xs-12">https://thegreatheights.com/?r='.$row['user'].'</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">Share on WhatsApp<br><br></div>
                                    <div class="col-md-7 col-xs-12"><a href="whatsapp://send?text=I am inviting your to join the Believers Family Network. We believe in Nigeria. We are teaming up to rebuild Nigeria and eradicate poverty through stratrgic re-orientation and business empowerment. Join us at @    
https://thegreatheights.com/?r='.$row['user'].'" data-action="share/whatsapp/share" class="btn btn-success">Share on WhatsApp</a></div>
                                    </div>
                                    <hr>

                                </div>
                                <!-- /.tabs2 -->
                                <!-- .tabs3 -->
                                <div class="tab-pane" id="settings">
                                    <form method="post" class="form-horizontal">
                                        <h5 class="m-t-30">Update Profile Information</h5>
                                    <hr>
                                        <div class="form-group">
                                            <label class="col-md-12">Surname</label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="" name="firstname" value="'.$row['firstname'].'" class="form-control"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="example-email" class="col-md-12">Other Names</label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="" value="'.$row['lastname'].'" class="form-control" name="lastname" id="example-email"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Phone Number</label>
                                            <div class="col-md-12">
                                                <input type="text" name="phone" value="'.$row['phone'].'" class="form-control"> </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-md-12">Gender</label>
                                            <div class="col-md-12">
                                                <input type="text" name="sex" value="'.$row['sex'].'" class="form-control"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Date of Birth</label>
                                            <div class="col-md-12">
                                                <input type="text" name="dob" value="'.$row['dob'].'" class="form-control"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Residential Address</label>
                                            <div class="col-md-12">
                                                <input type="text" name="address" value="'.$row['address'].'" class="form-control"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Office Address</label>
                                            <div class="col-md-12">
                                                <input type="text" name="officeaddress" value="'.$row['officeaddress'].'" class="form-control"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">City</label>
                                            <div class="col-md-12">
                                                <input type="text" name="city" value="'.$row['city'].'" class="form-control"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">State</label>
                                            <div class="col-md-12">
                                                <input type="text" name="state" value="'.$row['state'].'" class="form-control"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Name of Bank</label>
                                            <div class="col-md-12">
                                                <input type="text" name="bank" value="'.$row['bank'].'" class="form-control"> </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-12">Account Number</label>
                                            <div class="col-md-12">
                                                <input type="text" name="accountno" value="'.$row['accountno'].'" class="form-control"> </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-12">BVN</label>
                                            <div class="col-md-12">
                                                <input type="text" name="bvn" value="'.$row['bvn'].'" class="form-control"> </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-12">Account Name</label>
                                            <div class="col-md-12">
                                                <input type="text" name="accname" value="'.$row['accname'].'" class="form-control"> </div>
                                        </div>




                                         <div class="form-group">
                                            <div class="col-sm-12">
                                                <button type="submit" name="updateUserData" class="btn btn-success">Update User Data</button>
                                            </div>
                                        </div>

                                       
                                    </form>



                                     <form method="post" class="form-horizontal">
                                        <h5 class="m-t-30">Password Reset</h5>
                                    <hr>
                                        <div class="form-group">
                                            <label class="col-md-12">Old Password</label>
                                            <div class="col-md-12">
                                                <input type="password" placeholder="" name="currentpass" class="form-control"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="example-email" class="col-md-12">New Password</label>
                                            <div class="col-md-12">
                                                <input type="password" placeholder="" class="form-control" name="newpass" id="example-email"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Confirm Password</label>
                                            <div class="col-md-12">
                                                <input type="password" name="newpass2" class="form-control"> </div>
                                        </div>
                                         <div class="form-group">
                                            <div class="col-sm-12">
                                                <button type="submit" name="changePassword" class="btn btn-success">Reset Password</button>
                                            </div>
                                        </div>

                                       
                                    </form>



                                     <h5 class="m-t-30">Update Profile Photo</h5>
                                    <hr>
                                    <form method="post"  enctype="multipart/form-data">
                                    <div class="row">
                    <div class="col-sm-6 ol-md-6 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">Passport Size Photograph</h3>
                            <label for="input-file-max-fs">Maximum Size is 200kb</label>
                            <input type="file" name="image" id="input-file-max-fs" class="dropify" data-max-file-size="200K" required /> </div>
                    </div>
                </div>
                 <div class="form-group">
                                            <div class="col-sm-12">
                                                <button class="btn btn-success" name="updatePhoto">Update Photograph</button>
                                            </div>
                                        </div>


                                </div>
                                </form>
                                <!-- /.tabs3 -->
                            </div>
                        </div>
                    </div>';
	return $$a;
}




function userProfileDataSearch($a){
	global $db; $_SESSION['searchid'] = $_POST['userProfileDataSearch'];
	$id = $_SESSION['searchid'];
	$sql=$db->query("SELECT * FROM user WHERE md5(id) = '$id' " )or die(mysqli_error()); 
$row=mysqli_fetch_assoc($sql);

$data = '                    <div class="col-md-4 col-xs-12">
                        <div class="white-box">
                            <div class="user-bg"> <img width="100%" alt="user" src="photo/'.$row['photo'].'"> </div>
                            <div class="user-btm-box">
                                <!-- .row -->
                                <div class="row text-center m-t-10">
                                    <div class="col-md-6 col-xs-6 b-r"><strong>Name</strong>
                                        <p>'.$row['firstname'].' '.$row['lastname'].'</p>
                                    </div>
                                    <div class="col-md-6 col-xs-6"><strong>Username</strong>
                                        <p>'.$row['user'].'</p>
                                    </div>
                                </div>
                                <!-- /.row -->
                                
                               
                                <!-- 
                                <hr>
                                <div class="row text-center m-t-10">
                                    <div class="col-md-6 col-xs-6 b-r"><strong>Sponsor</strong>
                                        <p>'.$this->wildUserName($row['sponsor']).'</p>
                                    </div>
                                    <div class="col-md-6 col-xs-6"><strong>Upline</strong>
                                        <p>'.$this->wildUserName($row['a1']).'</p>
                                    </div>
                                </div>
                                 -->

                                <hr>
                                <!-- .row -->
                                <div class="row text-center m-t-10">
                                    <div class="col-md-12"><strong>Email</strong>
                                        <p>'.$row['email'].'</p>
                                    </div>
                                </div>

                                <!-- <hr>
                                <div class="col-md-4 col-xs-4 text-center">
                                    <p class="text-purple">Level</p>
                                    <h2>'.$this->Level().'</h2> </div>
                                <div class="col-md-4 col-xs-4 text-center">
                                    <p class="text-blue">Points</p>
                                    <h2>'.$this->Point().'</h2> </div>
                                <div class="col-md-4 col-xs-4 text-center">
                                    <p class="text-danger">Team</p>
                                    <h2>'.$this->Downlines().'</h2> </div>-->
                            </div>
                        </div>
                    </div>';



                    $data2 = '<div class="col-md-8 col-xs-12">
                        <div class="white-box">
                            <!-- .tabs -->
                            <ul class="nav nav-tabs tabs customtab">
                                <li class="tab">
                                    <a href="#home" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-home"></i></span> <span class="hidden-xs">History</span> </a>
                                </li>
                                <li class="active tab">
                                    <a href="#profile" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-user"></i></span> <span class="hidden-xs">Profile</span> </a>
                                </li>
                                <li class="tab">
                                    <a href="#settings" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-cog"></i></span> <span class="hidden-xs">Edit Profile</span> </a>
                                </li>
                            </ul>
                            <!-- /.tabs -->
                            <div class="tab-content">
                                <!-- .tabs 1 -->
                                <div class="tab-pane" id="home">
                                <div id="messages">
          

            
                                   </div>
                                   </div>

                                <!-- /.tabs1 -->
                                <!-- .tabs2 -->
                                <div class="tab-pane active" id="profile">
                                    
                                    <h6 class="m-t-30">Profile Information</h6>
                                   <hr>
                                 
                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">Phone Number</div>
                                    <div class="col-md-7 col-xs-12">'.$row['phone'].'</div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">Gender</div>
                                    <div class="col-md-7 col-xs-12">'.$row['sex'].'</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">Birthday</div>
                                    <div class="col-md-7 col-xs-12">'.$row['dob'].'</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">Residential Address</div>
                                    <div class="col-md-7 col-xs-12">'.$row['address'].'</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">Office Address</div>
                                    <div class="col-md-7 col-xs-12">'.$row['officeaddress'].'</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">City/State</div>
                                    <div class="col-md-7 col-xs-12">'.$row['city'].', '.$row['state'].'</div>
                                    </div>
                                    <hr>

                                   

                                    <div class="row">
                                    <div class="col-md-12 col-xs-12"><h6 class="m-t-30">Bank Account Details</h6></div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">Bank Name</div>
                                    <div class="col-md-7 col-xs-12">'.$row['bank'].'</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">Account Nunmber</div>
                                    <div class="col-md-7 col-xs-12">'.$row['accountno'].'</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">BVN</div>
                                    <div class="col-md-7 col-xs-12">'.$row['bvn'].'</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">Account Name</div>
                                    <div class="col-md-7 col-xs-12">'.$row['accname'].'</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-12 col-xs-12"><h6 class="m-t-30">Referral Information</h6></div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">Referral ID</div>
                                    <div class="col-md-7 col-xs-12">'.$row['user'].'</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">Referral Link</div>
                                    <div class="col-md-7 col-xs-12">https://thegreatheights.com/?r='.$row['user'].'</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">Share on WhatsApp<br><br></div>
                                    <div class="col-md-7 col-xs-12"><a href="whatsapp://send?text=I am inviting your to join the Believers Family Network. We believe in Nigeria. We are teaming up to rebuild Nigeria and eradicate poverty through stratrgic re-orientation and business empowerment. Join us at @    
https://thegreatheights.com/?r='.$row['user'].'" data-action="share/whatsapp/share" class="btn btn-success">Share on WhatsApp</a></div>
                                    </div>
                                    <hr>

                                </div>
                                <!-- /.tabs2 -->
                                <!-- .tabs3 -->
                                <div class="tab-pane" id="settings">
                                    <form method="post" class="form-horizontal">
                                        <h5 class="m-t-30">Update Profile Information</h5>
                                    <hr>
                                        <div class="form-group">
                                            <label class="col-md-12">Surname</label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="" name="firstname" value="'.$row['firstname'].'" class="form-control"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="example-email" class="col-md-12">Other Names</label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="" value="'.$row['lastname'].'" class="form-control" name="lastname" id="example-email"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Phone Number</label>
                                            <div class="col-md-12">
                                                <input type="text" name="phone" value="'.$row['phone'].'" class="form-control"> </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-md-12">Gender</label>
                                            <div class="col-md-12">
                                                <input type="text" name="sex" value="'.$row['sex'].'" class="form-control"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Date of Birth</label>
                                            <div class="col-md-12">
                                                <input type="text" name="dob" value="'.$row['dob'].'" class="form-control"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Residential Address</label>
                                            <div class="col-md-12">
                                                <input type="text" name="address" value="'.$row['address'].'" class="form-control"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Office Address</label>
                                            <div class="col-md-12">
                                                <input type="text" name="officeaddress" value="'.$row['officeaddress'].'" class="form-control"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">City</label>
                                            <div class="col-md-12">
                                                <input type="text" name="city" value="'.$row['city'].'" class="form-control"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">State</label>
                                            <div class="col-md-12">
                                                <input type="text" name="state" value="'.$row['state'].'" class="form-control"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Name of Bank</label>
                                            <div class="col-md-12">
                                                <input type="text" name="bank" value="'.$row['bank'].'" class="form-control"> </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-12">Account Number</label>
                                            <div class="col-md-12">
                                                <input type="text" name="accountno" value="'.$row['accountno'].'" class="form-control"> </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-12">BVN</label>
                                            <div class="col-md-12">
                                                <input type="text" name="bvn" value="'.$row['bvn'].'" class="form-control"> </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-12">Account Name</label>
                                            <div class="col-md-12">
                                                <input type="text" name="accname" value="'.$row['accname'].'" class="form-control"> </div>
                                        </div>




                                         <div class="form-group">
                                            <div class="col-sm-12">
                                                <button type="submit" name="updateUserData" class="btn btn-success">Update User Data</button>
                                            </div>
                                        </div>

                                       
                                    </form>



                                     <form method="post" class="form-horizontal">
                                        <h5 class="m-t-30">Password Reset</h5>
                                    <hr>
                                        <div class="form-group">
                                            <label class="col-md-12">Old Password</label>
                                            <div class="col-md-12">
                                                <input type="password" placeholder="" name="currentpass" class="form-control"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="example-email" class="col-md-12">New Password</label>
                                            <div class="col-md-12">
                                                <input type="password" placeholder="" class="form-control" name="newpass" id="example-email"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Confirm Password</label>
                                            <div class="col-md-12">
                                                <input type="password" name="newpass2" class="form-control"> </div>
                                        </div>
                                         <div class="form-group">
                                            <div class="col-sm-12">
                                                <button type="submit" name="changePassword" class="btn btn-success">Reset Password</button>
                                            </div>
                                        </div>

                                       
                                    </form>



                                     <h5 class="m-t-30">Update Profile Photo</h5>
                                    <hr>
                                    <form method="post"  enctype="multipart/form-data">
                                    <div class="row">
                    <div class="col-sm-6 ol-md-6 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">Passport Size Photograph</h3>
                            <label for="input-file-max-fs">Maximum Size is 200kb</label>
                            <input type="file" name="image" id="input-file-max-fs" class="dropify" data-max-file-size="200K" required /> </div>
                    </div>
                </div>
                 <div class="form-group">
                                            <div class="col-sm-12">
                                                <button class="btn btn-success" name="updatePhoto">Update Photograph</button>
                                            </div>
                                        </div>


                                </div>
                                </form>
                                <!-- /.tabs3 -->
                            </div>
                        </div>
                    </div>';
	return $$a;
}


function userHistoryData($a){
	global $db;
	$id = $_SESSION['user_id'];

}



function userProfileDataWild(){
	global $db;
	$user_ref = $_GET['user-ref'];
	$sql=$db->query("SELECT * FROM user WHERE md5(sn) = '$user_ref' " )or die(mysqli_error()); 
$row=mysqli_fetch_assoc($sql);
$num=mysqli_num_rows($sql);

$data = '             <h4>User Information</h4>
                                <hr>
                               <img width="250" alt="user" src="photo/'.$row['photo'].'">
                                <!-- .row -->
                                <div class="row">
                                <div class="row text-center m-t-10">
                                    <div class="col-md-6 col-xs-6 b-r"><strong>Sponsor</strong>
                                        <p>'.$this->wildUserName($row['sponsor']).'</p>
                                    </div>
                                    <div class="col-md-6 col-xs-6"><strong>Upline</strong>
                                        <p>'.$this->wildUserName($row['a1']).'</p>
                                    </div>
                                </div>
                                </div>
                                <!-- /.row -->

                                <hr>

                                    <form method="post" class="form-horizontal">
                                        <h5 class="m-t-30">Update Profile Information</h5>
                                    <hr>
                                        <div class="form-group">
                                            <label class="col-md-12">Surname</label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="" name="firstname" value="'.$row['firstname'].'" class="form-control"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="example-email" class="col-md-12">Other Names</label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="" value="'.$row['lastname'].'" class="form-control" name="lastname" id="example-email"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Phone Number</label>
                                            <div class="col-md-12">
                                                <input type="text" name="phone" value="'.$row['phone'].'" class="form-control"> </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-md-12">Gender</label>
                                            <div class="col-md-12">
                                                <input type="text" name="sex" value="'.$row['sex'].'" class="form-control"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Date of Birth</label>
                                            <div class="col-md-12">
                                                <input type="text" name="dob" value="'.$row['dob'].'" class="form-control"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Residential Address</label>
                                            <div class="col-md-12">
                                                <input type="text" name="address" value="'.$row['address'].'" class="form-control"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Office Address</label>
                                            <div class="col-md-12">
                                                <input type="text" name="officeaddress" value="'.$row['officeaddress'].'" class="form-control"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">City</label>
                                            <div class="col-md-12">
                                                <input type="text" name="city" value="'.$row['city'].'" class="form-control"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">State</label>
                                            <div class="col-md-12">
                                                <input type="text" name="state" value="'.$row['state'].'" class="form-control"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Name of Bank</label>
                                            <div class="col-md-12">
                                                <input type="text" name="bank" value="'.$row['bank'].'" class="form-control"> </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-12">Account Number</label>
                                            <div class="col-md-12">
                                                <input type="text" name="accountno" value="'.$row['accountno'].'" class="form-control"> </div>
                                        </div>

                                         <div class="form-group">
                                            <label class="col-md-12">BVN</label>
                                            <div class="col-md-12">
                                                <input type="text" name="bvn" value="'.$row['bvn'].'" class="form-control"> </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-12">Account Name</label>
                                            <div class="col-md-12">
                                                <input type="text" name="accname" value="'.$row['accname'].'" class="form-control"> </div>
                                        </div>




                                         <div class="form-group">
                                            <div class="col-sm-12">

                                                <button type="submit" name="updateUserDataWild" class="btn btn-success">Update User Data</button>
                                            </div>
                                        </div>

                                       
                                    </form>




                                     <h5 class="m-t-30">Update Profile Photo</h5>
                                    <hr>
                                    <form method="post"  enctype="multipart/form-data">
                                    <div class="row">
                    <div class="col-sm-6 ol-md-6 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">Passport Size Photograph</h3>
                            <label for="input-file-max-fs">Maximum Size is 200kb</label>
                            <input type="file" name="image" id="input-file-max-fs" class="dropify" data-max-file-size="200K" required /> </div>
                    </div>
                </div>
                 <div class="form-group">
                                            <div class="col-sm-12">
                                                <button class="btn btn-success" name="updatePhotoWild">Update Photograph</button>
                                            </div>
                                        </div>


                               
                                </form>

                                </br></br>';
     $usKey = $row['id']; $sql = $db->query("SELECT * FROM loan WHERE id='$usKey'"); 
     $row1 = $sql->fetch_assoc();
     $btn = ($row1['status']>3)?'Green':'#111';
     $btnname = ($row1['status']>3)?'Loan Active':'Loan In-Active';                           
    $data.='<div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="white-box stat-widget">
                    <h5><b>current Loan Details</b></h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Total</th>
                                <th> Interest </th>
                            </tr>
                            </thead>
                            <tbody>
                           <tr>
                           <td>Loan Request</td><td>₦'.number_format($this->userLoanDetails(1,$usKey)).'</td><td>₦'.number_format($this->userLoanInterest(1,$usKey)).'</td>
                           </tr>
                           <tr>
                           <td>Loan Approved</td><td>₦'.number_format($this->userLoanDetails(2,$usKey)).'</td><td>₦'.number_format($this->userLoanInterest(2,$usKey)).'</td>
                           </tr>
                           <tr>
                           <td>Loan Acceptes</td><td>₦'.number_format($this->userLoanDetails(3,$usKey)).'</td><td>₦'.number_format($this->userLoanInterest(3,$usKey)).'</td>
                           </tr>
                           <tr>
                           <td>Loan Disbursed</td><td>'.number_format($this->userLoanDetails(4,$usKey)).'</td><td>₦'.number_format($this->userLoanInterest(4,$usKey)).'</td>
                           </tr>
                           <tr>
                         <td><b><span style="color:'.$btn.';">'.$btnname.'</span></b></td>
                           </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>';
$query = $db->query("SELECT * FROM savings WHERE userid='$usKey'");
$row2 = $query->fetch_assoc();
$sql1 = $db->query("SELECT SUM(amount) AS sum, COUNT(*) AS num FROM savings2 WHERE userid='$usKey'");
 $ro = $sql1->fetch_assoc();
$data.='<div class="col-md-4 col-sm-12">
                <div class="white-box stat-widget">
                    <h5><b>Savings Details</b></h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Total</th>
                               
                            </tr>
                            </thead>
                            <tbody>
                           <tr>
                           <td>Total Savings</td><td>₦'.number_format($ro['sum']).'</td>
                           </tr>
                           <tr>
                           <td>Periodic Amount</td><td>₦'.number_format($row2['amount']).'</td>
                           </tr>
                           <tr>
                           <td>Period</td><td>'.$this->sKeyToPeriod($row2['period']).'</td>
                           </tr>
                          
                          <tr>
                           <td>Pending</td><td>'.$this->getSavingPending($usKey).'</td>
                           </tr>
                           <tr>
                           <td>Start Date</td><td>'.date("d M, Y", $row2['startdate']).'</td>
                           </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>';
$sql = $db->query("SELECT * FROM invacc WHERE userid='$usKey'");
$row3= $sql->fetch_assoc();
 $data.='<div class="col-md-4 col-sm-12">
                <div class="white-box stat-widget">
                    <h5><b>Current Investment</b></h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Total</th>
                               
                            </tr>
                            </thead>
                            <tbody>
                           <tr>
                           <td>Initiate</td><td>₦'.number_format($this-> userInvestmentDetail(1,$usKey)).'</td>
                           </tr>
                           <tr>
                           <td>Active</td><td>₦'.number_format($this-> userInvestmentDetail(2,$usKey)).'</td>
                           </tr>
                           <tr>
                           <td>Tenure</td><td>'.$row3['tenure'].' Month(s)</td>
                           </tr>
                          
                          <tr>
                           <td>ROI</td><td>'.number_format($row3['roi']).'</td>
                           </tr>
                           <tr>
                          <td>End Date</td><td>';if($row3['tan']!= 0){$data.= date("d M, Y",$row3['tan']);}
                        $data.='</td>
                          </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

        </div>
';
$data.='<div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="white-box stat-widget">
                    <h5>History of Expired Loan</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Loan Amount</th>
                                <th>Period</th>
                                <th>Total Repayment</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>';$con = $db->query("SELECT * FROM loan WHERE id='$usKey' AND status=5");
                            while($loanhs = $con->fetch_assoc()){ $stat = $loanhs['status']; 
                           $data.='<tr>
                           <td>₦'.number_format($loanhs['amount']).'</td><td>'.$loanhs['period'].'Months</td>
                              <td>₦'.number_format(repyament($loanhs['trno'])).'</td>';
                              $msg = ($stat == 5)?'Completed':'Not-Completed';
                              $data.='<td>'.$msg.'</td>
                           </tr>
                           ';}
                           $data.='</tbody>
                        </table>
                    </div>

                </div>

            </div>';

            
           $data.='<div class="col-md-6 col-sm-12">
                <div class="white-box stat-widget">
                    <h5>Investment History</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Investment Amount</th>
                                <th>Tenure</th>
                                <th>ROI</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>';$fet = $db->query("SELECT * FROM invacc WHERE userid='$usKey' AND status=3");
                            while($inhs = $fet->fetch_assoc()) { $stat = $inhs['status']; 
                           $data.='<tr>
                           <td>₦'.number_format($inhs['amount']).'</td><td>'.$inhs['tenure'].'Months</td>
                              <td>₦'.number_format($inhs['roi']).'</td>';
                              $msg = ($stat == 5)?'Completed':'Not-Completed';
                              $data.='<td>'.$msg.'</td>
                           </tr>
                           ';}
                           $data.='</tbody>
                        </table>
                    </div>

                </div>

            </div>

            </div>';    


                                    if($num==0){$data='';}
	return $data;
}
function  userInvestmentDetail($opt=1,$usid)
{
	global $db; $var=0;
	$sql = $db->query("SELECT * FROM invacc WHERE userid='$usid' AND status = '$opt'");
   $row = $sql->fetch_assoc();
   if($opt==1){$var = $row['amount'];}elseif($opt==2){$var = $row['amount'];}
 return $var;
}
function getSavingPending($usid){
  global $db; $pending=0;
  $sql = $db->query("SELECT * FROM savings WHERE userid='$usid'"); 
     $row = $sql->fetch_assoc();
     $period = $row['period'];
     $startdate = $row['startdate'];
     $today = time();
     $day = 60*60*24;
     $range = $today-$startdate;
     if($period==1){$days = (int)($range/$day);}elseif($period==2){$days = (int)($range/$day); $days= (int)($days/7);}
     elseif($period==3){$days = (int)($range/$day); $days = (int)($days/30);}

     $query = $db->query("SELECT COUNT(*) AS num FROM savings2 WHERE userid='$usid'");
     $row1 = $query->fetch_assoc();
     $pending = $days-$row1['num'];
     return $pending;
}

function userLoanInterest($opt=1, $usid){
	global $db; $var=0;
	$sql = $db->query("SELECT * FROM loan WHERE id='$usid' AND status = '$opt'"); 
     $row1 = $sql->fetch_assoc();
	if($opt==1){
	 $var = $row1['interest'];
     }
     elseif ($opt>=2 && $opt <=4) {
    $var = $row1['interest'];
}
return $var;
}
function userLoanDetails($opt=1, $usid){
global $db; $var=0;
$sql = $db->query("SELECT * FROM loan WHERE id='$usid' AND status = '$opt'"); 
     $row1 = $sql->fetch_assoc();
	if($opt==1){
	 $var = $row1['loan'];
     }
   elseif ($opt==2) {
    $var = $row1['loan'];
     } 
   elseif ($opt==3) {
     $var = $row1['loan'];
    }
    elseif ($opt==4) {
     $var = $row1['loan'];
     } 
     return $var;
}

function countSavings($usKey)
{
	global $db;
	 $savp = $db->query("SELECT * FROM savings2 WHERE userid='$usKey'"); $count=0; while($id_count = mysqli_fetch_assoc($savp)){
							   $count = $count +1;}return $count;
}

function userMsgCount()
{
    global $db; $num=0;$count='';
    $id = $_SESSION['user_id'];
    $sql= $db->query("SELECT * FROM msg WHERE rec = '$id' AND active = 1");
while($row = $sql->fetch_assoc()){
$send = $row['sender'];
if($send == $count){continue;}else{$num++;}
$count=$send;
}
     return $num;
    }

function adminMsg2($nu=''){
global $db,$userKey;
$msg = '';
$bl = array('info','warning','primary','danger','success');
$a = 0;
$sql=$db->query("SELECT * FROM msg WHERE rec = '$userKey' AND active > 0 ORDER BY sn DESC " )or die(mysqli_error());
			$num = mysqli_num_rows($sql);
			while($row = mysqli_fetch_assoc($sql)){
				$b=$a++;
				$c = $b%5; 
$msg .= '<a href="profile.php#'.$row['subject'].'">
                                        
                                        <div class="mail-contnet">
                                            <h5>'.$row['subject'].'</h5>
                                            <span class="mail-desc">'.substr($row['msg'],0,50).'...</span>
                                            <span class="time">'.date('d-M h:i A',$row['ctime']).'</span>
                                        </div>
                                    </a>';
			}
			if($nu==1){$msg=$num;}
	return $msg;
}





function adminMsg(){
global $db,$userKey;
$msg = '';
$bl = array('info','warning','primary','danger','success');
$a = 0;
$sql=$db->query("SELECT * FROM msg WHERE rec = '$userKey' AND active > 0 ORDER BY sn DESC" )or die(mysqli_error());
			$num = mysqli_num_rows($sql);
			while($row = mysqli_fetch_assoc($sql)){
				$b=$a++;
				$c = $b%5; 
$msg .= '
			<div class="m-l-0" id="'.$row['subject'].'"><a href="#" class="text-'.$bl[$c].'">'.$row['subject'].'</a> <span class="sl-date">'.date('d-M h:i A',$row['ctime']).'</span>
                                                    <p>'.$row['msg'].'</p>
                                                    
                                                    
                                                
                                        </div><hr>';
			}
	return $msg;
}





}

$profile = new Profile; 

//end of Bonus Class



$ref = $_SESSION['ref'] = $signup->win_hash(52);


?>
