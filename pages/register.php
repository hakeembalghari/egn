<div class="pull-left">
<div style="width: 700px;">
	<div class="bluebox">
    	<p>REGISTER A NEW ACCOUNT</p>
    </div>
    <img style="padding-top: 15px; padding-left: 2px;" src="img/premium.jpg" width="695" height="155" />
    <p style="font-size: 18px;padding-top: 10px;padding-left:10px;">Account Information</p>
<form class="form-horizontal" method="POST" action="registeru.php" style="margin-left: -15px;padding-top:20px;" id="regForm">
  <div class="control-group">
    <label class="control-label" for="inputEmail">Username</label>
    <div class="controls">
      <input type="text" id="inputEmail" name="username" placeholder="Name" required>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputEmail">Password</label>
    <div class="controls">
      <input type="password" id="inputEmail" name="password" placeholder="Password" required>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputEmail">Re-Enter Password</label>
    <div class="controls">
      <input type="password" id="inputEmail" name="repassword" placeholder="Re-Enter Password" required>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPassword" required>Email</label>
    <div class="controls">
      <input type="email" name="email" id="inputEmail" placeholder="Email" required>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputEmail">Security Question</label>
    <div class="controls">
      <select name="secret" required>
      	<option value="null">- Secret Question -</option>
  		<option value="What Was Your Childhood Nickname?">What Was Your Childhood Nickname?</option>
  		<option value="In What City Did You Meet Your Spouse/Significant Other?">In What City Did You Meet Your Spouse/Significant Other?</option>
  		<option value="What Is The Name Of Your Childhood Bestfriend?">What Is The Name Of Your Favorite Childhood Friend?</option>
  		<option value="What Elementary School Did You Attend?">What Elementary School Did You Attend?</option>
	</select>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputEmail">Security Answer</label>
    <div class="controls">
      <input type="text" id="inputEmail" name="secretanswer" placeholder="Secret Answer" required>
    </div>
  </div>
  <p style="font-size: 18px;padding-top: 6px;padding-left:25px; padding-botttom: 10px;">Personal Information (Optional)</p>
  
  <div class="control-group">
    <label class="control-label" for="inputEmail">Full Name</label>
    <div class="controls">
      <input type="text" name="fullname" for="inputEmail" placeholder="Full Name" />
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputEmail">Birth Date</label>
    <div class="controls">
     <select name="bfirst" class="input-medium">
      	<option value="January">January</option>
        <option value="February">February</option>
        <option value="March">March</option>
        <option value="April">April</option>
        <option value="May">May</option>
        <option value="June">June</option>
        <option value="July">July</option>
        <option value="August">August</option>
        <option value="September">September</option>
        <option value="October">October</option>
        <option value="November">November</option>
        <option value="December">December</option>
      </select>
      
      <select name="bsecond" class="input-small">
      	<option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
        <option value="24">24</option>
        <option value="25">25</option>
        <option value="26">26</option>
        <option value="27">27</option>
        <option value="28">28</option>
        <option value="29">29</option>
        <option value="30">30</option>
        <option value="31">31</option>
      </select>
      <input type="text" name="bthird" id="inputEmail" placeholder="Year" class="input-small">
      <br /><br />

        <input type="checkbox" name="TOS" required/>&nbsp; <div style="margin-left: 20px; margin-top: -17px;">Do You Accept The <a href="tos">Terms of Service?</a> <span style="font-size: 12px;">(Required)</span></div>
    </div>
  </div>
  
  <div style="padding-bottom:15px;">
  <?php
          require_once('recaptchalib.php');
          $publickey = "6LczWekSAAAAAOWCs8VNVPOVohIT9u26-A8abum0"; // you got this from the signup page
  ?>
  <!-- -->
<script type="text/javascript">
    var RecaptchaOptions = {
        theme : 'custom'
    };
</script>

<div id="recaptcha_container" style="padding-left:100px;">
  <div class="control-group" style="margin-left:-100px;">
    <label for="recaptcha_response_field" class="control-label" for="inputEmail">Captcha:</label>
    <div class="controls">
     <input type="text" id="recaptcha_response_field" name="recaptcha_response_field" class="text" placeholder="Enter The Two Words Below"  required/>
    </div>
  </div>

    <div id="recaptcha_image"></div>
    <input type="button" style="margin-top:13px;margin-left:80px;" class="btn btn-inverse" id="recaptcha_reload_btn" value="Get new words" onclick="Recaptcha.reload();" />
</div>
<script type="text/javascript" src="http://api.recaptcha.net/challenge?k=<?PHP echo $publickey; ?>">
</script>
						
<noscript>
    <iframe src="http://api.recaptcha.net/noscript?k=<?PHP echo $publickey; ?>"></iframe>
    <textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
    <input type="hidden" name="recaptcha_response_field" value="manual_challenge" />
</noscript>

  <!-- -->
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" style="margin-left: -80px;margin-top:-82px;" class="btn btn-inverse" style="margin-left: -80px;">Submit</button>
    </div>
  </div>

</form>
</div>




