<?php
session_start();

require("index.php");

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