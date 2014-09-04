<?PHP
session_start();
require_once('myDb.php');

$recRendered = false;
$staus = NULL;
$age = NULL;
$country = NULL;
$member_date = NULL;
$name = NULL;	
$isMine = false;
$id_post=$_GET['s'];
$ProfileName = $_GET['s'];
$user_profile = new UserProfile();
if($ProfileName=='')
{
echo "<script>window.location='index.php';</script>";exit;	
}
if($ProfileName==$_SESSION['user']['username'])
{
	$isMine = true;
}
	
	$UserOnlineStatus = mysqli_query($con,"SELECT sessions.UserID FROM sessions,users WHERE sessions.UserID=users.id AND  users.username='$ProfileName'");
	if(mysqli_num_rows($UserOnlineStatus)>=1)
	{
	$OnlineStatus='Online';	
	$UserStatusImage = 'user_online.png';
	}
	else
	{
	$OnlineStatus='Offline';
	$UserStatusImage = 'user_offline.png';	
	}
	
	
	
	$qry = "Select users.username, `users`.timestamp,users.date_of_birth,`users_profile`.* from users inner join users_profile on `users`.id = `users_profile`.user_id WHERE users.username='".$ProfileName."'";
	if(!$result = mysqli_query($con,$qry))
	echo('Error in query');
	else
	{
		
		if(mysqli_num_rows($result) >= 1)
		{
			$recRendered = true;
			$rec = mysqli_fetch_assoc($result);
			
			if(!$isMine and isset($_SESSION['user']))
			{
			$user_profile->profileVisited($_SESSION['user']['id'],$rec['profile_id']);	
			}
			if(isset($_SESSION['user']))
			{
			$isFriend = $user_profile->isFriend($_SESSION['user']['id'],$rec['user_id']);
			}
			else
			{
			$isFriend=true;	
			}
			$isInvited = $user_profile->isInvited($rec['user_id']);
			$status = $rec['status'];
			
			$country = $rec['country'];
			$member_date = $rec['timestamp'];
			$name = $rec['username'];
			$avatar = $rec['avatar'];
			$DateOfBirth = $rec['date_of_birth'];
			if($avatar=='')
			{
			$avatar = 'img/bf3.png';	
			}
		}
		else
		{
		echo "<script>window.location='index.php';</script>";exit;	
		}
	}
