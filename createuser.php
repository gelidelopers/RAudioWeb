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

    <h2 class="uk-heading-line uk-text-center"><span>Create admin user</span></h2>
    </div>
    <div class="uk-flex-center uk-child-width-1-4@s" uk-grid>
        <div>
            <?php
            if (isset($_POST['usuari']) && isset($_POST['passwd']) && !empty($_POST['usuari']) && !empty('passwd')) {
                require('bbdd.php');
                $password = password_hash($_POST['passwd'], PASSWORD_DEFAULT);
                $stmt = $dbh->prepare("INSERT INTO ra_user (name, password) VALUES (:user, :passwd)");
                $stmt->bindParam(':user', $_POST['usuari']);
                $stmt->bindParam(':passwd', $password);
                if ($stmt->execute()) {
                    echo '<div class="uk-alert-success" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p>Usuari ' . $_POST['usuari'] . 'creat correctament</p>
            </div>
            ';
                } else {
                    echo '<div class="uk-alert-danger" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p>Error al crear el usuari: ' . $stmt->errorInfo() . '</p>
            </div>
            ';
                }
            }

            ?>
            <div class="uk-card uk-card-default uk-card-body">
                <form method="post" enctype="multipart/form-data">
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