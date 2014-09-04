<?php 
    require("common.php"); 
  require_once('recaptchalib.php');
  $privatekey = "6LczWekSAAAAAFAvL9H-1L4ONgrNeB1pjyNj9dMB";
  
		// Your code here to handle a successful verification
		if(empty($_POST["email"]) or empty($_POST["password"])) 
		{
			echo "Error! You failed to enter all fields.";
			exit();
		}
		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
		{ 
			echo "Error! Invalid email address.";
			exit();
		} 
 
		$query = "SELECT * FROM users WHERE username = :username"; 
		$query_params = array( 
			':username' => $_POST['username'] 
		); 
         
        try 
        { 

            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 

            die("Failed to run query: " . $ex->getMessage()); 
        } 

        $row = $stmt->fetchAll(); 		
		
        if(!empty($row))
        { 
            echo "Error! User already in use."; 
			die();
        } 
		
        $query = " 
            SELECT 
                1 
            FROM users 
            WHERE 
                email = :email 
        "; 
         
        $query_params = array( 
            ':email' => $_POST['email'] 
        ); 
         
        try 
        { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 

        catch(PDOException $ex) 
        { 
            die("Failed to run query: " . $ex->getMessage()); 
        } 
         
        $row = $stmt->fetch(); 
         
        if(!empty($row)) 
        { 
            echo "Error! Email already in use.";
			exit();
        } 
		$dob_dd = $_POST['dob_dd'];
		$dob_mm = $_POST['dob_mm'];
		$dob_yy = $_POST['dob_yy'];
		
		$date_of_birth = $dob_yy.'-'.$dob_mm.'-'.$dob_dd;
        $query = " 
            INSERT INTO users ( 
                username, 
                password, 
				salt,
                email,
				date_of_birth,
				
				verifyid
            ) VALUES ( 
                :username, 
                :password, 
                 :salt,
                :email,
				:date_of_birth,
				
				:verifyid
            ) 
        "; 

        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 

        $password = hash('sha256', $_POST['password'] . $salt); 

        for($round = 0; $round < 65536; $round++) 
        { 
            $password = hash('sha256', $password . $salt); 
        } 
		
		
		$randhash = md5(time());
        $query_params = array( 
            ':username' => strip_tags($_POST['username']), 
            ':password' => $password, 
            ':salt' => $salt, 
            ':email' => strip_tags($_POST['email']),
			':date_of_birth'=>$date_of_birth,
			':verifyid' => $randhash
        ); 
         
        try 
        { 
 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params);
			
			$LastId = $db->lastInsertId();
			
			$Query = "INSERT INTO users_profile (user_id,first_name)
			
			values ('$LastId','".strip_tags($_POST['username'])."')
			";
			
			$Profile = $db->prepare($Query);
			$Profile->execute();
			
			
			include("vbulletin4/includes/class.vbulletin-bridge.php");

				$forum = new vBulletin_Bridge();
	$RegisterArray = array(
	'username'=>$_POST['username'],
	'email'=>$_POST['email'],
	'password'=>$_POST['password'],
	'usergroupid'=>2,
	'usertitle'=>$_POST['username']
	);
	$forum->register_newuser($RegisterArray,true);
        } 
        catch(PDOException $ex) 
        { 
 
            die("Failed to run query: " . $ex->getMessage()); 
        } 
		mail($_POST["email"], "Verify Your CGL Account", "Please Visit This Link To Verify Your C-GL.org Account http://electronicgaming.net/beta/verifyemail.php?id=".$randhash."&username=".$_POST["username"]."");
        echo('Successfully Registered!');
		  
		
?> 
