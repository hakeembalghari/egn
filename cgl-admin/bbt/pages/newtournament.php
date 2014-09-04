		
		
		
		
		<div class="content">     
        	<div id="pad-wrapper">
<div class="table-wrapper orders-table">
                <div class="row head">
                    <div class="col-md-12">
                        <h4>Create Tournament </h4>
						
						<br><br>
						
						<form name="ct" method="post" action="newt.php" class="form-horizontal">
						
					
					<div class="control-group">
						
						<label class="control-label" for="ttitle">  Tournament Title</label><br>
						<div class="controls">
						<input class="form-control" type="text" required="" min="5" style="width:400px" name="ttitle"></input>

						</div><br>
					
					
					
					
						<label class="control-label" for="ttype">  Tournament Type</label><br>
						
						<div class="controls">
						<select name="ttype" class="select2">
						<option value="Single" >Single Elimination</option>
						<option value="Double">Double Elimination</option>
						
						</select>

						</div><br>
						
						<label class="control-label" for="tround">  Round (Min)</label><br>
						<div class="controls">
						<input class="form-control" type="text" required="" min="5" style="width:100px" name="tround"></input>

						</div><br>
						<label class="control-label" for="troundf">  Round (Max)</label><br>
						<div class="controls">
						<input class="form-control" type="text" required="" min="5" style="width:100px" name="troundf"></input>

						</div><br>
						
						<label class="control-label" for="desc">  Description</label><br>
						<div class="controls">
						<textarea rows="3" class="form-control" style="width:300px">
						
						</textarea>
						
					

						</div><br>
						
						
<label>Bronze</label><br>
    <div class="btn-group" data-toggle="buttons">

        <label class="btn btn-primary">

            <input type="radio" name="bronze" value="true"> True

        </label>

        <label class="btn btn-primary">

            <input type="radio" name="bronze" value="false"> False

        </label>

       

    </div>


						<br><br>
						
						<input type="submit" name="submit" value="Submit" class="btn btn-primary" />
						</form>
                    </div>
                </div>
				</div>
                
              