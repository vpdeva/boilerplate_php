<?php

require_once('stripe/lib/Stripe.php');
$genClass=new General($DBH);
$skey=$genClass->getSetting('stripe_secret_key');
Stripe::setApiKey($skey);

require_once 'Mandrill.php'; 
include 'custom_classes.php'; 






function issetor(&$var, $default = false) 
{
return isset($var) ? $var : $default;
}

function isblank(&$var, $default = '') {
    return isset($var) ? $var : $default;
}
	
function login_check()
{
	if(!isset($_SESSION['user_id']) or ($_SESSION['user_id'])==''){
	
        header('Location: '.SURL.'index.php');
        exit();
	
	}
}

function countryArray()
 {

return array(
'US'=>'United States',
'AF'=>'Afghanistan',
'AL'=>'Albania',
'DZ'=>'Algeria',
'AS'=>'American Samoa',
'AD'=>'Andorra',
'AO'=>'Angola',
'AI'=>'Anguilla',
'AQ'=>'Antarctica',
'AG'=>'Antigua And Barbuda',
'AR'=>'Argentina',
'AM'=>'Armenia',
'AW'=>'Aruba',
'AU'=>'Australia',
'AT'=>'Austria',
'AZ'=>'Azerbaijan',
'BS'=>'Bahamas',
'BH'=>'Bahrain',
'BD'=>'Bangladesh',
'BB'=>'Barbados',
'BY'=>'Belarus',
'BE'=>'Belgium',
'BZ'=>'Belize',
'BJ'=>'Benin',
'BM'=>'Bermuda',
'BT'=>'Bhutan',
'BO'=>'Bolivia',
'BA'=>'Bosnia And Herzegovina',
'BW'=>'Botswana',
'BV'=>'Bouvet Island',
'BR'=>'Brazil',
'IO'=>'British Indian Ocean Territory',
'BN'=>'Brunei',
'BG'=>'Bulgaria',
'BF'=>'Burkina Faso',
'BI'=>'Burundi',
'KH'=>'Cambodia',
'CM'=>'Cameroon',
'CA'=>'Canada',
'CV'=>'Cape Verde',
'KY'=>'Cayman Islands',
'CF'=>'Central African Republic',
'TD'=>'Chad',
'CL'=>'Chile',
'CN'=>'China',
'CX'=>'Christmas Island',
'CC'=>'Cocos (Keeling) Islands',
'CO'=>'Columbia',
'KM'=>'Comoros',
'CG'=>'Congo',
'CK'=>'Cook Islands',
'CR'=>'Costa Rica',
'CI'=>'Cote D\'Ivorie (Ivory Coast)',
'HR'=>'Croatia (Hrvatska)',
'CU'=>'Cuba',
'CY'=>'Cyprus',
'CZ'=>'Czech Republic',
'CD'=>'Democratic Republic Of Congo (Zaire)',
'DK'=>'Denmark',
'DJ'=>'Djibouti',
'DM'=>'Dominica',
'DO'=>'Dominican Republic',
'TP'=>'East Timor',
'EC'=>'Ecuador',
'EG'=>'Egypt',
'SV'=>'El Salvador',
'GQ'=>'Equatorial Guinea',
'ER'=>'Eritrea',
'EE'=>'Estonia',
'ET'=>'Ethiopia',
'FK'=>'Falkland Islands (Malvinas)',
'FO'=>'Faroe Islands',
'FJ'=>'Fiji',
'FI'=>'Finland',
'FR'=>'France',
'FX'=>'France, Metropolitan',
'GF'=>'French Guinea',
'PF'=>'French Polynesia',
'TF'=>'French Southern Territories',
'GA'=>'Gabon',
'GM'=>'Gambia',
'GE'=>'Georgia',
'DE'=>'Germany',
'GH'=>'Ghana',
'GI'=>'Gibraltar',
'GR'=>'Greece',
'GL'=>'Greenland',
'GD'=>'Grenada',
'GP'=>'Guadeloupe',
'GU'=>'Guam',
'GT'=>'Guatemala',
'GN'=>'Guinea',
'GW'=>'Guinea-Bissau',
'GY'=>'Guyana',
'HT'=>'Haiti',
'HM'=>'Heard And McDonald Islands',
'HN'=>'Honduras',
'HK'=>'Hong Kong',
'HU'=>'Hungary',
'IS'=>'Iceland',
'IN'=>'India',
'ID'=>'Indonesia',
'IR'=>'Iran',
'IQ'=>'Iraq',
'IE'=>'Ireland',
'IL'=>'Israel',
'IT'=>'Italy',
'JM'=>'Jamaica',
'JP'=>'Japan',
'JO'=>'Jordan',
'KZ'=>'Kazakhstan',
'KE'=>'Kenya',
'KI'=>'Kiribati',
'KW'=>'Kuwait',
'KG'=>'Kyrgyzstan',
'LA'=>'Laos',
'LV'=>'Latvia',
'LB'=>'Lebanon',
'LS'=>'Lesotho',
'LR'=>'Liberia',
'LY'=>'Libya',
'LI'=>'Liechtenstein',
'LT'=>'Lithuania',
'LU'=>'Luxembourg',
'MO'=>'Macau',
'MK'=>'Macedonia',
'MG'=>'Madagascar',
'MW'=>'Malawi',
'MY'=>'Malaysia',
'MV'=>'Maldives',
'ML'=>'Mali',
'MT'=>'Malta',
'MH'=>'Marshall Islands',
'MQ'=>'Martinique',
'MR'=>'Mauritania',
'MU'=>'Mauritius',
'YT'=>'Mayotte',
'MX'=>'Mexico',
'FM'=>'Micronesia',
'MD'=>'Moldova',
'MC'=>'Monaco',
'MN'=>'Mongolia',
'MS'=>'Montserrat',
'MA'=>'Morocco',
'MZ'=>'Mozambique',
'MM'=>'Myanmar (Burma)',
'NA'=>'Namibia',
'NR'=>'Nauru',
'NP'=>'Nepal',
'NL'=>'Netherlands',
'AN'=>'Netherlands Antilles',
'NC'=>'New Caledonia',
'NZ'=>'New Zealand',
'NI'=>'Nicaragua',
'NE'=>'Niger',
'NG'=>'Nigeria',
'NU'=>'Niue',
'NF'=>'Norfolk Island',
'KP'=>'North Korea',
'MP'=>'Northern Mariana Islands',
'NO'=>'Norway',
'OM'=>'Oman',
'PK'=>'Pakistan',
'PW'=>'Palau',
'PA'=>'Panama',
'PG'=>'Papua New Guinea',
'PY'=>'Paraguay',
'PE'=>'Peru',
'PH'=>'Philippines',
'PN'=>'Pitcairn',
'PL'=>'Poland',
'PT'=>'Portugal',
'PR'=>'Puerto Rico',
'QA'=>'Qatar',
'RE'=>'Reunion',
'RO'=>'Romania',
'RU'=>'Russia',
'RW'=>'Rwanda',
'SH'=>'Saint Helena',
'KN'=>'Saint Kitts And Nevis',
'LC'=>'Saint Lucia',
'PM'=>'Saint Pierre And Miquelon',
'VC'=>'Saint Vincent And The Grenadines',
'SM'=>'San Marino',
'ST'=>'Sao Tome And Principe',
'SA'=>'Saudi Arabia',
'SN'=>'Senegal',
'SC'=>'Seychelles',
'SL'=>'Sierra Leone',
'SG'=>'Singapore',
'SK'=>'Slovak Republic',
'SI'=>'Slovenia',
'SB'=>'Solomon Islands',
'SO'=>'Somalia',
'ZA'=>'South Africa',
'GS'=>'South Georgia And South Sandwich Islands',
'KR'=>'South Korea',
'ES'=>'Spain',
'LK'=>'Sri Lanka',
'SD'=>'Sudan',
'SR'=>'Suriname',
'SJ'=>'Svalbard And Jan Mayen',
'SZ'=>'Swaziland',
'SE'=>'Sweden',
'CH'=>'Switzerland',
'SY'=>'Syria',
'TW'=>'Taiwan',
'TJ'=>'Tajikistan',
'TZ'=>'Tanzania',
'TH'=>'Thailand',
'TG'=>'Togo',
'TK'=>'Tokelau',
'TO'=>'Tonga',
'TT'=>'Trinidad And Tobago',
'TN'=>'Tunisia',
'TR'=>'Turkey',
'TM'=>'Turkmenistan',
'TC'=>'Turks And Caicos Islands',
'TV'=>'Tuvalu',
'UG'=>'Uganda',
'UA'=>'Ukraine',
'AE'=>'United Arab Emirates',
'UK'=>'United Kingdom',
'UM'=>'United States Minor Outlying Islands',
'UY'=>'Uruguay',
'UZ'=>'Uzbekistan',
'VU'=>'Vanuatu',
'VA'=>'Vatican City (Holy See)',
'VE'=>'Venezuela',
'VN'=>'Vietnam',
'VG'=>'Virgin Islands (British)',
'VI'=>'Virgin Islands (US)',
'WF'=>'Wallis And Futuna Islands',
'EH'=>'Western Sahara',
'WS'=>'Western Samoa',
'YE'=>'Yemen',
'YU'=>'Yugoslavia',
'ZM'=>'Zambia',
'ZW'=>'Zimbabwe'
);
}

 function stateArray()
 {
	return array(
		    'AL'=>'Alabama',
		    'AK'=>'Alaska',
		    'AZ'=>'Arizona',
		    'AR'=>'Arkansas',
		    'CA'=>'California',
		    'CO'=>'Colorado',
		    'CT'=>'Connecticut',
		    'DE'=>'Delaware',
		    'DC'=>'District of Columbia',
		    'FL'=>'Florida',
		    'GA'=>'Georgia',
		    'HI'=>'Hawaii',
		    'ID'=>'Idaho',
		    'IL'=>'Illinois',
		    'IN'=>'Indiana',
		    'IA'=>'Iowa',
		    'KS'=>'Kansas',
		    'KY'=>'Kentucky',
		    'LA'=>'Louisiana',
		    'ME'=>'Maine',
		    'MD'=>'Maryland',
		    'MA'=>'Massachusetts',
		    'MI'=>'Michigan',
		    'MN'=>'Minnesota',
		    'MS'=>'Mississippi',
		    'MO'=>'Missouri',
		    'MT'=>'Montana',
		    'NE'=>'Nebraska',
		    'NV'=>'Nevada',
		    'NH'=>'New Hampshire',
		    'NJ'=>'New Jersey',
		    'NM'=>'New Mexico',
		    'NY'=>'New York',
		    'NC'=>'North Carolina',
		    'ND'=>'North Dakota',
		    'OH'=>'Ohio',
		    'OK'=>'Oklahoma',
		    'OR'=>'Oregon',
		    'PA'=>'Pennsylvania',
		    'RI'=>'Rhode Island',
		    'SC'=>'South Carolina',
		    'SD'=>'South Dakota',
		    'TN'=>'Tennessee',
		    'TX'=>'Texas',
		    'UT'=>'Utah',
		    'VT'=>'Vermont',
		    'VA'=>'Virginia',
		    'WA'=>'Washington',
		    'WV'=>'West Virginia',
		    'WI'=>'Wisconsin',
		    'WY'=>'Wyoming',
		);

}

