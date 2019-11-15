<?php

session_start();

if (!isset($_SESSION['usuari'])) {

      if(isset($_POST['usuari']) && isset($_POST['passwd']) && canLogIn($_POST['usuari'],$_POST['passwd'])) {
         
         $_SESSION['usuari'] = $_POST['usuari'];
      } else {
         header("Location: login.php");
         die();
      }
      
   
}
function canLogIn($user, $passwd){
   return $user == 'admin' && $passwd == '12345';
}
?>
