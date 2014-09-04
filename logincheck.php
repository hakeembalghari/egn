<?php 
//ob_start();
    require("common.php"); 
    $submitted_username = '';    
    if(!empty($_POST)) 
    { 
        $query = " 
            SELECT 
                id, 
                username, 
                password, 
                salt, 
                email,
				ip,
				timestamp,
				old_salt,
				fullname,
				birthdate,
				verified
            FROM users 
            WHERE 
             
        "; 

		if(filter_var($_POST['username'], FILTER_VALIDATE_EMAIL)) {
		
			$query .="email = :username";	
		}
		else
		{
			$query .="username = :username";
		}
		
		
		
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

        $login_ok = false; 
 
        $row = $stmt->fetch();
		
		if($row["verified"] !== "1"){
            echo "Please verify your email to login";exit;
			//header("Location: login/failed?title=Error!&r=Please%20Verify%20Your%20Email%20To%20Login!"); 
		}
		$vbcheck = null;
		if(strlen($row["salt"]) > "16"){
			$vbcheck = true;	
		}
		$dga = null;
		if($vbcheck){
			
		$vbconvert = md5(md5($_POST["password"]) . $row["salt"]);
			if($vbconvert == $row["password"]){
			
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 

        $password = hash('sha256', $vbconvert . $salt); 

        for($round = 0; $round < 65536; $round++) 
        { 
            $password = hash('sha256', $password . $salt); 
        } 
		// Begin Update And Placement Of Salt + New Pass \\
				
		 $query = " 
            UPDATE users SET password = '".$password."', SALT = '".$salt."' WHERE username = '".$row["username"]."'
        "; 
         
        try 
        { 

            $stmt = $db->prepare($query); 
            $result = $stmt->execute(); 
        } 
        catch(PDOException $ex) 
        { 

            die("Failed to run query: " . $ex->getMessage()); 
        } 
		$dga = "1";
		$login_ok = true;
		// End \\
			}else{
				die("Old Passwords Don't Match");	
			}
		}
        if($row and $dga !== "1" and isset($row["old_salt"]) and !empty($row["old_salt"])) 
        { 
			$finalcheck = md5(md5($_POST["password"]) . $row["old_salt"]);
            $check_password = hash('sha256', $finalcheck . $row['salt']); 
            for($round = 0; $round < 65536; $round++) 
            { 
                $check_password = hash('sha256', $check_password . $row['salt']); 
            } 
             
            if($check_password === $row['password']) 
            { 

                $login_ok = true; 
            } 
        } else { 

            $check_password = hash('sha256', $_POST['password'] . $row['salt']); 
            for($round = 0; $round < 65536; $round++) 
            { 
                $check_password = hash('sha256', $check_password . $row['salt']); 
            } 
             
            if($check_password === $row['password']) 
            { 

                $login_ok = true; 
            } 
        } 
        if($login_ok) 
        { 
			include("vbulletin4/includes/class.vbulletin-bridge.php");
			$forum = new vBulletin_Bridge();
            unset($row['salt']); 
            unset($row['password']); 
            $forum->login(array('username'=>$_POST['username'],
			'password'=>$_POST['password']));
            $_SESSION['user'] = $row; 
           
            echo "Successfully Login...";
			
			
        } 
        else 
        { 
		echo "Invalid username or password.";
           // header("Location: login/failed?title=Error!&r=Invalid%20Username%20or%20Password."); 
            $submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8'); 
       		 } 
   		 } 
		 //ob_end_flush();
?> 
