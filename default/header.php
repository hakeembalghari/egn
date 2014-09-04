<?PHP
	include('common.php');
	switch($_GET["p"]):
		case "home":
			$title = "Whats Your Game?";
			break;
		case "profile":
			$title = "Profile";
			break;
		case "settings":
			$title = "Account Settings";
			break;
		case "privacy":
			$title = "Privacy Policy";
			break;
		case "sponsors";
			$title = "Sponsors";
			break;
		case "tos";
			$title = "Terms of Service";
			break;
		case "genesis";
			$title = "Genesis Anti-Cheat";
			break;
		case "";
			$title= "Whats Your Game?";
			break;
		case "advertise";
			$title= "Advertise With EGN";
			break;
		case "register";
			$title= "Register With EGN";
			break;
		case "staff";
			$title= "Staff";
			break;
		case "support";
			$title= "Support Center";
			break;
		case "vticket";
			$title = "Viewing Ticket"; 
			break;
		case "login";
			$title = "Login"; 
			break;
		case "forums";
			$title = "Forums"; 
			break;
	endswitch;
	
	$query = "
           UPDATE users SET ip = '".$_SERVER['REMOTE_ADDR']."', page = :page WHERE id = '".$_SESSION["user"]["id"]."'
    ";  
	$query_params = array(
	":page" => $_GET["p"]
	);    
    try 
    {
        $stmt = $db->prepare($query); 
        $stmt->execute($query_params); 
    } 	
	catch(PDOException $ex) 
    {  
        die("Failed to run query: " . $ex->getMessage()); 
    }
	
	$SessionCheck = "SELECT SessionId FROM sessions WHERE SessionId='".session_id()."'";
	
	try
	{
	$record = $db->prepare($SessionCheck);
	$record->execute();	
		
			
	}
	 catch(PDOException $ex) 
        { 

            die("Failed to run query: " . $ex->getMessage()); 
        } 

	$row = $record->fetch();
	$SessionId = session_id();
		$Guest = (isset($_SESSIION['user'])?0:1);
		$Time = time();
		
		if(isset($_SESSION['user']))
		$UserID = $_SESSION['user']['id'];
		else
		$UserID=0;
		
		if(isset($_SESSION['user']))
		$Guest = 0;
		else
		$Guest=1;
		
		
	
	if(empty($row))
	{
			$Statement = "INSERT INTO sessions (SessionId,Guest,Time,UserID)
			VALUES ('$SessionId','$Guest','$Time','$UserID')
			 "; 
		
	}
	else
	{
		$Statement = "UPDATE sessions SET Guest='$Guest',Time='$Time',UserID='$UserID' WHERE SessionId='$SessionId'
			 "; 
		
	}
	
	try
	{
		$record = $db->prepare($Statement);
	$record->execute();	
		
	}
	catch(PDOException $ex) 
        { 

            die("Failed to run query: " . $ex->getMessage()); 
        }
		
		$DestroyInactiveSessions = "DELETE FROM sessions WHERE (TIME_TO_SEC(TIMEDIFF(NOW(), FROM_UNIXTIME(`Time`))) / 60)>10";
		
		try
		{
		$record = $db->prepare($DestroyInactiveSessions);
		$record->execute();	
			
		}
		catch(PDOException $ex)
		{
			
			$die("Error: ".$ex->getMessage);	
		}
?>
<!DOCTYPE html>
<html>
   <head>
      <title>CGL - <?PHP echo $title; ?></title>
      <base href="/beta/">
      <!-- Bootstrap -->
      <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
      <link href="css/style_old.css" rel="stylesheet" media="screen">
      <link href="css/jquery.pnotify.default.css" rel="stylesheet" media="screen">
       <link href="css/tipsy.css" rel="stylesheet" media="screen">
        <link href="css/pagination.css" rel="stylesheet" media="screen">
      <link href="css/jquery.pnotify.default.icons.css" rel="stylesheet" media="screen">
      
      <link rel="stylesheet" href="css/font-awesome.min.css">
      <link href="css/wysihtml5.css" rel="stylesheet" media="screen">
      <link rel="shortcut icon" href="http://www.c-gl.org/favicon.ico" />
      <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900' rel='stylesheet' type='text/css'>
         <script>
			  var RecaptchaOptions = { theme : 'clean' };
		</script>
		<script src="js/jquery.js"></script>
        <script src="js/editable.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.pnotify.min.js"></script>
<!--<script src="js/bootstrap-editable.min.js"></script>-->
<script src="js/jquery.form.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/wysihtml5-0.3.0.min.js"></script> 
<script src="js/bootstrap-wysihtml5-0.0.2.min.js"></script>
<script src="js/wysihtml5.js"></script> 

<script src="js/iframeheight.min.js"></script>
<script src="js/jquery.leanModal.min.js"></script>
<script src="js/jquery.tipsy.js"></script>

<script type="text/javascript">
//$('.editor').wysihtml5();
</script>
<script>
$(document).ready(function() {
	
	$("a[rel*=leanModal]").leanModal({ top:42,overlay : 0.8, closeButton: ".modal_close" });
	
    
     
 });
 
 </script>
