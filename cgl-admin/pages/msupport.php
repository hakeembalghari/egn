<?PHP
	$query = " 
        SELECT 
            id,question,answer FROM pm_support
    ";      
    try 
    {
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } 
    catch(PDOException $ex) 
    {  
        die("Failed to run query: " . $ex->getMessage()); 
    } 
    $gqanda = $stmt->fetchAll();
?>
		<div class="content">     
        	<div id="pad-wrapper">
<div class="table-wrapper orders-table">

                      
                      <div class="row head">
                    <div class="col-md-12">
                        <h4>New Q&A </h4>
                    </div>
                    <br>
         <form class="form-horizontal" action="newqsupport.php" method="POST">
  <div class="control-group">
    <label class="control-label" for="inputEmail">Question</label><br>

    <div class="controls">
      <input type="text" style="width: 600px;"class="form-control" placeholder="Question" name="question" autocomplete="off">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPassword">Answer</label><br>

    <div class="controls">
      <textarea class="wys" style="width: 600px; height: 150px;" name="answer"></textarea>
    </div>
  </div>
  <div class="control-group">
  <br>

    <div class="controls">
      <button type="submit" class="btn btn-primary">Submit Question</button>
    </div>
  </div>
</form>
<div class="section"></div>
                <div class="row head">
                    <div class="col-md-12">
                        <h4>Modify Support</h4>
                    </div>
                </div>
                
                <div class="row" style="padding-top: 10px;">
	<table class="table table-hover">
                        <thead>
                        
                            <tr>
                                <th class="col-md-2">
                                    Question
                                </th>
                                <th class="col-md-2">
                                    <span class="line"></span>
                                    Answer
                                </th>
                                <th class="col-md-2">
                                    <span class="line"></span>
                                </th>
                            </tr>
                       
                        </thead>
                        <tbody>
                            <!-- row -->
                            <?PHP foreach($gqanda as $gqand): ?>
                            <tr class="first">
                                <td>
                                    <div class="comments" data-title="Modify Title" data-type="text" data-pk="<?PHP echo $gqand["id"]; ?>" data-url="ajax.php?r=msupportquestion"><?PHP echo $gqand["question"]; ?></div>
                                </td>
                                <td>
                                	<div class="comments" data-title="Modify Content" style="height: 64px;overflow-y: auto;overflow-x: scroll; width:600px;" data-type="wysihtml5" data-pk="<?PHP echo $gqand["id"]; ?>" data-url="ajax.php?r=msupportcontent"><?PHP echo $gqand["answer"]; ?></div>
                                </td>
                                
                                <td>
                                   <a class="btn btn-danger" href="delqsupport.php?s=<?PHP echo $gqand["id"]; ?>"><i class="icon-trash"></i></a>
                                </td>
                         	</tr>
                            <?PHP endforeach; ?>
                      </tbody>
                      </table>

                </div> 
             </div>
           </div>