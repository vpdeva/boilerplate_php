<?php



if(isset($_SESSION['user_id'])){
	
	
	
	unset($_SESSION['user_id']);
	unset($_SESSION['user_username']);
	unset($_SESSION['user_email']);


}
//session_destroy();
?>
<script>window.location = '<?=SURL;?>login';</script>