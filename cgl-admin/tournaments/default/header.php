<?php
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>CGL Tournaments</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
    <!-- bootstrap -->
    <link href="css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="css/bootstrap/bootstrap-overrides.css" type="text/css" rel="stylesheet" />

    <!-- libraries -->
    <link href="css/lib/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css" />
    <link href="css/lib/font-awesome.css" type="text/css" rel="stylesheet" />
    <link href="css/lib/bootstrap.datepicker.css" type="text/css" rel="stylesheet" />
    

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="css/compiled/layout.css">
    <link rel="stylesheet" type="text/css" href="css/compiled/elements.css">
    <link rel="stylesheet" type="text/css" href="css/compiled/icons.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-editable.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.pnotify.default.css">
    <link href="inputs-ext/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.css" rel="stylesheet"> 
    <link href="css/lib/select2.css" type="text/css" rel="stylesheet" />

    <!-- this page specific styles -->
    <link rel="stylesheet" href="css/compiled/index.css" type="text/css" media="screen" />

    <!-- open sans font -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- lato font -->
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    	<!-- scripts -->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-ui-1.10.2.custom.min.js"></script>
    <script src="js/bootstrap-editable.min.js"></script> 
    <script src="js/bootstrap.datepicker.js"></script> 
      <script src="js/select2.min.js"></script>
    <script src="inputs-ext/wysihtml5/bootstrap-wysihtml5-0.0.2/wysihtml5-0.3.0.min.js"></script>  
    <script src="inputs-ext/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.js"></script>
    <script src="inputs-ext/wysihtml5/wysihtml5.js"></script>
    <script src="js/jquery.pnotify.min.js"></script>
    <!-- knob -->
    <script src="js/jquery.knob.js"></script>
    <script src="js/bootstrap.validation.js"></script>
    <!-- flot charts -->
    <!--<script src="js/jquery.flot.js"></script>
    <script src="js/jquery.flot.stack.js"></script>
    <script src="js/jquery.flot.resize.js"></script>-->
    <script src="js/theme.js"></script>
	
	<script>
	   $(document).ready(function() {
        	
			
			$('.input-datepicker').datepicker().on('changeDate', function (ev) {
                $(this).datepicker('hide');
            });
			
	
			
			
    });
	</script>
</head>

<body>
    <!-- navbar -->
    <header class="navbar navbar-inverse" role="banner">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" id="menu-toggler">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html"><img src="img/logo.png"></a>
        </div>
        <ul class="nav navbar-nav pull-right hidden-xs">
            
            <li class="dropdown">
                <a href="#" class="dropdown-toggle hidden-xs hidden-sm" data-toggle="dropdown">
<?php echo ucfirst($_SESSION["user"]["username"]); ?>'s Account
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="personal-info.html">Personal info</a></li>
                    <li><a href="#">Account settings</a></li>
                    <li><a href="#">Billing</a></li>
                    <li><a href="#">Export your data</a></li>
                    <li><a href="#">Send feedback</a></li>
                </ul>
            </li>
            <li class="settings hidden-xs hidden-sm">
                <a href="personal-info.html" role="button">
                    <i class="icon-cog"></i>
                </a>
            </li>
            <li class="settings hidden-xs hidden-sm">
                <a href="logout.php" role="button">
                    <i class="icon-share-alt"></i>
                </a>
            </li>
        </ul>
    </header>
    <!-- end navbar -->

    <!-- sidebar -->
  <div id="sidebar-nav">
        <ul id="dashboard-menu">
            <li class="active">
        
                <a href="home">
                    <i class="icon-home"></i>
                    <span>Home</span>
                </a>
            </li>            
           
            
           
           
			
			
			
			
			   
			
			 <li>
                <a class="dropdown-toggle" >
                    <i class="icon-magic"></i>
                    <span>Games</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu">
				   <li><a href="games">All Games</a></li>
                    <li><a href="newgames">Add new Game</a></li>
					
                </ul>
            </li>
			
			   <li>
                <a class="dropdown-toggle" >
                    <i class="icon-magic"></i>
                    <span>Tournaments</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu">
				   <li><a href="tournaments">All Tournaments</a></li>
                    <li><a href="newtournament">Create Tournament</a></li>
					
                </ul>
            </li>
			
			<li>
                <a class="dropdown-toggle">
                    <i class="icon-magic"></i>
                    <span>Teams</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu">
				   <li><a href="teams">All Teams</a></li>
                    <li><a href="createteam">Create Team</a></li>
                 
                   
                </ul>
            </li>
			
			
			
			
			
			
			
			
        </ul>
    </div>
    <!-- end sidebar -->
    