function writeLog($user_id, $company_id, $activity_title, $message)
 {
	//to do: if one is blank, search db for correct values
	$today_date=date('Y-m-d h:i:s');	
	$activity_name	=	"Update Activity";
	$user_activity_desc	=	" User Updated the Activity";
	
	$query2=mysql_query("INSERT INTO user_activity(usr_id,company_id, activity_name,user_activity_desc,activity_time,status) VALUES ('".$user_id."','".$company_id."','".		$activity_title."','".$message."','".$today_date."','1')")or die(mysql_error());
}

function restricted($group_id, $user_id=0)
  {
	  	global $DBH;
	  	  if ($user_id==0 && $group_id>0 && isset($_SESSION['user_id'])){
		  	  $user_id=$_SESSION['user_id'];
		  	  
		  $query= "select count(*) from user_groups where user_id=:user_id AND group_id=:group_id ";
		  

		  $cmpresult= $DBH->prepare($query);
		  $cmpresult->execute(array(':user_id' => $user_id, ':group_id'=>$group_id));
		  $rows = $cmpresult->fetchColumn();
		  if ($rows>0){
			  
			  }else{
				  header("Location:" );
			
				}
		  }
  }

class General
{
public $DBH;

 
  function __construct($DBH)
	{
		$this->DBH = $DBH;
		
	}
	
	
	public function getSettings()
	{
		
			$query= "select * from site_settings where id='1'";
			 $cmpresult= $this->DBH->prepare($query);
			 $cmpresult->execute();
			  $ob=$cmpresult->fetch(PDO::FETCH_ASSOC);
			 return $ob;
	}
	