<script type="text/javascript">
	$(document).ready(function(){
    	$("[rel=tooltip]").tipsy({fade: true,gravity:'n'});
    	
		function SessionCheck()
		{
		$.post("session_check.php",function(result){
    

if(result=='false')
{
$('#btn_login_hidden').click();
$('#err_msg').text('Your session has been expired, please try signing again');	
$('#err_msg').fadeIn(1000);
}

  });
		
		}
		
		setInterval(SessionCheck,120000); //After every 2 mins
		
		
		
		
		
		
		
		
		
		
		
		$('#frmUpdateEmail').submit(function(event){
			event.preventDefault();
			
			$.ajax({
						url:'update_info.php',
						type:'post',
						data:$('#frmUpdateEmail').serialize(),
						
						beforeSend:function(snd)
						{
							
						},
						success:function(data)
						{
							
							$('#_msg_email').text(data);
							$('#_msg_email').fadeIn(1000);
							if(data.charAt(0) == 'S')
							{
								setTimeout(function(){$('#_msg_email').text('Redirecting....');},2000);
								setTimeout(function(){window.location = "profile";},4000);
							}
							
							
							
							
							
						},
						complete:function()
						{
							
						},
						error: function(jqXHR, textStatus, errorThrown)
						{
            				$('#_msg_email').text(txtStatus);
							$('#_msg_email').fadeIn(100);
          				}

				
				});
		});
		
		$('#frmUpdateInfo').submit(function(event){
			event.preventDefault();
			
			$.ajax({
						url:'update_info.php',
						type:'post',
						data:$('#frmUpdateInfo').serialize(),
						
						beforeSend:function(snd)
						{
							
						},
						success:function(data)
						{
							
							$('#_msg_info').text(data);
							$('#_msg_info').fadeIn(1000);
							if(data.charAt(0) == 'S')
							{
								setTimeout(function(){$('#_msg_info').text('Redirecting....');},2000);
								setTimeout(function(){window.location = "profile";},4000);
							}
							
							
							
							
							
						},
						complete:function()
						{
							
						},
						error: function(jqXHR, textStatus, errorThrown)
						{
            				$('#_msg_info').text(txtStatus);
							$('#_msg_info').fadeIn(100);
          				}

				
				});
		});
		
		$('#frmUpdatePass').submit(function(event){
			event.preventDefault();
			
			$.ajax({
						url:'update_info.php',
						type:'post',
						data:$('#frmUpdatePass').serialize(),
						
						beforeSend:function(snd)
						{
							
						},
						success:function(data)
						{
							
							$('#_msg_pass').text(data);
							$('#_msg_pass').fadeIn(1000);
							if(data.charAt(0) == 'S')
							{
								setTimeout(function(){$('#_msg_pass').text('Redirecting....');},2000);
								setTimeout(function(){window.location = "profile";},4000);
							}
							
							
							
							
							
						},
						complete:function()
						{
							
						},
						error: function(jqXHR, textStatus, errorThrown)
						{
            				$('#_msg_pass').text(txtStatus);
							$('#_msg_pass').fadeIn(100);
          				}

				
				});
		});
		
		$('#frmStatus').submit(function(event){
			event.preventDefault();
			
			$.ajax({
						url:'update_info.php',
						type:'post',
						data:$('#frmStatus').serialize(),
						
						beforeSend:function(snd)
						{
							
						},
						success:function(data)
						{
							
							$('#_msg_status').text(data);
							$('#_msg_status').fadeIn(1000);
							if(data.charAt(0) == 'S')
							{
								setTimeout(function(){$('#_msg_status').text('Redirecting....');},2000);
								setTimeout(function(){location.reload();},3000);
							}
							
						},
						complete:function()
						{
							
						},
						error: function(jqXHR, textStatus, errorThrown)
						{
            				$('#_msg_status').text(txtStatus);
							$('#_msg_status').fadeIn(100);
          				}

				
				});
		});
		
		
		$('#opt_edit_status').click(function(){
			$('#status_box').fadeIn();
			//$('#xstatus').fadeOut(100);
		});
		
		
		$('#opt_edit_pic').click(function(){
			$('#avatar_upload').fadeIn();
			//$('#xstatus').fadeOut(100);
		});
		
		
	});
</script>

<script type="text/javascript">
$("#regForm").validate();
</script>

<script type="text/javascript">
	$(".bf3").on("mouseover", function () {
   		 $(".bf3pan").css("display", "block");
		 $(".csgopan").css("display", "none");
		 $(".csspan").css("display", "none");
		 $(".cod4pan").css("display", "none");
	});
	
	$(".cod4").on("mouseover", function () {
   		 $(".bf3pan").css("display", "none");
		 $(".csgopan").css("display", "none");
		 $(".csspan").css("display", "none");
		 $(".cod4pan").css("display", "block");
	});
	
	$(".csgo").on("mouseover", function () {
   		 $(".bf3pan").css("display", "none");
		 $(".csgopan").css("display", "block");
		 $(".csspan").css("display", "none");
		 $(".cod4pan").css("display", "none");
	});
	
	$(".css").on("mouseover", function () {
   		 $(".bf3pan").css("display", "none");
		 $(".csgopan").css("display", "none");
		 $(".csspan").css("display", "block");
		 $(".cod4pan").css("display", "none");
	});
</script>

<script>
	$('.tbuttonone').click(function(){
      $('.tbuttonone').removeClass('tabbutton').addClass('tabbuttonactive');
	  $('.tbuttontwo').removeClass('tabbuttonactive').addClass('tabbutton');
	  $('.pbuttonone').removeClass('inactivetabp').addClass('activetabp');
	  $('.pbuttontwo').removeClass('activetabp').addClass('inactivetabp');
	 });
	 
	 $('.tbuttontwo').click(function(){
      $('.tbuttonone').removeClass('tabbuttonactive').addClass('tabbutton');
	  $('.tbuttontwo').removeClass('tabbutton').addClass('tabbuttonactive');
	  $('.pbuttonone').removeClass('activetabp').addClass('inactivetabp');
	  $('.pbuttontwo').removeClass('inactivetabp').addClass('activetabp');
	 });
	 
	 function ShowForm(FormName)
	 {
		//$("#PopupContent").fadeOut();
		var HeaderText = '';
		$("#navlist li").removeAttr("id");
		if(FormName=='Register')
		{
			HeaderText = 'Create a new EGN account';
			$("#navlist li:eq(1)").attr('id','active');
		}
		else if(FormName=='Signin')
		{
			HeaderText = 'Sign In';
			$("#navlist li:eq(0)").attr('id','active');
		}
		else if(FormName=='Reset')
		{
			HeaderText = 'Forgot Login Details';
			$("#navlist li:eq(2)").attr('id','active');
		}
		$(".signup-header h2").text(HeaderText);
		$("#PopupContent").html($("#PopupContent"+FormName).html());
		//$("#PopupContent").fadeIn();
		 
	 }
	 
