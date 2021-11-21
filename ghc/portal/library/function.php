<?php
if(isset($_GET['unread'])){
    global $db;
    $id = $_GET['unread'];
     $db->query("UPDATE msg SET active = 1 WHERE sha1(sn) = '$id'");
}
function daysInWords($date)
{
return date('Y-m-d', strtotime('+1 month', strtotime($date))); 
}
function sanitize($dity)
{
	return htmlentities($dity, ENT_QUOTES, "UTF-8");
} 
function sendChat($key){
	global $db;
	$sql = $db->query("SELECT msg FROM msg WHERE sender = '$key'");
	$row = $sql->fetch_assoc();
	return $row['msg'];
}
function recChat($key){ 
	global $db;
	$sql = $db->query("SELECT msg FROM msg WHERE rec = '$key'");
	$row = $sql->fetch_assoc();
	return $row['msg'];
}
function userPhoto($data)
{ global $db;
	$sql = $db->query("SELECT photo FROM user WHERE id = '$data'");
	$row = $sql->fetch_assoc();
	return 'photo/'.$row['photo'];
}
function userName($data)
{ global $db;
	$sql = $db->query("SELECT firstname, lastname FROM user WHERE id = '$data'");
	$row = $sql->fetch_assoc();
	return $row['firstname'].' '.$row['lastname'];
}
function MsgSubjectShow() 
{
	global $db; $count=''; 
    $id = $_SESSION['user_id'];
    $sql= $db->query("SELECT * FROM msg WHERE rec = '$id' AND active = 1 ORDER BY sn DESC");
	while($row = $sql->fetch_assoc()){
	$send = $row['sender'];

if($send == $count){continue;}else{
echo '<div class="message-center">
		<a href="chatting.php?messages='.sha1($row['sn']).'&page=1">
                                        <div class="user-img">
                                            <img src="'.userPhoto($row['sender']).'" alt="user" class="img-circle">
                                            <span class="profile-status online pull-right"></span>
                                        </div>
                                        <div class="mail-contnet">
                                            <h5>'.userName($row['sender']).'</h5>
                                            <span class="mail-desc">'.substr($row['msg'],0,20).'</span>
                                            <span class="time">'.date('d-m-Y h:iA',$row['ctime']).'</span>
                                        </div>
                                    </a>
		</div>';}
 $count = $send;
	}
}
function sqL($table,$level=1){  
	global $db;
$sql=$db->query("select * FROM $table")or die(mysqli_error());	
	if($level==1){ return $sql; }
	elseif($level==2){ return mysqli_fetch_assoc($sql); }
	else{return mysqli_num_rows($sql); }
}

function sqL1($table,$col1,$val1,$level=1){
global $db;
$sql=$db->query("select * from $table where $col1='$val1' " )or die(mysqli_error());	
	if($level==1){ return $sql; }
	elseif($level==2){ return mysqli_fetch_assoc($sql); }
	else{return mysqli_num_rows($sql); }
}

function repyament($trno){
    global $db;

    $sql= $db->query("SELECT SUM(tranch) AS sum FROM loantranch WHERE trno='$trno' AND paid != 0 ");
    $row = $sql->fetch_assoc();

    return $row['sum'];
}

function sqL1x($table,$col1,$val1,$level=1){
global $db;
$sql=$db->query("select * from $table where $col1='$val1' " )or die(mysqli_error());	
	if($level==1){ return $sql; }
	elseif($level==2){ return mysqli_fetch_assoc($sql); }
	else{return mysqli_num_rows($sql); }
}


function sqL2($table,$col1,$val1,$col2,$val2,$level=1){
global $db;
$sql=$db->query("select * from $table where $col1='$val1' and $col2='$val2' " )or die(mysqli_error());	
	if($level==1){ return $sql; }
	elseif($level==2){ return mysqli_fetch_assoc($sql); }
	else{return mysqli_num_rows($sql); }
}

function sqL3($table,$col1,$val1,$col2,$val2,$col3,$val3,$level=1){
global $db;
$sql=$db->query("select * from $table where $col1='$val1' and $col2='$val2' and $col3='$val3' " )or die(mysqli_error());	
	if($level==1){ return $sql; }
	elseif($level==2){ return mysqli_fetch_assoc($sql); }
	else{return mysqli_num_rows($sql); }
}


function sqL4($table,$col1,$val1,$col2,$val2,$col3,$val3,$col4,$val4,$level=1){
global $db;
$sql=$db->query("select * from $table where $col1='$val1' and $col2='$val2' and $col3='$val3' and $col4='$val4' " )or die(mysqli_error());	
	if($level==1){ return $sql; }
	elseif($level==2){ return mysqli_fetch_assoc($sql); }
	else{return mysqli_num_rows($sql); }
}

function sqL5($table,$col1,$val1,$col2,$val2,$col3,$val3,$col4,$val4,$col5,$val5,$level=1){
global $db;
$sql=$db->query("select * from $table where $col1='$val1' and $col2='$val2' and $col3='$val3' and $col4='$val4' and $col5='$val5' " )or die(mysqli_error());	
	if($level==1){ return $sql; }
	elseif($level==2){ return mysqli_fetch_assoc($sql); }
	else{return mysqli_num_rows($sql); }
}




function colSum($table,$col,$format=1){
global $db;
$sql=$db->query("SELECT SUM($col) AS value_sum FROM $table where sid = SID "); 
$row = mysqli_fetch_assoc($sql); 
if($format==1){
return number_format($row['value_sum']);
}
else{
return $row['value_sum'];
}
  }
  

  
      function colSum1($table,$col,$cola,$vala,$format=1){
global $db;
$sql=$db->query("SELECT SUM($col) AS value_sum FROM $table WHERE $cola = '$vala' "); 
$row = mysqli_fetch_assoc($sql); 
if($format==1){
return number_format($row['value_sum']);
}
else{
return $row['value_sum'];
}
  }
  
  
  
  
        function colSum2($table,$col,$cola,$vala,$colb,$valb,$format=1){
global $db;
$sql=$db->query("SELECT SUM($col) AS value_sum FROM $table WHERE $cola = '$vala' AND $colb = '$valb' "); 
$row = mysqli_fetch_assoc($sql); 
if($format==1){
return number_format($row['value_sum']);
}
else{
return $row['value_sum'];
}
  }
  
  
  
     function colSum3($table,$col,$cola,$vala,$colb,$valb,$colc,$valc,$format=1){
global $db;
$sql=$db->query("SELECT SUM($col) AS value_sum FROM $table WHERE $cola = '$vala' AND $colb = '$valb' AND $colc = '$valc' "); 
$row = mysqli_fetch_assoc($sql); 
if($format==1){
return number_format($row['value_sum']);
}
else{
return $row['value_sum'];
}
  }
  
   
     function rangeSum($table,$col,$start,$end){
global $db;
$sql=$db->query("SELECT SUM($col) AS value_sum FROM $table WHERE today between '$start' and '$end' "); 
$row = mysqli_fetch_assoc($sql); 
return number_format($row['value_sum']);
  }

function userLog(){
if($_SESSION['user'] != 'admin'){
		 header("location: logout.php");  }
			return;
}


function checkLogin(){
if(!isset($_SESSION['login'])){
		 header("location: logout.php");  }
		 elseif($_SESSION['level_id']<1){ header("location: logout.php"); }
		 elseif($_SESSION['level_id']>9){ header("location: logout.php"); }
			return;
}



function flip_tick($pass){
							// return password_hash($pass, PASSWORD_BCRYPT);
							
								return $pass;
                        }
						function checkPass($pass){
							// return password_hash($pass, PASSWORD_BCRYPT);
							global $db;
							
							$sql = $db->query("SELECT pass FROM user WHERE pass = $pass");
							$row = mysqli_fetch_assoc($sql);
							if($row['pass']!=$pass){return false;}else
								return $pass;
                        }



    function modalHead($name,$title){
							echo '<div class="modal modal-default fade" id="modal-class">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true"> &times;</span></button>
                <h4 class="modal-title">'.$title.'</h4>
              </div>
              <div class="modal-body">'; return; 
						}
	
	function modalFoot($name,$butt){	
					  echo '</div>
              <div class="modal-footer">
              <button type="button" class="btn btn-'.$name.'" data-dismiss="modal">Close</button>'.$butt.' 
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>'; return;
					 }



////FORMS


 function myInput($name,$place,$width=6,$required){
	 //name is name of form
	 //place refers to placeholder

$fm = '<div class="col-xs-12 col-sm-12 col-md-'.$width.'" style="padding-bottom:10px" ><input name="'.$name.'" class="form-control"  placeholder="'.$place.'" '.$required.' /></div>'; 
return $fm;	
}


function myInputV($name,$place,$width=6,$value){

	 //name is name of form
	 //place refers to placeholder

$fm = '<div class="col-xs-12 col-sm-12 col-md-'.$width.'" style="padding-bottom:10px" >'.$place.'
<input name="'.$name.'" id="'.$name.'" class="form-control js-calc" value="'.$value.'"  placeholder="'.$place.'" /></div>'; 
return $fm;	
}


function myBtn($bname,$bvalue,$width=12){
	//bname refers to botton name
	//bvalue refers to botton value
$btn = '<div class="col-xs-12 col-sm-12 col-md-'.$width.'" style="padding-bottom:10px" ><button style="text-align:center; width:100%" type="submit" class="btn btn-primary" name="'.$bname.'">'.$bvalue.'</button></div>'; 
return $btn;	
}

function myBtn2($bname,$bvalue,$width=12){
	//bname refers to botton name
	//bvalue refers to botton value
$btn = '<div class="col-xs-12 col-sm-12 col-md-'.$width.'" style="padding-bottom:10px" ><button style="text-align:center; width:100%" type="submit" class="btn btn-success" name="'.$bname.'">'.$bvalue.'</button></div>'; 
return $btn;	
}




function myForm($content){
	//content is an array of form contents
$postfm = '<form method="post">'. $content . '</form>'; 
return $postfm;
}




function arrayForm($names,$places){
	
	//names refers to array of names
	//places refers to array of placeholders
	
	$names = explode(' ',$names);
	$places = explode(' ',$places);
		$n = count($names);
		$a = 0;
		
		while($a<$n){ $b = $a++;
				$input .= '<div style="float:left; padding:10px; width:100%"><input name="'.$names[$b].'" class="form-control" value=""  placeholder="'.$places[$b].'"  required />';	
				}
	
	return $input;
}


///// TABLES

function Table($field,$value,$dbtable){
		//field is an array that needs to be exploaded
		//dbtable is the name of the database table you want to fetch from
		//sumoption make a provision for adding a sum row at the end of the 
		//table and needs to be defined eternally to contain the exact structure of 
		//the table row containing sum of column fields.
		$field = explode(' ',$field);
		$value = explode(' ',$value);
		$n = count($field);
		$a = 0;
	
		
		
		$table .= '<table class="table table-hover" id="dataTables-example">
                    <thead>
                          <tr>';
				while($a<$n){ $b = $a++;
				$table .= '<th>'.strtoupper(str_replace("-"," ",$field[$b])).'</th>';	
				}
		$table .= '   </tr>
                    </thead>
                    <tbody> ';
                           
							//$qu=mysql_query("select * FROM zone ORDER BY zone " )or die(mysql_error());
						

							while($row = sqL($dbtable)){ 
							
                          $table .= '<tr class="odd gradeX">';
						  $a = 0;
						  while($a<$n){ $b = $a++; 
				$table .= '<td class="center">'.$row->$value[$b].' </td>';	}
				$table .= '</tr>';   
							}
				

				$table .= ' </tbody></table>';
                   
				return $table;		  
	}










				
				


/*
		
function getUserLevel($rep){
		global $db,$rep,$user_created;
		$sql = $db->query("SELECT * FROM admin WHERE sn = '$rep' ");
		$row=mysqli_fetch_assoc($sql);
		$user_created = $row['created'];
		 if($row['usertype']==1){$level = 'Ticket Officer';}elseif($row['usertype']==2){$level = 'Administrator';}
		return $level;
	}
	
	function getUserN($rep){
		global $db,$rep,$user_created;
		$sql = $db->query("SELECT * FROM admin WHERE sn = '$rep' ");
		$row=mysqli_fetch_assoc($sql);
		$userN = $row['surname'].' '.$row['othername'];
		return $userN;
	}						
	

*/



function chkLogin(){
if($_SERVER['SCRIPT_NAME']=='/bfnet/login.php' OR $_SERVER['SCRIPT_NAME']=='/bfnet/signup.php'){ }
elseif(isset($_SESSION['user_id'])){ }
else{ header('location: ../'); exit;  } 
	return;	
}

function adminAccess(){
	if($_SESSION['userLevel'] != 2){ session_destroy(); }
	return;
}



function sendSms($sms,$phone,$id=''){
	global $db;
$smsapi = 'http://www.trenetsms.com/components/com_spc/smsapi.php?username='.SMSUSER.'&password='.SMSPASS.'&sender='.urlencode(SENDERID).'&recipient='.$phone.'&message='.urlencode($sms);
if(file($smsapi)===TRUE){
$sql = $db->query("INSERT INTO sms (phone,id,sms) VALUES ('$phone','$id','$sms')"); 
}
return;
}


function time_left($secs){
    $bit = array(
        '<font size="-1">year</font>'        => $secs / 31556926 % 12,
        '<font size="-1">week</font>'        => $secs / 604800 % 52,
        '<font size="-1">day</font>'        => $secs / 86400 % 7,
        '<font size="-1">hour</font>'        => $secs / 3600 % 24
        );
        
    foreach($bit as $k => $v){
        if($v > 1)$ret[] = $v . $k . '<font size="-1">s</font>';
        if($v == 1)$ret[] = $v . $k;
        }
   
    
    return join(' ', $ret);
    }


			
?>