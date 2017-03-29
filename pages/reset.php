<?php
	$userClass=new User($DBH);

if (!empty($_POST['email']) )
{
		$emailClass=new Mailer($DBH);
	$user_id= $userClass->getUserId($_POST['email']);
	$user = $userClass->getUser($user_id);
	if ($user_id>0){
		$code= $userClass->resetCode($user_id);
		$emailClass->resetPassword($user['firstname'], $_POST['email'], $code);
		echo "Please check your email. A link has been emailed to you.";
	}
	
	
}

if (!empty($_POST['pword']) && !empty($_POST['pword2']) && $_POST['pword2']==$_POST['pword']  && !empty($_POST['act_code']) )
{
	$dataArray=array();
	$dataArray['pword']=$_POST['pword'];
	$dataArray['act_code']=$_POST['act_code'];
	$userClass->resetPassword($dataArray);
}




if (!empty($_GET['pram1']) && ($userClass->checkCode($_GET['pram1'])>0))
{?>

<form id="resetForm" method="POST" action="" novalidate="" class=" col-md-offset-4 col-md-4">
	                            <h2> Reset Password</h2>
	                         
                              <div class="form-group">
							  	<input type="hidden" name="act_code" value="<?=$_GET['pram1'];?>">
                                  <input type="password" class="form-control" id="pword" name="pword" value="" required="" placeholder="Password">
                                  <input type="password" class="form-control" id="pword2" name="pword2" value="" required="" placeholder="Password Again">
                              </div>
                                                           <button type="submit" id="changePassword" name="changePassword" class="btn btn-success btn-block">Reset</button>
							  
                          </form>



<?
}else{
?>

<form id="emailForm" method="POST" action="/reset/" novalidate="" class=" col-md-offset-4 col-md-4">
	                            <h2> Reset Password</h2>
	                            <?php
									// if we got an error then we display it here
									if( issetor($error) ){
										echo '<p><h3 style="color:red">Error!</h3>' . $error . '</p>';
										echo "<pre>Session:<br />" . print_r( $_SESSION, true ) . "</pre><hr />";
									}
								?>
                              <div class="form-group">
                           Enter your email to reset your password
                                  <input type="text" class="form-control" id="email" name="email" value="" required="" title="Please enter your email" placeholder="Email">
                                  <span class="help-block"></span>
                              </div>
                                                           <button type="submit" id="resetButton" name="resetButton" class="btn btn-success btn-block">Reset</button>
							  
                          </form>
                          <?php }?>