<?php
$genClass= new General($DBH);
$groupClass= new Group($DBH);
$socials=$genClass->getSocialSettings();
$domain = $genClass->getSetting('domain');
$register = $genClass->getSetting('allow_register');
$providers=array();

foreach ($socials as $social){
	
	switch ($social['provider']){
	case "OpenId":
		$providers[$social['provider']] = array (
				"enabled" => $socials['OpenId']['status']
			);
		break;
	case "Yahoo":
	
		$providers[$social['provider']] =array ( 
				"enabled" => $social['status'],
				"keys"    => array ( "key" => $social['id_key'], "secret" => $social['secret_key'] ),
			);		
			break;	
	case "AOL":
		$providers[$social['provider']] =array ( 
			"enabled" => $social['status']
			);
		break;
	case "Google":
		$providers[$social['provider']] =array ( 
			"enabled" => $social['status'],
			"keys"    => array ( "id" => $social['id_key'], "secret" => $social['secret_key'] ), 
			);
		break;
	case "Facebook":
		$providers[$social['provider']] =array ( 
			"enabled" => $social['status'],
				"keys"    => array ( "id" => $social['id_key'], "secret" => $social['secret_key'] ),
				"scope" => "email"
			);
		break;
	case "Twitter":
		$providers[$social['provider']] =array ( 
			"enabled" => $social['status'],
			"keys"    => array ( "key" => $social['id_key'], "secret" => $social['secret_key'] )  
			);
		break;
	case "Live":
	$providers[$social['provider']] =array ( 
			"enabled" => $social['status'],
			"keys"    => array ( "id" => $social['id_key'], "secret" => $social['secret_key'] )  
		);
	break;
	case "LinkedIn":
	$providers[$social['provider']] =array ( 
		"enabled" => $social['status'],
			"keys"    => array ( "key" => $social['id_key'], "secret" => $social['secret_key'] )  
		);
	break;
	case "Foursquare":
	$providers[$social['provider']] =array ( 
		"enabled" => $social['status'],
			"keys"    => array ( "id" => $social['id_key'], "secret" => $social['secret_key'] )  
		);
	break;				
}
}

$config =array(
		"base_url" => $domain."/includes/hybridauth/", 

		"providers" => $providers,

		// If you want to enable logging, set 'debug_mode' to true.
		// You can also set it to
		// - "error" To log only error messages. Useful in production
		// - "info" To log info and error messages (ignore debug messages) 
		"debug_mode" => false,

		// Path to file writable by the web server. Required if 'debug_mode' is not false
		"debug_file" => "",
	);
	

	// check for erros and whatnot
	$error = "";
	
	if( isset( $_GET["error"] ) ){
		$error = '<b style="color:red">' . trim( strip_tags(  $_GET["error"] ) ) . '</b><br /><br />';
	}
	if( isset( $_GET["provider"] ) && $_GET["provider"] ):
		try{
			// create an instance for Hybridauth with the configuration file path as parameter
			 $hybridauth = new Hybrid_Auth( $config );
 
			// set selected provider name 
			$provider = @ trim( strip_tags( $_GET["provider"] ) );

			// try to authenticate the selected $provider
			$adapter = $hybridauth->authenticate( $provider );

			// if okey, we will redirect to user profile page 
			$user_profile = $adapter->getUserProfile();
			
			
		     	$provider_id = $user_profile->identifier;            
		 	    $provider_firstname = $user_profile->firstName;
		 	    $provider_lastname = $user_profile->lastName;
			    $provider_email = $user_profile->email;  
			     
			    if ($userClass->getUserId($provider_email)==''){
				    //no user by that email, register a new one.
				    $dataArray=array();
				    $dataArray['firstname']=$provider_firstname;
				    $dataArray['lastname']=$provider_lastname;
				    $dataArray['email']=$provider_email;
				    $dataArray['status']=1;
				    $userClass->saveUser($dataArray);
				   
			    }
			    else{
				    
				 $userClass->setProvider($provider, $provider_id, $userClass->getUserId($provider_email));
			    }
			     
			   
			   
			   
			  if ( $userClass->login(null, null, null, 'boilerplate', $provider, $provider_id)==true)
			    header("Location: /index.php");
			   
			   
			   
			//$hybridauth->redirect( "profile.php$provider" );
		}
		catch( Exception $e ){
			// In case we have errors 6 or 7, then we have to use Hybrid_Provider_Adapter::logout() to 
			// let hybridauth forget all about the user so we can try to authenticate again.

			// Display the received error,
			// to know more please refer to Exceptions handling section on the userguide
			switch( $e->getCode() ){ 
				case 0 : $error = "Unspecified error."; break;
				case 1 : $error = "Hybriauth configuration error."; break;
				case 2 : $error = "Provider not properly configured."; break;
				case 3 : $error = "Unknown or disabled provider."; break;
				case 4 : $error = "Missing provider application credentials."; break;
				case 5 : $error = "Authentication failed. The user has canceled the authentication or the provider refused the connection."; break;
				case 6 : $error = "User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again."; 
					     $adapter->logout(); 
					     break;
				case 7 : $error = "User not connected to the provider."; 
					     $adapter->logout(); 
					     break;
			} 

			// well, basically your should not display this to the end user, just give him a hint and move on..
			$error .= "<br /><br /><b>Original error message:</b> " . $e->getMessage(); 
			$error .= "<hr /><pre>Trace:<br />" . $e->getTraceAsString() . "</pre>";
		}
    endif;
