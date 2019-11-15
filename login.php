<?php
session_start();
if (isset($_SESSION["usuari"])) {
  session_destroy();
  session_unset();
  $_SESSION = [];
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
        <form action="index.php" method="post" enctype="multipart/form-data">
          <div class="uk-margin">
            <input name="usuari" class="uk-input uk-form-width-medium" type="text" placeholder="Usuari">
          </div>
          <div class="uk-margin">
            <input name="passwd" class="uk-input uk-form-width-medium" type="password" placeholder="Contrasenya">
          </div>
          <div class="uk-margin">
            <input class="uk-button uk-button-primary" type="submit" value="entrar">
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>