if($recRendered)
{	

?>
 <script>

                                $('.editable').each(function() {
                                    this.contentEditable = true;
                                });
                            </script>
<script type="text/javascript">

function GetFriends(user_id,text)
{
	$("#friend_list_content").html("<img src='img/loading.gif'> Please wait...");
$.post("get-friends.php",{user_id:user_id,text:text},function(result){
	$("#friend_list_content").html(result);
    

  });
	
	
	
}
function changePagination(obj)
{
		var pageNo = $(obj).attr('data-val');
		$('.pagination a').each(function(index, element) {
            
			$(element).removeClass('active');
		$(element).addClass('gradient');
        });
		$(obj).removeClass('gradient');
		$(obj).addClass('active');
		
		getComments(pageNo);
	
}
function getComments(pageNo)
{
	$("#ListedComments").html('Loading Comments, Please wait....');
$.post("get-comments.php",{pageNo:pageNo,username:'<?=$_GET['s'];?>'},function(result){
	$("#ListedComments").html(result);
    $("#ListedComments").fadeIn("slow");


  });
}


$(document).ready(function() { 

getComments(1);
 <?php if($isMine)
 {
	 ?>
 $('.edit').editable('save_inline.php', {
         indicator : 'Saving...',
        // tooltip   : 'Click to edit...',
		 onblur:'submit'
     });
	 
	 
	 $('.edit_area').editable('save_inline.php', { 
         type      : 'textarea',
         cancel    : 'Cancel',
         submit    : 'OK',
         indicator : 'Saving...',
        // tooltip   : 'Click to edit...',
		 onblur:'submit',
		 
     });
	 <?php
 }
 ?>
	var options = { 
			//target:   '#output1',   // target element(s) to be updated with server response 
			beforeSubmit:  beforeSubmit,  // pre-submit callback 
			success:       afterSuccess,  // post-submit callback 
			resetForm: true        // reset the form after successful submit 
		}; 
		
	 $('#MyUploadForm').submit(function() { 
			$(this).ajaxSubmit(options);  			
			// always return false to prevent standard browser submit and page navigation 
			return false; 
		}); 
}); 

function afterSuccess()
{
	$('#submit-btn').show(); //hide submit button
	$('#loading-img').hide(); //hide submit button
	$('#avatar_upload').fadeOut();
	location.reload();

}

//function to check file size before uploading.
function beforeSubmit(){
    //check whether browser fully supports all File API
   if (window.File && window.FileReader && window.FileList && window.Blob)
	{
		
		if( !$('#imageInput').val()) //check empty input filed
		{
			$("#output").html("Are you kidding me?");
			return false
		}
		
		var fsize = $('#imageInput')[0].files[0].size; //get file size
		var ftype = $('#imageInput')[0].files[0].type; // get file type
		

		//allow only valid image file types 
		switch(ftype)
        {
            case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/pjpeg':
                break;
            default:
                $("#output").html("<b>"+ftype+"</b> Unsupported file type!");
				return false
        }
		
		//Allowed file size is less than 1 MB (1048576)
		if(fsize>1048576) 
		{
			$("#output").html("<b>"+bytesToSize(fsize) +"</b> Too big Image file! <br />Please reduce the size of your photo using an image editor.");
			return false
		}
				
		$('#submit-btn').hide(); //hide submit button
		$('#loading-img').show(); //hide submit button
		//$("#output1").html("");  
	}
	else
	{
		//Output error to older unsupported browsers that doesn't support HTML5 File API
		$("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
		return false;
	}
}

//function to format bites bit.ly/19yoIPO
function bytesToSize(bytes) {
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
   if (bytes == 0) return '0 Bytes';
   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}

</script>
<style>

				.avatar_img
				{
				margin-left:6px;margin-bottom:10px	
				}
				
.new_button{
background-color: #3498db;
    border-radius: 3px;
    color: #fff;
    cursor: pointer;
    display: inline;
    float: left;
    margin-right: 10px;
    opacity: 0.6;
    padding: 8px 10px;
}
.clear{clear: both;}
/* the comments container  */
.cmt-container{ 
	width: 630px;
	height: auto; min-height: 30px;
	padding: 10px;
	margin: 10px auto;
	background-color: #fff;
	border: #d3d6db 1px solid;
	-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px;
} 

.cmt-cnt{
	width: 100%; height: auto; min-height: 35px; 
	padding: 5px 0;
	overflow: auto;
}
.cmt-cnt img{
	width: 35px; height: 35px; 
	float: left; 
	margin-right: 10px;
	-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px;
	background-color: #ccc;
}
.thecom{
	width: auto; height: auto; min-height: 35px; 
	background-color: #fff;
}
.thecom h5{
	display: inline;
	float: left;
	font-family: tahoma;
	font-size: 13px;
	color: #3b5998;
	margin: 0 15px 0 0;
}
.thecom .com-dt{
	display: inline;
	float: left;
	font-size: 12px; 
	line-height: 18px;
	color: #ccc;
}
.thecom p{
	width: auto;
	margin: 5px 5px 5px 45px;
	color: #4e5665;
}
.new-com-bt{
	width: 100%; 	height: 30px;
	border: #d3d7dc 1px solid;
	-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px;
	background-color: #f9f9f9;
	color: #adb2bb;
	cursor: text;
}
.new-com-bt span{
	display: inline;
	font-size: 13px;
	margin-left: 10px;
	line-height: 30px;
}
.new-com-cnt{ width: 100%; height: auto; min-height: 110px; }
.the-new-com{ /* textarea */
	width: 98%; height: auto; min-height: 70px;
	padding: 5px; margin-bottom: 8px;
	border: #d3d7dc 1px solid;
	-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px;
	background-color: #f9f9f9;
	color: #333;
	resize: none;
}
.new-com-cnt input[type="text"]{
	margin: 0;
	height: 20px;
	padding: 5px;
	border: #d3d7dc 1px solid;
	-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px;
	background-color: #f9f9f9;
	color: #333;
	margin-bottom:5px;
}
.cmt-container textarea:focus, .new-com-cnt input[type="text"]:focus{
	border-color: rgba(82, 168, 236, 0.8);
  outline: 0;
  outline: thin dotted \9;
  /* IE6-9 */
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.4);
     -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.4);
          box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.4);
}
.bt-add-com{
	display: inline;
	float: left;
	padding: 8px 10px;  margin-right: 10px;
	background-color: #3498db;
	color: #fff; cursor: pointer;
	opacity: 0.6;
	-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px;
}
.bt-cancel-com{
	display: inline;
	float: left;
	padding: 8px 10px; 
	border: #d9d9d9 1px solid;
	background-color: #fff;
	color: #404040;	cursor: pointer;
	-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px;
}
.new-com-cnt{ 
	width:100%; height: auto; 
	display: none;
	padding-top: 10px; margin-bottom: 10px;
	border-top: #d9d9d9 1px dotted;
}


