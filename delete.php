<?php require('auth.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="description" content="A layout example with a side menu that hides on mobile, just like the Pure website.">
    <title>Responsive Side Menu &ndash; Layout Examples &ndash; Pure</title>
    <?php include('csshead.php'); ?>
</head>

<body>
    <?php include('navbar.php'); ?>
    <h1>Segur que vols borrar el registre <?php if (isset($_GET['name'])) echo $_GET['name']; ?> ?</h1>
    <a class="uk-button uk-button-primary uk-margin" href="#">FUCK GO BACK</a>
    <a class="uk-button uk-button-danger uk-margin" href="#">si home si</a>
</body>

</html>