</div></div>
<div style="margin-top: 20px;"></div>
<center>
<p style="color: #494949;">
| &nbsp;&nbsp;&nbsp;<a href="staff" style="color: #494949;">Staff</a>&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;<a href="tos" style="color: #494949;">Terms of Use</a>&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;<a href="privacy" style="color: #494949;">Privacy</a>&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;<a href="advertise" style="color: #494949;">Advertise</a>&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;<a href="support" style="color: #494949;">Frequently Asked Questions</a>&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;Apply&nbsp;&nbsp;&nbsp; |</p>
<br />

</center>

</body>
</html>
<!-- Bootstrap Javascript Includes-->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.pnotify.min.js"></script>
<script src="js/bootstrap-editable.min.js"></script>
<script src="js/jquery.form.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/wysihtml5-0.3.0.min.js"></script> 
<script src="js/bootstrap-wysihtml5-0.0.2.min.js"></script></script>
<script src="js/wysihtml5.js"></script> 
<script src="js/wysihtml5.js"></script> 
<script src="js/iframeheight.min.js"></script>

<script>
$('.editor').wysihtml5();
</script>

<script type="text/javascript">
	$(document).ready(function(){
    	$("[rel=tooltip]").tooltip();
    	$('iframe').iframeHeight();
		
		//$('#login_form').fadeIn(1000);
		//$('#xlogin').click(function(){$('#login_form').fadeOut(1000);});
		$('#btn_login').click(function(){$('#login_form').fadeIn(200);});	
		$('#xlogin').click(function(){$('#login_form').fadeOut(200);});	
		$('#btn_reg').click(function(){$('#reg_user').fadeIn(200);});	
		$('#xreg').click(function(){$('#reg_user').fadeOut(200);});	
		
		$('#frmLogin').submit(function(event){
			event.preventDefault();
			$.ajax({
						url:'logincheck.php',
						type:'post',
						data:$('#frmLogin').serialize(),
						
						beforeSend:function(snd)
						{
							
						},
						success:function(data)
						{
							$('#err_msg').text(data);
							$('#err_msg').fadeIn(1000);
							
						},
						complete:function()
						{
							
						},
						error: function(jqXHR, textStatus, errorThrown)
						{
            				$().toastmessage("showErrorToast","Unknown error");
          				}

				
				});
		});
		
		$('#frmRegister').submit(function(event){
			event.preventDefault();
			
			$.ajax({
						url:'register_user.php',
						type:'post',
						data:$('#frmRegister').serialize(),
						
						beforeSend:function(snd)
						{
							
						},
						success:function(data)
						{
							
							$('#err_msg_reg').text(data);
							$('#err_msg_reg').fadeIn(1000);
							setTimeout(function(){$('#err_msg_reg').text('Redirecting....');},2000);
							setTimeout(function(){window.location = "home";},4000);
							
							
							
							
							
						},
						complete:function()
						{
							
						},
						error: function(jqXHR, textStatus, errorThrown)
						{
            				$().toastmessage("showErrorToast","Unknown error");
          				}

				
				});
		});
	});
</script>

<script type="text/javascript">
$("#regForm").validate();
</script>

<script type="text/javascript">
	$(".bf3").on("mouseover", function () {
   		 $(".bf3pan").css("display", "block");
		 $(".csgopan").css("display", "none");
		 $(".csspan").css("display", "none");
		 $(".cod4pan").css("display", "none");
	});
	
	$(".cod4").on("mouseover", function () {
   		 $(".bf3pan").css("display", "none");
		 $(".csgopan").css("display", "none");
		 $(".csspan").css("display", "none");
		 $(".cod4pan").css("display", "block");
	});
	
	$(".csgo").on("mouseover", function () {
   		 $(".bf3pan").css("display", "none");
		 $(".csgopan").css("display", "block");
		 $(".csspan").css("display", "none");
		 $(".cod4pan").css("display", "none");
	});
	
	$(".css").on("mouseover", function () {
   		 $(".bf3pan").css("display", "none");
		 $(".csgopan").css("display", "none");
		 $(".csspan").css("display", "block");
		 $(".cod4pan").css("display", "none");
	});
</script>

<script>
	$('.tbuttonone').click(function(){
      $('.tbuttonone').removeClass('tabbutton').addClass('tabbuttonactive');
	  $('.tbuttontwo').removeClass('tabbuttonactive').addClass('tabbutton');
	  $('.pbuttonone').removeClass('inactivetabp').addClass('activetabp');
	  $('.pbuttontwo').removeClass('activetabp').addClass('inactivetabp');
	 });
	 
	 $('.tbuttontwo').click(function(){
      $('.tbuttonone').removeClass('tabbuttonactive').addClass('tabbutton');
	  $('.tbuttontwo').removeClass('tabbutton').addClass('tabbuttonactive');
	  $('.pbuttonone').removeClass('activetabp').addClass('inactivetabp');
	  $('.pbuttontwo').removeClass('inactivetabp').addClass('activetabp');
	 });

</script>

<?PHP if($_GET["s"] == "success"){ ?>
	<script>
	$.pnotify({
    title: '<?PHP echo $_GET["title"]; ?>',
    text: '<?PHP echo $_GET["r"]; ?>',
    type: 'success',
	history: false
	});
	</script>
<?php } ?>

<?PHP if($_GET["s"] == "failed"){ ?>
	<script>
	$.pnotify({
    title: '<?PHP echo $_GET["title"]; ?>',
    text: '<?PHP echo $_GET["r"]; ?>',
    type: 'error',
	history: false
	});
	</script>
<?php } ?>



