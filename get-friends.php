<?php
session_start();
require_once('myDb.php');
$user_id = $_POST['user_id'];
$text = $_POST['text'];

$Query   = mysqli_query($con, "SELECT DISTINCT a.Id,a.UserId as user_1,a.FriendId as user_2 FROM friends a,users b  WHERE (b.id=a.UserId OR b.id=a.FriendId) AND b.username LIKE '%$text%'  AND (UserId='$user_id' OR  FriendId='$user_id' )  ");
$output='';
$user_profile = new UserProfile();
if(mysqli_num_rows($Query)==0)
{
echo '<tr><td colspan="3">No Match Found</td></tr>';exit;	
	
}
for($i=0;$Records = mysqli_fetch_assoc($Query);$i++)
{
	if($Records['user_1']==$user_id)
	{
		$user_id = $Records['user_2'];	
		
	}
	else
	{
		$user_id = $Records['user_1'];
		
	}
	$User = $user_profile->getUser($user_id);
echo '<tr>';	
	echo '<td width="20%">';
	$href='<a href="profile/'.$User['username'].'">';
	echo $href;
	$user_profile->getAvatar($user_id,70);
	echo '</a></td>';
	
	echo '<td width="60%">'.$href.$User['first_name'].' '.$User['last_name'].'</a></td>';
	echo '<td width="20%"><select onChange="if(this.value==1){AddFriend(\''.$User['user_id'].'\');}"">';
	echo '<option value="">Select Action</option>';
	if(!$user_profile->isFriend($user_id,$User['user_id']))
	{
	echo '<option value="1">Add as Friend</option>';
	}
	echo '<option value="2">Private Message</option></select></td>';
echo '</tr>';
}

?>