/* Css Shadow Effect for the prod-box and prod-box-list div */
 .shadow{
    -webkit-box-shadow: 0px 0px 18px rgba(50, 50, 50, 0.31);
    -moz-box-shadow:    0px 0px 10px rgba(50, 50, 50, 0.31);
    box-shadow:         0px 0px 5px rgba(50, 50, 50, 0.31);
}
</style>
<style>
#upload-wrapper {
	width: 50%;
	margin-right: auto;
	margin-left: auto;
	margin-top: 50px;
	background: #F5F5F5;
	padding: 50px;
	border-radius: 10px;
	box-shadow: 1px 1px 3px #AAA;
}
#upload-wrapper h3 {
	padding: 0px 0px 10px 0px;
	margin: 0px 0px 20px 0px;
	margin-top: -30px;
	border-bottom: 1px dotted #DDD;
}
#avatar_upload input[type=file] {
	border: 1px solid #DDD;
	padding: 0px;
	background: #FFF;
	border-radius: 5px;
	color:#000;
	margin-left:35px;
	margin-top:15px;
	
}
#avatar_upload #submit-btn {
	border: none;
	padding: 6px;
	background: #61BAE4;
	border-radius: 5px;
	color: #FFF;
	margin-top:15px
}
#output{
	padding: 5px;
	font-size: 12px;
	margin-left:15px
}
#output img {
	border: 1px solid #DDD;
	padding: 5px;
}
</style>
<div id="avatar_upload" style="width: 400px;position:absolute;z-index:1000;background:#222;display:none;top:70px;left:400px;color:#EEE;">
			<div class="bluebox">
				<p style="width:97%;float:left;">Upload Image</p><a href="javascript:void(0);" onClick="$('#avatar_upload').fadeOut();" id="xStatus1" style="color:#EEE;">X</a>
			</div>
			<form action="processupload.php" method="post" enctype="multipart/form-data" id="MyUploadForm">
