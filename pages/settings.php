<?PHP
//Auth to open this page?
session_start();
require_once('myDb.php');
$user = $_SESSION["user"]["id"];

$fName = null;
$lName = null;
$dob_dd = null;
$dob_mm = null;
$dob_yy = 2014;
$country = null;
$email = null;
$countries = array();	

$ProfileCheck = mysqli_query($con,"SELECT user_id FROM users_profile WHERE user_id='".$_SESSION['user']['id']."'");
	
	$ProfileCheck = mysqli_fetch_array($ProfileCheck);
	
	if(count($ProfileCheck)==0)
	{
	mysqli_query($con,"INSERT INTO users_profile (user_id,first_name) VALUES ('".$_SESSION['user']['id']."','".$_SESSION['user']['username']."')");	
		echo "<script>location.reload();</script>";
		exit;
	}

$qry = "Select `users_profile`.*,`users`.email,users.date_of_birth from users_profile inner join users on `users_profile`.user_id = `users`.id where `users_profile`.user_id='" . $user . "'"; 
if(!$result = mysqli_query($con,$qry))
Die('Error in query');
if(mysqli_num_rows($result) >= 1)
{	
	$rec = mysqli_fetch_assoc($result);
	$fName = $rec['first_name'];
	$lName = $rec['last_name'];
	$dob_dd = date('d',strtotime($rec['date_of_birth']));
	$dob_mm = date('m',strtotime($rec['date_of_birth']));
	$dob_yy = date('Y',strtotime($rec['date_of_birth']));
	$country = $rec['country'];
	$email = $rec['email'];
}			