</script>

   </head>
   <body>

		
		
		<div id="status_box" style="width: 400px;position:absolute;z-index:1000;background:#222;display:none;top:70px;left:400px;color:#EEE;">
			<div class="bluebox">
				<p style="width:97%;float:left;">Update Status</p><a href="javascript:void(0);" onClick="$('#status_box').fadeOut();" id="xStatus" style="color:#EEE;">X</a>
			</div>
			<form id="frmStatus" class="form-horizontal" method="POST" action="" style="margin-left: -80px;padding-top:20px;" >
				<div class="control-group input-append">
					<label class="control-label" for="inputEmail">Status</label>
					<div class="controls">
						<input type="text" id="inputUser" name="status" placeholder="">
					
				</div>
				</div>
				
				<div class="control-group">
					
					<div class="controls">
						<span id="_msg_status" style="line-height: 2; height: 30px; font-weight: 700; background-color: #1A1A1A; border: 1px solid #000;padding:4px;color:#ff0000;display:none;"></span>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<input type="hidden" name="frmName" value="updateStatus"/>
						<button type="submit" class="btn btn-inverse">Update</button>
					</div>
				</div>
			</form>
		</div>
		<style>
				
				.leanModalPopup input
				{
				background-color:#FFF;
				color:#333;
				}
				
				.leanModalPopup select
				{
				background-color:#FFF;
				color:#333;
				}
				
				.leanModalPopup td
				{
				color:#333;
					
				}
				#navcontainer
{
/*background: #f0e7d7;
width: 30%;
margin: 0 auto;
padding: 1em 0;
font-family: georgia, serif;
font-size: 13px;
text-align: center;
text-transform: lowercase;*/
}

ul#navlist
{
text-align: left;
list-style: none;
padding: 0;
margin: 0 auto;
width: 100%;
}

ul#navlist li
{
display: block;
margin: 0;
padding: 0;
}

ul#navlist li a
{
display: block;
width: 100%;
padding: 0.5em 0 0.5em 0.5em;
border-width: 1px;
border-color: #ffe #aaab9c #ccc #fff;
border-style: solid;
color: #777;
text-decoration: none;
}

#navcontainer>ul#navlist li a { width: auto; }

ul#navlist li#active a
{
color: #000;
font-weight:bold;
}

ul#navlist li a:hover, ul#navlist li#active a:hover
{
color: #000;
background: transparent;
border-color: #ccc #ccc #ccc #fff;
}
				
				</style>
      
      <!-- General Popup for Signin, Register & Forgot Passowrd -->
      <div id="signup" class="leanModalPopup" style="display:none">
			<div id="signup-ct">
				<div class="signup-header" style="background-image: linear-gradient(to bottom, #175d7f 0%, #003b5b 100%);" >
					<h2 style="color:#FFF">Create a new EGN account</h2>
					
					<a href="#" class="modal_close"></a>
				</div>
				
               
				<div style="margin-left:15px">
                <div id="navcontainer" style="float:left;width:200px;margin-right:12px;border-right:1px solid #01497F;height:470px">
                <ul id="navlist" style="list-style:none;margin-left:0px">
                <li><a href="javascript:void(0);" onClick="ShowForm('Signin');">Sign In</a></li>
                <li id="active"  onClick="ShowForm('Register');"><a href="javascript:void(0);">Create Account</a></li>
                <li  onClick="ShowForm('Reset');"><a href="javascript:void(0);">Forgot Login Details</a></li>
                
                </ul>
                
                </div>
               <div id="PopupContent"></div>
                           </div>
			</div>
		</div>
        
        
        <div id="PopupContentRegister" style="display:none">
        <script>
		$('#frmRegister').submit(function(event){
			event.preventDefault();
			
			$.ajax({
						url:'register_user.php',
						type:'post',
						data:$('#frmRegister').serialize(),
						
						beforeSend:function(snd)
						{
							
						},
						success:function(data)
						{
							
							$('#err_msg_reg').text(data);
							$('#err_msg_reg').fadeIn(1000);
							if(data.charAt(0) == 'S')
							{
								setTimeout(function(){$('#err_msg_reg').text('Account created! please check your email to verify your account.');},1000);
								//setTimeout(function(){window.location = "profile";},2000);
							}
							
							
							
							
							
						},
						complete:function()
						{
							
						},
						error: function(jqXHR, textStatus, errorThrown)
						{
            				$().toastmessage("showErrorToast","Unknown error");
          				}

				
				});
		});
		
		</script>
        
        
        <form  method="POST" action=""  id="frmRegister" style="margin-top:20px">
     
     
     <table style="width:68%;margin-left:35px">
     <tr style="text-align:left;font-weight:bold">
     <td colspan="2">Username</td>
   
     
     </tr>
     <tr>
     <td colspan="2">  <input type="text" name="username"  id="username" required style="width:508px"></td>
    
</td>
     </tr>
     
     <tr style="text-align:left;font-weight:bold">
     <td >Password</td>
     <td >Confirm Password</td>
   
     
     </tr>
     
     <tr style="text-align:left;font-weight:bold">
     <td ><input type="password" name="password"  id="password" required></td>
     <td > <input type="password" name="confirm_password" id="confirm_password" required></td>
   
     
     </tr>
       <tr style="text-align:left;font-weight:bold">
     <td >Email</td>
     <td >Confirm Email</td>
   
     
     </tr>
     
     
     
     
     <tr style="text-align:left;font-weight:bold">
     <td > <input type="email" name="email" id=" email" required></td>
     <td ><input type="email" name="cEmail" id="cEmail" required></td>
   
     
     </tr>
   
   <tr style="text-align:left;font-weight:bold">
     <td colspan="2" >Date of Birth</td>
 
   
     
     </tr>
     <tr>
     <td colspan="2"><select name="dob_dd"  style="width:60px;margin-right:10px;" required>
							<option value="">DD</option>
							<?php
							for($i=1;$i<=31;$i++)
							{
								
								echo "<option >" . $i . "</option>";
							}
							
							?>
							</select>
							<select name="dob_mm"  style="width:100px;" required>
							<option value="">MM</option>
							<?php
							
							for($i=1;$i<=12;$i++)
							{
								
								echo "<option value='".$i."' >" . date('F',strtotime("01-".$i."-2014")) . "</option>";
							}
							
							
							?>
							</select>
							
							<select name="dob_yy"  style="width:100px;margin-left:10px;" required>
							<option value="">YYYY</option>
							<?php
							for($i=1950;$i<=2014;$i++)
							{
								
								echo "<option >" . $i . "</option>";
							}
							
							?>
							</select></td>
     </tr>
   <tr style="text-align:left;font-weight:bold">
     <td colspan="2" >Terms &amp; Conditions</td>
 
   
     
     </tr>
     
     
        <tr style="text-align:left;font-weight:bold">
     <td colspan="2" > <textarea style="height:100px;width:508px;color:#000;" readonly>Terms of Service

Introduction

Welcome to http://electronicgaming.net. This website is owned and operated by Electronic Gaming Network, LLC. By visiting our website and accessing the information, resources, services, products, and tools we provide, you understand and agree to accept and adhere to the following terms and conditions as stated in this policy (hereafter referred to as ‘User Agreement’).

