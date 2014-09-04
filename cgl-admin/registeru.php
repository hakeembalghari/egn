<?php 
    require("common.php"); 
    // Your code here to handle a successful verification
  
    if(empty($_POST["email"]) or empty($_POST["username"]) or empty($_POST["password"])) 
    { header('Location: register/failed?title=Error!&r=You%20Failed%20To%20Enter%20All%20Fields!'); die("All Fields Not Entered"); }

        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
        { 
            header("Location: register/failed?title=Error!&r=Invalid%20E-Mail!"); 
        } 
 
        $query = " 
            SELECT 
                * 
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

        $row = $stmt->fetchAll(); 		
		
        if(!empty($row))
        { 
            header("Location: register/failed?title=Error!&r=Username%20Already%20In%20Use!"); 
			die();
        } 
		
        $query = " 
            SELECT 
                1 
            FROM admin_users 
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
            header("Location: register/failed?title=Error!&r=E-Mail%20Already%20In%20Use!"); 
        } 
		

        $query = " 
            INSERT INTO admin_users ( 
                username, 
                password, 
                salt, 
                email
            ) VALUES ( 
                :username, 
                :password, 
                :salt, 
                :email
            ) 
        "; 

        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 

        $password = hash('sha256', $_POST['password'] . $salt); 

        for($round = 0; $round < 65536; $round++) 
        { 
            $password = hash('sha256', $password . $salt); 
        } 
		
		$secretanswer = md5($_POST["secretanswer"]);
		$bday = "".$_POST["bfirst"]." ".$_POST["bsecond"].", ".$_POST["bthird"]."";
		
        $query_params = array( 
            ':username' => strip_tags($_POST['username']), 
            ':password' => $password, 
            ':salt' => $salt, 
            ':email' => strip_tags($_POST['email'])
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
        header("Location: home/success?title=Success!&r=You%20May%20Now%20Login%20Securely.");
		die("Redirecting to login.php");  
		
?> 