$qry = "Select * from tbl_countries";
if(!$result = mysqli_query($con,$qry))
Die('Error in query');
if(mysqli_num_rows($result) >= 1)
{	
	while(($rec = mysqli_fetch_assoc($result)) != null)
	{
		$countries[] = $rec['country_name'];
	}

}			
?>
<div class="mcontain">
	<div class="mbox">
		
		
		<div style="width:960px; padding:0px 2px 10px 0px;float:left;">
			<div class="bluebox">
					<p>Settings</p>
			</div>
			
			<div style="float:left;height:auto;width:470px;">
				<div style="width:450px;float:left;padding:10px;">
				<div class="bluebox">
					<p>Change Email</p>
				</div>
				<form class="form-horizontal" method="POST" action="" style="padding-top:20px;" id="frmUpdateEmail">
				<div class="control-group input-append">
					<label class="control-label" for="inputEmail">Current Email Address</label>
					<div class="controls">
						<input type="text"  name="email" placeholder="Current Email" readonly value="<?php echo $email ?>">
					
					</div>
				</div>
				<div class="control-group input-append">
					<label class="control-label" for="inputEmail">New Email Address</label>
						<div class="controls">
							<input type="text"  name="new_email" placeholder="New Email">
							
						</div>
				</div>
				<div class="control-group">
					
					<div class="controls">
						<span id="_msg_email" style="line-height: 2; height: 30px; font-weight: 700; background-color: #1A1A1A; border: 1px solid #000;padding:4px;color:#ff0000;display:none;"></span>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<input type="hidden" name="frmName" value="updateEmail"/>
						<button type="submit" class="btn btn-inverse">Update Email Address</button>
					</div>
				</div>
				</form>
				</div>
				
				<div style="width:450px;float:left;padding:10px;">
				<div class="bluebox">
					<p>Change Password</p>
				</div>
				<form class="form-horizontal" method="POST" action="" style="padding-top:20px;" id="frmUpdatePass">
				<div class="control-group input-append">
					<label class="control-label" for="input">Old Password</label>
					<div class="controls">
						<input type="password"  name="old_pass" placeholder="Password">
					
					</div>
				</div>
				<div class="control-group input-append">
					<label class="control-label" for="inputEmail">New Password</label>
						<div class="controls">
							<input type="password"  name="new_pass" placeholder="Password">
							
						</div>
				</div>
				<div class="control-group input-append">
					<label class="control-label" for="inputEmail">Confirm New Password</label>
						<div class="controls">
						
							<input type="hidden" name="frmName" value="updatePassword"/>
							<input type="password"  name="cnew_pass" placeholder="Password">
						</div>
				</div>
				<div class="control-group">
					
					<div class="controls">
						<span id="_msg_pass" style="line-height: 2; height: 30px; font-weight: 700; background-color: #1A1A1A; border: 1px solid #000;padding:4px;color:#ff0000;display:none;"></span>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<input type="hidden" name="frmName" value="updatePassword"/>
						<button type="submit" class="btn btn-inverse">Change Password</button>
					</div>
				</div>
				</form>
				</div>
				
			</div>
			
			<div style="width:470px;float:left;padding:10px 0px 0px 0px;">
				<div class="bluebox">
					<p>Personal Information</p>
				</div>
				<form id="frmUpdateInfo" class="form-horizontal" method="POST" action="" style="padding-top:20px;" >
				<div class="control-group input-append">
					<label class="control-label" for="inputEmail">Username</label>
					<div class="controls">
						<input type="text" id="inputUser" name="user_name" placeholder="Username" readonly value="<?php echo $_SESSION['user']['username']; ?>">
					
					</div>
				</div>
				<div class="control-group input-append">
					<label class="control-label" for="inputEmail">First Name</label>
						<div class="controls">
							<input type="text" id="inputPass" name="fname" placeholder="First Name" value="<?php echo $val =($fName != 'null'?$fName:'') ?>">
							
						</div>
				</div>
				<div class="control-group input-append">
					<label class="control-label" for="inputEmail">Last Name</label>
						<div class="controls">
							<input type="text" id="inputPass" name="lname" placeholder="Last Name" value="<?php echo $val =($lName != 'null'?$lName:'')?>">
							
						</div>
				</div>
				<div class="control-group input-append">
					<label class="control-label" for="inputEmail">Date of birth</label>
						<div class="controls">
                        <select name="dob_dd"  style="width:60px;margin-right:10px;">
							<option>DD</option>
							<?php
							for($i=1;$i<=31;$i++)
							{
								if($dob_dd == $i)
								echo "<option selected>" . $i . "</option>";
								else
								echo "<option >" . $i . "</option>";
							}
							
							?>
							</select>
							<select name="dob_mm"  style="width:60px; margin-right:10px">
							<option>MM</option>
							<?php
							
							for($i=1;$i<=12;$i++)
							{
								if($dob_mm == $i)
								echo "<option value='".$i."' selected>" . date('M',strtotime("01-".$i."-2014")) . "</option>";
								else
								echo "<option value='".$i."' >" . date('M',strtotime("01-".$i."-2014")) . "</option>";
							}
							
							
							?>
							</select>
							
							<select name="dob_yy"  style="width:80px;">
							<option>YYYY</option>
							<?php
							for($i=1950;$i<=2014;$i++)
							{
								if($dob_yy == $i)
								echo "<option selected>" . $i . "</option>";
								else
								echo "<option >" . $i . "</option>";
							}
							
							?>
							</select>
							
							
						</div>
				</div>
				
				<div class="control-group input-append">
					<label class="control-label" for="inputEmail">Country</label>
						<div class="controls">
							<select name="country">
							<option>Select Country</option>
							<?php
							foreach($countries as $c)
							{
								if($country == trim($c))
								echo "<option selected>" . $c . "</option>";
								else
								echo "<option>" . $c . "</option>";
							}
							
							?>
							</select>
							
							
						</div>
				</div>
				<div class="control-group">
					
					<div class="controls">
						<span id="_msg_info" style="line-height: 2; height: 30px; font-weight: 700; background-color: #1A1A1A; border: 1px solid #000;padding:4px;color:#ff0000;display:none;"></span>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<input type="hidden" name="frmName" value="updateInfo"/>
						<button type="submit" class="btn btn-inverse">Update Personal Information</button>
					</div>
				</div>
				</form>
			</div>
			
			
			
			
						
		</div>
		
		
			
				
		
		

</div>
</div>