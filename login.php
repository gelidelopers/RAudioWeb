<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="css/uikit.min.css" />

    <!-- UIkit JS -->
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>

</head>

<body>
    <div id="head">
        <h2 class="uk-heading-line uk-text-center"><span>RAudio Login</span></h2>
    </div>
    <div class="uk-flex-center uk-child-width-1-4@s" uk-grid>
        <div>
            <div class="uk-card uk-card-default uk-card-body">
                <form action="main.php" method="post" enctype="multipart/form-data">
                    <div class="uk-margin">
                        <input class="uk-input uk-form-width-medium" type="text" placeholder="Usuari">
                    </div>
                    <div class="uk-margin">
                        <input class="uk-input uk-form-width-medium" type="password" placeholder="Contrasenya">
                    </div>

                    <div class="uk-margin">
                        <input class="uk-button uk-button-primary" type="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>