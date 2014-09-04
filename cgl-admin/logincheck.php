<?php 

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
				timestamp
            FROM admin_users 
            WHERE 
                username = :username 
        "; 

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

            unset($row['salt']); 
            unset($row['password']); 
            
            $_SESSION['user'] = $row; 
			if($_POST["remember"] == "1"){
			}
            header("Location: home"); 
            die("Redirecting to: home");
			
        } 
        else 
        { 
            header("Location: login?s=failed&title=Error!&r=Invalid%20Username%20or%20Password."); 
            $submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8'); 
   		 } 
?> 
