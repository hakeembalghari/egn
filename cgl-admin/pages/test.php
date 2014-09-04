		<div class="content">     
        	<div id="pad-wrapper">
<div class="table-wrapper orders-table">
                <div class="row head">
                    <div class="col-md-12">
                        <h4>Test Page</h4>
                    </div>
                </div>
                
                <div class="row" style="padding-top: 10px;">
<?PHP
	echo $json = json_encode(array());
    $b = json_decode($json);
	echo "<br>";
	array_push($b, "newthing");
	array_push($b, "newthing");
	array_push($b, "newthing");
	echo json_encode($b);
?>
                </div>