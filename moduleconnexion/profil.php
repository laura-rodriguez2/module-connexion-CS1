
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

if (isset($_REQUEST['login'], $_REQUEST['prenom'], $_REQUEST['nom'], $_REQUEST['password'])){
  // récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
  $login = stripslashes($_REQUEST['login']);
  $login = mysqli_real_escape_string($conn, $login); 
  // récupérer l'email et supprimer les antislashes ajoutés par le formulaire
  $prenom = stripslashes($_REQUEST['prenom']);
  $prenom = mysqli_real_escape_string($conn, $prenom);
  $nom = stripslashes($_REQUEST['nom']);
  $nom = mysqli_real_escape_string($conn, $nom);
  // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
  $password = stripslashes($_REQUEST['password']);
  $password = mysqli_real_escape_string($conn, $password);
  $id='id';
  //requéte SQL + mot de passe crypté
    $query = "UPDATE utilisateurs
            SET login = '$login', prenom = '$prenom', nom = '$nom', password = '$password'
            WHERE id=$id";
  // Exécuter la requête sur la base de données
    $res = mysqli_query($conn, $query);
    if($res){
        echo "<div class='sucess'>
                <h3>Vos informations ont été enregistrées.</h3>
            </div>";
    }
}else{
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
          <form id="form_inscription" action="" method="post">
              <h1 id="h1_inscription">Modifier mes informations</h1><br>
            <input type="text" class="box-input" name="login" placeholder="Login" required /><br>
              <input type="text" class="box-input" name="prenom" placeholder="prenom" required /><br>
              <input type="text" class="box-input" name="nom" placeholder="nom" required /><br>
              <input type="password" class="box-input" name="password" placeholder="Mot de passe" required /><br>
              <input type="password" class="box-input" name="password" placeholder="Confirmez votre mot de passe" required /><br><br>
              <input type="submit" name="submit" value="Enregistrer mes informations" class="box_button" /><br>
              <!-- <p class="box-register">Déjà inscrit? <a href="connexion.php">Connectez-vous ici</a></p> -->
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
