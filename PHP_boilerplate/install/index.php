<?php

function issetor(&$var, $default = false) 
{
return isset($var) ? $var : $default;
}

function step_1(){ 
 /*if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['agree'])){
  header('Location: /install/index.php?step=2');
  exit;
 }*/
 
 if($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['agree']) ) {
  echo "You must agree to the license.";
 }
 
 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['agree']) && isset($_POST['license']) ) {

$url = 'http://www.masomagroup.com/license_verify.php/';
 

$ch = curl_init($url);
 
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
$result = curl_exec($ch);
curl_close($ch);
//echo $result;
 	if ($result=='true')
 	{
	  header('Location: /install/index.php?step=2');	
 	}
 	else 
 	echo $result;
 	
 }
?>
 <p> I agree not to duplicate or resell this software in part or whole. I agree that I have purchased a license to use this script.</p>
 
 <form action="/install/index.php?step=1" method="post" id="install_form" class="form-horizontal">
	
	  <div class="form-group">
		  
			    <label class="col-sm-4 control-label" for="agree">I Agree</label>
			    <div class="col-sm-6">
			     <input type="checkbox" name="agree" id="agree" />
			    </div>
			  </div>

			  <div class="form-group">
			    <label class="col-sm-4 control-label" for="license">Please enter your Envato license for this script.</label>
			    <div class="col-sm-6">
			    <input type="text" name="license" id="license" >
			    </div>
			  </div>
			  
			  	  <div class="form-group">
			    
			    <div class="col-sm-6">
			    <button class="btn btn-label label-success" type="submit" name="s1com" >Continue</button>

			    </div>
			  </div>
  
   </form>
<?php 
}
function step_2(){
	$pre_error="";
  if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['pre_error'] ==''){
   header('Location: /install/index.php?step=3');
   exit;
  }
  if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['pre_error'] != '')
   echo $_POST['pre_error'];
      
  if (phpversion() < '5.0') {
   $pre_error = 'You need to use PHP5 or above for our site!<br />';
  }
  if (ini_get('session.auto_start')) {
   $pre_error .= 'Our site will not work with session.auto_start enabled!<br />';
  }
  if (!extension_loaded('mysql')) {
   $pre_error .= 'MySQL extension needs to be loaded for our site to work!<br />';
  }
  if (!extension_loaded('gd')) {
   $pre_error .= 'GD extension needs to be loaded for our site to work!<br />';
  }
  if (!is_writable('../includes/config.php')) {
   $pre_error .= 'config.php needs to be writable for our site to be installed!';
  }
  ?>
  <table width="100%">
	  <tr>
		  <td></td>
		  <td>Current</td>
		  <td>Required</td>
		  <td></td>
	  </tr>
  <tr>
   <td>PHP Version:</td>
   <td><?php echo phpversion(); ?></td>
   <td>5.0+</td>
   <td><?php echo (phpversion() >= '5.0') ? '<span class="label label-success">Ok</span>' : '<span class="label label-danger">Not Ok</span>'; ?></td>
  </tr>
  <tr>
   <td>Session Auto Start:</td>
   <td><?php echo (ini_get('session_auto_start')) ? 'On' : 'Off'; ?></td>
   <td>Off</td>
   <td><?php echo (!ini_get('session_auto_start')) ? '<span class="label label-success">Ok</span>' : '<span class="label label-danger">Not Ok</span>'; ?></td>
  </tr>
  <tr>
   <td>MySQL:</td>
   <td><?php echo extension_loaded('mysql') ? 'On' : 'Off'; ?></td>
   <td>On</td>
   <td><?php echo extension_loaded('mysql') ? '<span class="label label-success">Ok</span>' : '<span class="label label-danger">Not Ok</span>'; ?></td>
  </tr>
  <tr>
   <td>GD:</td>
   <td><?php echo extension_loaded('gd') ? 'On' : 'Off'; ?></td>
   <td>On</td>
   <td><?php echo extension_loaded('gd') ? '<span class="label label-success">Ok</span>' : '<span class="label label-danger">Not Ok</span>'; ?></td>
  </tr>
  <tr>
   <td>config.php</td>
   <td><?php echo is_writable('../includes/config.php') ? 'Writable' : 'Unwritable'; ?></td>
   <td>Writable</td>
   <td><?php echo is_writable('../includes/config.php') ? '<span class="label label-success">Ok</span>' : '<span class="label label-danger">Not Ok</span>'; ?></td>
  </tr>
  </table>
  <div class="clear"></div>
  <form action="/install/index.php?step=2" method="post">
   <input type="hidden" name="pre_error" id="pre_error" value="<?php echo $pre_error;?>" />
   <? if ($pre_error==""){?>
	   <button type="submit" class="btn btn-success" name="continue" style="margin-left: auto; margin-right: auto;">Continue</button>
	   <? } else {?>
	   <button type="submit" class="btn btn-info" name="continue">Check Again</button>
	   <? } ?>
  </form>