<input name="ImageFile" id="imageInput" type="file" />
<input type="submit"  id="submit-btn" value="Upload" />
<img src="img/loading.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
</form>
<div id="output"></div>
		</div>
        
        
        <div id="friend_requests" style="width: 500px;position:absolute;z-index:1000;background:#222;display:none;top:70px;left:400px;color:#EEE;">
			<div class="bluebox">
				<p style="width:97%;float:left;">Friend Requests</p><a href="javascript:void(0);" onClick="$('#friend_requests').fadeOut();" id="xStatus1" style="color:#EEE;">X</a>
			</div>
			
            <table style="width:100%">
            <?php
			$FriendRequestQuery = mysqli_query($con,"SELECT * FROM notifications WHERE Type='friend' AND UserId='".$rec['user_id']."'");
				
			$FriendRequests = mysqli_affected_rows($con);
			
			
			while($FriendReceived = mysqli_fetch_array($FriendRequestQuery))
			{
				
             $UserData = $user_profile->GetUser($FriendReceived['SentBy']);
			$profile_link='profile/'.$UserData['username'];
			 ?>
             <tr >
             <td width="10%" style="padding-left:5px"><a href="<?=$profile_link;?>"><img src="<?=$UserData['avatar'];?>" style="height:35px; width:35px" /></a></td>
             
             <td width="50%"><a href="<?=$profile_link;?>">
			 <?php
			 echo $UserData['username'];
			 ?></a> sent you Friend Request</td>
              <td width="40%"><input type="button" value="Accept" onClick="FriendController('<?=$FriendReceived['UserId'];?>','<?=$FriendReceived['SentBy'];?>','accept')" /> <input type="button" value="Cancel" onClick="FriendController('<?=$FriendReceived['UserId'];?>','<?=$FriendReceived['SentBy'];?>','cancel')" /></td>
             
             </tr>
             <?php	
				
				
				
			}
				
			
			?>
            </table>
            
<div id="output"></div>
		</div>