	public function getSetting($field_name)
	{
		
			$query= "select ".$field_name." from site_settings where id='1'";
			 $cmpresult= $this->DBH->prepare($query);
			 $cmpresult->execute();
			  $ob=$cmpresult->fetchColumn();
			 return $ob;
	}
	
	public function getSocialSettings()
	{
		
			$query= "select * from social_settings order by provider";
			 $cmpresult= $this->DBH->prepare($query);
			 $cmpresult->execute();
			 $ob=$cmpresult->fetchAll();
			 return $ob;
	}
		public function saveSocialSettings($dataArray)
	{
		$socials=$this->getSocialSettings();
		$error=0;
		foreach ($socials as $social){
			$query= "update social_settings set id_key=:id_key, secret_key=:secret_key, status=:status where provider=:provider";
			
			 $cmpresult= $this->DBH->prepare($query);
			 $cmpresult->bindParam(':provider',$social['provider'] );
			 $cmpresult->bindParam(':id_key', isblank($dataArray[$social['provider'].'_id']));
			 $cmpresult->bindParam(':secret_key', isblank($dataArray[$social['provider'].'_sk']));
			 $cmpresult->bindParam(':status', isblank($dataArray[$social['provider'].'_active'][0]));
			
			if ($cmpresult->execute()!=true)
			$error=1;
			}
		
		if ($error==0)
			return true;
		
	}
	
	public function savePermissions($dataArray)
	{
		
		
		
		foreach ($dataArray['permissions'] as $permissions=>$page)
		
		{
			$query= "DELETE FROM permissions WHERE page_name=:page_name";
			 $cmpresult= $this->DBH->prepare($query);
			 $cmpresult->bindParam(':page_name',$permissions );
			 $cmpresult->execute();	
			foreach ($page as $value=>$group)
			{
			 
			 $query= "insert into permissions set page_name=:page_name, group_id=:group_id";
			 $cmpresult= $this->DBH->prepare($query);
			 $cmpresult->bindParam(':page_name',$permissions );
			 $cmpresult->bindParam(':group_id',$group );
				  
			 $cmpresult->execute();	
			  
			}
		}
	}
	
	public function getPermissions($page, $group)
	{
			 $query= "select count(*) as count from permissions where page_name=:page_name and group_id=:group_id";
			 $cmpresult= $this->DBH->prepare($query);
			  $cmpresult->bindParam(':page_name',$page );
			 $cmpresult->bindParam(':group_id',$group );
			 $cmpresult->execute();
			 $ob=$cmpresult->fetch(PDO::FETCH_ASSOC);
		
			if ($ob['count']>0) 
			return true;
			else return false;
	}
	
	public function saveSettings($dataArray)
	{
	
		$query= "update site_settings set domain=:domain, admin_email=:admin_email, default_permission=:default_permission,  default_plan=:default_plan, public_profiles=:public_profiles, allow_register=:allow_register, login_message=:login_message, restricted_message=:restricted_message, terms_conditions=:terms_conditions, stripe_secret_key=:stripe_secret_key, stripe_public_key=:stripe_public_key, mandrill_key=:mandrill_key  where id='1'";
		if (!empty($dataArray['public_profiles'][0]))
		$public_profiles=$dataArray['public_profiles'][0];
		else 
		$$public_profiles=0;
		
		if (!empty($dataArray['allow_register'][0]))
		$allow_register=$dataArray['allow_register'][0];
		else 
		$allow_register=0;
		 $cmpresult= $this->DBH->prepare($query);
		 $cmpresult->bindParam(':domain',isblank($dataArray['domain']) );
		 $cmpresult->bindParam(':admin_email', isblank($dataArray['admin_email']));
		 $cmpresult->bindParam(':default_permission', isblank($dataArray['default_permission']));
		 $cmpresult->bindParam(':default_plan', isblank($dataArray['default_plan']));
		 $cmpresult->bindParam(':public_profiles', isblank($public_profiles));
		 $cmpresult->bindParam(':allow_register', isblank($allow_register));
		 $cmpresult->bindParam(':login_message', isblank($dataArray['login_message']));
		 $cmpresult->bindParam(':restricted_message', isblank($dataArray['restricted_message']));
		 $cmpresult->bindParam(':terms_conditions', isblank($dataArray['terms_conditions']));
		 $cmpresult->bindParam(':stripe_secret_key', isblank($dataArray['stripe_secret_key']));
		 $cmpresult->bindParam(':stripe_public_key', isblank($dataArray['stripe_public_key']));
		 $cmpresult->bindParam(':mandrill_key', isblank($dataArray['mandrill_key']));
		 
		if ($cmpresult->execute()!=true)
		return false;
		else return true;
		
	}

}

class User
{
  
 public $DBH;
 private  $key = '$2a$07$umgumgumgumgumgumgumgumgu$';
 
  function __construct($DBH)
	{
		$this->DBH = $DBH;
		
		 
	}
	
	public function checkPermission($user_id, $page_name)
	 {
		 $query= "SELECT count(*) FROM permissions where page_name=:page_name";
		  $cmpresult= $this->DBH->prepare($query);
		  $cmpresult->bindParam(':page_name', $page_name);
		  $cmpresult->execute();
		  $rows = $cmpresult->fetchColumn();
		 if ($rows>0){
		  $query= "SELECT count(*) as count FROM user_groups as u left join permissions as p on u.group_id=p.group_id where u.user_id=:user_id and p.page_name=:page_name ";
		  $cmpresult= $this->DBH->prepare($query);
		  $cmpresult->bindParam(':user_id', $user_id);
		  $cmpresult->bindParam(':page_name', $page_name);
		  $cmpresult->execute();
		  $rows = $cmpresult->fetchColumn();
		  if ($rows>0){
			  return true;
		  }
		  else return false;
		 }
		 else return true;
	 }
 
