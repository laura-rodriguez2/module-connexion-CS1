<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', '1');

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'moduleconnexion');
$mysqli = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($mysqli === false){
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
}
if(isset($_POST["submit"])) { 
    $login = stripslashes($_REQUEST['login']);
    $login = mysqli_real_escape_string($mysqli, $login); 
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($mysqli, $password);
            $requete = mysqli_query($mysqli,"SELECT login, password FROM utilisateurs WHERE login = '".$login."' and password='".hash('sha256', $password)."'");
            $row = mysqli_fetch_assoc($requete); 

            

// Validation du formulaire
if (isset($_POST['login']) &&  isset($_POST['password'])) {
    foreach ($utilisateurs as $utilisateur) {
        if (
            $utilisateur['login'] === $_POST['login'] &&
            $utilisateur['password'] === $_POST['password']
        ) {
            $loggedUser = [
                'login' => $utilisateur['login'],
            ];
        } else {
            $errorMessage = sprintf('Les informations envoyées ne permettent pas de vous identifier : (%s/%s)',
                $_POST['login'],
                $_POST['password']);
        }
    }
    var_dump($loggedUser);
}
}
if(!isset($loggedUser)): ?>
<form action="index.php" method="post">
    <!-- si message d'erreur on l'affiche -->
    <?php if(isset($errorMessage)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif; ?>
    <div class="mb-3">
        <label for="login" class="header_a">login</label>
        <input type="login" class="header_a" name="login" placeholder="login">
        <div>Le login utilisé lors de la création de compte.</div>
    </div>
    <div class="mb-3">
        <label for="password" class="header_a">Mot de passe</label>
        <input type="password" class="header_a" id="password" name="password">
    </div>
    <button type="submit" class="box_button">Envoyer</button>
</form>
<!-- 
    Si utilisateur/trice bien connectée on affiche un message de succès
-->
<?php else: ?>
    <div class="alert alert-success" role="alert">
        Bonjour <?php echo $loggedUser['login']; ?> et bienvenue sur le site !
    </div>
<?php endif; ?>

<?php
/*
form method post; action"";
select => fetch =>count si 0=> good si1=>not good
session['login']=$POST['login']
c'est connecté normalement

suite 

connexion bdd = bon
verifier si le login est present en bdd
$login = $POST["user];
$password=$POST["password;]
if(isset $POST["login"] et $POST["password"]){      (en plus pour verifier)
    echo ok ?
}
    if(isset($login)){    c'est mieux de mettre seulement isset login plutot que isset login ET isset mdp, permet d'avoir msg d'erreur plus clair
        $req="SELECT * WHERE login=$login";
        $req=mysqli_query($req);
        $result=fetch assoc         (fetch pour que ça donne les numeros, fetch assoc pour les noms)
        if(count($result=0)){
            $mdpBDD=$result[0]["mdp]
        }
        if($mdp==mdpBDD){
            $session["user]=$login
            (on peut mettre d'autre variable de session comme $session["nom]=$nom)
        }
        else{
            wrong mdp
        }
        else{
            wrong login
        }
        }
    }

*/
?>



<?php
// if($mysqli['id'] === 1){
//     // $_SESSION ['loggedin'] = true;
//     $_SESSION ['login'] = $row['admin'];
//     echo "Vous êtes connecté en tant qu'admin";
// }
// if($row['login'] === $_POST['login'] &&
//     $row['password'] === $_POST['password']){ 

//     $_SESSION ['loggedin'] = true;
//     $_SESSION ['login'] = $row['login'];
//     echo "Vous êtes connecté";
// }
// else{
//     $_SESSION['loggedin'] = false;
//     $_SESSION ['login'] = 0;
//     echo "Login ou mot de passe incorrect";
// }
// if ($_POST['login'] == $row['login'] && 
//                 $_POST['password'] == $row['password']) {
//                 $_SESSION['valid'] = true;
//                 $_SESSION['login'] = $_POST['login'];
                
//                 echo "You have entered valid use name and password";
// }else {
//                 echo  "Wrong username or password";
// }
// }

//                 if(mysqli_num_rows($Requete) == 0) {
//                     echo "Le Login ou le mot de passe est incorrect, le compte n'a pas été trouvé.";
//                 }  
//                 if($login=="admin" and $password=="admin"){
//                     header("location: admin.php");
//                     echo "Vous êtes à présent connecté !";    
//             }
//             elseif($_SESSION['login']) {
//                     header("location: profil.php");
//                     echo "Vous êtes à présent connecté !";
//                 }
            


// if(isset($_POST['login']))
// { 
//    echo "<li><a class='header_a' name='profil' href='profil.php'>Profil</a></li>"; 
//    echo "<li><a class='header_a' name='deconnexion' href='index.php'>Déconnexion</a></li>";
// }  
// else{
//     echo "<li><a class='header_a' name='inscription' href='inscription.php'>Inscription</a></li>";
//     echo "<li><a class='header_a' name='connexion' href='connexion.php'>Connexion</a></li>";
// }

// $btn1 = "inscription";
// $btn2 = "connexion";

// $btn3 = "profil";
// $btn4 = "deconnexion";
//     if(isset($_POST['login'])){
//         $btn1;
//         $btn2;
//     }
//     else{
//         $btn3;
//         $btn4;
//     }
    // Trouver un moyen de ne pas acceder a la page admin si on ne l'est pas !!
    // Trouver un moyen de pas pouvoir s'inscrire avec le même login, mdp ect..
    // function getLogin($login, $password)
    // {
        // Your query goes here to get Login info based on given $user and $pass. 
    //     $_SESSION['user_logged_in'] = true;
    // }
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
        <?php
        if (!isset($_SESSION["login"])){?>
            <!-- <button type= 'submit' name ='connexion' value = 'connexion' class='header_a'>Connexion</button> -->
            <form method = 'POST' action = 'index.php'>   
            <button type= 'submit' name ='profil' value = 'profil' class='header_a'>Profil</button>
            <button type= 'submit' name ='deconnexion' value = 'deconnexion' class='header_a'>Déconnexion</button>
                </form>
        <?php }else { ?>
            <li><p class='header_a'><a href='connexion.php'>Connexion</a></p></li>
            <li><p class='header_a'><a href='inscription.php'>Inscription</a></p></li>
            
        
        <?php } if(isset($_POST["deconnexion"])){
        session_destroy() ;
        header('location:index.php');
        } 
        ?>
                <!-- <ul id="header_ul">
                    <li><a class="header_a" href="index.php">Accueil</a>
                    <li><a class="header_a" name="inscription" href="inscription.php">Inscription</a></li>
                    <li><a class="header_a" name="connexion" href="connexion.php">Connexion</a></li> 
                    <li><a class="header_a" name="profil" href="profil.php">Profil</a></li> 
                </ul>    -->
            </nav>
        </header>
        <main id="main_la">
            <div id="deplacement_form">
                <form id="form_inscription" action="" method="post" name="login">
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