<div class="mcontain">
	<div class="mbox">
		
		
		<div style="width: 992px; padding:0px 2px 10px 0px;float:left;">
			<div style="width: inherit;height:140px;float:left;border:1px solid #000;">
				<div style="position:relative" id="output1"><img style="float:left;padding:10px 5px 0px 10px;border-radius:20px" src="<?=$avatar;?>" width="100" height="100" alt=""/><?php if($isMine) { ?><img id="opt_edit_pic" src="img/pencil.png" alt="" width="40" height="40" style="position:absolute;top:77px;left:77px;z-index:1000;cursor:pointer"/>
                <?php }?></div>
				<div style="float:left;width:540px;height:120px;padding:12px;">
					<h1 style="color:#4CAED8;font-size:22px;padding:0px;margin:0px;line-height:24px;"><?php echo $name; ?> <img src="img/<?=$UserStatusImage;?>" title="<?=$OnlineStatus;?>" alt="<?=$OnlineStatus;?>" /></h1>
					<h3 style="color:#4CAED8;font-size:16px;padding:0px;margin:0px;line-height:24px;display:inline-block;">Status: <?php echo $status ?></h3><?php if($isMine){?><img id="opt_edit_status" style="padding:0px 0px 0px 10px;line-height:30px;verticle-align:top;cursor:pointer;" src="img/pencil.png" alt="" width="24" height="24"/> <?php }?>
					<h4 style="color:#4CAED8;font-size:12px;padding:0px;margin:0px;">Member Since: <?php echo $member_date ?></h4>
				</div>
                <?php
				
				$FriendRequestQuery = mysqli_query($con,"SELECT * FROM notifications WHERE Type='friend' AND UserId='".$rec['user_id']."' AND SentBy='".$_SESSION['user']['id']."'");
				
				$FriendRequestSent = mysqli_affected_rows($con);
				
				if($FriendRequestSent>0)
				{
					$FriendRequestSent=true;
				}
				else
				{
				$FriendRequestSent = false;	
				}
				
				if(!$isMine and isset($_SESSION['user']) and !$FriendRequestSent and !$isFriend and !$isInvited)
				{
				?>
                <div style="float:right;padding:12px">
                <button id="button_add_friend" class="new_button" onclick="AddFriend('<?=$rec['user_id'];?>')">Add Friend</button>
                </div>
			<?php
				}
				
				
				
				if($FriendRequests>0)
				{
				$FriendRequest = true;	
					
				}
				else
				{
					$FriendRequest = false;	
					
				}
				
				
				if($FriendRequest and $isMine)
				{
				?>
                 <div style="float:right;padding:12px">
                <button id="" class="new_button" onclick="$('#friend_requests').fadeIn('1000');"><?=$FriendRequests;?> Friend Request</button>
                </div>
                
                <?php	
					
					
				}
				
				?>
			</div>
			<div style="float:left;height:auto;width:225px;">
				<div style="width: inherit;float:left">
				<div class="bluebox">
					<p>About Me</p>
				</div>
				<div class="boxpill" style="height:170px">
					<div class="boxpill">
						<span >Name: <?php echo $name ?></span>
					</div>
					<div class="boxpill">
						<span>Age: <?php if($DateOfBirth!='') echo General::GetAge($DateOfBirth,date('Y-m-d'))." Years"; else echo 'Not Defined'; ?></span>
					</div>
					<div class="boxpill">
						<span>Country: <?php echo $country ?></span>
					</div>
					<div class="boxpill">
						<span>Games:</span>
					</div>
				</div>
				</div>
				<div style="width: inherit;float:left;">
				<div class="bluebox">
					<p>Stats</p>
				</div>
				<div class="boxpill" style="height:112px;">
				</div>
				
				</div>
				<div style="width: inherit;float:left;">
					<div class="bluebox">
						<p>Friends</p>
					</div>
					<div class="boxpill" style="height:146px;position:relative">
                    <?php
					$Friends = $user_profile->getFriends($rec['user_id']);
					
					foreach($Friends as $Friend)
					{
						
						if($Friend['user_1']==$rec['user_id'])
						{
							$FriendId = $Friend['user_2'];
						}
						else
						{
							$FriendId = $Friend['user_1'];
						}
					?>
                    <a class="avatar_img" href="<?php echo $user_profile->profileLink($FriendId);?>" rel="tooltip" title="<?php $RecentUN =  $user_profile->GetUser($FriendId); echo $RecentUN['username'];?>"><?php echo $user_profile->getAvatar($FriendId,'45'); ;?>
                        <img src="img/<?php if($user_profile->checkUserStatus($FriendId)) echo 'user_online.png'; else echo 'user_offline.png';?>" style="position:absolute;margin-left:-13px;margin-top:36px;height:7px;width:7px" />
                        </a>
                    
                    <?php	
						
						
					}
					?>
                    
                 <!--   <div style="color: rgb(239, 239, 239); height: 26px; width: 150px; font-weight: 500; float: right; margin-right: 0px; margin-top: 121px; background: none repeat scroll 0px 0px rgb(65, 165, 211); border: 1px solid rgb(0, 1, 2);">
	<p style="margin-left: 7px; margin-top: 3px;">SHOW ALL</p>
	</div>-->
                   <div style="color: rgb(239, 239, 239); height: 26px; width: 75px; font-weight: 500; float: right; margin-right: 0px; margin-top: 121px; background: none repeat scroll 0px 0px rgb(65, 165, 211); border: 1px solid rgb(0, 1, 2);">
                  <a href="#friend_list_popup" onClick="GetFriends('<?=$rec['user_id'];?>','')" class="" rel="leanModal">  <p style="margin-left: 7px; margin-top: 3px;color:#FFF;">SHOW ALL</p></a>
                   </div>
					</div>
				
				</div>
                
				<div style="width: inherit;float:left;">
					<div class="bluebox">
						<p>Recent Visitors</p>
					</div>
					<div class="boxpill" style="height:146px;">
					<?php
					$Records = $user_profile->getRecentVisitors($rec['profile_id']);
					
					
					foreach($Records as $Record)
					{
						
						
						?>
                        <a class="avatar_img" style="" href="<?php echo $user_profile->profileLink($Record['user_id']);?>" rel="tooltip" title="<?php $RecentUN =  $user_profile->GetUser($Record['user_id']); echo $RecentUN['username'].' '; echo General::showDate($Record['date_time']);?>"><?php echo $user_profile->getAvatar($Record['user_id'],'45'); ;?>
                        <img src="img/<?php if($user_profile->checkUserStatus($Record['user_id'])) echo 'user_online.png'; else echo 'user_offline.png';?>" style="position:absolute;margin-left:-13px;margin-top:36px;height:7px;width:7px" />
                        </a>
                        <?php
						
						
					}
					
					?>
                    </div>
				</div>
			

			</div>
			<div style="float:left;height:auto;width:457px;">
				<div style="width: inherit;float:left;">
					<div class="bluebox">
						<p>Awards Showcase</p>
					</div>
					<div class="boxpill" style="height:170px;">
					</div>
				
				</div>
				<div style="width: inherit;float:left;">
					<div class="bluebox">
						<p>Biography</p>
					</div>
					<div class="boxpill edit_area" id="users_profile~biography" style="height:112px;overflow:hidden; overflow-y:scroll"><?=stripslashes($rec['biography']);?></div>
				
				</div>
				<div style="width: inherit;float:left;">
					<div class="bluebox">
						<p>My Setup</p>
					</div>
					<div class="boxpill" style="height:335px;">
					<style>
					#hey tr{
					vertical-align:top;	
					}
					</style>
                    
                   <table style="width:100%" id="hey" >
                   <tr >
                   <td style="width:30%; ">Video Card: </td>
                   <td style="width:70%" id="users_profile~Video_Card" class="edit"><?=$rec['Video_Card'];?></td>
                   </tr>
                    <tr>
                   <td >Sound Card: </td>
                   <td  id="users_profile~Sound_Card" class="edit"><?=$rec['Sound_Card'];?></td>
                   </tr>
                   <tr>
                   <td >CPU: </td>
                   <td  id="users_profile~CPU" class="edit"><?=$rec['CPU'];?></td>
                   </tr>
                   
                   <tr>
                   <td >Ram: </td>
                   <td  id="users_profile~Ram" class="edit"><?=$rec['Ram'];?></td>
                   </tr>
                   
                   <tr>
                   <td >Hard Drive: </td>
                   <td  id="users_profile~Hard_Drive" class="edit"><?=$rec['Hard_Drive'];?></td>
                   </tr>
                   
                   <tr>
                   <td >Headset: </td>
                   <td  id="users_profile~Headset" class="edit"><?=$rec['Headset'];?></td>
                   </tr>
                   
                   <tr>
                   <td >Microphone: </td>
                   <td  id="users_profile~Microphone" class="edit"><?=$rec['Microphone'];?></td>
                   </tr>
                   
                   <tr>
                   <td >Webcam: </td>
                   <td  id="users_profile~Webcam" class="edit"><?=$rec['Webcam'];?></td>
                   </tr>
                   
                    <tr>
                   <td >Mouse: </td>
                   <td  id="users_profile~Mouse" class="edit"><?=$rec['Mouse'];?></td>
                   </tr>
                   
                   
                   
                    <tr>
                   <td >Mousepad: </td>
                   <td  id="users_profile~Mousepad" class="edit"><?=$rec['Mousepad'];?></td>
                   </tr>
                   
                   
                   
                    <tr>
                   <td >Keyboard: </td>
                   <td  id="users_profile~Keyboard" class="edit"><?=$rec['Keyboard'];?></td>
                   </tr>
                   
                   
                   
                    <tr>
                   <td >Monitor: </td>
                   <td  id="users_profile~Monitor" class="edit"><?=$rec['Monitor'];?></td>
                   </tr>
                   
                   
                   
                   <tr>
                   <td >Case: </td>
                   <td  id="users_profile~Case" class="edit"><?=$rec['Case'];?></td>
                   </tr>
                   
                   
                   <tr>
                   <td >Extra: </td>
                   <td  id="users_profile~Extra" class="edit"><?=$rec['Extra'];?></td>
                   </tr>
                   
                   
                   
                   
                   </table>
                    
                    
                    </div>
				
				</div>
			</div>
			
			<div style="float:left;height:auto;width:310px;">
				<div style="width: inherit;float:left;">
					<div class="bluebox">
						<p>Social</p>
					</div>
					<div style="height:170px;" class="boxpill">
						<div class="boxpill">
							<table style="width:100%" id="hey" >
                   <tr >
                   <td style="width:12%; "><a href="<?php if($rec['Facebook']=='') echo 'javascript:void(0);'; else echo $rec['Facebook'];?>" target="_blank"><img src="img/facebook-icon.png" alt="Facebook" title="Facebook" height="22" width="22" /></a></td>
                   <td style="width:88%" id="users_profile~Facebook" class="edit link-text"><?=$rec['Facebook'];?></td>
                   </tr>
                   
                   <tr >
                   <td ><a href="<?php if($rec['Twitter']=='') echo 'javascript:void(0);'; else echo $rec['Twitter'];?>" target="_blank"><img src="img/twitter-icon.png" alt="Twitter" title="Twitter" height="22" width="22" /></a></td>
                   <td  id="users_profile~Twitter" class="edit"><?=$rec['Twitter'];?></td>
                   </tr>
                   
                   <tr >
                   <td ><a href="<?php if($rec['Steam']=='') echo 'javascript:void(0);'; else echo $rec['Steam'];?>" target="_blank"><img src="img/steam-icon.png" alt="Steam" title="Steam" height="22" width="22" /></a></td>
                   <td  id="users_profile~Steam" class="edit"><?=$rec['sTeam'];?></td>
                   </tr>
                   
                    <tr >
                   <td ><a href="<?php if($rec['Twitch']=='') echo 'javascript:void(0);'; else echo $rec['Twitch'];?>" target="_blank"><img src="img/twitch-icon.png" alt="Twitch TV" title="Twitch TV" height="22" width="22" /></a></td>
                   <td  id="users_profile~Twitch" class="edit"><?=$rec['Twitch'];?></td>
                   </tr>
                   
                    <tr >
                   <td ><a href="<?php if($rec['Youtube']=='') echo 'javascript:void(0);'; else echo $rec['Youtube'];?>" target="_blank"><img src="img/youtube-icon.png" alt="Youtube" title="Youtube" height="22" width="22" /></a></td>
                   <td  id="users_profile~Youtube" class="edit"><?=$rec['Youtube'];?></td>
                   </tr>
                   
                   
                   
                   
                   
                   </table>
						
					</div>
				</div>
				<div style="width: inherit;float:left;">
					<div class="bluebox">
						<p>Current Team</p>
					</div>
					<div class="boxpill" style="height:112px;">
					</div>
				</div>
				<div style="width: inherit;float:left;">
					<div class="bluebox">
						<p>Matches</p>
					</div>
					<div class="boxpill" style="height:146px;">
					</div>
				</div>
				<div style="width: inherit;float:left;">
					<div class="bluebox">
						<p>My Config</p>
					</div>
					<div class="boxpill" style="height:146px;">
					</div>
				</div>
			</div>
            
			
						
		</div>
		<div style="width:682px;float:left;">
				<div style="width: inherit;float:left;">
					<div class="bluebox">
						<p>Comments</p>
					</div>
					<div class="boxpill" style="height:500px;border:none">
                      <div class="cmt-container" >
   
    <div id="ListedComments" style="color:#000"></div>
    
    <div class="pagination dark">
		<?php
		$CommentCount = $user_profile->commentCount($rec['username']);
		if($CommentCount<4) $CommentCount=4;
		if($CommentCount>=4)
		{
			$Pages = ceil($CommentCount / 4);
		
			for($i=1;$i<=$Pages;$i++)
			{
				if($i==1) $class="active"; else $class="gradient";	
				
				
			?>
        <a href="javascript:void(0);" onClick="changePagination(this)" data-val="<?=$i;?>" class="page dark <?=$class;?>"><?=$i;?></a>    
            <?php	
				
			}
		}
		
		?>
		
        
	</div>

