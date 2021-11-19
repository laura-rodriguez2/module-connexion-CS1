<?php
/*
Page: connexion.php
*/
require("index.php");
session_start(); // à mettre tout en haut du fichier .php, cette fonction propre à PHP servira à maintenir la $_SESSION
if(isset($_POST['submit'])) { // si le bouton "Connexion" est appuyé
    // on vérifie que le champ "Pseudo" n'est pas vide
    // empty vérifie à la fois si le champ est vide et si le champ existe belle et bien (is set)
    if(empty($_POST['login'])) {
        echo "Le champ Pseudo est vide.";
    } else {
        // on vérifie maintenant si le champ "Mot de passe" n'est pas vide"
        if(empty($_POST['password'])) {
            echo "Le champ Mot de passe est vide.";
        } else {
            // les champs sont bien posté et pas vide, on sécurise les données entrées par le membre:
            $login = htmlentities($_POST['login']); // le htmlentities() passera les guillemets en entités HTML, ce qui empêchera les injections SQL
            $password = htmlentities($_POST['password']);
            //on se connecte à la base de données:
            $mysqli = mysqli_connect('localhost', 'root', '', 'moduleconnexion');
            //on vérifie que la connexion s'effectue correctement:
            if(!$mysqli){
                echo "Erreur de connexion à la base de données.";
            } 
            else {
                // on fait maintenant la requête dans la base de données pour rechercher si ces données existe et correspondent:
                $Requete = mysqli_query($mysqli,"SELECT * FROM utilisateurs WHERE login = '".$login."' and password='".hash('sha256', $password)."'");//si vous avez enregistré le mot de passe en md5() il vous suffira de faire la vérification en mettant mdp = '".md5($MotDePasse)."' au lieu de mdp = '".$MotDePasse."'
                // si il y a un résultat, mysqli_num_rows() nous donnera alors 1
                // si mysqli_num_rows() retourne 0 c'est qu'il a trouvé aucun résultat
                if(mysqli_num_rows($Requete) == 0) {
                    echo "Le pseudo ou le mot de passe est incorrect, le compte n'a pas été trouvé.";
                }  
                if($login=="admin"and $password=="admin"){
                  $_SESSION['login'] = $login; // la session peut être appelée différemment et son contenu aussi peut être autre chose que le pseudo
                    header("location: admin.php");
                    echo "Vous êtes à présent connecté !";    
            }
            else {
                    // on ouvre la session avec $_SESSION:
                     // la session peut être appelée différemment et son contenu aussi peut être autre chose que le pseudo
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
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
<form class="box" action="" method="post" name="login">
<h1 class="box-title">Connexion</h1>
<input type="text" class="box-input" name="login" placeholder="Login">
<input type="password" class="box-input" name="password" placeholder="Mot de passe">
<input type="submit" value="Connexion " name="submit" class="box-button">
<p class="box-register">Vous êtes nouveau ici? <a href="inscription.php">S'inscrire</a></p>
</form>
</body>
</html> 
