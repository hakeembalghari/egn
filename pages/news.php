<?php
//require_once('../config.php');
if(isset($_GET['id']))
{
    
   $q="select* from pm_news where id=".$_GET['id'];
   
   $res=  mysqli_query($con,$q);
           
           
  
         
         //echo $row['id'];



?>
<div class="pull-left">
<div style="width: 700px;">
	<div>
    
      
        <?php
         while ($row=  mysqli_fetch_array($res))
   {
      ?>
            <img src="data:<?PHP echo $row["imagetype"]; ?>;base64,<?PHP echo base64_encode($row["image"]); ?>" width="84" height="84" style="padding-top: 10px; padding-left: 10px;"/><p style="color: #84b8db;padding-left:110px;font-size:15px;margin-top:-80px;margin-bottom: 70px;"><?PHP echo strip_tags($row["title"]); ?></p><br>
          
            
           <p style="padding-left:110px;font-size:15px;margin-top:-80px;margin-bottom: 70px; text-align: justify;"><?PHP echo strip_tags($row["contents"]); ?></p><br>
        <?php  
            // echo "<img src=".base64_encode($row["image"])."/>";
   }
        ?>
    </div>

</div>
    
<?php }?>