

<?php

include('bb/BinaryBeast.php');
		
		
		$bb=new BinaryBeast();
                
                
                
//$bb->enable_dev_mode();
$bb->disable_ssl_verification();



?>



<div class="content">     
        	<div id="pad-wrapper">
<div class="table-wrapper orders-table">
                <div class="row head">
                    <div class="col-md-12">
                        <h4> Tournaments </h4>
						
						
						<?php
/**
 * Simple example demonstrating how to delete a tournament
 * 
 * (also used by other examples to allow deleting examples after you're done with them)
 *
 * @filesource
 *
 * @global BBTournament $tournament
 *
 * @package BinaryBeast
 * @subpackage Examples
 *
 * @version 1.0.1
 * @date    2013-04-13
 * @author  Brandon Simmons <contact@binarybeast.com>
 */

//May be set from another example


/**
 * Process the request
 */
if(isset($_GET['id'])) {
    $tournament = $bb->tournament($_GET['id']);
    if(!$tournament->delete()) {
        var_dump(array('Error deleting tournament', 'errors' => $bb->error_history));
        die();
    }
    else {
        //die('<h1 style="color:red">Tournament (' . $_GET['id'] . ') deleted successfully!</h1>');
		header('Location: tournaments');
    }
}

/**
 * Create a tournament to delete (unless provided by another example)
 */
if(!isset($tournament)):
    require_once('../bb/__brackets.php');
?>
    <h1>Tournament Brackets (<?php echo $tournament->id; ?>)</h1>

    <?php
        BBHelper::embed_tournament($tournament);
    ?>

<?php endif; ?>

<form action="/examples/tournament/delete/delete.php" method="post">
    <input type="hidden" name="id" value="<?php echo $tournament->id; ?>" />
    <fieldset>
        <legend>Delete the Tournament!</legend>
        <input type="submit" value="Delete" />
    </fieldset>
</form>
						
						
						
						

						
						
                    </div>
                </div>
                