<?php
if(isset($_SESSION['user']))
{

?>
    <div class="new-com-bt">
        <span>Write a comment ...</span>
    </div>
    <div class="new-com-cnt">
        <input style="display:none" type="text" id="name-com" name="name-com" value="<?=$_SESSION['user']['username'];?>" placeholder="Your name" disabled />
        <input style="display:none" type="text" id="mail-com" name="mail-com" value="<?=$_SESSION['user']['email'];?>" placeholder="Your e-mail adress" disabled />
        <textarea class="the-new-com" placeholder="Post your comment as <?=$_SESSION['user']['username'];?>"></textarea>
        <div class="bt-add-com">Post comment</div>
        <div class="bt-cancel-com">Cancel</div>
    </div>
    <div class="clear"></div>
</div><!-- end of comments container "cmt-container" -->
<?php 

}
?>

<script type="text/javascript">
   function AddFriend(user_id)
   {
	$.post("add_friend.php?action=request",{user_id:user_id},function(result){
   $("#button_add_friend").hide();
   $('.modal_close').click();
  }); 
	   
   }
   
   
   function FriendController(UserId,SentBy,action)
   {
	$.post("add_friend.php?action="+action,{UserId:UserId,SentBy:SentBy},function(result){
   location.reload();
  }); 
	   
   }
   
   $(function(){ 
        //alert(event.timeStamp);
        $('.new-com-bt').click(function(event){    
            $(this).hide();
            $('.new-com-cnt').show();
            $('.the-new-com').focus();
        });

        /* when start writing the comment activate the "add" button */
        $('.the-new-com').bind('input propertychange', function() {
           $(".bt-add-com").css({opacity:0.6});
           var checklength = $(this).val().length;
           if(checklength){ $(".bt-add-com").css({opacity:1}); }
        });

        /* on clic  on the cancel button */
        $('.bt-cancel-com').click(function(){
            $('.the-new-com').val('');
            $('.new-com-cnt').fadeOut('fast', function(){
                $('.new-com-bt').fadeIn('fast');
            });
        });

        // on post comment click 
        $('.bt-add-com').click(function(){
            var theCom = $('.the-new-com');
            var theName = $('#name-com');
            var theMail = $('#mail-com');

            if( !theCom.val()){ 
                alert('You need to write a comment!'); 
            }else{ 
                $.ajax({
                    type: "POST",
                    url: "add-comment.php",
                    data: 'act=add-com&id_post=<?php echo $id_post; ?>&name='+theName.val()+'&email='+theMail.val()+'&comment='+theCom.val(),
                    success: function(html){
                        theCom.val('');
                        //theMail.val('');
                        //theName.val('');
                        $('.new-com-cnt').hide('fast', function(){
                            $('.new-com-bt').show('fast');
                            $(".pagination .page:first").click();
							//$('.new-com-bt').before(html);  
                        })
                    }  
                });
            }
        });

    });