  public function login($email, $password, $hash='0', $saltkey='0', $provider='', $provider_id='0')
  {	
	  	 $query="select count(*) as count, u.*, u.id as user_id from  users as u left join auth as a on a.user_id=u.id left join authentications as p on p.user_id=u.id WHERE u.status != '0'";
	  	 
	  if (isset($email) && isset($password)){
	  $key = $this->key;
	  $pass =  crypt($password, $key);
	  $query.=" and u.email =:email and u.password=:password";
	  $cmpresult= $this->DBH->prepare($query);
	  $cmpresult->bindParam(':email', urldecode($email));
	  $cmpresult->bindParam(':password', $pass);
	  }
	  else if (isset($hash) && $hash!='0' && $saltkey='boilerplate'){
	  $query.=" and u.act_code =:hash";
	  $cmpresult= $this->DBH->prepare($query);
	  $cmpresult->bindParam(':hash', $hash);
	
	  }
	  else if (!empty($provider) && !empty($provider_id) && $saltkey='boilerplate'){
	  $query.=" and p.provider =:provider and p.provider_id=:provider_id";
	  $cmpresult= $this->DBH->prepare($query);
	  $cmpresult->bindParam(':provider', $provider);
	  $cmpresult->bindParam(':provider_id', $provider_id);
	
	  }

		  if ($cmpresult->execute()==true){
			   $ob=$cmpresult->fetch(PDO::FETCH_ASSOC);
		
			//user exists
			if ($ob['count']>0){
				
				
				$_SESSION['user_id']		=	$ob['id'];
				$_SESSION['user_username']	=	$ob['username'];
				$_SESSION['user_email']		=	$ob['email'];
				$_SESSION['user_firstname']	=	$ob['firstname'];
				//$_SESSION['user_profileimg']	=	$ob['id'];
				// check auth token
				if (!isset($ob['token'])|| $ob['token']==null){
				 $tokquery =  "Insert Into auth set token=:token , user_id=:user_id";
					}
				else{
				 $tokquery = "UPDATE auth set token=:token  WHERE user_id=:user_id";
					}
					
				$token = md5(uniqid(rand(), true));	
				
				$tokresult = $this->DBH->prepare($tokquery);
				$tokresult->bindParam(':token', $token);
				$tokresult->bindParam(':user_id', $ob['id']);
				$tokresult->execute();
				$_SESSION['token'] = $token; 
				$ob['token']=$token;
				
				return $ob; 
				
			}
			else
			return false;
			
		  }
		  
	  	
	}
	
  public function getUser($user_id=0)
  {
	  if ($user_id>0){
		  //$query= "select u.*, c.*, p.*, g.* from users as u left join custom_fields as c on u.id=c.user_id left join custom_field_structure as p on c.custom_field_structure_id=p.id left join field_groups as g on p.field_group_id=g.id where u.id=:user_id ";
		  $query="select * from users where id=:user_id";
		  $this->DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

		  $cmpresult= $this->DBH->prepare($query);
		  $cmpresult->execute(array(':user_id' => $user_id));
		  
		  $ob=$cmpresult->fetch(PDO::FETCH_ASSOC);
		  
			   $groupquery="select * from custom_fields where user_id=:user_id";
			   $groupresult= $this->DBH->prepare($groupquery);
			  $groupresult->execute(array(':user_id' => $user_id));
			  $groups=$groupresult->fetchAll();
			$ob['custom_fields']=$groups;  
		  
		  return $ob;
		 }

	}
    public function getUserId($user_email='')
  {
	  if ($user_email!=''){
		
		  $query="select id from users where email=:user_email";
		 

		  $cmpresult= $this->DBH->prepare($query);
		  $cmpresult->execute(array(':user_email' => $user_email));
		  
		  $ob=$cmpresult->fetchColumn();
		  return $ob;
		 }

	}
  public function checkToken($token)
  {
	  	  if (isset($token) && $token!=""){
		  $query= "select user_id from auth where token=:token ";
		  $this->DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

		  $cmpresult= $this->DBH->prepare($query);
		  $cmpresult->execute(array(':token' => $token));
		  $ob=$cmpresult->fetch(PDO::FETCH_ASSOC);
		  return $ob['user_id'];
		  	 }
  }
  
    public function resetCode($user_id)
  {
	  	  if (isset($user_id) && $user_id!=""){
		  	  $act_code= md5(uniqid('',true),false);
		  $query= "update users set act_code=:act_code, reset='1' where id=:user_id";
		  $cmpresult= $this->DBH->prepare($query);
		  $cmpresult->execute(array(':act_code' => $act_code, ':user_id' => $user_id));
		 return $act_code;
		  	 }
  }
  
      public function resetPassword($dataArray)
  {
	  	 $key = $this->key;
		 $pass =  crypt($dataArray['pword'], $key);
		  $query= "update users set password=:password, act_code='', reset='0' where act_code=:act_code";
		  $cmpresult= $this->DBH->prepare($query);
		   if ($cmpresult->execute(array(':act_code' => $dataArray['act_code'], ':password' => $pass))==true)
		   	header ("Location: /login");
		 
		  	
  }
  
      public function checkCode($code)
  {
	  	  if (isset($code) && $code!=""){
		  	 
		  $query= "select id from users where act_code=:act_code and reset='1'";
		  $cmpresult= $this->DBH->prepare($query);
		  $cmpresult->execute(array(':act_code' => $code));
		  return $cmpresult->fetchColumn();
		  
		  
		  	 }
  }
  
   public function userIsInGroup($group_id, $user_id=0)
  {			
	  if ($user_id==0 && isset($_SESSION['user_id'])){
	  			$user_id=$_SESSION['user_id'];
  				}
  				
	  	  if ($user_id>0 && $group_id>0){
		  $query= "select count(*) from user_groups where user_id=:user_id AND group_id=:group_id ";
		  

		  $cmpresult= $this->DBH->prepare($query);
		  $cmpresult->execute(array(':user_id' => $user_id, ':group_id'=>$group_id));
		  $rows = $cmpresult->fetchColumn();
		  if ($rows>0){
			  return true;
			  }else
			  return false;
		  }
  }
  

  
   public function listUsers()
  {
	  	  
		  $query= "select id, username, email, status from users";
		  

		  $cmpresult= $this->DBH->prepare($query);
		  $cmpresult->execute();
		  $rows = $cmpresult->fetchAll();
		  
		  return $rows;
	}
	
