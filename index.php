<?php
///Boilerplate v1.0.3

session_start();
ini_set('error_reporting', E_ALL);

include("includes/config.php");
include("includes/classes.php");



$userClass=new User($DBH);
$groupClass=new Group($DBH);
$billingClass=new Billing($DBH);
$genClass=new General($DBH);
$register=$genClass->getSetting('allow_register');
$permission_msg=$genClass->getSetting('restricted_message');
require_once( "includes/hybridauth/Hybrid/Auth.php" );

include("pages/head.php");

if (isset($_SESSION['user_id']))
$billingClass->checkSubscription($_SESSION['user_id']);

 if(isset($_SESSION['message'])) { ?>
<div class="alert <?php echo $_SESSION['msg_type'] ?> alert-dismissable">

  <?php 
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
			unset($_SESSION['msg_type']);
		?>
</div>
<?php } 





$pg_name="login";
if(isset($_GET['page']) && $_GET['page']!='')
{
	$pg_name=$_GET['page'];
}
else {
		
		if (!isset($_SESSION['user_id']))
		$pg_name="login";
		else
		$pg_name="home";
	 }
	 $_SESSION['pg_name']=$pg_name;


if ($userClass->userIsInGroup(1)){
	include("pages/left.php");
}
	 

//check if user's group has permission
if (!isset($_SESSION['user_id']))
$user_id=null;
else
$user_id=$_SESSION['user_id'];

	if(file_exists('pages/'.$pg_name.'.php') &&  ($userClass->checkPermission($user_id,$pg_name)==true)){
			if ($pg_name=="register" && $register==false){
				echo $permission_msg;
			}else
			include('pages/'.$pg_name.'.php');
		} else { 
		    echo $permission_msg;
		}


include("pages/footer.php");

?>