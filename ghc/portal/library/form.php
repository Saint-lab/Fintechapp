	<?php
			////add Trip
$addtrip = myInput('title','Enter Trip Title',3,'required'); 
$addtrip .= myInput('adult','Adult Price',3,'required');
$addtrip .= myInput('child','Child Price',3,'required');
$addtrip .= myBtn('addTrip','Register Trip',12);

////Delete Trip
$deletetrip = '<div class="col-xs-12 col-sm-12 col-md-3" style="padding-bottom:10px" >
<select name="trip" class="form-control select2" required>
<option selected="selected" disabled="disabled" value="">Select Trip</option>'; 
$result = sqL('trip');
							while($row = mysqli_fetch_assoc($result)) { $title = $row['title']; $val = $row['sn']; $deletetrip .= '<option>'.$title.'</option>'; }

$deletetrip .= '</select></div>';
$deletetrip .= '<div class="col-xs-12 col-sm-12 col-md-3" style="padding-bottom:10px" >
<select name="sure" class="form-control select2" required>
<option selected="selected" disabled="disabled" value="">Sure?</option>
<option value="1">YES</option>
</select></div>';
$deletetrip .= myBtn('deleteTrip','Delete Trip',3);





			
			////Trip Statistics
$tripstat = '<div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
<select name="trip" class="form-control select2" required>
<option selected="selected" disabled="disabled" value="">Select Trip</option>'; 
$result = sqL('trip');
while($row = mysqli_fetch_assoc($result)) { $title = $row['title']; $val = $row['sn']; $tripstat .= '<option>'.$title.'</option>'; }
$tripstat .= '</select></div>';
$tripstat .= myBtn('tripStat','Generate Statistics',6);





////Edit Trip
$edittrip = '<div class="col-xs-12 col-sm-12 col-md-3" style="padding-bottom:10px" >
<select name="trip" class="form-control select2" required>
<option selected="selected" disabled="disabled" value="">Select Trip</option>'; 
$result = sqL('trip');
							while($row = mysqli_fetch_assoc($result)) { $title = $row['title']; $val = $row['sn']; $edittrip .= '<option>'.$title.'</option>'; }

$edittrip .= '</select></div>';
$edittrip .= myInput('adult','Adult Price',3,'required');
$edittrip .= myInput('child','Child Price',3,'required');
$edittrip .= myBtn('editTrip','Update Trip Data',12);




/// ADD VEHICLE//////

$addvehicle = myInput('make','Make (e.g: Peugeout)',3);

$addvehicle .= myInput('model','Model',3,'required');
$addvehicle .= myInput('chasisno','Chasis Number',3,'required');
$addvehicle .= myInput('tallyno','Tally Number',3);
$addvehicle .= myInput('plateno','Plate Number',3);

$addvehicle .= myInput('capacity','Passenger Capacity',3);
$addvehicle .= myInput('color','Vehicle Color',3);
$addvehicle .= myInput('other','Other Information',12);

$addvehicle .= myBtn('addVehicle','Register Vehicle');




/// ADD VEHICLE LOG//////

$addvehiclelog = '<div class="col-xs-12 col-sm-12 col-md-3" style="padding-bottom:10px" >
<select name="vehicle" class="form-control select2" required>
<option selected="selected" disabled="disabled" value="">Select Vehicle</option>'; 
$result = $db->query("SELECT * FROM vehicle WHERE status=0") or die();
							while ($row = mysqli_fetch_assoc($result)) { $cat = $row['plateno']; $addvehiclelog .= '<option>'.$cat.'</option>'; }

$addvehiclelog .= '</select></div>';


$addvehiclelog .= '<div class="col-xs-12 col-sm-12 col-md-3" style="padding-bottom:10px" >
<select name="trip" class="form-control select2" required>
<option selected="selected" disabled="disabled" value="">Select Trip</option>'; 
$result = $db->query("SELECT * FROM trip") or die();
							while ($row = mysqli_fetch_assoc($result)) { $cat = $row['title']; $addvehiclelog .= '<option>'.$cat.'</option>'; }

$addvehiclelog .= '</select></div>';

