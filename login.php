<?php
session_start();
require('utils.php');
if (isset($_SESSION["usuari"])) {
  session_destroy();
  session_unset();
  $_SESSION = [];
} else {
  if (isset($_POST['usuari']) && isset($_POST['passwd']) && canLogIn($_POST['usuari'], $_POST['passwd'])) {
    $_SESSION['usuari'] = $_POST['usuari'];
    header("Location: index.php");
    die();
  }
}
function canLogIn($user, $passwd)
{
   $result = false;

   try {

      require('bbdd.php');
      $stmt = $dbh->prepare("SELECT password,id,lang FROM ra_user WHERE name = :user ");
      $stmt->bindParam(':user', $user);
      $stmt->execute();
      $row = $stmt->fetchColumn(0);
      if (isset($row) && !empty($row)) {
         $result = password_verify($passwd, $row);
         if ($result) {
            $row = $stmt->fetchColumn(1);
            if (isset($row) && is_numeric($row)) {
               $_SESSION['iduser'] = $row;
            }
            $row = $stmt->fetchColumn(2);
            if (isset($row) && !empty($row)) {
               $_SESSION['lang'] = $row;
            }
         }
      }
   } catch (Exception $e) { }
   return $result;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php include('csshead.php'); ?>
  <title>Document</title>
</head>

<body>
  <div id="head">
    <h2 class="uk-heading-line uk-text-center"><span>RAudio Login</span></h2>
  </div>
  <div class="uk-flex-center uk-child-width-1-4@s" uk-grid>
    <div>
      <div class="uk-card uk-card-default uk-card-body  uk-animation-shake">
        <form method="post" enctype="multipart/form-data">
          <div class="uk-margin">
            <input name="usuari" class="uk-input uk-form-width-medium" type="text" placeholder="Usuari">
          </div>
          <div class="uk-margin">
            <input name="passwd" class="uk-input uk-form-width-medium" type="password" placeholder="Contrasenya">
          </div>
          <div class="uk-margin">
            <input class="uk-button uk-button-primary" type="submit" value="<?php echo translate('web.login.enter',array())?>">
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>