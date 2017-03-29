<?php 
ob_start();


#######################
#
# Data Base Connection
#
#######################

define('SURL', 'URLHERE');

try {
  
  # MySQL with PDO_MYSQL
  $DBH = new PDO("mysql:host=localhost;dbname=name", 'user_name', 'password');
 
  }
catch(PDOException $e) {
    echo $e->getMessage();
}

?>