  public function confirmUser($hash='0'){
	 if ($hash!='0'){
		  $query="UPDATE users SET status ='1' WHERE act_code=:hash";
		  $cmpresult= $this->DBH->prepare($query);
		 if ($cmpresult->execute(array(':hash' => $hash))==true)
		 {
			
			 
			 if ($this->login(null, null, $hash, 'boilerplate')!=false){
				  //check for default subscription
			  $gen=new General($this->DBH);
			  $gen_plan=$gen->getSetting('default_plan');
			  if (!empty($gen_plan)){
				$billing=new Billing($this->DBH);  
				$gen_bill=$billing->listPlans($gen_plan);
				$trial=$gen_bill['trial_period_days']; 
				
				//if trial >0 then start trial, if no trial, send to billing
				if ($trial>0){
					$billing->createCustomer($_SESSION['user_id'],$_SESSION['user_email'], 2 );
					$billing->activateUser($_SESSION['user_id'],$gen_bill['group'],2 );
					}
					else{
					$billing->createCustomer($_SESSION['user_id'],$_SESSION['user_email'], 0 );
						header("Location: /billing");
					}  
			 }
			 
				 
				return true;
			}else return false;
		 }else return false;
	 }else return false;

 }

	
	
  public function saveUser($dataArray)
  {
	  	 
		  $query= "select count(*) as count, status from users where (username=:username AND id!=:user_id) or (email=:email AND id!=:user_id) ";
		  $cmpresult= $this->DBH->prepare($query);
		  $cmpresult->bindParam(':username', $dataArray['username']);
		  $cmpresult->bindParam(':email', $dataArray['email']);
		  $cmpresult->bindParam(':user_id', $dataArray['user_id']);
		  $cmpresult->execute();
		  
		  $rows = $cmpresult->fetch(PDO::FETCH_ASSOC);
		  if ($rows['count']==0 || empty($dataArray['user_id'])){
			  
			 $qrstatus="";
			
			  if (empty($dataArray['user_id'])){
				  
				  //new user
				  $action ="insert into ";
				  $where=", act_code=:hash ";
				  
				    if (!empty($dataArray['status'])){
					   $status=$dataArray['status'];
					 }
					 else
					 $status=0;
					 
				  $qrstatus=", status=:status";
				  $hash= md5(uniqid('',true),false);
				  
				  if (empty($dataArray['username'])){
					  $dataArray['username']=$dataArray['email'];
				  }
				  
				  
				   $query= "select count(*) from users where (username=:username) or (email=:email) ";
				  $cmpresult= $this->DBH->prepare($query);
				  $cmpresult->bindParam(':username', $dataArray['username']);
				  $cmpresult->bindParam(':email', $dataArray['email']);
				  $cmpresult->execute();
				  $rows2 = $cmpresult->fetchColumn();
				  if ($rows2!=0){return false;}
				  
			  }
			  else
			  {
				  $action="update ";
				  $where=" where id=:user_id";
				  $user_id=$dataArray['user_id'];
				  if (!empty($dataArray['status'])){
					   $qrstatus=", status=:status";
					 }
				 if (!empty($dataArray['status'])){
					   $status=$dataArray['status'];
					 }
					 else
					 $status=1; 
				 
			  }
			 
			   
			   
			  
			  if (isset($dataArray['pword']) && isset($dataArray['pword2']) && $dataArray['pword']!="" && $dataArray['pword']==$dataArray['pword2']){
				  $password= ",password=:password"; 
			  }else $password="";
		  $query= $action." users SET username=:username, email=:email, firstname=:firstname, lastname=:lastname".$qrstatus.$password.$where;
		  $this->DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
		  $cmpresult= $this->DBH->prepare($query);
		  $cmpresult->bindParam(':username', $dataArray['username']);
		  $cmpresult->bindParam(':email', $dataArray['email']);
		  $cmpresult->bindParam(':firstname', $dataArray['firstname']);
		  $cmpresult->bindParam(':lastname', $dataArray['lastname']);
		  if (!empty($dataArray['status']) || isset($status)){
		  $cmpresult->bindParam(':status', $status );
		  }
		  
		  if(!empty($dataArray['user_id'])){
			   $cmpresult->bindParam(':user_id', $user_id); 
		  }
		  
		
		  
		  if(!empty($hash)){
			   $cmpresult->bindParam(':hash', $hash); 
		  }
		  if($password!=""){
			  $key = $this->key;
		   $pass =  crypt($dataArray['pword'], $key);
		   $cmpresult->bindParam(':password', $pass);
		   }
	
		   
		  if ($cmpresult->execute()==true){
			  
			  $error=0;
			  if (empty($dataArray['user_id'])){
				  $user_id=$this->DBH->lastInsertId();
				  }
			  //update groups
			  
			  if (isset ($dataArray['groups']) && sizeof($dataArray['groups'])>0){
			  $gquery= "DELETE FROM user_groups where user_id=:user_id";
			  $gresult= $this->DBH->prepare($gquery);
			  $gresult->bindParam(':user_id', $user_id);
			
			  	if ($gresult->execute()==true){
				  	
				  	
				  	 foreach($dataArray['groups'] as $key){
				  	 $gquery= "INSERT INTO user_groups set user_id=:user_id, group_id=:group_id";
				  	 $gresult= $this->DBH->prepare($gquery);
				  	 $gresult->bindParam(':user_id', $user_id);
				  	 $gresult->bindParam(':group_id', $key);
				  	
				  	 if($gresult->execute()!=true)
				  	 $error=1;	
				  	 }
				  	 
				  	 
				
				  }
				  else $error=1;
			  
			  	}
			  	else {
				  	if (empty($dataArray['user_id'])){
				  	 $gen=new General($this->DBH);
				    $gen_group=$gen->getSetting('default_permission');
				    $gquery= "INSERT INTO user_groups set user_id=:user_id, group_id=:group_id";
				  	 $gresult= $this->DBH->prepare($gquery);
				  	 $gresult->bindParam(':user_id', $user_id);
				  	 $gresult->bindParam(':group_id', $gen_group);
				  	 $gresult->execute();
				  	
				  	}
				  	
			  	}
			  	
			  
			
			  	
		  }
		  else $error=1;  
		  
		  
		  }
		  else $error=1;
		  
		  
		  
		    if ($error==0){
					 
					  if(!empty($hash)){
						  $email=new Mailer($this->DBH);
						  
						   $email->sendWelcome($dataArray['firstname'], $dataArray['email'], $hash);
						  }
						return true;  
					  } 
					  else return false; 
	}
	
	public function setProvider($provider,$provider_id, $user_id)
	{
		  if (isset ($provider) && isset($provider_id) && isset($user_id)){
			  
				  	 $gquery= "replace INTO authentications set provider=:provider, provider_id=:provider_id, user_id=:user_id";
				  	 $gresult= $this->DBH->prepare($gquery);
				  	 $gresult->bindParam(':provider', $provider);
				  	 $gresult->bindParam(':provider_id', $provider_id);
				  	 $gresult->bindParam(':user_id', $user_id);
				  	
				  	return $gresult->execute();
		}		 	
	}
  
