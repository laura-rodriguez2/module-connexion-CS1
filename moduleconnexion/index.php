<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'moduleconnexion');
$mysqli = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($mysqli === false){
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
}

if(isset($_POST['Login'])){
    //enlever bouton inscription et connexion(le changer par déconnexion) dans le header
}
else{
    //afficher
}
?>
<html>
    <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" />
    </head>
    <body>
        <header id="header_la">     
            <h1 id="h1">Module de connexion</h1>
            <nav id="header_nav">
                <ul id="header_ul">
                    <li><a class="header_a" href="index.php">Accueil</a>
                    <li><a class="header_a" href="inscription.php">Inscription</a></li>
                    <li><a class="header_a" href="connexion.php">Connexion</a></li>
                    <li><a class="header_a" href="profil.php">Profil</a></li>
                </ul>   
            </nav>
        </header>
        <main id="main_la">
            
        </main>
        <footer id="footer_la">
            <nav id="footer_nav">
                <ul id="footer_ul">
                    <h2 id="h2">Réseaux Sociaux</h2>
                    <li><a href="https://twitter.com/home">Twitter</li>
                    <li><a href="https://www.instagram.com/aik0sann/?hl=fr">Instagram</li>
                    <li><a href="https://github.com/laura-rodriguez2/module-connexion">GitHub</li>
                </ul>
            </nav>
        </footer>
    </body>
</html>