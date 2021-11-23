<?php
// Informations d'identification
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'moduleconnexion');

// Connexion à la base de données MySQL 
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Vérifier la connexion
if($conn === false){
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
}
?>
<html>
    <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" />
    </head>
    <body>
        <header id="header_la">     
            <h1 id="h1">Titre</h1>
            <nav id="header_nav">
                <ul id="header_ul">
                    <li class="header_li"><a class="header_a" href="index.php">Accueil</a>
                    <li class="header_li"><a class="header_a" href="inscription.php">Inscription</a></li>
                    <li class="header_li"><a class="header_a" href="connexion.php">Connexion</a></li>
                    <li class="header_li"><a class="header_a" href="#footer_la">Contact</a></li>
                </ul>   
            </nav>
        </header>
        <main>

        </main>
        <footer id="footer_la">

        </footer>
    </body>
</html>