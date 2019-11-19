<?php require('auth.php');
require('utils.php');
require('bbdd.php'); ?>
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
    <?php

    if (isset($_GET['table']) && isset($_GET['id'])) {

        if (isset($_POST['sure']) && $_POST['sure'] == 'yes') {
            $err = delete($_GET['id'], $_GET['table']);
            if (!empty($err)) {
                echo '<div class="uk-alert-danger" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p> Error :( ' . $err . '</p>
            </div>
            ';
            } else {
                echo '<div class="uk-alert" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p>bORRAT</p>
            </div>
            ';
            }
        } else {

            ?>
            <h1>Segur que vols borrar el registre <?php if (isset($_GET['name'])) echo $_GET['name']; ?> ?</h1>
            <a class="uk-button uk-button-primary uk-margin" href="index.php"><?php echo translate('web.datatables.delete.notsure', 'ca-ES') ?></a>
            <form method="post"><input type="invisible" name="sure" value="yes"><input class="uk-button uk-button-danger uk-margin" href="" type="submit">si home si</input></form>
    <?php
        }
    } else {
        echo '<div class="uk-alert-danger" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p>Queisieron</p>
            </div>
            ';
    }


    ?>
</body>

</html>

<?php



function delete($id, $table)
{

    if ($table == 'ra_user' && $id == 1) {
        return 'no es pot borrar el super admin';
    }
    try {
        require('bbdd.php');

        $stmt = $dbh->prepare(buildQuery($table));
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) { } else {
            return $stmt->errorCode() . ": " . $stmt->erorInfo();
        }
    } catch (Exception $e) {
        return 'error';
    }
}

function buildQuery($table)
{
    if ($table == 'ra_contact') {
        return 'DELETE FROM ra_contact WHERE id = :id';
    }
}

?>