<?php

session_start();

if (!isset($_SESSION['usuari'])) {

   if (isset($_POST['usuari']) && isset($_POST['passwd']) && canLogIn($_POST['usuari'], $_POST['passwd'])) {

      $_SESSION['usuari'] = $_POST['usuari'];
   } else {
      header("Location: login.php");
      die();
   }
}

function canLogIn($user, $passwd)
{
   $result = false;

   try {

      require('bbdd.php');
      $stmt = $dbh->prepare("SELECT password,id FROM ra_user WHERE name = :user ");
      $stmt->bindParam(':user', $user);
      $stmt->execute();
      $row = $stmt->fetchColumn(0);
      if (isset($row) && !empty($row)) {
         $result = password_verify($passwd, $row);
         if ($result) {
            $row = $stmt->fetchColumn(1);
            if (isset($row) && !empty($row)) {
               $_SESSION['idusuari'] = $row;
            }
         }
      }
   } catch (Exception $e) { }
   return $result;
}
