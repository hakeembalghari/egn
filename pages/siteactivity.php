 <div style="width:469px;border: 1px solid black; background: #2e2e2e; margin-top: -1px;">
  <div class="tab-content">
    <div class="tab-pane active" id="tabuno" style="overflow: hidden;">
    <?PHP foreach($gnews as $gnew): ?>
		            <!-- 
      	  News Article
      			-->
      <div style="height: 100px;line-height:3.4; padding-left:15px;">
      	<img src="data:<?PHP echo $gnew["imagetype"]; ?>;base64,<?PHP echo base64_encode($gnew["image"]); ?>" width="84" height="84" style="padding-top: 10px;"/><p style="color: #84b8db;padding-left:110px;font-size:15px;margin-top:-110px;"><?PHP echo strip_tags($gnew["title"]); ?></p>
        <p style="width:340px;padding-left:111px;margin-top:-23px;line-height:1.2;"><?PHP echo strip_tags(substr($gnew["contents"], 0, 75)); ?></p>
        <p style="color:#84b8db;padding-left:360px;margin-top:-15px;"><a href="news?id=<?php echo $gnew["id"]; ?>" style="color:#84b8db;">READ MORE...</a></p>
      </div>
      <!-- -->
      <div class="newssep"></div>
      <!-- -->
<?PHP endforeach; ?>
    <div style="height: 105px;line-height:3.4; padding-left:15px;">
      	
      </div>
    </div>
    <div class="tab-pane" id="tabdos" style="overflow: hidden;">
            <!-- 
      	  News Article
      			-->
     
    
      <!-- -->
    
   <?php

$q="SELECT * FROM users WHERE timestamp <= CURDATE() ORDER BY timestamp";

$res=mysqli_query($con,$q);

while($row=mysqli_fetch_row($res))
{
?>

<div style="height: 50px;line-height:3.4; padding-left:15px;">
      	<img src="http://puu.sh/4UNlB.jpg" height="25" width="25"><div style="padding-left:45px;margin-top:-53px;">  <?php echo $row[1]." has just joined CGL  ";?></div>
        <div style="font-size:12px;padding-left:327px;margin-top:-27px;">
        	<a href="commentu?uname=<?php echo $row[1];?>" style="color:#84b8db;">Comment</a></div>
        </span>
      </div>

<?php
}

?>