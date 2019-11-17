<?php require('auth.php');
require('utils.php');
?>
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
    <div class="uk-containter">
        <h1><?php echo (translate('web.index.h1', 'ca-ES')); ?></h1>
        <?php showDataTable('select id, name, email from ra_contact','select count(*) from ra_contact',array(),array('id','name','email'))?>
    </div>
</body>

</html>