  public function deleteUser($user_id)
  {
	  	  
		  $query= "delete from users where id=:user_id";
		  $cmpresult= $this->DBH->prepare($query);
		  $cmpresult->bindParam(':user_id', $user_id);
		  $cmpresult->execute();
		  
		  $query= "delete from user_groups where user_id=:user_id";
		  
		  $cmpresult= $this->DBH->prepare($query);
		  $cmpresult->bindParam(':user_id', $user_id);
		  $cmpresult->execute();
		  
		  $query= "delete from subscriptions where user_id=:user_id";
		  
		  $cmpresult= $this->DBH->prepare($query);
		  $cmpresult->bindParam(':user_id', $user_id);
		  $cmpresult->execute();
	}
  
	
}


class Group
{
	
  
 public $DBH;	  

 function __construct($DBH)
	{
		$this->DBH = $DBH;
		//$fetch_zone =mysql_query("select timezone from user where id ='".$user_id."'") or die(mysql_error());
		//$row_name = mysql_fetch_assoc($fetch_zone);
		//$timezone = new DateTimeZone($row_name['timezone']);
		 
	}
	
 public function saveGroup($dataArray)
  {
	  if (empty($dataArray['email']))
	  	$dataArray['email']=0;
	  	
	  	 if (empty($dataArray['redirect']))
	  	$dataArray['redirect']='';
	  	
	  	  $moreparams = array();
		 if (!empty($dataArray['group_id'])){
			 //update
			  $query= "UPDATE groups SET title=:title, redirect=:redirect, email=:email WHERE id=:group_id";
			  $cmpresult= $this->DBH->prepare($query);
			  $cmpresult->bindParam(':title', $dataArray['title']);
			  $cmpresult->bindParam(':email', $dataArray['email']);
			  $cmpresult->bindParam(':redirect', $dataArray['redirect']);
			  $cmpresult->bindParam(':group_id', $dataArray['group_id']);
		 }
		 else{
			 //insert new
			  $action = "INSERT INTO";
			  $query= "INSERT INTO groups SET title=:title, redirect=:redirect, email=:email";
			  $cmpresult= $this->DBH->prepare($query);
			  $cmpresult->bindParam(':title', $dataArray['title']);
			   $cmpresult->bindParam(':redirect', $dataArray['redirect']);
			  $cmpresult->bindParam(':email', $dataArray['email']);
			  
			 }
		 
			 
		  if ($cmpresult->execute()==true)
				return true;
			  	else 
			  	return false;
	}
		  
	public function getGroup($group_id)
  {
	  	  
		  $query= "select * from groups where id=:group_id";
		  
		  $cmpresult= $this->DBH->prepare($query);
		  $cmpresult->bindParam(':group_id', $group_id);
		  $cmpresult->execute();
		  $ob=$cmpresult->fetch(PDO::FETCH_ASSOC);
		  
		  return $ob;
	}
	
		public function deleteGroup($group_id)
  {
	  	  
		  $query= "delete from groups where id=:group_id";
		  $cmpresult= $this->DBH->prepare($query);
		  $cmpresult->bindParam(':group_id', $group_id);
		  $cmpresult->execute();
		  
		  $query= "delete from user_groups where group_id=:group_id";
		  
		  $cmpresult= $this->DBH->prepare($query);
		  $cmpresult->bindParam(':group_id', $group_id);
		  $cmpresult->execute();
		  
		  $query= "update subscription_plans set user_group_id='0' where user_group_id=:group_id";
		  
		  $cmpresult= $this->DBH->prepare($query);
		  $cmpresult->bindParam(':group_id', $group_id);
		  $cmpresult->execute();
	}
	
	
	 public function getGroups()
  {
	  	  
		  $query= "select * from groups";
		  
		  $cmpresult= $this->DBH->prepare($query);
		  $cmpresult->execute();
		  $rows = $cmpresult->fetchAll();
		  
		  return $rows;
	}
	
  public function getGroupUsers($group_id=0)
  {
	  
	  	  if ($group_id!=0){
		  $query= "select u.*, g.* from users as u left join user_groups as g on u.id=g.user_id where g.group_id=:group_id ";
		  
		  $cmpresult= $this->DBH->prepare($query);
		  $cmpresult->bindParam(':group_id', $group_id);
		  $cmpresult->execute();
		  $rows = $cmpresult->fetchAll();
		  
		  return $rows;
		  }
	}
	
	 
	
}

class Billing
{
	public $DBH;	  

 function __construct($DBH)
	{
		$this->DBH = $DBH;

		 
	}
 public function listPlans($plan_id='0')
 {
	
	 if ($plan_id=='0'){
		 
		$plans_data= Stripe_Plan::all();
		//print_r( $plans['data']);
		
		 $plans = array();
			if($plans_data) {
				$i=0;
				foreach($plans_data['data'] as $plan) {
					// store the plan ID as the array key and the plan name as the value
					$plans[$i]['id'] = $plan['id'];
					$plans[$i]['name'] = $plan['name'];
					$plans[$i]['amount'] = $plan['amount'];
					$plans[$i]['interval'] = $plan['interval'];
					$plans[$i]['interval_count'] = $plan['interval_count'];
					$plans[$i]['trial_period_days'] = $plan['trial_period_days'];
					$i++;
				}
			}
			return $plans;
	
	
	 }else if ($plan_id!='0' && $plan_id!=""){
		 $plans_data= Stripe_Plan::retrieve($plan_id);
		 
		  $plans = array();
			if($plans_data) {
				
				
					// store the plan ID as the array key and the plan name as the value
					$plans['new_plan_id'] = $plans_data['id'];
					$plans['name'] = $plans_data['name'];
					$plans['amount'] = intval($plans_data['amount'])/100;
					$plans['interval'] = $plans_data['interval'];
					$plans['interval_count'] = $plans_data['interval_count'];
					$plans['trial_period_days'] = $plans_data['trial_period_days'];
					
					
					 $query= "SELECT user_group_id from subscription_plans where stripe_plan_id=:plan_id";
					 $cmpresult= $this->DBH->prepare($query);
					 $cmpresult->bindParam(':plan_id', $plans['new_plan_id']);
					 $cmpresult->execute();
					 $ob=$cmpresult->fetch(PDO::FETCH_ASSOC);
					 $plans['group']=$ob['user_group_id'];
			}
			return $plans;
	 }
	
 }
 
