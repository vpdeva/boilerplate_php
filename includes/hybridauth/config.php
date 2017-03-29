<?php
	
$genClass= new General($DBH);
$socials=$genClass->getSocialSettings();
$domain = $genClass->getSetting('domain');
/**
* HybridAuth
* http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
* (c) 2009-2014, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
*/

// ----------------------------------------------------------------------------------------
//	HybridAuth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------

return 
	array(
		"base_url" => $domain."/includes/hybridauth/", 

		"providers" => array ( 
			// openid providers
			"OpenID" => array (
				"enabled" => $socials['OpenId']['status']
			),

			"Yahoo" => array ( 
				"enabled" => $socials['Yahoo']['status'],
				"keys"    => array ( "key" => $socials['Yahoo']['id_key'], "secret" => $socials['Yahoo']['secret_key'] ),
			),

			"AOL"  => array ( 
				"enabled" => $socials['AOL']['status'] 
			),

			"Google" => array ( 
				"enabled" => $socials['Google']['status'],
				"keys"    => array ( "id" => $socials['Google']['id_key'], "secret" => $socials['Google']['secret_key'] ), 
			),

			"Facebook" => array ( 
				"enabled" => $socials['Facebook']['status'],
				"keys"    => array ( "id" => $socials['Facebook']['id_key'], "secret" => $socials['Facebook']['secret_key'] ),
				"scope" => "email"
			),

			"Twitter" => array ( 
				"enabled" => $socials['Twitter']['status'],
				"keys"    => array ( "key" => $socials['Twitter']['id_key'], "secret" => $socials['Twitter']['secret_key'] ) 
			),

			// windows live
			"Live" => array ( 
				"enabled" => $socials['Live']['status'],
				"keys"    => array ( "id" => $socials['Live']['id_key'], "secret" => $socials['Live']['secret_key'] ) 
			),

			"LinkedIn" => array ( 
				"enabled" => $socials['LinkedIn']['status'],
				"keys"    => array ( "key" => $socials['LinkedIn']['id_key'], "secret" => $socials['LinkedIn']['secret_key'] ) 
			),

			"Foursquare" => array (
				"enabled" => $socials['Foursquare']['status'],
				"keys"    => array ( "id" => $socials['Foursquare']['id_key'], "secret" => $socials['Foursquare']['secret_key'] ) 
			),
		),

		// If you want to enable logging, set 'debug_mode' to true.
		// You can also set it to
		// - "error" To log only error messages. Useful in production
		// - "info" To log info and error messages (ignore debug messages) 
		"debug_mode" => false,

		// Path to file writable by the web server. Required if 'debug_mode' is not false
		"debug_file" => "",
	);
