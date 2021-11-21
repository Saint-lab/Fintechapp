	<?php

        $tripT = '<table class="table table-hover"> 
		<tr><th>SN</th><th>Trip</th><th>Adult Price</th><th>Child Price</th><th>Date</th>
		<th>Profile</th></tr>';

          $sql = $db->query(" select * from trip  order by title asc");
          $i = 1;
           while( $row=mysqli_fetch_assoc($sql)){  $e = $i++;
           $trip_id = $row['sn'];

          $date = $row['created']; 
		$title = $_GET['title'];  if(str_replace("-"," ",$title)==$row['title'])
		{ $color = ' bgcolor="#CCFF99" ';  } else{$color = '';}
          
$tripT .= '<tr'.$color.'><td>'.$e.'</td><td>'.$row['title'].'</td><td>'.$row['adult'].'</td><td>'.$row['child'].'</td><td>'.substr($date,0,10).'</td><td> <a href="?trip='.str_replace(" ","-",$row['title']).'"><i class="fa fa-gears"></i></a></td></tr>';
           }
        $tripT .=  '</table>';  
		
		
		function sumA($item,$trip,$opt){
			global $db;
			$sql = $db->query("SELECT * FROM ticket WHERE $item = '$trip' ");
			$amount = 0;
while($row=mysqli_fetch_assoc($sql)){
$date = $row['created'];
$ww = $row['ww'];
$dd = substr(str_replace("-","",$date),0,8);
$mm = substr($dd,0,6);
$yy = substr($dd,0,4);

$w = date('yW');
$d = date('Ymd');
$m = date('Ym');
$y = date('Y');	
if($opt==1){ if($d==$dd){	$amount = $amount + $row['amount']; }} 
else if($opt==2){ if($m==$mm){	$amount = $amount + $row['amount']; }} 
else if($opt==3){ if($y==$yy){	$amount = $amount + $row['amount']; }} 
else if($opt==4){ if($w==$ww){	$amount = $amount + $row['amount']; }} 
}
return number_format($amount);
		}
		
		

		
		
		
		
		if($_GET['trip']){
		$tripp = $_GET['trip']; 
$tripStatT = '<table class="table table-hover">';

				  $sql = $db->query("SELECT * FROM trip where title = '$tripp' ");
				 
$row=mysqli_fetch_assoc($sql);

				  
$tripStatT .= '<tr><td>Date Created</td><td>'.$row['created'].'</td></tr>';  
$tripStatT .= '<tr><td>Trip Price</td><td>'.$row['adult'].'/'.$row['child'].'</td></tr>'; 
 
$tripStatT .= '<tr><td>Revenue: Today</td><td>'.sumA('trip',$tripp,1).'</td></tr>';  

$tripStatT .= '<tr><td>Revenue: This Week</td><td>'.sumA('trip',$tripp,4).'</td></tr>';
   
$tripStatT .= '<tr><td>Revenue: This Month</td><td>'.sumA('trip',$tripp,2).'</td></tr>';

$tripStatT .= '<tr><td>Revenue: This Year</td><td>'.sumA('trip',$tripp,3).'</td></tr>'; 
    
$tripStatT .= '</table>';
	
$tripStatH = $row['title'];
}



        $vehicleT = '<table class="table table-hover"> 
		<tr><th>SN</th><th>Vehicle</th><th>Tally</th><th>Chasis Number</th><th>Plate No</th><th>Capacity</th><th>Status</th><th>Profile</th></tr>';

          $sql = sqL('vehicle');
          $i = 1;
           while( $row=mysqli_fetch_assoc($sql)){  $e = $i++;
           $vehicle_id = $row['sn'];
		    $status = $row['status'];

          $date = $row['created']; $vehicle = $_GET['vehicle'];
		   if($status==1){$action = 'Logged';  $primary = 'primary'; } elseif($status==2){$action = 'On Trip'; $primary = 'danger'; } elseif($status==3){$action = 'Trip Ended'; $primary = 'success'; } elseif($status==4){$action = 'Under Repair'; $primary = ''; }else{$action = 'Available'; $primary = 'warning'; }
		   
		  if(str_replace("-"," ",$vehicle)==$row['plateno']){ $color = ' bgcolor="#CCFF99" ';  } else{$color = '';}
          
$vehicleT .= '<tr'.$color.'><td>'.$e.'</td><td>'.$row['make'].' '.$row['model'].'</td><td>'.$row['tallyno'].'</td><td>'.$row['chasisno'].'</td><td>'.$row['plateno'].'</td><td>'.$row['capacity'].'</td><td><button class="btn btn-'.$primary.' btn-xs" type="submit" name="" value="'.$vehiclelog_id.'">'.$action.'</button></td><td> <a href="?vehicle='.str_replace(" ","",$row['plateno']).'"><i class="fa fa-gears"></i></a></td></tr>';
           }
        $vehicleT .=  '</table>'; 
		
		
		

		if($_GET['vehicle']){
		$plateno = $_GET['vehicle']; 
$vehicleStatT = '<table class="table table-hover">';

				  $sql = sqL1('vehicle','plateno',$plateno);
				 
$row=mysqli_fetch_assoc($sql);
$vehicle_image = $row['photo'];
				  
$vehicleStatT .= '<tr><td>Vehicle</td><td>'.$row['make'].' '.$row['model'].'</td></tr>'; 
$vehicleStatT .= '<tr><td>Date Registered</td><td>'.$row['created'].'</td></tr>';  
$vehicleStatT .= '<tr><td>Colour</td><td>'.$row['color'].'</td></tr>';  
    
$tripStatT .= '</table>';  
$vehicleStatT .= '</table>';
	
$vehicleStatH = $plateno;
}





        $vehiclelogT = '<table class="table table-hover"> 
		<tr><th>SN</th><th>Vehicle</th><th>Trip/Diver</th><th>Date/Time</th><th>S.Odometer</th><th>S/E Trip</th><th>Profile</th></tr>';

          $sql = $db->query("SELECT * FROM vehiclelog ORDER BY sn DESC LIMIT 40" );
          $i = 1;
           while( $row=mysqli_fetch_assoc($sql)){  $e = $i++;
           $vehiclelog_id = $row['sn'];
		   $status = $row['status'];

          $date = $row['created']; 
		  if($_GET['vehiclelog']==sha1($row['sn'])){ $color = ' bgcolor="#CCFF99" ';  } else{$color = '';}
          if($status==1){$action = 'Start Trip';  $primary = 'success'; } elseif($status==2){$action = 'End Trip'; $primary = 'danger'; }else{$action = 'Ended'; $primary = ''; }
$vehiclelogT .= '<tr'.$color.'><td>'.$e.'</td><td>'.$row['vehicle'].'</td><td>'.$row['trip'].'<br>'.$row['driver'].'</td><td>'.$row['date'].'<br>'.$row['time'].'</td><td>'.$row['startodo'].'</td><td><button class="btn btn-'.$primary.' btn-xs" type="submit" name="startTrip" value="'.$vehiclelog_id.'">'.$action.'</button></td><td> <a href="?vehiclelog='.sha1($row['sn']).'"><i class="fa fa-gears"></i></a></td></tr>';
           }
        $vehiclelogT .=  '</table>'; 



		if($_GET['vehiclelog']){
		$snVL = $_GET['vehiclelog']; 


				  $sql = $db->query("SELECT * FROM vehiclelog WHERE sha1(sn) = '$snVL' ");
				  $rw=mysqli_fetch_assoc($sql);
				  $logid = $rw['sn'];
				  $plateno = $rw['vehicle'];
				  $dateVL = $rw['date'];
				  $timeVL = $rw['time'];
				  $trip = $rw['trip'];
				  $tripVL = $rw['trip'];
				  
				  
$sq = sqL1('vehicle','plateno',$plateno);
$ro=mysqli_fetch_assoc($sq);
$vehicle_image = $ro['photo'];
$capacity = 4;

$tick= $db->query("SELECT * FROM ticket WHERE trip='$trip' AND date='$dateVL' AND time='$timeVL' ");
$tickets = mysqli_num_rows($tick);
$available = $capacity-$tickets;
				  

$vehiclelogStatT .= '<div class="col-lg-6">Vehicle: '.$rw['vehicle'].'</div>';    
$vehiclelogStatT .= '<div class="col-lg-6"> Driver: '.$rw['driver'].'</div>';
$vehiclelogStatT .= '<div class="col-lg-6">Date: '.$rw['date'].'</div>';    
$vehiclelogStatT .= '<div class="col-lg-6"> Time: '.$rw['time'].'</div>';
$vehiclelogStatT .= '<div class="col-lg-6"><font size="+1">Capacity: '.$capacity.'</font></div>';
$vehiclelogStatT .= '<div class="col-lg-6"><font size="+1">Available: '.$available.'</font></div><hr>';

$vehiclelogStatH = $rw['trip'];


		$ticketT = '<table class="table table-hover"> 
		<tr><th>SN</th><th>Ticket ID</th><th>Name</th><th>Phone</th><th>Address</th><th>Destin.</th><th>NOK</th><th>NOK Phone</th><th>Cost</th><th>Rec</th></tr>';

          $sql = sqL3('ticket','trip',$tripVL,'time',$timeVL,'date',$dateVL);
          $i = 1;
           while( $row=mysqli_fetch_assoc($sql)){  $e = $i++;

          $date = $row['created']; 
		  $ticketid=$row['ticketid'];
          
$ticketT .= '<tr><td>'.$e.'</td><td>'.$row['ticketid'].'</td><td>'.$row['name'].'</td><td>'.$row['phone'].'</td><td>'.$row['address'].'</td><td>'.$row['destination'].'</td><td>'.$row['nextofkin'].'</td><td>'.$row['nextphone'].'</td><td>'.$row['amount'].'</td><td> <a href="#" onclick="BrWindow("receipt.php?ticketid='.$ticketid.'","","width=400,height=600")" ><i class="fa fa-gears"></i></a></td></tr>';
           }
        $ticketT .=  '</table>'; 

}



        $branchT = '<table class="table table-hover"> 
		<tr><th>SN</th><th>Branch</th><th>Address</th><th>Profile</th></tr>';

          $sql = sqL('branch');
          $i = 1;
           while( $row=mysqli_fetch_assoc($sql)){  $e = $i++;
           $branch_id = $row['sn'];

          $date = $row['created']; $branch = $_GET['branch'];
		  if(str_replace("-"," ",$branch)==$row['branch']){ $color = ' bgcolor="#CCFF99" ';  } else{$color = '';}
          
$branchT .= '<tr'.$color.'><td>'.$e.'</td><td>'.$row['branch'].'</td><td>'.$row['address'].'</td><td> <a href="?branch='.str_replace(" ","",$row['branch']).'"><i class="fa fa-gears"></i></a></td></tr>';
           }
        $branchT .=  '</table>'; 
		
	
	function getBranch($sn){
		global $db;
		$sql = $db->query("SELECT * FROM branch WHERE sn = '$sn' ");
		$row=mysqli_fetch_assoc($sql);
		return $row['branch'];
	}
	
	///Users
	$userT = '<table class="table table-hover"> 
		<tr><th>SN</th><th>Name</th><th>Phone</th><th>Address</th><th>E-mail</th><th>Sex</th><th>User Level</th><th>Branch</th><th>Profile</th></tr>';

          $sql = sqL('admin');
          $i = 1;
           while( $row=mysqli_fetch_assoc($sql)){  $e = $i++;
			$sn = $row['sid'];
          $date = $row['created']; 
		  if($row['usertype']==1){$level = 'Ticket Officer';}elseif($row['usertype']==2){$level = 'Administrator';}elseif($row['usertype']==0){$level = 'Driver';}
		   if($_GET['user']==sha1($row['sn'])){ $color = ' bgcolor="#CCFF99" ';  } else{$color = '';}
          
$userT .= '<tr'.$color.'><td>'.$e.'</td><td>'.$row['surname'].' '.$row['othername'].'</td><td>'.$row['phone'].'</td><td>'.$row['address'].'</td><td>'.$row['email'].'</td><td>'.$row['sex'].'</td><td>'.$level.'</td><td>'.getBranch($sn).'<td> <a href="?user='.sha1($row['sn']).'"><i class="fa fa-gears"></i></a></td></tr>';
           }
        $userT .=  '</table>'; 	
		
		
		
		///user Stat
		
		if($_GET['user']){
		$user = $_GET['user']; 
		$sqlx = $db->query("SELECT * FROM admin WHERE sha1(sn) = '$user' ");
		$rowx=mysqli_fetch_assoc($sqlx);
		$userStatH = $rowx['surname'].' '.$rowx['othername'];
		
		$userStatT = '<img src="../upload/'.$rowx['photo'].'" width="100%">';
		
		}
		
		
		
		
		