 public function savePlan($dataArray)
 {
	 
		 if (!empty($dataArray['plan_id'])){
			 //update
			 
			 $p = Stripe_Plan::retrieve($dataArray['plan_id']);
			 $p->name = $dataArray['name'];
			 //$p->amount = intval($dataArray['amount'])*100;
			 //$p->id = $dataArray['new_plan_id'];
			 //$p->interval_count = $dataArray['interval_count'];
			 //$p->interval = $dataArray['interval'];
			 //$p->trial_period_Days = $dataArray['trial_period_days'];
			  
			 $p->save();
			 
			  $query= "UPDATE subscription_plans SET user_group_id=:group_id WHERE stripe_plan_id=:plan_id";
			  $cmpresult= $this->DBH->prepare($query);
			  
			  $cmpresult->bindParam(':group_id', $dataArray['group']);
			  $cmpresult->bindParam(':plan_id', $dataArray['plan_id']);
			
		 }
		 else{
			 //insert new
			 $p = Stripe_Plan::create(array(
			  "amount" => intval($dataArray['amount'])*100,
			  "interval" => $dataArray['interval'],
			  "name" => $dataArray['name'],
			  "currency" => "usd",
			  "id" => $dataArray['new_plan_id'],
			  "trial_period_days" => $dataArray['trial_period_days'],
			  "interval_count"=>$dataArray['interval_coutnr'])
			);
			
			  
			  $query= "insert into subscription_plans SET stripe_plan_id=:new_id, user_group_id=:user_group_id";
			  $cmpresult= $this->DBH->prepare($query);
			  $cmpresult->bindParam(':new_id', $dataArray['new_plan_id']);
			  $cmpresult->bindParam(':user_group_id', $dataArray['group']);
			  
			 }
		 
			 
		  if ($cmpresult->execute()==true)
				return true;
			  	else 
			  	return false;
	}
	
 public function deletePlan($plan_id)
 {
	  $plan = Stripe_Plan::retrieve($plan_id);
	  $plan->delete();
	  
	   $query= "delete from subscription_plans where stripe_plan_id=:new_id";
			  $cmpresult= $this->DBH->prepare($query);
			  $cmpresult->bindParam(':new_id', $plan_id);
			  $cmpresult->execute();
  
  }
 
  public function updateBilling($customer_id='0', $stripeArray=array())
  {
	 if ($customer_id!='0' && sizeof($stripeArray)>0){
		$cu = Stripe_Customer::retrieve($customer_id);
		foreach($stripeArray as $key=>$value){
			$cu->$key = $value;
			}
		return $cu->save();
		 
	  }	  

		 
  }
   public function createCharge($customer_id='0', $stripeArray=array()) 
  {
	 
	  if ($customer_id!='0' && sizeof($stripeArray)>0){
		 $stripeArray['customer']=$customer_id;
		 $stripeArray['currency']='usd';
		return  Stripe_Charge::create($stripeArray);
		 
	  }	  


  }
 public function renewSubscription($customer_id)
 {
	  $query= "update subscriptions set update_billing='0', status='1' where stripe_customer_id=:customer_id";
			  $cmpresult= $this->DBH->prepare($query);
			  $cmpresult->bindParam(':customer_id', $customer_id);
			  return $cmpresult->execute();
  
  }
   public function getStripeCustomerId($user_id)
 {
	 $userClass=new User($this->DBH);
	 $user=$userClass->getUser($user_id);
	 $email=$user['email'];
	  $query= "select stripe_customer_id FROM subscriptions where user_id=:user_id";
			  $cmpresult= $this->DBH->prepare($query);
			  $cmpresult->bindParam(':user_id', $user_id);
			  $cmpresult->execute();
			  $customer_id = $cmpresult->fetchColumn();
			  if (empty($customer_id)){
				$this->createCustomer($user_id, $email, '3');
				$this->getStripeCustomerId($user_id);
			  }
			  return $customer_id;
  }
  
 public function requestBilling($customer_id)
 {
	  $query= "update subscriptions set update_billing='1'where stripe_plan_id=:customer_id";
			  $cmpresult= $this->DBH->prepare($query);
			  $cmpresult->bindParam(':customer_id', $customer_id);
			  $cmpresult->execute();
  
  }
  
  public function checkSubscription($user_id='0')
  {
	  if ($user_id!='0'){
		  	
		  
		   $query= "select * from subscriptions where user_id=:user_id";
		   $cmpresult= $this->DBH->prepare($query);
		  if ($cmpresult->execute( array(':user_id'=>$user_id))==true){
			  $ob = $cmpresult->fetch(PDO::FETCH_ASSOC);
			  $packageupdate = $ob["update_billing"];
			  $packagestatus = $ob["status"];
		
			  if ($packageupdate=='1'){
				 	    $_SESSION['message'] = "Failed to renew your subscription. Please update your billing information to keep your account active!.";
						$_SESSION['msg_type'] = "alert-warning";
						return true;
				}
				
			if ($packagestatus=='2'){
				 	    $_SESSION['message'] = "You are using the free trial. Please update your billing information to keep your account active!.";
						$_SESSION['msg_type'] = "alert-warning";
						return true;
				}
			
			if ($packagestatus=='1' || $packagestatus=='2'){
					return true;
					}
			
								  
			  
		  } else return false;
		  
		} 
  }
 
 public function revokeUser($stripe_user_id)
 {
	 		  $gen=new General($this->DBH);
			  $gen_group=$gen->getSetting('default_permission');
			  
			  $query= "SELECT user_id from subscriptions where stripe_customer_id=:user_id";
			  $cmpresult= $this->DBH->prepare($query);
			  $cmpresult->bindParam(':user_id', $stripe_user_id);
			  $cmpresult->execute();
			  $user_id = $cmpresult->fetchColumn();
			  
	   		  $query2= "DELETE from user_groups where user_id=:user_id and group_id!=:group_id";
			  $cmpresult2= $this->DBH->prepare($query2);
			  $cmpresult2->bindParam(':user_id', $user_id);
			  $cmpresult2->bindParam(':group_id', $gen_group);
			  $cmpresult2->execute();
			  
			  $query3= "UPDATE subscriptions set status='3', update_billing='0' where user_id=:user_id";
			  $cmpresult3= $this->DBH->prepare($query);
			  $cmpresult3->bindParam(':user_id', $user_id);
			return $cmpresult3->execute();
			
			  
			  
  }
  public function cancelSubscription($user_id){
	  $stripe_id= $this->getStripeCustomerId($user_id);
	  $customer=Stripe_Customer::retrieve($stripe_id);
	  foreach ($customer->subscriptions->data as $sub){
		  $customer->subscriptions->retrieve($sub['id'])->cancel();
	  }
	  
	  $query3= "UPDATE subscription set status='3' where user_id=:user_id";
			  $cmpresult3= $this->DBH->prepare($query);
			  $cmpresult3->bindParam(':user_id', $user_id);
			return $cmpresult3->execute();
	  
  }
  