</script>
					</div>
				</div>
			</div>
			<div style="width:310px;float:left;">
				<div style="width: inherit;float:left;">
					
					<div class="boxpill" style="height:535px;">
					</div>
				</div>
			</div>
		

</div>
</div>

<div id="friend_list_popup" class="leanModalPopup" style="display:none;width:525px">
			<div id="signup-ct">
				<div class="signup-header" style="background-image: linear-gradient(to bottom, #175d7f 0%, #003b5b 100%);" >
					<h2 style="color:#FFF">Friends</h2>
					
					<a href="javascript:void(0);" class="modal_close"></a>
				</div>
                <div id="PopupContent" style="color:#000;">
               <table style="width:68%;margin-left:10px;margin-top:20px">
     
     <tr>
     <td colspan="2">  <input type="text" name="FriendQuery"  id="FriendQuery"  style="width:490px" placeholder="Search Friends" ></td>
    
</td>
     </tr>
     
     
     
     </table>
     
     <table style="width:96%;margin-left:10px;">
     <tbody id="friend_list_content" style="height:420px;overflow-y:scroll;vertical-align:top">
     
     
     </tbody>
     
     
     </table>
				
                </div>
               
				
			</div>
		</div>
        <script>
		var typingTimer;                //timer identifier
var doneTypingInterval = 2000;  //time in ms, 5 second for example

//on keyup, start the countdown
$('#FriendQuery').keyup(function(){
    clearTimeout(typingTimer);
    if ($('#FriendQuery').val) {
        typingTimer = setTimeout(function() {
    GetFriends('<?=$rec['user_id'];?>',$("#FriendQuery").val())
}, doneTypingInterval);
    }
});
		
		</script>
<?php
} 
	
?>