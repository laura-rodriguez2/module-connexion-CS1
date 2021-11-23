<?php
session_start();
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'moduleconnexion');
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($conn === false){
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
}

if(isset($_POST['submit'])) { 

    if(empty($_POST['login'])) {
        echo "Le champ Pseudo est vide.";
    } else {
        if(empty($_POST['password'])) {
            echo "Le champ Mot de passe est vide.";
        } else {
            $login = htmlentities($_POST['login']); 
            $password = htmlentities($_POST['password']);
            $mysqli = mysqli_connect('localhost', 'root', '', 'moduleconnexion');
            if(!$mysqli){
                echo "Erreur de connexion à la base de données.";
            } 
            else {
                $Requete = mysqli_query($mysqli,"SELECT * FROM utilisateurs WHERE login = '".$login."' and password='".hash('sha256', $password)."'");//si vous avez enregistré le mot de passe en md5() il vous suffira de faire la vérification en mettant mdp = '".md5($MotDePasse)."' au lieu de mdp = '".$MotDePasse."'
                
                if(mysqli_num_rows($Requete) == 0) {
                    echo "Le Login ou le mot de passe est incorrect, le compte n'a pas été trouvé.";
                }  
                if($login=="admin"and $password=="admin"){
                    header("location: admin.php");
                    echo "Vous êtes à présent connecté !";    
            }
            elseif($_SESSION['login'] = $login) {
                    header("location: profil.php");
                    echo "Vous êtes à présent connecté !";
                }
            }
        }
    }          
    // Trouver un moyen de ne pas acceder a la page admin si on ne l'est pas !!
    // Trouver un moyen de pas pouvoir s'inscrire avec le même login, mdp ect..
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
                    <li><a class="header_a" href="index.php">Accueil</a>
                    <li><a class="header_a" href="inscription.php">Inscription</a></li>
                    <li><a class="header_a" href="connexion.php">Connexion</a></li>
                    <li><a class="header_a" href="profil.php">Profil</a></li>
                </ul>   
            </nav>
        </header>
        <main id="main_la">
            <form id="form_inscription" action="" method="post" name="login">
            <h1 id="h1_inscription">Connexion</h1><br>
            <input type="text" class="box-input" name="login" placeholder="Login"><br>
            <input type="password" class="box-input" name="password" placeholder="Mot de passe"><br><br>
            <input type="submit" value="Connexion " name="submit" class="box_button"><br><br>
            <p class="box_register">Vous êtes nouveau ici? <a class="color_link" href="inscription.php">S'inscrire</a></p>
            </form>
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