   public function activateUser($user_id,$group_id,$status=1)
 {
 			$gquery= "select count(*) FROM user_groups where user_id=:user_id and group_id=:group_id";
			  $gresult= $this->DBH->prepare($gquery);
			  $gresult->bindParam(':user_id', $user_id);
			  $gresult->bindParam(':group_id', $group_id);
			  $gresult->execute();
			  $rows = $gresult->fetchColumn();
			  if ($rows==0){
			  		 $gquery= "INSERT INTO user_groups set user_id=:user_id, group_id=:group_id";
				  	 $gresult= $this->DBH->prepare($gquery);
				  	 $gresult->bindParam(':user_id',$user_id);
				  	 $gresult->bindParam(':group_id', $group_id);
				  	 $gresult->execute();
				 }
			$query= "UPDATE subscriptions set status=:status, update_billing='0' where user_id=:user_id";
			  $cmpresult= $this->DBH->prepare($query);
			  $cmpresult->bindParam(':user_id', $user_id);
			   $cmpresult->bindParam(':status', $status);
			  return $cmpresult->execute();
  }
     public function activateCustomer($customer_id,$plan_id)
 {
 			//determine group to join for this plan.
 			// get customer user_id and assign user to above groups
 			  $query= "SELECT user_id from subscriptions where stripe_customer_id=:user_id";
			  $cmpresult= $this->DBH->prepare($query);
			  $cmpresult->bindParam(':user_id', $customer_id);
			  $cmpresult->execute();
			  $user_id = $cmpresult->fetchColumn();
			  
			  $query= "SELECT user_group_id from subscription_plans where stripe_plan_id=:plan_id";
			  $cmpresult= $this->DBH->prepare($query);
			  $cmpresult->bindParam(':plan_id', $plan_id);
			  $cmpresult->execute();
			  $group_id = $cmpresult->fetchColumn();
			  $plan=$this->listPlans($plan_id);
			  if ($plan['trial_period_days']>0)
			  	$status=3;
			  	else
			  	$status=1;
			 if ($this->revokeUser($customer_id)==true){
				 
				  return $this->activateUser($user_id,$group_id,$status);
				 
			 }else
			 return false;
			 
			  	
	 }	
  
  
   public function createCustomer($user_id, $user_email, $status=3)
  {
			  $stripeArray=array();
			  $stripeArray["email"] = $user_email;
			 
			 $query= "SELECT COUNT(*) from subscriptions where user_id=:user_id";
		     $cmpresult= $this->DBH->prepare($query);
			 $cmpresult->bindParam(':user_id', $user_id);
			 $cmpresult->execute();
			 $rows = $cmpresult->fetchColumn();
		  if ($rows==0){
			  
			  //register customer with stripe
			 $customer = Stripe_Customer::create($stripeArray);
			 $stripe_id =$customer->id;
			  

			 
		  $query= "INSERT INTO subscriptions SET user_id=:user_id, status=:status, stripe_customer_id=:stripe_customer_id";
		  $cmpresult= $this->DBH->prepare($query);
		  $vars= array(':user_id' => $user_id, ':status'=>$status, 'stripe_customer_id'=>$stripe_id);
		  if ($cmpresult->execute( $vars)==true){
			  return true;

		  }
		 }
			  
			  
		
		 
  }
	

}

class Mailer
{
	public $DBH;	  

 function __construct($DBH)
	{
		$this->DBH = $DBH;

		 
	}
	
public function sendWelcome($name, $email, $code ){
		$gen = new General($this->DBH);
		$mandrill = new Mandrill($gen->getSetting('mandrill_key'));

		
				try {
			    
			    $template_name = 'boilerplate-new-user';
			    $template_content="";
				$message = array(
        
        'to' => array(
            array(
                'email' => $email,
                'name' => $name,
                'type' => 'to'
            )
        ),
        
        'global_merge_vars' => array(
            array(
                'name' => 'code',
                'content' => $code
            ),
              array(
                'name' => 'name',
                'content' => $name
            ),
        )
       
    ); 
			    
	$result = $mandrill->messages->sendTemplate($template_name,$template_content, $message);
			    
			} catch(Mandrill_Error $e) {
    // Mandrill errors are thrown as exceptions
    echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
    // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
    throw $e;
	} 
}
public function sendFailedBilling($name, $email ){
		$gen = new General($this->DBH);
		$mandrill = new Mandrill($gen->getSetting('mandrill_key'));

		
				try {
			    
			    $template_name = 'failed-payment';
			    $template_content="";
				$message = array(
        
        'to' => array(
            array(
                'email' => $email,
                'name' => $name,
                'type' => 'to'
            )
        ),
        
        'global_merge_vars' => array(
           array(
                'name' => 'name',
                'content' => $name
            ),
        )
       
    );
			    
	$result = $mandrill->messages->sendTemplate($template_name,$template_content, $message);
			    
			} catch(Mandrill_Error $e) {
    // Mandrill errors are thrown as exceptions
    echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
    // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
    throw $e;
	} 
}

public function resetPassword($name, $email, $code ){
		$gen = new General($this->DBH);
		$mandrill = new Mandrill($gen->getSetting('mandrill_key'));

		
				try {
			    
			    $template_name = 'reset-password';
			    $template_content="";
				$message = array(
        
        'to' => array(
            array(
                'email' => $email,
                'name' => $name,
                'type' => 'to'
            )
        ),
        
        'global_merge_vars' => array(
           array(
                'name' => 'name',
                'content' => $name
            ),
             array(
                'name' => 'code',
                'content' => $code
            )
        )
       
    );
			    
	$result = $mandrill->messages->sendTemplate($template_name,$template_content, $message);
			    
			} catch(Mandrill_Error $e) {
    // Mandrill errors are thrown as exceptions
    echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
    // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
    throw $e;
	} 
}
	
}
		  
?>	


