<?php

session_start();
include("includes/config.php");
include("includes/classes.php");

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type');

$userClass=new User($DBH);

$groupClass=new Group($DBH);

$billingClass=new Billing($DBH);

$generalClass=new General($DBH);

	
/////////////////////// POST APIS //////////////////////

//USER AUTHENTICATION
if(isset($_REQUEST['email']) && $_REQUEST['email']!="" && (isset($_REQUEST['password'])) && $_REQUEST['password']!="")
{	
	$user=$userClass->login($_REQUEST['email'], $_REQUEST['password']);
	if (isset($user) && $user!=false){
	echo json_encode(array("success" => true, "data" => $user, "message" => ""));
	exit;
	} 
	else 
	{
	echo json_encode(array("success" => false, "data" => null, "message" => "Error Your username or password is invalid."));
	exit;
	}

}

//LOGIN AUTHENTICATION



	
	//TOKEN AUTHENTICATION
	if(isset($_POST['token']) || isset($_REQUEST['token']) )
	{
		if(isset($_POST['token']))
		$token = $_POST['token'];
		else if (isset($_REQUEST['token']))
		$token = $_REQUEST['token'];
		
		$user_id = $userClass->checkToken($token);			
		
		
	//get user info
	if (isset($_REQUEST['action'])&&$_REQUEST['action']=='getUser'){
		$user = $userClass->getUser($_REQUEST['user_id']);
		if (isset($user) && $user!=false){
			echo json_encode(array("success" => true, "data" => $user, "message" => ""));
			exit;
			} 
			else 
			{
			echo json_encode(array("success" => false, "data" => null, "message" => "Error "));
			exit;
			}

			
		}
		
		
	if (isset($_REQUEST['action'])&&$_REQUEST['action']=='listUsers'){
			//make sure an admin is accesing.
			if ($userClass->userIsInGroup(1, $user_id)==true){
			$user = $userClass->listUsers();
			}
			else
			$user=false;
			
		if (isset($user) && $user!=false){
			echo json_encode(array("success" => true, "data" => $user, "message" => ""));
			exit;
			} 
			else 
			{
			echo json_encode(array("success" => false, "data" => null, "message" => "Error"));
			exit;
			}

			
			
		}
		
		if (isset($_REQUEST['action'])&&$_REQUEST['action']=='deleteGroup'){
			//make sure an admin is accesing.
			if ($userClass->userIsInGroup(1, $user_id)==true){
			$user = $groupClass->deleteGroup($_REQUEST['group_id']);
			}
			else
			$user=false;
			
		if (isset($user) && $user!=false){
			echo json_encode(array("success" => true, "data" => $user, "message" => ""));
			exit;
			} 
			else 
			{
			echo json_encode(array("success" => false, "data" => null, "message" => "Error"));
			exit;
			}

			
			
		}	
		
	if (isset($_REQUEST['action'])&&$_REQUEST['action']=='deleteUser'){
			//make sure an admin is accesing.
			if ($userClass->userIsInGroup(1, $user_id)==true){
			$user = $userClass->deleteUser($_REQUEST['user_id']);
			}
			else
			$user=false;
			
		if (isset($user) && $user!=false){
			echo json_encode(array("success" => true, "data" => $user, "message" => ""));
			exit;
			} 
			else 
			{
			echo json_encode(array("success" => false, "data" => null, "message" => "Error"));
			exit;
			}

			
			
		}
	 

		
	if (isset($_REQUEST['action'])&&$_REQUEST['action']=='getGroupUsers'){
			//make sure an admin is accesing.
			if ($userClass->userIsInGroup(1, $user_id)==true){
			$user = $groupClass->getGroupUsers($_REQUEST['group_id']);
			
			}
			else
			$user=false;
			
		if (isset($user) && $user!=false){
			echo json_encode(array("success" => true, "data" => $user, "message" => ""));
			exit;
			} 
			else 
			{
			echo json_encode(array("success" => false, "data" => null, "message" => "Error"));
			exit;
			}

			
			
		}
		
	if (isset($_REQUEST['action'])&&$_REQUEST['action']=='saveUser'){
					//make sure an admin is editing or the actual user.
					if (($userClass->userIsInGroup(1, $user_id)==true) || ($_POST['user_id']==$user_id)){
					$user = $userClass->saveUser($_POST);
					}
					
					
					if (isset($user) && $user!=false){
					echo json_encode(array("success" => true, "data" => $user, "message" => ""));
					exit;
					} 
					else 
					{
					echo json_encode(array("success" => false, "data" => $user, "message" => "Error"));
					exit;
					}

			
		}
			if (isset($_REQUEST['action'])&&$_REQUEST['action']=='getGroups'){
			//make sure an admin is accesing.
			if ($userClass->userIsInGroup(1, $user_id)==true){
			$user = $groupClass->getGroups();
			}
			else
			$user=false;
			
		if (isset($user) && $user!=false){
			echo json_encode(array("success" => true, "data" => $user, "message" => ""));
			exit;
			} 
			else 
			{
			echo json_encode(array("success" => false, "data" => null, "message" => "Error"));
			exit;
			}

			
			
		}
	if (isset($_REQUEST['action'])&&$_REQUEST['action']=='saveGroup'){
					//make sure an admin is editing or the actual user.
					if (($userClass->userIsInGroup(1, $user_id)==true)){
					$user= $groupClass->saveGroup($_POST);
					}
					else
					$user=false;
					
					if (isset($user) && $user!=false){
					echo json_encode(array("success" => true, "data" => $user, "message" => ""));
					exit;
					} 
					else 
					{
					echo json_encode(array("success" => false, "data" => null, "message" => "Error"));
					exit;
					}

			
		}
	if (isset($_REQUEST['action'])&&$_REQUEST['action']=='getGroup'){
			//make sure an admin is accesing.
			if ($userClass->userIsInGroup(1, $user_id)==true){
			$user = $groupClass->getGroup($_REQUEST['group_id']);
			}
			else
			$user=false;
			
		if (isset($user) && $user!=false){
			echo json_encode(array("success" => true, "data" => $user, "message" => ""));
			exit;
			} 
			else 
			{
			echo json_encode(array("success" => false, "data" => null, "message" => "Error"));
			exit;
			}

			
			
		}
	if (isset($_REQUEST['action'])&&$_REQUEST['action']=='deleteGroup'){
			//make sure an admin is accesing.
			if ($userClass->userIsInGroup(1, $user_id)==true){
			$user = $groupClass->deleteGroup($_REQUEST['group_id']);
			}
			else
			$user=false;
			
		if (isset($user) && $user!=false){
			echo json_encode(array("success" => true, "data" => $user, "message" => ""));
			exit;
			} 
			else 
			{
			echo json_encode(array("success" => false, "data" => null, "message" => "Error"));
			exit;
			}

			
			
		}	

	if (isset($_REQUEST['action'])&&$_REQUEST['action']=='listPlans'){
			
			
				
			$user = $billingClass->listPlans();
			
			
		if ($user!=false){
			echo json_encode(array("success" => true, "data" => $user, "message" => ""));
			exit;
			} 
			else 
			{
			echo json_encode(array("success" => false, "data" => null, "message" => "Error"));
			exit;
			}

			
			
		}
	if (isset($_REQUEST['action'])&&$_REQUEST['action']=='savePlan'){
					//make sure an admin is editing or the actual user.
					if (($userClass->userIsInGroup(1, $user_id)==true)){
					$user= $billingClass->savePlan($_POST);
					}
					else
					$user=false;
					
					if (isset($user) && $user!=false){
					echo json_encode(array("success" => true, "data" => $user, "message" => ""));
					exit;
					} 
					else 
					{
					echo json_encode(array("success" => false, "data" => null, "message" => "Error"));
					exit;
					}

			
		}
	if (isset($_REQUEST['action'])&&$_REQUEST['action']=='getPlan'){
			//make sure an admin is accesing.
			if ($userClass->userIsInGroup(1, $user_id)==true){
			$user = $billingClass->listPlans($_REQUEST['plan_id']);
			}
			else
			$user=false;
			
		if (isset($user) && $user!=false){
			echo json_encode(array("success" => true, "data" => $user, "message" => ""));
			exit;
			} 
			else 
			{
			echo json_encode(array("success" => false, "data" => null, "message" => "Error"));
			exit;
			}

			
			
		}
		
	if (isset($_REQUEST['action'])&&$_REQUEST['action']=='deletePlan'){
			//make sure an admin is accesing.
			if ($userClass->userIsInGroup(1, $user_id)==true){
			$user = $billingClass->deletePlan($_REQUEST['plan_id']);
			}
			else
			$user=false;
			
		if (isset($user) && $user!=false){
			echo json_encode(array("success" => true, "data" => $user, "message" => ""));
			exit;
			} 
			else 
			{
			echo json_encode(array("success" => false, "data" => null, "message" => "Error"));
			exit;
			}

			
			
		}	
	if (isset($_REQUEST['action'])&&$_REQUEST['action']=='saveSocialSettings'){
		//make sure an admin is editing or the actual user.
		if (($userClass->userIsInGroup(1, $user_id)==true)){
		$user= $generalClass->saveSocialSettings($_POST);
		}
		else
		$user=false;
		
		if (isset($user) && $user!=false){
		echo json_encode(array("success" => true, "data" => $user, "message" => ""));
		exit;
		} 
		else 
		{
		echo json_encode(array("success" => false, "data" => null, "message" => "Error"));
		exit;
		}

			
		}
	if (isset($_REQUEST['action'])&&$_REQUEST['action']=='saveSettings'){
					//make sure an admin is editing or the actual user.
					if (($userClass->userIsInGroup(1, $user_id)==true)){
					$user= $generalClass->saveSettings($_POST);
					}
					else
					$user=false;
					
					if (isset($user) && $user!=false){
					echo json_encode(array("success" => true, "data" => $user, "message" => ""));
					exit;
					} 
					else 
					{
					echo json_encode(array("success" => false, "data" => null, "message" => "Error"));
					exit;
					}

			
		}
	if (isset($_REQUEST['action'])&&$_REQUEST['action']=='getSettings'){
		//make sure an admin is accesing.
		if ($userClass->userIsInGroup(1, $user_id)==true){
		$user = $generalClass->getSettings();
		}
		else
		$user=false;
		
	if (isset($user) && $user!=false){
		echo json_encode(array("success" => true, "data" => $user, "message" => ""));
		exit;
		} 
		else 
		{
		echo json_encode(array("success" => false, "data" => null, "message" => "Error"));
		exit;
		}

		
		
	}
	if (isset($_REQUEST['action'])&&$_REQUEST['action']=='savePermissions'){
		//make sure an admin is editing or the actual user.
		if (($userClass->userIsInGroup(1, $user_id)==true)){
		$user= $generalClass->savePermissions($_POST);
		}
		else
		$user=false;
		
		if (isset($user) && $user!=false){
		echo json_encode(array("success" => true, "data" => $user, "message" => ""));
		exit;
		} 
		else 
		{
		echo json_encode(array("success" => false, "data" => null, "message" => "Error"));
		exit;
		}

			
		}
	if (isset($_REQUEST['action'])&&$_REQUEST['action']=='getPermissions'){
		//make sure an admin is accesing.
		if ($userClass->userIsInGroup(1, $user_id)==true){
		$user = $generalClass->getPermissions($_REQUEST['page']);
		}
		else
		$user=false;
		
		if (isset($user) && $user!=false){
		echo json_encode(array("success" => true, "data" => $user, "message" => ""));
		exit;
		} 
		else 
		{
		echo json_encode(array("success" => false, "data" => null, "message" => "Error"));
		exit;
		}

		
		
	}
		
 
	} 
	else if (isset($_REQUEST['action'])&&$_REQUEST['action']=='registerUser'){
					
				
					$user = $userClass->saveUser($_POST);
				
					
					if (isset($user) && $user!=false){
					echo json_encode(array("success" => true, "data" => $user, "message" => ""));
					exit;
					} 
					else 
					{
					echo json_encode(array("success" => false, "data" => $user, "message" => "Your email seems to be in use already. "));
					exit;
					}

			
	}
	else if (isset($_REQUEST['action'])){
	
	include ("methods_custom.php");	
	
	}
	else 
	{

		echo json_encode(array("success" => false, "data" => null, "message" => "Token verification fail..."));
		exit;
	}
?>