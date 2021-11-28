<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=moduleconnexion', 'root', ''); 
// $bdd = new PDO('mysql:host=localhost;dbname=laura-rodriguez_moduleconnexion', 'Laura', 'Rodriguez'); //Connexion à la base de données
if(isset($_POST['submit'])){
    $login = htmlspecialchars($_POST['login']); 
    $password = $_POST['password'];
    
    if(!empty($login) AND !empty($password)){
        $requeteutilisateur = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?"); // Vérifier si le login est le même que dans la base de données
        $requeteutilisateur->execute(array($login));  
        $result = $requeteutilisateur->fetchAll();  
            if (count($result) > 0){  // S'il n'y a pas de login trouvé dans la bdd, alors ça retourne "Mauvais Login"
                $sqlPassword = $result[0]['password'];
                if(password_verify($password, $sqlPassword)){ // Permet de vérifier si les 2 mots de passes sont identiques
                    $_SESSION['id'] = $result[0]['id'];  //créé une session avec les éléments de la table utilisateurs
                    $_SESSION['login'] = $result[0]['login'];
                    $_SESSION['nom'] = $result[0]['nom'];
                    $_SESSION['prenom'] = $result[0]['prenom'];
                        header("Location: profil.php");   //Redirige sur la page profil
                }
                else{ $erreur = "Mauvais login !"; }
            }
                else{ $erreur = "Mauvais mot de passe !"; }
                if ($_SESSION['login'] == 'admin'){  //Si le login et le mdp rentré est "admin" alors ça redirige sur la page admin à la place de profil.php
                    header("Location: admin.php");
                }
    }
                else{ $erreur = "Tous les champs doivent être remplis !"; }
}
?>
<html>
    <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" />
    <title>Connexion</title>
    </head>
    <body>
        <header id="header_la">     
            <h1 id="h1">Module de connexion</h1>
            <nav id="header_nav">
                <ul id="header_ul">
                    <li><a class="header_a" href="index.php">Accueil</a>
                    <li><a class="header_a" name="inscription" href="inscription.php">Inscription</a></li>
                    <li><a class="header_a" name="connexion" href="connexion.php">Connexion</a></li> 
                    <li><a class="header_a" name="profil" href="profil.php">Profil</a></li> 
                </ul>   
            </nav>
        </header>
        <main id="main_la">
            <div id="deplacement_form">
                <form id="form_inscription" action="" method="post" name="login">
                    <div style="color: yellow;"><?php
                        if (isset($erreur)){
                            echo $erreur;
                        }
                    ?></div>
                    <h2 id="h1_inscription">Connexion</h1><br>
                        <input type="text" class="box-input" name="login" placeholder="Login" required><br>
                        <input type="password" class="box-input" name="password" placeholder="Mot de passe" required><br><br>
                        <input type="submit" value="Se connecter" name="submit" class="box_button"><br><br>
                        <p class="box_register">Vous êtes nouveau ici? <a class="color_link" href="inscription.php">S'inscrire</a></p>
                </form>
            </div>
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