This agreement is in effect as of Jul 15, 2013.

We reserve the right to change this User Agreement from time to time without notice. You acknowledge and agree that it is your responsibility to review this User Agreement periodically to familiarize yourself with any modifications. Your continued use of this site after such modifications will constitute acknowledgment and agreement of the modified terms and conditions.

Responsible Use and Conduct

By visiting our website and accessing the information, resources, services, products, and tools we provide for you, either directly or indirectly (hereafter referred to as ‘Resources’), you agree to use these Resources only for the purposes intended as permitted by (a) the terms of this User Agreement, and (b) applicable laws, regulations and generally accepted online practices or guidelines.

Wherein, you understand that:

a. In order to access our Resources, you may be required to provide certain information about yourself (such as identification, contact details, etc.) as part of the registration process, or as part of your ability to use the Resources. You agree that any information you provide will always be accurate, correct, and up to date.

b. You are responsible for maintaining the confidentiality of any login information associated with any account you use to access our Resources. Accordingly, you are responsible for all activities that occur under your account/s.

c. Accessing (or attempting to access) any of our Resources by any means other than through the means we provide, is strictly prohibited. You specifically agree not to access (or attempt to access) any of our Resources through any automated, unethical or unconventional means.

d. Engaging in any activity that disrupts or interferes with our Resources, including the servers and/or networks to which our Resources are located or connected, is strictly prohibited.

e. Attempting to copy, duplicate, reproduce, sell, trade, or resell our Resources is strictly prohibited.

f. You are solely responsible any consequences, losses, or damages that we may directly or indirectly incur or suffer due to any unauthorized activities conducted by you, as explained above, and may incur criminal or civil liability.

g. We may provide various open communication tools on our website, such as blog comments, blog posts, public chat, forums, message boards, newsgroups, product ratings and reviews, various social media services, etc. You understand that generally we do not pre-screen or monitor the content posted by users of these various communication tools, which means that if you choose to use these tools to submit any type of content to our website, then it is your personal responsibility to use these tools in a responsible and ethical manner. By posting information or otherwise using any open communication tools as mentioned, you agree that you will not upload, post, share, or otherwise distribute any content that:

i. Is illegal, threatening, defamatory, abusive, harassing, degrading, intimidating, fraudulent, deceptive, invasive, racist, or contains any type of suggestive, inappropriate, or explicit language;

ii. Infringes on any trademark, patent, trade secret, copyright, or other proprietary right of any party;

Iii. Contains any type of unauthorized or unsolicited advertising;

Iiii. Impersonates any person or entity, including any http://electronicgaming.net employees or representatives.

We have the right at our sole discretion to remove any content that, we feel in our judgment does not comply with this User Agreement, along with any content that we feel is otherwise offensive, harmful, objectionable, inaccurate, or violates any 3rd party copyrights or trademarks. We are not responsible for any delay or failure in removing such content. If you post content that we choose to remove, you hereby consent to such removal, and consent to waive any claim against us.

h. We do not assume any liability for any content posted by you or any other 3rd party users of our website. However, any content posted by you using any open communication tools on our website, provided that it doesn’t violate or infringe on any 3rd party copyrights or trademarks, becomes the property of Electronic Gaming Network, LLC, and as such, gives us a perpetual, irrevocable, worldwide, royalty-free, exclusive license to reproduce, modify, adapt, translate, publish, publicly display and/or distribute as we see fit. This only refers and applies to content posted via open communication tools as described, and does not refer to information that is provided as part of the registration process, necessary in order to use our Resources.

i. You agree to indemnify and hold harmless Electronic Gaming Network, LLC and its parent company and affiliates, and their directors, officers, managers, employees, donors, agents, and licensors, from and against all losses, expenses, damages and costs, including reasonable attorneys’ fees, resulting from any violation of this User Agreement or the failure to fulfill any obligations relating to your account incurred by you or any other person using your account. We reserve the right to take over the exclusive defense of any claim for which we are entitled to indemnification under this User Agreement. In such event, you shall provide us with such cooperation as is reasonably requested by us.

Limitation of Warranties

By using our website, you understand and agree that all Resources we provide are “as is” and “as available”. This means that we do not represent or warrant to you that:

i) the use of our Resources will meet your needs or requirements.

ii) the use of our Resources will be uninterrupted, timely, secure or free from errors.

iii) the information obtained by using our Resources will be accurate or reliable, and

iv) any defects in the operation or functionality of any Resources we provide will be repaired or corrected.

Furthermore, you understand and agree that:

v) any content downloaded or otherwise obtained through the use of our Resources is done at your own discretion and risk, and that you are solely responsible for any damage to your computer or other devices for any loss of data that may result from the download of such content.

vi) no information or advice, whether expressed, implied, oral or written, obtained by you from Electronic Gaming Network, LLC or through any Resources we provide shall create any warranty, guarantee, or conditions of any kind, except for those expressly outlined in this User Agreement.

Limitation of Liability

In conjunction with the Limitation of Warranties as explained above, you expressly understand and agree that any claim against us shall be limited to the amount you paid, if any, for use of products and/or services. Electronic Gaming Network, LLC will not be liable for any direct, indirect, incidental, consequential or exemplary loss or damages which may be incurred by you as a result of using our Resources, or as a result of any changes, data loss or corruption, cancellation, loss of access, or downtime to the full extent that applicable limitation of liability laws apply.

Copyrights/Trademarks

All content and materials available on http://electronicgaming.net, including but not limited to text, graphics, website name, code, images and logos are the intellectual property of Electronic Gaming Network, LLC, and are protected by applicable copyright and trademark law. Any inappropriate use, including but not limited to the reproduction, distribution, display or transmission of any content on this site is strictly prohibited, unless specifically authorized by Electronic Gaming Network, LLC.

Termination of Use

You agree that we may, at our sole discretion, suspend or terminate your access to all or part of our website and Resources with or without notice and for any reason, including, without limitation, breach of this User Agreement. Any suspected illegal, fraudulent or abusive activity may be grounds for terminating your relationship and may be referred to appropriate law enforcement authorities. Upon suspension or termination, your right to use the Resources we provide will immediately cease, and we reserve the right to remove or delete any information that you may have on file with us, including any account or login information.

Governing Law

