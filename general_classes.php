<?php
class General
{
	public static function GetAge($date1, $date2)
	{
		$diff  = abs(strtotime($date2) - strtotime($date1));
		$years = floor($diff / (365 * 60 * 60 * 24));
		return $years;
	}
	public static function showDate($date)
	{
		$date = date('dS F Y \a\t h:ia', strtotime($date));
		return $date;
	}
}

class UserProfile
{
	public function GetAwards($user_id)
	{
			global $con;
		$Query = mysqli_query($con, "SELECT a.*,b.Title,b.Image FROM assign_award a, awards b WHERE a.AwardId=b.AwardId AND UserId='".$user_id."'");
		
		$Records = array();
		$i       = 0;
		while ($Record = mysqli_fetch_assoc($Query))
		{
			$Records[$i] = array(
				'Image' => $Record['Image'],
				'Title' => $Record['Title'],
				'Description' => $Record['Description']
				
			);
			$i++;
		}
		return $Records;
		
		
	}
	public function GetUser($user_id)
	{
		global $con;
		$Query = mysqli_query($con, "SELECT a.*,b.* FROM users a,  users_profile b WHERE a.id=b.user_id AND id='$user_id'");
		return mysqli_fetch_assoc($Query);
	}
	public function getAvatar($user_id, $avatar_size)
	{
		global $con;
		$Query  = mysqli_query($con, "SELECT b.avatar FROM users a,  users_profile b WHERE a.id=b.user_id AND id='$user_id'");
		$Record = mysqli_fetch_array($Query);
		if ($Record['avatar'] == '')
		{
			$Record['avatar'] = 'img/no-image.jpg';
		}
		echo '<img src="' . $Record['avatar'] . '" style="height:' . $avatar_size . 'px;width:' . $avatar_size . 'px;border-radius:5px">';
	}
	/*public function isFriend($user_id)
	{
		global $con;
		$Query = mysqli_query($con, "SELECT * FROM friends WHERE FriendId='$user_id' OR UserId='$user_id'");
		if (mysqli_affected_rows($con) > 0)
		{
			$isFriend = true;
		}
		else
		{
			$isFriend = false;
		}
		return $isFriend;
	}*/
	public function isInvited($user_id)
	{
		global $con;
		$Query = mysqli_query($con, "SELECT * FROM notifications WHERE SentBy='$user_id'");
		if (mysqli_affected_rows($con) > 0)
		{
			$isFriend = true;
		}
		else
		{
			$isFriend = false;
		}
		return $isFriend;
	}
	public function profileVisited($user_id, $profile_id)
	{
		global $con;
		$DeleteQuery = mysqli_query($con,"DELETE FROM profile_visit WHERE user_id='$user_id' AND profile_id='$profile_id'");
		$Query = mysqli_query($con, "INSERT INTO profile_visit (user_id,profile_id) VALUES ('" . $user_id . "','" . $profile_id . "')");
		if (mysqli_insert_id($con))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function getRecentVisitors($profile_id)
	{
		global $con;
		$Query   = mysqli_query($con, "SELECT  user_id,profile_id,date_time FROM profile_visit WHERE profile_id='" . $profile_id . "' ORDER BY date_time DESC LIMIT 12  ");
		$Records = array();
		$i       = 0;
		while ($Record = mysqli_fetch_assoc($Query))
		{
			$Records[$i] = array(
				'user_id' => $Record['user_id'],
				'profile_id' => $Record['profile_id'],
				'date_time' => $Record['date_time']
			);
			$i++;
		}
		return $Records;
	}
	public function profileLink($user_id)
	{
		$Record = $this->GetUser($user_id);
		return 'profile/' . $Record['username'];
	}
	public function checkUserStatus($user_id)
	{
		global $con;
		$UserOnlineStatus = mysqli_query($con, "SELECT sessions.UserID FROM sessions,users WHERE sessions.UserID=users.id AND  users.id='$user_id'");
		if (mysqli_num_rows($UserOnlineStatus) >= 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function getFriends($user_id)
	{
		global $con;
		$Query   = mysqli_query($con, "SELECT Id,UserId as user_1,FriendId as user_2 FROM friends  WHERE (UserId='$user_id' OR  FriendId='$user_id' ) LIMIT 12");
		$Records = array();
		$i       = 0;
		while ($Record = mysqli_fetch_assoc($Query))
		{
			$Records[$i] = array(
				'Id' => $Record['Id'],
				'user_1' => $Record['user_1'],
				'user_2' => $Record['user_2']
			);
			$i++;
		}
		return $Records;
	}
	public function getComments($username)
	{
		$sql = mysqli_query($con, "SELECT * FROM comments WHERE username = '$username'") or die(mysqli_error($con));
		$Comments = array();
		$i        = 0;
		while ($Comments = mysqli_fetch_assoc($sql))
		{
			$Comments[$i] = array(
				'Id' => $Record['Id'],
				'user_1' => $Record['user_1'],
				'user_2' => $Record['user_2']
			);
			$i++;
		}
		return $Records;
	}
	public function commentCount($username)
	{
		global $con;
		$sql = mysqli_query($con, "SELECT id FROM comments WHERE username = '$username'") or die(mysqli_error($con));
		return mysqli_num_rows($sql);
	}
	
	public function isFriend($user_id,$friend_id)
	{
		global $con;
	$Query   = mysqli_query($con, "SELECT Id,UserId as user_1,FriendId as user_2 FROM friends  WHERE (UserId='$user_id' OR  FriendId='$user_id' ) ");	
	
	
	$return = false;
	while ($Record = mysqli_fetch_assoc($Query))
		{
			if($Record['user_1']==$user_id)
			{
				$friend = $Record['user_2'];	
				
			}
			else
			{
				$friend = $Record['user_1'];	
				
			}
			
			if($friend_id==$user_id)
			{
			$return= true;
			break;	
			}
			
			
		}
		
		return $return;
		
	}
}
?>