<?php
session_start();
require_once('myDb.php');

if(isset($_SESSION["user"]["username"]) or !empty($_SESSION["user"]["username"]))
{	
	//Check input for sql inj//
	$user = $_SESSION["user"]["id"];
	if(isset($_POST['frmName']) && ($_POST['frmName'] == 'updateEmail')) 	
	{
		$email = $_POST['email'];
		$nEmail = $_POST['new_email'];
		
		//Chk email belongs to auth user
		$qry = "Select * from users where id='" . $user . "'"; 
		if(!$result = mysqli_query($con,$qry))
		Die('Error in query');
		if(mysqli_num_rows($result) >= 1)
		{
			$rec = mysqli_fetch_assoc($result);
			if($rec['email'] == $email)
			{	
			
				$qry = "update users set email='" . $nEmail . "' where id ='" . $user . "'";
				if(!mysqli_query($con,$qry))
				Die('Error in query');
				else
				echo 'Email successfully updated';
			}
			else
			Die('Invalid email or email not belongs to current user');
		}
		else
		{
			echo 'Error: Invalid User!';
		}
         
    }
	elseif(isset($_POST['frmName']) && ($_POST['frmName'] == 'updateInfo'))
	{
		//chk input for sql inj
		
		 
		
		
		
		$qry = "Select * from users_profile where user_id='" . $user . "'"; 
		if(!$result = mysqli_query($con,$qry))
		Die('Error in query');
		if(mysqli_num_rows($result) >= 1)
		{	
		
			$fName = '';
			$lName = '';
			$dob_dd = '00';
			$dob_mm = '00';
			$dob_yy = '0000';
			$status = '';
			$country = '';
			if(isset($_POST['fname']) && !empty($_POST['fname']))
			$fName = $_POST['fname'];
			if(isset($_POST['lname']) && !empty($_POST['lname']))
			$lName = $_POST['lname'];
			if(isset($_POST['dob_dd']) && !empty($_POST['dob_dd']))
			$dob_dd = $_POST['dob_dd'];
			if(isset($_POST['dob_mm']) && !empty($_POST['dob_mm']))
			$dob_mm = $_POST['dob_mm'];
			if(isset($_POST['dob_yy']) && !empty($_POST['dob_yy']))
			$dob_yy = $_POST['dob_yy'];
			
			$DOB = $dob_yy.'-'.$dob_mm.'-'.$dob_dd;
			
			if(isset($_POST['country']) && !empty($_POST['country']))
			$country = $_POST['country'];
			
			$qry = "update users_profile set first_name='" . $fName . "',last_name='" . $lName . "',country='" . $country . "' where user_id='" . $user . "'";
			
			
			if(!mysqli_query($con,$qry))
			Die('Error in query');
			
			
			$qry = "update users set date_of_birth='" . $DOB . "' where id='" . $user . "'";
			
			
			if(!mysqli_query($con,$qry))
			Die('Error in query');			
			else
			echo 'Information Updated!';
			
		}
		else
		{
			$qry = "Insert Into users_profile (user_id,first_name,last_name,age,status,country)values('" . $user . "','" . $fName . "','" . $lName . "'," . $age . ",'" . $status . "','" . $country . "')";

			if(!mysqli_query($con,$qry))
			Die('Error in query');
			else
			echo 'Information Updated!';
		}
		
	}
	elseif(isset($_POST['frmName']) && ($_POST['frmName'] == 'updatePassword'))
	{
		$pass = null;
		$new_pass = null;
		$cnew_pass = null;
		
		if(isset($_POST['old_pass']) && !empty($_POST['old_pass']))
			$pass = $_POST['old_pass'];
		if(isset($_POST['new_pass']) && !empty($_POST['new_pass']))
			$new_pass = $_POST['new_pass'];
		if(isset($_POST['cnew_pass']) && !empty($_POST['cnew_pass']))
			$cnew_pass = $_POST['cnew_pass'];
		if($new_pass != $cnew_pass)
		{
		echo 'Passwords do not match.';
		exit;
		}
		$OldPasswordCheck = mysqli_query($con,"SELECT password,salt,old_salt FROM users WHERE id='".$_SESSION['user']['id']."'");
		$Record = mysqli_fetch_array($OldPasswordCheck);
		$check_password = hash('sha256', $pass . $Record['salt']); 
            for($round = 0; $round < 65536; $round++) 
            { 
                $check_password = hash('sha256', $check_password . $Record['salt']); 
            } 
             
            if($check_password === $Record['password']) 
            { 

                $login_ok = true; 
            }
			else
			{
				
			echo 'Old Password doesn\'t match.';exit;	
			}
		
		$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 

        $password = hash('sha256', $new_pass . $salt); 

        for($round = 0; $round < 65536; $round++) 
        { 
            $password = hash('sha256', $password . $salt); 
        } 

        
        
		mysqli_query($con,"UPDATE users SET password='$password',salt='$salt' WHERE id='".$_SESSION['user']['id']."'"); 
             
			 echo 'Password Successfully changed!';exit;
		
		
	}
	elseif(isset($_POST['frmName']) && ($_POST['frmName'] == 'updateStatus'))
	{
		$status = $_POST['status'];
		$qry = "update users_profile set status='" . $status . "' where user_id ='" . $user . "'";
		if(!mysqli_query($con,$qry))
		echo $qry;
		else
		echo 'Status successfully updated.';
		
	}
	
}
else
header("Location:/home");

?>