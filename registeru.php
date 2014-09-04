<?php 
    require("common.php"); 
  require_once('recaptchalib.php');
  $privatekey = "6LczWekSAAAAAFAvL9H-1L4ONgrNeB1pjyNj9dMB";
  $resp = recaptcha_check_answer ($privatekey,
       $_SERVER["REMOTE_ADDR"],
       $_POST["recaptcha_challenge_field"],
       $_POST["recaptcha_response_field"]);
//if (1==2) {
   if (!$resp->is_valid) {
    // What happens when the CAPTCHA was entered incorrectly
    echo "<script>window.location=' register/failed?title=Error!&r=Wrong%20Captcha,%20Please%20Try%20To%20Enter%20Again!';</script>";
   } else {
    // Your code here to handle a successful verification
  
    if(empty($_POST["email"]) or empty($_POST["username"]) or empty($_POST["password"])) 
    { header('Location: register/failed?title=Error!&r=You%20Failed%20To%20Enter%20All%20Fields!'); die("All Fields Not Entered"); }
    if($_POST['username']==$_POST['password']){header('Location: register/failed?title=Error! Username and Password should not be same'); die("All Fields Not Entered");}
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
        { 
            header("Location: register/failed?title=Error!&r=Invalid%20E-Mail!"); 
        } 
 
        $query = " 
            SELECT 
                * 
            FROM users 
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
            header("Location: register/failed?title=Error!&r=E-Mail%20Already%20In%20Use!"); 
        } 
		
		if($_POST["password"] !== $_POST["repassword"]){
			header("Location: register/failed?title=Error!&r=You%20Failed%20To%20Repeat%Your%Entered%Password"); 
		}

        $query = " 
            INSERT INTO users ( 
                username, 
                password, 
                salt, 
                email,
				fullname,
				birthdate,
				secretquestion,
				secretanswer,
				verifyid,
				twitch_username
            ) VALUES ( 
                :username, 
                :password, 
                :salt, 
                :email,
				:fullname,
				:birthdate,
				:secretquestion,
				:secretanswer,
				:verifyid,
				:twitch_username
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
		$randhash = md5(time());
        $query_params = array( 
            ':username' => strip_tags($_POST['username']), 
            ':password' => $password, 
            ':salt' => $salt, 
            ':email' => strip_tags($_POST['email']),
			':fullname' => strip_tags($_POST["fullname"]),
			':birthdate' => strip_tags($bday),
			':secretquestion' => strip_tags($_POST["secret"]),
			':secretanswer' => strip_tags($secretanswer),
			':verifyid' => $randhash,
			':twitch_username'=>$_POST['twitch_username']
        ); 
         
        try 
        { 
		
	
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
				include("vbulletin4/includes/class.vbulletin-bridge.php");

				$forum = new vBulletin_Bridge();
	$RegisterArray = array(
	'username'=>$_POST['username'],
	'email'=>$_POST['email'],
	'password'=>$_POST['password'],
	'usergroupid'=>2,
	'usertitle'=>$_POST['fullname']
	);
	$forum->register_newuser($RegisterArray,true);
        } 
        catch(PDOException $ex) 
        { 
 
            die("Failed to run query: " . $ex->getMessage()); 
        } 
		mail($_POST["email"], "Verify Your CGL Account", "Please Visit This Link To Verify Your EGN Account http://electronicgaming.net/beta/verifyemail.php?id=".$randhash."&username=".$_POST["username"]."");
        header("Location: home");
		die("Redirecting to login.php");  
		}
?> 