This website is controlled by Electronic Gaming Network, LLC. It can be accessed by most countries around the world. By accessing our website, you agree that the statutes and laws of our state, without regard to the conflict of laws and the United Nations Convention on the International Sales of Goods, will apply to all matters relating to the use of this website and the purchase of any products or services through this site.

Furthermore, any action to enforce this User Agreement shall be brought in the federal or state courts You hereby agree to personal jurisdiction by such courts, and waive any jurisdictional, venue, or inconvenient forum objections to such courts.

Guarantee

UNLESS OTHERWISE EXPRESSED, Electronic Gaming Network, LLC EXPRESSLY DISCLAIMS ALL WARRANTIES AND CONDITIONS OF ANY KIND, WHETHER EXPRESS OR IMPLIED, INCLUDING, BUT NOT LIMITED TO THE IMPLIED WARRANTIES AND CONDITIONS OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NON-INFRINGEMENT.

Fees and Payments

When you pay any fee or payment listed on the Site (www.electronicgaming.net), you agree to the user ToS for payments. Subscription fees will be billed at the price listed on the Site at the time of your subscription. We may change the subscription price listed on the website, price changes go into effect immediately and will end all current subscriptions. We use the information provided by the user to bill them via PayPal. You must provide current, complete and accurate information in your billing account. If your account is compromised you must notify us immediately so we may take action on the unauthorized use of your account. All subscriptions and payments are final, there will be no refunds. It is the users job to stop subscriptions. If your account is suspended, or permanently banned, there are no refund for any subscriptions or payments. We reserve the right to suspended or ban your account when payments are charged back.

Contact Information

If you have any questions or comments about these our Terms of Service as outlined above, you can contact us at:

Electronic Gaming Network, LLC

admin@electronicgaming.net
</textarea></td>
 
   
     
     </tr>
     <tr>
     <td colspan="2"> <input type="checkbox" required style="margin-right:5px"> <strong>I've read and accept our Terms &amp; Conditions and <span style="text-decoration:underline">Privacy Policy</span></strong></td>
     </tr>
     <tr>
     <td id="err_msg_reg" style="line-height: 2; height: 30px; font-weight: 700; padding:4px;color:#ff0000;display:none;" colspan="2"> </td>
     </tr>
     <tr>
     <td> </td> <td style="padding-left:192px;padding-top:13px">
				  <input type="submit" class="bluebox" style="color: #eee; height: 34px;outline:none; font-size: 20px; line-height: 0.9; -webkit-border-radius: 3px; border-radius: 3px;margin-left: 3px;" value="Sign Up">
</td>
     </tr>
     
     </table>
                  
                  
				  
				 </form>
        </div>
        
        <div id="PopupContentSignin" style="display:none">
        <script>
        $('#frmLogin').submit(function(event){
			event.preventDefault();
			$.ajax({
						url:'logincheck.php',
						type:'post',
						data:$('#frmLogin').serialize(),
						
						beforeSend:function(snd)
						{
							
						},
						success:function(data)
						{
							$('#err_msg').text(data);
							$('#err_msg').fadeIn(1000);
							if(data.charAt(0) == 'S')
							{
								setTimeout(function(){$('#err_msg').text('Redirecting....');},1000);
								setTimeout(function(){window.location = "home";},2000);
							}
							
						},
						complete:function()
						{
							
						},
						error: function(jqXHR, textStatus, errorThrown)
						{
            				$().toastmessage("showErrorToast","Unknown error");
          				}

				
				});
		});
        </script>
        
        <form  method="POST" action=""  id="frmLogin" style="margin-top:20px">
     
     <table style="width:68%;margin-left:35px">
     <tr style="text-align:left">
     <th width="50%">Username or Email</th>
     <th width="50%">Password</th>
     
     </tr>
     <tr>
     <td>  <input type="text" name="username"  id="username" required></td>
     <td> <input type="password" name="password" id="password" required >
</td>
     </tr>
     <tr style="font-weight:bold">
     <td colspan="2">Remember Me</td>
     
     </tr>
     <tr style="font-style:bold">
     <td colspan="2"><input type="checkbox"></td>
     
     </tr>
     <tr>
     <td id="err_msg" style="line-height: 2; height: 30px; font-weight: 700; padding:4px;color:#ff0000;display:none;" colspan="2"> </td>
     </tr>
     
     <tr>
   <td> </td> <td  style="padding-left:152px;padding-top:13px"> <input type="submit" class="bluebox" style="color: #eee; height: 34px;outline:none; font-size: 20px; line-height: 0.9; -webkit-border-radius: 3px; border-radius: 3px;margin-left: 3px;" value="Login"></td>
     </tr>
     </table>
				  
                  
                <div style="text-align:center" class="">
						<span id="err_msg" style="line-height: 2; height: 30px; font-weight: 700; padding:4px;color:#ff0000;display:none;"></span>
					</div>
				  <div class="btn-fld" style="width:420px;text-align:right">
				 