?>
	

              <div class="row">
                  <div class="col-xs-6">
                      <div class="well">
                          <form id="loginForm" method="POST" action="/login/" novalidate="novalidate">
	                            <h2> Login</h2>
	                            <?php
									// if we got an error then we display it here
									if( $error ){
										echo '<p><h3 style="color:red">Error!</h3>' . $error . '</p>';
										echo "<pre>Session:<br />" . print_r( $_SESSION, true ) . "</pre><hr />";
									}
								?>
                              <div class="form-group">
                           
                                  <input type="text" class="form-control" id="email" name="email" value="" required="" title="Please enter your email" placeholder="Email">
                                  <span class="help-block"></span>
                              </div>
                              <div class="form-group">
                                  
                                  <input type="password" class="form-control" id="password" name="password" value="" required="" title="Please enter your password" placeholder="Password">
                                  <span class="help-block"></span>
                              </div>
                              <div id="loginErrorMsg" class="alert alert-error hide">Wrong username or password</div>
                             <span class="help-block"><a href="/reset">Forget Password?</a></span>

                              <button type="submit" id="loginButton" name="loginButton" class="btn btn-success btn-block">Login</button>
							  <fieldset>
						        <legend>Sign-in with one of these providers</legend>
						        <?php foreach ($socials as $social){ 
							        if ($social['status']==1){?>
								        <a href="login/&provider=<?=$social['provider'];?>">Sign-in with <?=$social['provider'];?></a><br />
							       
							       <?php }
							        
						         } ?>
												      
									</fieldset> 
                          </form>
                      </div>
                  </div>
                  <div class="col-xs-6">
	                  <?php if ($register==true){?> 
                      <p class="lead">Register now for <span class="text-success">FREE</span></p>
                      <ul class="list-unstyled" style="line-height: 2">
                          <li><span class="fa fa-check text-success"></span> See all your orders</li>
                          <li><span class="fa fa-check text-success"></span> Fast re-order</li>
                          <li><span class="fa fa-check text-success"></span> Save your favorites</li>
                          <li><span class="fa fa-check text-success"></span> Fast checkout</li>
                          <li><span class="fa fa-check text-success"></span> Get a gift <small>(only new customers)</small></li>
                         
                      </ul>
                      <p><a href="/register/" class="btn btn-info btn-block">Yes please, register now!</a></p>
                      <?php }?> 
                  </div>
              </div>
          


   
 