<?php
}
function step_3(){
  if (isset($_POST['step3']) && $_POST['step3']=="ok") {
   $base_url=isset($_POST['base_url'])?$_POST['base_url']:"";
   $database_host=isset($_POST['database_host'])?$_POST['database_host']:"";
   $database_name=isset($_POST['database_name'])?$_POST['database_name']:"";
   $database_username=isset($_POST['database_username'])?$_POST['database_username']:"";
   $database_password=isset($_POST['database_password'])?$_POST['database_password']:"";
   $admin_email=isset($_POST['admin_email'])?$_POST['admin_email']:"";
   $admin_password=isset($_POST['admin_password'])?$_POST['admin_password']:"";
  
  if (empty($admin_email) || empty($admin_password) || empty($database_host) || empty($database_username) || empty($database_name)) {
   echo "All fields are required! Please re-enter.<br />";
  } else {
   $connection = mysql_connect($database_host, $database_username, $database_password);
   mysql_select_db($database_name, $connection);
  
   $file ='boilerplate.sql';
   if ($sql = file($file)) {
   $query = '';
   foreach($sql as $line) {
    $tsl = trim($line);
   if (($sql != '') && (substr($tsl, 0, 2) != "--") && (substr($tsl, 0, 1) != '#')) {
   $query .= $line;
  
   if (preg_match('/;\s*$/', $line)) {
  
    mysql_query($query, $connection) or die(mysql_error());
    $err = mysql_error();
    if (!empty($err))
      break;
   $query = '';
   }
   }
   }
   $key = '$2a$07$umgumgumgumgumgumgumgumgu$';
   $pass =  crypt($admin_password, $key);
   mysql_query("INSERT INTO `users` SET `id`='1', `email`='".$admin_email."', `password` = '" . $pass . "', `status`='1' ") or die (mysql_error());
   mysql_query("INSERT INTO `site_settings` (`id`, `domain`, `admin_email`, `default_permission`, `public_profiles`, `allow_register`, `login_message`, `restricted_message`, `terms_conditions`, `stripe_secret_key`, `stripe_public_key`, `mandrill_key`, `default_plan`) VALUES (1, '".$base_url."', '".$admin_email."', 2, 1, 1, 'Please Log In', 'You do not have permission to access this content', 'I am at least 15 years old.', '', '', '', '')");

   mysql_close($connection);
   }
   $f=fopen("../includes/config.php","w");
   $database_inf="<?php 
ob_start();


#######################
#
# Data Base Connection
#
#######################

define('SURL', '".$base_url."/');

try {
  
  # MySQL with PDO_MYSQL
  \$DBH = new PDO('mysql:host=".$database_host.";dbname=".$database_name."', '".$database_username."', '".$database_password."');
 
  }
catch(PDOException \$e) {
    echo \$e->getMessage();
}

?>";
  if (fwrite($f,$database_inf)>0){
   fclose($f);
  }
  header("Location: /install/index.php?step=4");
  }
  }
?>
  <form method="post" action="/install/index.php?step=3" id="install_form" class="form-horizontal">
	  <fieldset>
	  		 <div class="form-group">
			    <label class="col-sm-4 control-label" for="base_url">Base URL</label>
			    <div class="col-sm-6">
			    <input type="text" name="base_url" id="base_url" >
			    <p class="help_line">Base URL (with http:// or https://)</p>
			    </div>
			  </div>
			   <div class="form-group">
			    <label class="col-sm-4 control-label" for="database_host">Database Host</label>
			    <div class="col-sm-6">
			       <input type="text" name="database_host" id="database_host" value='localhost' size="30">
			  
			    </div>
			  </div>
			    <div class="form-group">
			    <label class="col-sm-4 control-label" for="database_name">Database Name</label>
			    <div class="col-sm-6">
			       <input type="text" name="database_name" id="database_name" value='<?php echo issetor($database_name); ?>' size="30">
			  
			    </div>
			  </div>
			    <div class="form-group">
			    <label class="col-sm-4 control-label" for="database_username">Database Username</label>
			    <div class="col-sm-6">
			        <input type="text" name="database_username" id="database_username" size="30" value="<?php echo issetor($database_username); ?>">
			  
			    </div>
			  </div>
			    <div class="form-group">
			    <label class="col-sm-4 control-label" for="database_password">Database Password</label>
			    <div class="col-sm-6">
			        <input type="text" name="database_password" id="database_password" size="30" value="<?php echo issetor($database_password); ?>">
			  
			    </div>
			  </div>
			  
			  </fieldset>
			  <fieldset>
			<div class="form-group">
			    <label class="col-sm-4 control-label" for="admin_email">Admin Email</label>
			    <div class="col-sm-6">
			       <input type="text" name="admin_email" size="30" value="<?php echo issetor($username); ?>">
			  
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="col-sm-4 control-label" for="admin_email">Admin Password</label>
			    <div class="col-sm-6">
			          <input name="admin_password" type="text" size="30" maxlength="15" value="<?php echo issetor($password); ?>">
			  
			    </div>
			  </div>
			  	  <div class="form-group">
			    
			    <div class="col-sm-6">
				    <input type="hidden" value="ok" name="step3">
			    <button class="btn btn-label label-success" type="submit" name="s3com">Install!</button>

			    </div>
			  </div>
  
			  </fieldset>



  </form>
<?php
}

function step_4(){
?>
 For security, you need to delete this install (/install) directory. The installer can attempt to delete it, but you might want to handle it yourself. 
 <p><a href="/install/index.php?step=delete" class="btn btn-danger">DELETE INSTALL DIRECTORY?</a></p>
<?php 
}

function step_delete($path)
{
    if (is_dir($path) === true)
    {
        $files = array_diff(scandir($path), array('.', '..'));

        foreach ($files as $file)
        {
            step_delete(realpath($path) . '/' . $file);
        }

        echo rmdir($path);
    }

    else if (is_file($path) === true)
    {
        echo unlink($path);
    }

    echo "Check permissions are 777 or delete manually. ";
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../favicon.ico">

    <title>Boilerplate Install</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">

    <link href="../css/bootstrap-theme.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">
    
    <link href="../css/jquery.dataTables.css" rel="stylesheet">
    <link href="../css/select2.css" rel="stylesheet">
	<link href="../css/jquery.gritter.css" rel="stylesheet">
	<link rel="stylesheet" href="../css/bootstrap-formhelpers-min.css" media="screen">
   
   
       <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
      <script src="../js/jquery.js"></script>
  </head>
    <body> 
    <div class="container-fluid">
	    
      <div class="container">
<?php
$step = (isset($_GET['step']) && $_GET['step'] != '') ? $_GET['step'] : '';
switch($step){
  case '1':
  step_1();
  break;
  case '2':
  step_2();
  break;
  case '3':
  step_3();
  break;
  case '4':
  step_4();
  break;
  case 'delete':
  step_delete("/install");
  break;
  default:
  step_1();
}
?>
      </div>
    </div>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/jquery.dataTables.js"></script>
    <script src="../js/select2.js"></script>
    <script src="../js/jquery.gritter.js"></script>
    <script src="../js/bootstrapValidator-min.js"></script>
    <script src="../js/bootstrap-formhelpers-min.js"></script>
    <script type="text/javascript">		
	$( document ).ready(function() {
$('#install_form').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
       
        fields: {
           
             agree: {
                    validators: {
                        choice: {
                            min: 1,
                            max: 1,
                            message: 'You must agree to the terms'
                        }
                    }
                },
              license: {
                validators: {
                    notEmpty: {
                        message: 'Your license is required and can\'t be empty'
                    },
					stringLength: {
                        min: 10,
                        max: 65,
                        message: 'License must be more than 3 and less than 65 characters long'
                    }
                }
            },
                 database_host: {
                validators: {
                    notEmpty: {
                        message: 'Host is required and can\'t be empty'
                    }
                }
            },
             database_username: {
                validators: {
                    notEmpty: {
                        message: 'User is required and can\'t be empty'
                    }
                }
            },
              database_name: {
                validators: {
                    notEmpty: {
                        message: 'Name is required and can\'t be empty'
                    }
                }
            },
            
                    admin_email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required and can\'t be empty'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    },
					stringLength: {
                        min: 6,
                        max: 65,
                        message: 'The email must be more than 6 and less than 65 characters long'
                    }
                }
            },
             admin_password: {
                    enabled: true,
                    validators: {
                        notEmpty: {
                            message: 'The password is required and cannot be empty'
                        }
                    }
                },
                database_password: {
                    enabled: true,
                    validators: {
                        notEmpty: {
                            message: 'The password is required and cannot be empty'
                        }
                    }
                },
                
			    }

});
});
</script>
<body>
	
	