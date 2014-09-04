		
		
<?php

include('bb/BinaryBeast.php');
		
		
		$bb=new BinaryBeast();
                
                
                
//$bb->enable_dev_mode();
$bb->disable_ssl_verification();
$tournament                 = $bb->tournament();
$team = $tournament->team();

$team->country_code = 'NOR';
$team->display_name = 'New norwegian team name';
$team->save();
echo "hello";
?>

		
		
		<div class="content">     
        	<div id="pad-wrapper">
<div class="table-wrapper orders-table">
                <div class="row head">
                    <div class="col-md-12">
                        <h4>Add Team </h4>
						
						<form name="addteam" action="" method="post">
						
						<input type="text" name="teamtitle" />
						<br>
						
						
						
						<input type="submit" name="submit" value="Submit" />
						
						</form>
						
						
                    </div>
                </div>
                
              