$addvehiclelog .= '<div class="col-xs-12 col-sm-12 col-md-3" style="padding-bottom:10px" >
<select name="driver" class="form-control select2" required>
<option selected="selected" disabled="disabled" value="">Select Driver</option>'; 
$result = $db->query("SELECT * FROM admin WHERE usertype=0") or die();
							while ($row = mysqli_fetch_assoc($result)) { $cat = $row['surname'].' '.$row['othername']; $addvehiclelog .= '<option>'.strtoupper($cat).'</option>'; }
$addvehiclelog .= '</select></div>';
$addvehiclelog .= '<div class="col-xs-12 col-sm-12 col-md-3" style="padding-bottom:10px" >
<input type="text" name="date" class="form-control pull-right" id="datepicker"  placeholder="Trip Date" onkeydown="return false"></div>';
$addvehiclelog .= '<div class="col-xs-12 col-sm-12 col-md-3" style="padding-bottom:10px" >
<select name="time" class="form-control select2" required>
<option selected="selected" disabled="disabled" value="">Select Time</option>'; 
$result = $db->query("SELECT * FROM tripcat WHERE sn<4") or die();
							while ($row = mysqli_fetch_assoc($result)) { $cat = $row['time']; $addvehiclelog .= '<option>'.strtoupper($cat).'</option>'; }
$addvehiclelog .= '</select></div>';
$addvehiclelog .= myInput('startodo','Start Odometer',3);
$addvehiclelog .= myInput('startfuel','Start Fuel Level',3,'required');

$addvehiclelog .= myBtn('addVehicleLog','Enter Vehicle Log');




///VEHICLE LOG UPDATE
$addvehiclelog2 = myInputV('endodo','End Odometer',6,$rw['endodo']);
$addvehiclelog2 .= myInputV('endfuel','End Fuel Level',6,$rw['endfuel']);
$addvehiclelog2 .= myInputV('additionalfuel','Additional Fuel',6,$rw['additionalfuel']);
$addvehiclelog2 .= myInputV('fuelcost','Fuel Cost',6,$rw['fuelcost']);
$addvehiclelog2 .= myInputV('maintenance','Cost on Transit',6,$rw['maintenance']);
$addvehiclelog2 .= '<textarea style="margin-right:10px" name="other2" class="form-control" rows="3" placeholder="Trip Report">'.$rw['other2'].'</textarea><br>';
$addvehiclelog2 .= myBtn('updateVehicleLog','Update Vehicle Log');




///Add Ticket
if($_GET['vehiclelog']){
		$snVL = $_GET['vehiclelog']; 
$sql = $db->query("SELECT * FROM vehiclelog WHERE sha1(sn) = '$snVL' ");
$row=mysqli_fetch_assoc($sql);

$trip = $row['trip'];
$sql = $db->query("SELECT * FROM trip WHERE title = '$trip' ");
$row=mysqli_fetch_assoc($sql);

		
$addticket = '<div class="col-lg-6" style="padding-bottom: 10px">
<select name="option1" id="option1" class="form-control">
   <option value="4" selected>ADULT</option>
   <option value="5">CHILD</option>
</select> </div>
<div class="col-lg-6" id="4" style="display: block"><h2 style="margin:0">₦'.number_format($row['adult']).'</h2><input type="hidden" value="'.$row['adult'].'" name="adult"></div>
<div class="col-lg-6" id="5" style="display: none"> <h2 style="margin:0">₦'.number_format($row['child']).'</h2><input type="hidden" value="'.$row['child'].'" name="child"></div><br><br><br>';

$addticket .= myInput('name','Full Name');
$addticket .= myInput('phone','Phone Number');
$addticket .= myInput('address','Address');
$addticket .= myInput('destination','Destination');
$addticket .= myInput('nextofkin','Next-of-Kin');
$addticket .= myInput('nextphone','Next-of-Kin Phone Number');


$addticket .= myBtn('addTicket','Register Passenger');


}



		


//Add Branch
$addbranch = myInput('branch','Branch Title',4);
$addbranch .= myInput('address','Branch Address',5);

$addbranch .= myBtn('addBranch','Register Branch Office');




