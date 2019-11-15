<nav class="uk-navbar-container" uk-navbar>
    <div class="uk-navbar-left">

        <ul class="uk-navbar-nav">
            <li><a href="index.php">Inici</a></li>
            <li>
                <a href="#">Audio</a>
                <div class="uk-navbar-dropdown">
                    <ul class="uk-nav uk-navbar-dropdown-nav">
                        <li><a href="enconstruccio.php">Importar</a></li>
                        <li><a href="enconstruccio.php">Llibreria musica</a></li>
                        <li><a href="enconstruccio.php">Llibreria programes</a></li>
                        <li><a href="enconstruccio.php">Llibreria publicitat</a></li>
                        <li><a href="enconstruccio.php">Llibreria indicatius</a></li>
                        <li><a href="enconstruccio.php">Llibreria sintonies</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <a href="#">Programació</a>
                <div class="uk-navbar-dropdown">
                    <ul class="uk-nav uk-navbar-dropdown-nav">
                        <li><a href="enconstruccio.php">Programes</a></li>
                        <li><a href="enconstruccio.php">Blocs publcitaris</a></li>
                        <li><a href="enconstruccio.php">Temporades</a></li>
                        <li><a href="enconstruccio.php">Fórmules auto DJ</a></li>
                    </ul>
                </div>
            </li>
        </ul>

    </div>
    <div class="uk-navbar-right">
        <ul class="uk-navbar-nav">
            <li>
                <a href="#"><?php echo $_SESSION['usuari']; ?></a>
                <div class="uk-navbar-dropdown">
                    <ul class="uk-nav uk-navbar-dropdown-nav">
                        <li><a href="login.php">Sortir</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>