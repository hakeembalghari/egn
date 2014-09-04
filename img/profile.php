<?PHP
session_start();
require_once('myDb.php');
$user = $_SESSION['user']['username'];
$recRendered = false;

$staus = null;
$age = null;
$country = null;
$member_date = null;
$name = null;	
if(!isset($_SESSION["user"]["username"]) or empty($_SESSION["user"]["username"]))
{		
	echo '<p style="padding:10px;">You are not authorized to view this page</p>';
}
else
{
	$qry = "Select `users`.timestamp,`users_profile`.* from users inner join users_profile on `users`.username = `users_profile`.user_name";
	if(!$result = mysqli_query($con,$qry))
	echo('Error in query');
	else
	{
		if(mysqli_num_rows($result) >= 1)
		{
			$recRendered = true;
			$rec = mysqli_fetch_assoc($result);
			
			$status = $rec['status'];
			$age = $rec['age'];
			$country = $rec['country'];
			$member_date = $rec['timestamp'];
			$name = $rec['first_name'] . " " . $rec['last_name'];;
		}
	}
if($recRendered)
{	
?>
<div class="mcontain">
	<div class="mbox">
		
		
		<div style="width: 960px; padding:0px 2px 10px 0px;float:left;">
			<div style="width: 960px;height:140px;float:left;border:1px solid #000;">
				<img style="float:left;padding:10px 5px 0px 10px;" src="img/bf3.png" width="100" height="100" alt=""/>
				<div style="float:left;width:540px;height:120px;padding:12px;">
					<h1 style="color:#4CAED8;font-size:22px;padding:0px;margin:0px;line-height:24px;"><?php echo $user ?></h1>
					<h3 style="color:#4CAED8;font-size:16px;padding:0px;margin:0px;line-height:24px;display:inline-block;">Status: <?php echo $status ?></h3><img src="img/pencil.png" alt="" width="24" height="24"/>
					<h4 style="color:#4CAED8;font-size:12px;padding:0px;margin:0px;">Member Since: <?php echo $member_date ?></h4>
				</div>
			
			</div>
			<div style="float:left;height:auto;width:160px;">
				<div style="width:160px;float:left">
				<div class="bluebox">
					<p>About Me</p>
				</div>
				<div class="boxpill">
					<div class="boxpill">
						<span>Name: <?php echo $name ?></span>
					</div>
					<div class="boxpill">
						<span>Age: <?php echo $age ?></span>
					</div>
					<div class="boxpill">
						<span>Country: <?php echo $country ?></span>
					</div>
					<div class="boxpill">
						<span>Games:</span>
					</div>
				</div>
				</div>
				<div style="width:160px;float:left;">
				<div class="bluebox">
					<p>Stats</p>
				</div>
				<div class="boxpill" style="height:112px;">
				</div>
				
				</div>
				<div style="width:160px;float:left;">
					<div class="bluebox">
						<p>Friends</p>
					</div>
					<div class="boxpill" style="height:88px;">
					</div>
				
				</div>
				<div style="width:160px;float:left;">
					<div class="bluebox">
						<p>Recent Visitors</p>
					</div>
					<div class="boxpill" style="height:93px;">
					</div>
				</div>
			

			</div>
			<div style="float:left;height:auto;width:640px;">
				<div style="width:640px;float:left;">
					<div class="bluebox">
						<p>Awards Showcase</p>
					</div>
					<div class="boxpill" style="height:112px;">
					</div>
				
				</div>
				<div style="width:640px;float:left;">
					<div class="bluebox">
						<p>Biography</p>
					</div>
					<div class="boxpill" style="height:112px;">
					</div>
				
				</div>
				<div style="width:640px;float:left;">
					<div class="bluebox">
						<p>My Setup</p>
					</div>
					<div class="boxpill" style="height:224px;">
					</div>
				
				</div>
			</div>
			
			<div style="float:left;height:auto;width:160px;">
				<div style="width:160px;float:left;">
					<div class="bluebox">
						<p>Social</p>
					</div>
					<div style="height:112px;" class="boxpill">
						<div class="boxpill">
							<img style="padding-right: 5px;" src="img/blr.png" height="16" width="16" />Facebook
						</div>
						<div class="boxpill">
							<img style="padding-right: 5px;" src="img/blr.png" height="16" width="16" />Facebook
						</div>
						<div class="boxpill">
							<img style="padding-right: 5px;" src="img/blr.png" height="16" width="16" />Facebook
						</div>
						
					</div>
				</div>
				<div style="width:160px;float:left;">
					<div class="bluebox">
						<p>Current Team</p>
					</div>
					<div class="boxpill" style="height:112px;">
					</div>
				</div>
				<div style="width:160px;float:left;">
					<div class="bluebox">
						<p>Matches</p>
					</div>
					<div class="boxpill" style="height:88px;">
					</div>
				</div>
				<div style="width:160px;float:left;">
					<div class="bluebox">
						<p>My Config</p>
					</div>
					<div class="boxpill" style="height:93px;">
					</div>
				</div>
			</div>
			<div style="width:640px;float:left;height:100px;">
				<div style="width:640px;float:left;">
					<div class="bluebox">
						<p>Comments</p>
					</div>
					<div class="boxpill" style="height:100px;">
					</div>
				</div>
			</div>
			<div style="width:320px;float:left;height:100px;">
				<div style="width:320px;float:left;">
					<div class="bluebox">
						<p>Advertise</p>
					</div>
					<div class="boxpill" style="height:100px;">
					</div>
				</div>
			</div>
						
		</div>
		
		

</div>
</div>
<?php
} 
	} 
?>