<?php
require("myDb.php");

	$pageNo = $_POST['pageNo'];
	
	$limitTo = $pageNo*4;
	$limitFrom = $limitTo-4;
	
	$id_post=$_POST['username'];
	
    $sql = mysqli_query($con,"SELECT * FROM comments WHERE username = '$id_post' ORDER BY id DESC LIMIT $limitFrom,4") or die(mysqli_error($con));;
    while($affcom = mysqli_fetch_assoc($sql)){ 
        $name = stripslashes($affcom['name']);
        $email = stripslashes($affcom['email']);
        $comment = stripslashes($affcom['comment']);
        $date = $affcom['date'];

        // Get gravatar Image 
        // https://fr.gravatar.com/site/implement/images/php/
        $default = "mm";
        $size = 35;
		
		$Query = mysqli_query($con,"SELECT
users_profile.avatar
FROM
    users
    INNER JOIN users_profile 
        ON (users.id = users_profile.user_id)
        WHERE users.email='".$email."'");
		
		$Image = mysqli_fetch_array($Query);

$grav_url = $Image['avatar'];
if($grav_url=='')
{
$grav_url = 'img/no-image.jpg';	
}

       // $grav_url = "getImage.php?email=".strtolower(trim('xaman.riaz@gmail.com'))."&s=".$size;

    ?>
    <div class="cmt-cnt">
        <img src="<?php echo $grav_url; ?>" />
        <div class="thecom">
            <h5><?php echo $name; ?></h5><span data-utime="1371248446" class="com-dt"><?php echo $date; ?></span>
            <br/>
            <p>
                <?php echo $comment; ?>
            </p>
        </div>
    </div><!-- end "cmt-cnt" -->
    <?php } ?>
