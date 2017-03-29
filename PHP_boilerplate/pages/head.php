<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../favicon.ico">

    <title>Boilerplate</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=SURL;?>css/bootstrap.css" rel="stylesheet">
    <link href="<?=SURL;?>css/bootstrap-theme.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?=SURL;?>css/dashboard.css" rel="stylesheet">
    
    <link href="<?=SURL;?>css/jquery.dataTables.css" rel="stylesheet">
    <link href="<?=SURL;?>css/select2.css" rel="stylesheet">
	<link href="<?=SURL;?>css/jquery.gritter.css" rel="stylesheet">
	<link rel="stylesheet" href="<?=SURL;?>css/bootstrap-formhelpers-min.css" media="screen">
   
   
       <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
      <script src="<?=SURL;?>js/jquery.js"></script>
  </head>
    <body> 

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
         
          <a class="navbar-brand" href="/">BOILER PLATE</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <?php if (isset($_SESSION['user_id'])){?>
            <li><a href="/home">Home</a></li>
            <li><a href="/protected">Protected Page</a></li>
            <li><a href="/edit-profile/<?=$_SESSION['user_id'];?>">My Profile</a></li>
            <li><a href="/billing">Billing</a></li>
             <li><a href="/logout">Logout</a></li>
                         <?} else {?>
                         <li><a href="/protected">Protected Page</a></li>
						 <li><a href="/register">Register</a></li>
                         <li><a href="/login">Login</a></li>
                         <?php } ?>
          </ul>
         
        </div>
      </div>
    </nav>
    <div class="container-fluid">
	    
      <div class="container">
	
         