//Parcel
        $parcelT = '<table class="table table-hover"> 
		<tr><th>SN</th><th>Track No</th><th>Title</th><th>Content</th><th>Sender</th><th>Receiver</th><th>Charge</th><th>Profile</th></tr>';

          $sql = $db->query("SELECT * FROM parcel ORDER BY sn DESC ");
          $i = 1;
           while( $row=mysqli_fetch_assoc($sql)){  $e = $i++;
           $parcel_id = $row['sn'];
		   $status = $row['status'];

          $date = $row['created']; 
		  if($_GET['parcel']==sha1($row['sn'])){ $color = ' bgcolor="#CCFF99" ';  } else{$color = '';}
          if($status==1){$action = 'Start Trip';  $primary = 'success'; } elseif($status==2){$action = 'End Trip'; $primary = 'danger'; }else{$action = 'Ended'; $primary = ''; }
$parcelT .= '<tr'.$color.'><td>'.$e.'</td><td>'.$row['trackno'].'</td><td>'.$row['title'].'</td><td>'.$row['content'].', '.$row['weight'].'</td><td>'.$row['name'].', '.$row['phone'].', '.$row['location'].'</td><td>'.$row['name2'].', '.$row['phone2'].', '.$row['location2'].'</td><td>'.$row['fee'].'</td><td> <a href="?parcel='.sha1($row['sn']).'"><i class="fa fa-gears"></i></a></td></tr>';
           }
        $parcelT .=  '</table>'; 	
		
		
		
		
		

if($_GET['parcel']){
		$parcel = $_GET['parcel']; 
		
		$sqlx = $db->query("SELECT * FROM parcel WHERE sha1(sn) = '$parcel' ");
		$rowx=mysqli_fetch_assoc($sqlx);
		$parcelStatH = $rowx['title'];
		$trackno = $rowx['trackno'];
		$Loc1 = $rowx['location'];
		$Loc2 = $rowx['location2'];
		$Rec = $rowx['name2'];
		$Sen = $rowx['name'];
		$Trackno = $trackno;
$parcelStatT = '<table class="table table-hover">
<tr><th>SN</th><th>Date/time</th><th>Status</th>';


				  $sql = sqL1x('trackparcel','trackid',$trackno); $i=1;
while($row=mysqli_fetch_assoc($sql)){ $e=$i++;

$parcelStatT .= '<tr><td>'.$e.'</td><td>'.$row['created'].'</td><td>'.$row['report'].'</td></tr>'; 
}
$parcelStatT .= '</table>';


}

	

?>