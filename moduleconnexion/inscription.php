<?php
    $bdd = new PDO('mysql:host=localhost;dbname=moduleconnexion', 'root', '');
        if (isset($_POST['submit'])){
            $erreur = "";  
            $login = htmlspecialchars($_POST['login']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $nom = htmlspecialchars($_POST['nom']);
            $password = htmlspecialchars($_POST["password"]);
            $confirmation = htmlspecialchars ($_POST['password2']);

        if (!empty($_POST['login']) AND !empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['password']) AND !empty($_POST['password2'])){
            $loginlenght = strlen($login);  //Permet de calculer la longueur du login
            $requete=$bdd->prepare("SELECT * FROM utilisateurs WHERE login = ? "); 
            $requete->execute(array($login));
            $loginexist= $requete->rowCount();


            if ($loginlenght > 255)
            $erreur= "Votre pseudo ne doit pas depasser 255 caractères !";        
            elseif($password !== $confirmation)
                    $erreur="Les mots de passes sont differents !";
            if($loginexist !== 0)
            $erreur = "Login deja pris !";
            if($erreur == ""){
                $hashage = password_hash($password, PASSWORD_BCRYPT);
                $insertmbr= $bdd->prepare("INSERT INTO utilisateurs(login, prenom, nom, password) VALUES(?, ?, ?, ?)");
                $insertmbr->execute(array($login, $prenom, $nom, $hashage));
                $erreur = "Votre compte à bien été crée !";
            }
        }
            else{
                $erreur="Tout les champs doivent etre remplis !";
            }
}?>
<!doctype html>
<html>
    <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" />
    <title>Inscription</title>
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
            <div id="deplacement_form">
                <form id="form_inscription" action="" method="post">
                    <div style="color: yellow;"><?php
                    if (isset($erreur)){
                        echo $erreur;
                    }
                    ?></div>
                    <h2 id="h1_inscription">S'inscrire</h1><br>
                        <input type="text" class="box-input" name="login" placeholder="Login" required /> <br>
                        <input type="text" class="box-input" name="prenom" placeholder="prenom" required /> <br>
                        <input type="text" class="box-input" name="nom" placeholder="nom" required /> <br>
                        <input type="password" class="box-input" name="password" placeholder="Mot de passe" required /> <br>
                        <input type="password" class="box-input" name="password2" placeholder="Confirmez votre mot de passe" required /> <br><br>
                        <input type="submit" name="submit" value="S'inscrire" class="box_button" /> <br><br>
                        <p id="box_register">Déjà inscrit? <a class="color_link" href="connexion.php">Connectez-vous ici</a></p> 
                </form>
                </div>
    
</div>
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