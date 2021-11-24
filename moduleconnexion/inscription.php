<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'moduleconnexion');
$mysqli = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($mysqli === false){
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
}

if (isset($_REQUEST['login'], $_REQUEST['prenom'], $_REQUEST['nom'], $_REQUEST['password'])){
    $login = stripslashes($_REQUEST['login']);
    $login = mysqli_real_escape_string($mysqli, $login); 
    $prenom = stripslashes($_REQUEST['prenom']);
    $prenom = mysqli_real_escape_string($mysqli, $prenom);
    $nom = stripslashes($_REQUEST['nom']);
    $nom = mysqli_real_escape_string($mysqli, $nom);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($mysqli, $password);
    
//verification meme login
    $result= mysqli_query($mysqli, "SELECT * FROM utilisateurs WHERE login = $_POST[login]");
        $count= mysqli_fetch_all($mysqli, $result);  
    if($count==1){
        echo "Ce login existe déjà";
    }
//requete inscription
    $query = "INSERT into `utilisateurs` (login, prenom, nom, password)
            VALUES ('$login', '$prenom', '$nom', '".hash('sha256', $password)."')";
        $res = mysqli_query($mysqli, $query);
    
    if($res==1){

        echo "<div class='sucess'>
            <h3>Vous êtes inscrit avec succès.</h3>
            <p><a href='connexion.php'>Cliquez ici pour vous connecter</a></p>
        </div>";
    }
    else{
    } 
}
// "INSERT INTO login FROM utilisateurs";

    // fetch (fetch all, fetch array..) =>count dans le cas ou c'est égal à 0=>login free
    //                              c'est égal à 1=>login utilisé 
    // "INSERT INTO ...";
/* 
savoir si le login est deja utilisé 
SELECT * FROM utilisateurs WHERE login =$POST['login'];
et pas oublier etape 1(apres connexion bdd) : form method post; action"";
*/
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
          <div id="deplacement_form">
            <form id="form_inscription" action="" method="post">
                <h2 id="h1_inscription">S'inscrire</h1><br>
                  <input type="text" class="box-input" name="login" placeholder="Login" required /> <br>
                  <input type="text" class="box-input" name="prenom" placeholder="prenom" required /> <br>
                  <input type="text" class="box-input" name="nom" placeholder="nom" required /> <br>
                  <input type="password" class="box-input" name="password" placeholder="Mot de passe" required /> <br>
                  <input type="password" class="box-input" name="password" placeholder="Confirmez votre mot de passe" required /> <br><br>
                  <input type="submit" name="submit" value="S'inscrire" class="box_button" /> <br><br>
                  <p id="box_register">Déjà inscrit? <a class="color_link" href="connexion.php">Connectez-vous ici</a></p> 
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