</div>
				 </form>
        
        </div>
        
        
        
        
        
        <div id="PopupContentReset" style="display:none">
        <script>
        $('#frmReset').submit(function(event){
			event.preventDefault();
			
			$.ajax({
						url:'forgot_password.php?action=reset',
						type:'post',
						data:$('#frmReset').serialize(),
						
						success:function(data)
						{
							
							$('#err_msg_reset').text(data);
							$('#err_msg_reset').fadeIn(1000);
							
								$("#err_msg_reset").text(data);
							
							
							
							
							
							
						},
						error: function(jqXHR, textStatus, errorThrown)
						{
            				$().toastmessage("showErrorToast","Unknown error");
          				}

				
				});
		});</script>
        <form  method="POST" action=""  id="frmReset" style="margin-top:20px" onSubmit="SubmitFormAjax(this,'forgot_password.php?action=reset','err_msg_reset')">
     
     <table style="width:68%;margin-left:35px">
     <tr style="text-align:left">
     <th >Email Address:</th>
     
     
     </tr>
     
     <tr>
     <td>  <input type="email" name="Email"  id="Email" style="width:508px" required></td>
     
     
     </tr>
     <tr>
     <td style="font-size:14px">(Please enter your email address above and we'll reset your password for you.)
     </tr>
     <tr>
     <td id="err_msg_reset" style="line-height: 2; height: 30px; font-weight: 700; padding:4px;color:#ff0000;display:none;" > </td>
     </tr>
     
     <tr>
    <td  style="padding-right:27px;padding-top:13px;text-align:right"> <input type="submit" class="bluebox" style="color: #eee; height: 34px;outline:none; font-size: 20px; line-height: 0.9; -webkit-border-radius: 3px; border-radius: 3px;margin-left: 3px;" value="Reset Password"></td>
     </tr>
     </table>
				  
                  
                <div style="text-align:center" class="">
						<span id="err_msg" style="line-height: 2; height: 30px; font-weight: 700; padding:4px;color:#ff0000;display:none;"></span>
					</div>
				  <div class="btn-fld" style="width:420px;text-align:right">
				 
</div>
				 </form>
        
        </div>
        
      
	  <div class="header">
         <div class="container">
            <div class="pull-left" style="padding-top: 5px;"><a href="home"><img src="img/logo.png" height="94" width="210" /></a></div>
            <div class="pull-right" style="padding-top:100px;">
            <?PHP if(isset($_SESSION["user"]["username"]) or !empty($_SESSION["user"]["username"])){ ?>
				
			  <div class="btn-group">
                <button class="bluebox" style="color: #eee;height:35px;outline:none; -webkit-border-radius: 2px; border-radius: 2px;" data-toggle="dropdown">My CGL <i class="icon-angle-down icon-1"></i></button>
                <ul class="dropdown-menu" style="margin-left:-102px;border:none;margin-top: -2px;">
                  <li>
   <div style="width: 170px; padding: 5px; background: #005E82; border: 5px solid #013861;">
	<ul class="unstyled">
    	<li style="padding-left: 3px;"><a href="profile/<?=$_SESSION['user']['username'];?>" style="color: white;">My Profile</a></li>
        <li style="padding-left: 3px;"><a href="settings" style="color: white;">Settings</a></li>
        <li style="padding-left: 3px;"><a href="logout.php" style="color: white;">Sign Out</a></li>
        
		<div style="height: 8px; width: 180px; margin-left: -5px;margin-top: 7px;background: #013861;"></div>
        <li style="padding-left: 3px;"><a href="support" style="color: white;">My Support Tickets</a></li>
        <li style="padding-left: 3px;"><a href="newticket" style="color: white;">New Support Ticket</a></li>
        <li style="padding-left: 3px;"><a href="#" style="color: white;">My Disputes</a></li>
        <div style="height: 8px; width: 180px; margin-left: -5px;margin-top: 7px;background: #013861;"></div>
        <li style="padding-left: 3px;"><a href="#" style="color: white;">My Team Invites</a></li>
        <li style="padding-left: 3px;"><a href="#" style="color: white;">My Friend Invites</a></li>
        <li style="padding-left: 3px;"><a href="#" style="color: white;">My Friend Lists</a></li>
        <li style="padding-left: 3px;"><a href="#" style="color: white;">My Inbox</a></li>
        <li style="padding-left: 3px;"><a href="#" style="color: white;">Compose a Message</a></li>
        <li style="padding-left: 3px;"><a href="#" style="color: white;">Sent Messages</a></li>
    </ul>
</div>
                  </li>
                </ul>
              </div>
			<?php } else { ?>
               
			   <a id="btn_login" href="#signup" rel="leanModal" onClick="ShowForm('Signin')"><button type="button" class="btn btn-inverse" style="margin-top: -98px;margin-left: 4px;height: 35px; font-weight: 700;">Login</button></a>
               <a id="btn_reg" href="#signup" rel="leanModal" onClick="ShowForm('Register')"><button type="button" class="btn btn-inverse" style="margin-top: -98px;margin-left: 4px;height: 35px; font-weight: 700;">Register</button></a>
               <?php } ?>
               <a id="btn_login_hidden" style="display:none" href="#signin" rel="leanModal"><button type="button" class="btn btn-inverse" style="margin-top: -98px;margin-left: 4px;height: 35px; font-weight: 700;">Login</button></a>
            </div>
         </div>
      </div>
      <div class="ournav maingrad">
      <div class="container">
         <ul class="nav nav-pills" style="padding-top: 7px;">
            <li><a href="home">HOME</a></li>
            <li class="dropdown" style="outline: none;">
               <a style="outline: none;" class="dropdown-toggle" id="drop4" role="button" data-toggle="dropdown" href="#">COMMUNITY &nbsp;<i class="icon-caret-down"></i></a>
               <ul style="background-color: none;margin-left: -3px;" id="menu1" class="dropdown-menu" role="menu" aria-labelledby="drop4">
               <ul class="ourdropdown-menu">
               				  
                              <li class="css" style="padding-right: 1px;">
                                 <a role="menuitem" href="#">
                                    <img style="padding-right: 10px; padding-top:8px;" src="img/aapg.png" height="23" width="23" /> 
                                    <p style="padding-left: 40px; margin-top: -23px; padding-right: 50px;">America's Army</p>
                                 </a>
                              </li>
                              <li class="divider"></li>
                              <li class="bf3" style="padding-right: 1px;">
                                 <a role="menuitem" href="#">
                                    <img style="padding-right: 10px; padding-top:8px;" src="img/bf.png" height="23" width="23" /> 
                                    <p style="padding-left: 40px; margin-top: -23px; padding-right: 50px;">Battlefield 4</p>
                                 </a>
                              </li>
                              <li class="divider"></li>
                              <li class="css" style="padding-right: 1px;">
                                 <a role="menuitem" href="#">
                                    <img style="padding-right: 10px; padding-top:8px;" src="img/BLR.png" height="23" width="23" /> 
                                    <p style="padding-left: 40px; margin-top: -23px; padding-right: 50px;">BlackLight Retribution</p>
                                 </a>
                              </li>
                              <li class="divider"></li>
                              <li class="cod4" style="padding-right: 1px;">
                                 <a role="menuitem" href="#">
                                    <img style="padding-right: 10px; padding-top:8px;" src="img/cod4.png" height="23" width="23" /> 
                                    <p style="padding-left: 40px; margin-top: -23px; padding-right: 50px;">Call of Duty 4</p>
                                 </a>
                              </li>
                               <li class="divider"></li>
                              <li class="css" style="padding-right: 1px;">
                                 <a role="menuitem" href="#">
                                    <img style="padding-right: 10px; padding-top:8px;" src="img/combatarms.png" height="23" width="23" /> 
                                    <p style="padding-left: 40px; margin-top: -23px; padding-right: 50px;">Combat Arms</p>
                                 </a>
                              </li>
                              <li class="divider"></li>
                              <li class="csgo" style="padding-right: 1px;">
                                 <a role="menuitem" href="#">
                                    <img style="padding-right: 10px; padding-top:8px;" src="img/csgo.png" height="23" width="23" /> 
                                    <p style="padding-left: 40px; margin-top: -23px; padding-right: 50px;">CS: Global Offensive</p>
                                 </a>
                              </li>
                             
                              
                              <li class="divider"></li>
                              <li class="css" style="padding-right: 1px;">
                                 <a role="menuitem" href="#">
                                    <img style="padding-right: 10px; padding-top:8px;" src="img/LeagueofLegends.png" height="23" width="23" /> 
                                    <p style="padding-left: 40px; margin-top: -23px; padding-right: 50px;">League of Legends</p>
                                 </a>
                              </li>
                              <li class="divider"></li>
                              <li class="css" style="padding-right: 1px;">
                                 <a role="menuitem" href="#">
                                    <img style="padding-right: 10px; padding-top:8px;" src="img/rekoil.png" height="23" width="23" /> 
                                    <p style="padding-left: 40px; margin-top: -23px; padding-right: 50px;">Rekoil</p>
                                 </a>
                              </li>
                               <li class="divider"></li>
                              <li class="css" style="padding-right: 1px;">
                                 <a role="menuitem" href="#">
                                    <img style="padding-right: 10px; padding-top:8px;" src="img/sf2.png" height="23" width="23" /> 
                                    <p style="padding-left: 40px; margin-top: -23px; padding-right: 50px;">Soldier Front 2</p>
                                 </a>
                              </li>
                              
                              <li class="divider"></li>
                              <li class="css" style="padding-right: 1px;">
                                 <a role="menuitem" href="#">
                                    <img style="padding-right: 10px; padding-top:8px;" src="img/warface.png" height="23" width="23" /> 
                                    <p style="padding-left: 40px; margin-top: -23px; padding-right: 50px;">Warface</p>
                                 </a>
                              </li>
                              <li class="divider"></li>
                              <li class="css" style="padding-right: 1px;">
                                 <a role="menuitem" href="#">
                                    <img style="padding-right: 10px; padding-top:8px;" src="img/server.png" height="23" width="23" /> 
                                    <p style="padding-left: 40px; margin-top: -23px; padding-right: 50px;">Community Servers</p>
                                 </a>
                              </li>
                              
                           </ul>
            </ul>
            </li>
            
            <li class="dropdown" style="outline: none;">
               <a style="outline: none;" class="dropdown-toggle" id="drop4" role="button" data-toggle="dropdown" href="#">GAMES &nbsp;<i class="icon-caret-down"></i></a>
               <ul style="background-color: none;" id="menu1" class="dropdown-menu" role="menu" aria-labelledby="drop4">
                  <li style="background: white;">
                     <div style=" margin-left: -198px;" >
                        
                        <div class="pull-left">
                           <ul class="ourdropdown-menu">
                              <li class="bf3">
                                 <a role="menuitem" href="#">
                                    <img style="padding-right: 10px; padding-top:8px;" src="img/bf3.png" height="23" width="23" /> 
                                    <p style="padding-left: 40px; margin-top: -23px; padding-right: 50px;">Battlefield 3</p>
                                 </a>
                              </li>
                              <li class="divider"></li>
                              <li class="cod4">
                                 <a role="menuitem" href="#">
                                    <img style="padding-right: 10px; padding-top:8px;" src="img/bf3.png" height="23" width="23" /> 
                                    <p style="padding-left: 40px; margin-top: -23px; padding-right: 50px;">Battlefield 3</p>
                                 </a>
                              </li>
                              <li class="divider"></li>
                              <li class="csgo">
                                 <a role="menuitem" href="#">
                                    <img style="padding-right: 10px; padding-top:8px;" src="img/bf3.png" height="23" width="23" /> 
                                    <p style="padding-left: 40px; margin-top: -23px; padding-right: 50px;">Battlefield 3</p>
                                 </a>
                              </li>
                              <li class="divider"></li>
                              <li class="css">
                                 <a role="menuitem" href="#">
                                    <img style="padding-right: 10px; padding-top:8px;" src="img/bf3.png" height="23" width="23" /> 
                                    <p style="padding-left: 40px; margin-top: -23px; padding-right: 50px;">Battlefield 3</p>
                                 </a>
                              </li>
                           </ul>
                        </div>
                        <div class="pull-right">
                           <!-- 
                           		Begin Game 
                                			-->
                           <div class="bf3pan pans" style="display: block;">
                              <div class="darkgrad" style="color: white;height:80px; border-bottom: 1px solid #181818;">
                                 <img style="padding-left:10px;padding-top:8px;" src="img/bf3.png" height="62" width="62" /> 
                                 <p style="margin-left: 90px; font-weight:500;font-size:27px;margin-top:-44px;">Battlefield 3 - 1</p>
                              </div>
                              <p style="color: #4caed8;font-weight:400;font-size:19px;padding-top:6px;padding-left:7px;">Here Comes the Boom!</p>
                              <span class="pull-right">
                                 <btn class="btn btn-default" style="font-weight: 500; margin-top: -49px; padding: 7px 13px;font-size: 16px;margin-right: 10px;">REGISTER</btn>
                              </span>
                              <p style="padding-left: 8px;font-size: 14px; margin-top: 27px;">Registration Open</p>
                              <span class="pull-right" style="margin-top: -35px;">
                                 <div class="btn-group">
                                    <button class="btn btn-link" style="font-size: 13px;">Home</button>
                                    <button class="btn btn-link" style="font-size: 13px;">Find a Scrim</button>
                                    <button class="btn btn-link" style="font-size: 13px;">Competitors</button>
                                    <button class="btn btn-link" style="font-size: 13px;">Standings</button>
                                    <button class="btn btn-link" style="font-size: 13px;">Matches</button>
                                    <button class="btn btn-link" style="font-size: 13px;">Downloads</button>
                                    <button class="btn btn-link" style="font-size: 13px;">Forums</button>
                                 </div>
                              </span>
                              <div style="height:1px;border-top: 1px solid #181818;"></div>
                              <div class="darkgrad" style="height:48px; border-top: 1px solid #363636;"></div>
                           </div>
                           <!--
                              -->
                              
                              <!-- 
                           		Begin Game 
                                			-->
                           <div class="cod4pan pans">
                              <div class="darkgrad" style="color: white;height:80px; border-bottom: 1px solid #181818;">
                                 <img style="padding-left:10px;padding-top:8px;" src="img/bf3.png" height="62" width="62" /> 
                                 <p style="margin-left: 90px; font-weight:500;font-size:27px;margin-top:-44px;">Battlefield 3 - 2</p>
                              </div>
                              <p style="color: #4caed8;font-weight:400;font-size:19px;padding-top:6px;padding-left:7px;">Here Comes the Boom!</p>
                              <span class="pull-right">
                                 <btn class="btn btn-default" style="font-weight: 500; margin-top: -49px; padding: 7px 13px;font-size: 16px;margin-right: 10px;">REGISTER</btn>
                              </span>
                              <p style="padding-left: 8px;font-size: 14px; margin-top: 27px;">Registration Open</p>
                              <span class="pull-right" style="margin-top: -35px;">
                                 <div class="btn-group">
                                    <button class="btn btn-link" style="font-size: 13px;">Home</button>
                                    <button class="btn btn-link" style="font-size: 13px;">Find a Scrim</button>
                                    <button class="btn btn-link" style="font-size: 13px;">Competitors</button>
                                    <button class="btn btn-link" style="font-size: 13px;">Standings</button>
                                    <button class="btn btn-link" style="font-size: 13px;">Matches</button>
                                    <button class="btn btn-link" style="font-size: 13px;">Downloads</button>
                                    <button class="btn btn-link" style="font-size: 13px;">Forums</button>
                                 </div>
                              </span>
                              <div style="height:1px;border-top: 1px solid #181818;"></div>
                              <div class="darkgrad" style="height:48px; border-top: 1px solid #363636;"></div>
                           </div>
                           <!--
                              -->
                              
                              <!-- 
                           		Begin Game 
                                			-->
                           <div class="csgopan pans">
                              <div class="darkgrad" style="color: white;height:80px; border-bottom: 1px solid #181818;">
                                 <img style="padding-left:10px;padding-top:8px;" src="img/bf3.png" height="62" width="62" /> 
                                 <p style="margin-left: 90px; font-weight:500;font-size:27px;margin-top:-44px;">Battlefield 3 - 3</p>
                              </div>
                              <p style="color: #4caed8;font-weight:400;font-size:19px;padding-top:6px;padding-left:7px;">Here Comes the Boom!</p>
                              <span class="pull-right">
                                 <btn class="btn btn-default" style="font-weight: 500; margin-top: -49px; padding: 7px 13px;font-size: 16px;margin-right: 10px;">REGISTER</btn>
                              </span>
                              <p style="padding-left: 8px;font-size: 14px; margin-top: 27px;">Registration Open</p>
                              <span class="pull-right" style="margin-top: -35px;">
                                 <div class="btn-group">
                                    <button class="btn btn-link" style="font-size: 13px;">Home</button>
                                    <button class="btn btn-link" style="font-size: 13px;">Find a Scrim</button>
                                    <button class="btn btn-link" style="font-size: 13px;">Competitors</button>
                                    <button class="btn btn-link" style="font-size: 13px;">Standings</button>
                                    <button class="btn btn-link" style="font-size: 13px;">Matches</button>
                                    <button class="btn btn-link" style="font-size: 13px;">Downloads</button>
                                    <button class="btn btn-link" style="font-size: 13px;">Forums</button>
                                 </div>
                              </span>
                              <div style="height:1px;border-top: 1px solid #181818;"></div>
                              <div class="darkgrad" style="height:48px; border-top: 1px solid #363636;"></div>
                           </div>
                           <!--
                              -->
                              
                              <!-- 
                           		Begin Game 
                                			-->
                           <div class="csspan pans">
                              <div class="darkgrad" style="color: white;height:80px; border-bottom: 1px solid #181818;">
                                 <img style="padding-left:10px;padding-top:8px;" src="img/bf3.png" height="62" width="62" /> 
                                 <p style="margin-left: 90px; font-weight:500;font-size:27px;margin-top:-44px;">Battlefield 3 - 4</p>
                              </div>
                              <p style="color: #4caed8;font-weight:400;font-size:19px;padding-top:6px;padding-left:7px;">Here Comes the Boom!</p>
                              <span class="pull-right">
                                 <btn class="btn btn-default" style="font-weight: 500; margin-top: -49px; padding: 7px 13px;font-size: 16px;margin-right: 10px;">REGISTER</btn>
                              </span>
                              <p style="padding-left: 8px;font-size: 14px; margin-top: 27px;">Registration Open</p>
                              <span class="pull-right" style="margin-top: -35px;">
                                 <div class="btn-group">
                                    <button class="btn btn-link" style="font-size: 13px;">Home</button>
                                    <button class="btn btn-link" style="font-size: 13px;">Find a Scrim</button>
                                    <button class="btn btn-link" style="font-size: 13px;">Competitors</button>
                                    <button class="btn btn-link" style="font-size: 13px;">Standings</button>
                                    <button class="btn btn-link" style="font-size: 13px;">Matches</button>
                                    <button class="btn btn-link" style="font-size: 13px;">Downloads</button>
                                    <button class="btn btn-link" style="font-size: 13px;">Forums</button>
                                 </div>
                              </span>
                              <div style="height:1px;border-top: 1px solid #181818;"></div>
                              <div class="darkgrad" style="height:48px; border-top: 1px solid #363636;"></div>
                           </div>
                           <!--
                              -->
                        </div>
                  </li>
               </ul>
            </li>
            <li><a href="sponsors">SPONSORS &nbsp;</a></li>
            <li><a href="genesis">GENESIS AC</a></li>
            <li><a href="support">SUPPORT&nbsp;</a></li>
            <li><a href="#">CGL TV</a></li>
            <li class="pull-right"><a href="http://facebook.com/CyberGamingLeague" target="_blank"><i class="icon-facebook icon-2"></i></a></li>
            <li class="pull-right"><a href="https://twitter.com/cglllc" target="_blank"><i class="icon-twitter icon-2"></i></a></li>
            <li class="pull-right"><a href="http://youtube.com/CyberGamingLeague" target="_blank"><i class="icon-youtube icon-2"></i></a></li>
         </ul>
               
         </div>
         
      </div>
      
      <div class="container">
      	<div class="topban"></div>
      </div>
      
      
      
      <div class="container" style="height:100%;background:#222222;margin-top:7px;color:#eeeeee;padding:2px;>
	      <div class="main">
        
      