//Add User
$adduser = myInput('surname','Surname',4,'required');
$adduser .= myInput('othername','Other Names',5,'required');
$adduser .= myInput('phone','Phone Number',4,'required');
$adduser .= myInput('address','Residential Address',4,'required');
$adduser .= '<div class="col-xs-12 col-sm-12 col-md-4" style="padding-bottom:10px" >
<select name="sex" class="form-control select2" required>
<option selected="selected" disabled="disabled" value="">Gender</option>
<option>MALE</option>
<option>FEMALE</option>
</select></div>';
$adduser .= '<div class="col-xs-12 col-sm-12 col-md-3" style="padding-bottom:10px" >
<select name="usertype" class="form-control select2" required>
<option selected="selected" disabled="disabled" value="">User Level</option>
<option value="0">Driver</option>
<option value="1">Ticket Officer</option>
<option value="2">Administrator</option>
</select></div>';
$adduser .= '<div class="col-xs-12 col-sm-12 col-md-3" style="padding-bottom:10px" >
<select name="branch" class="form-control select2" required>
<option selected="selected" disabled="disabled" value="">Select Branch</option>'; 
$result = $db->query("SELECT * FROM branch") or die();
							while ($row = mysqli_fetch_assoc($result)) { $cat = $row['branch'];  $valu = $row['sn']; $adduser .= '<option value="'.$valu.'">'.$cat.'</option>'; }
$adduser .= '</select></div>';
$adduser .= myInput('email','E-mail',3,'required');

$adduser .= myInput('password','Password',3,'required');
$adduser .= myBtn('addUser','Register User');



///Add Vehicle Photo
$addphoto = '<div class="col-xs-12 col-sm-12 col-md-3" style="padding-bottom:10px" >
<select name="vehicle" class="form-control select2" required>
<option selected="selected" disabled="disabled" value="">Select Vehicle</option>'; 
$result = $db->query("SELECT * FROM vehicle") or die();
							while ($row = mysqli_fetch_assoc($result)) { $cat = $row['plateno'];   $addphoto .= '<option>'.$cat.'</option>'; }
$addphoto .= '</select></div>';
$addphoto .= '<div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" ><input type="file" name="image" class="form-control"></div>';
$addphoto .= myBtn('addPhoto','Update Vehicle Photo');



///Add User Photo
$userphoto = '<div class="col-xs-12 col-sm-12 col-md-3" style="padding-bottom:10px" >
<select name="user" class="form-control select2" required>
<option selected="selected" disabled="disabled" value="">Select User</option>'; 
$result = $db->query("SELECT * FROM admin") or die();
							while ($row = mysqli_fetch_assoc($result)) { $cat = $row['surname'].' '.$row['othername'];   $userphoto .= '<option value="'.$row['sn'].'">'.$cat.'</option>'; }
$userphoto .= '</select></div>';
$userphoto .= '<div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" ><input type="file" name="image" class="form-control"></div>';
$userphoto .= myBtn('userPhoto','Update User Photo');



//Add parcel
$addparcel = myInput('title','Parcel Title',3);
$addparcel .= myInput('content','Parcel Content',3);
$addparcel .= myInput('weight','Parcel Weight',3);
$addparcel .= myInput('name','Sender\'s Name',3);
$addparcel .= myInput('phone','Sender\'s Phone Number',3);
$addparcel .= myInput('name2','Receiver\'s Name',3);
$addparcel .= myInput('phone2','Receiver\'s Phone Number',3);
$addparcel .= myInput('location','Sending Location',3);
$addparcel .= myInput('location2','Receiving Location',3);
$addparcel .= '<div class="col-xs-12 col-sm-12 col-md-3" style="padding-bottom:10px" ><input type="number" name="fee" class="form-control" placeholder="Charges (in Naira)" /></div>';
$addparcel .= myBtn('addParcel','Register Parcel',3);




//Add Track Report
$numTra = sqL1x('trackparcel','trackid',$trackno,3);
if($numTra==0){$reporttra = 'Parcel Successfully Registered: '.$parcelStatH;  }
else if($numTra==1){$reporttra = 'Parcel Leaves '.$Loc1;  }
else if($numTra==2){$reporttra = 'Parcel Arrives '.$Loc2;  }
else if($numTra==3){$reporttra = $Rec.' Contacted for parcel Pickup';  }
else if($numTra==4){$reporttra = 'Parcel Delivered to '.$Rec;  }

if($numTra<5){
				
$trackparcel = '<input type="hidden" name="report" value="'.$reporttra.'">';
$trackparcel .= '<button style="text-align:center; width:100%" type="submit" class="btn btn-success" value="'.$Trackno.'" name="addTrackReport">'.$reporttra.'</button>';
}else{$trackparcel = 'Parcel Has Been Delivered to Recipient'; }

?>