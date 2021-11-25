<?php
session_start();
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'moduleconnexion');
$mysqli = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($mysqli === false){
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
}

// if (isset($_POST['login'], $_POST['prenom'], $_POST['nom'], $_POST['password'])){
        ////////////////// POST ACTION TO REGISTER NEW ADMIN ////////////////
        // $reg_name = inject_checker($connection, ucwords($_POST['reg_name']));
        // $reg_username = inject_checker($connection, strtolower($_POST['reg_username']));
        // $reg_password1 = inject_checker($connection, $_POST['reg_password1']);
        // $reg_password2 = inject_checker($connection, $_POST['reg_password2']);
        // $reg_phone = inject_checker($connection, $_POST['reg_phone']);
        // $reg_address = inject_checker($connection, $_POST['reg_address']);
        /////////// ERROR CHECKING FOR EMPTY FILEDS
        // if(empty($reg_name)){
        // $error_msg = "Name Field Can not be empty";
        // }
        // elseif(empty($reg_username)){
        // $error_msg = "Username Field Can not be empty";
        // }
        // elseif(empty($reg_password1)){
        // $error_msg = "Password Field Can not be empty";
        // }
        // elseif($reg_password1 !== $reg_password2){
        // $error_msg = "Password Do not Match";
        // }
        // elseif(empty($reg_phone)){
        // $error_msg = "Phone Field Can not be empty";
        // }
        // elseif(empty($reg_address)){
        // $error_msg = "Address Field Can not be empty";
        // }else{  
if(isset($_POST['submit'])){
            echo "ttest";
        $login = stripslashes($_REQUEST['login']);
        $login = mysqli_real_escape_string($mysqli, $login); 
        $prenom = stripslashes($_REQUEST['prenom']);
        $prenom = mysqli_real_escape_string($mysqli, $prenom);
        $nom = stripslashes($_REQUEST['nom']);
        $nom = mysqli_real_escape_string($mysqli, $nom);
        $password1 = stripslashes($_REQUEST['password']);
        $password1 = mysqli_real_escape_string($mysqli, $password1);
        $password2 = stripslashes($_REQUEST['password']);
        $password2 = mysqli_real_escape_string($mysqli, $password2);
            echo "1";
        if($password1 !== $password2){
            echo "Password Do not Match";
        }
        $query = "SELECT * FROM utilisateurs WHERE login = '$login' ";
        $run_query = mysqli_query($mysqli, $query);
            echo "3";
        if(mysqli_num_rows($run_query) > 0){
            $error_msg = "Error: This User Alreaddy Exist";
        }
        else{
        $query2 = "INSERT INTO utilisateurs(login, nom, prenom, password)
        VALUES('$login', '$nom', '$prenom', '$password')";
        $run_query2 = mysqli_query($mysqli, $query2);
        echo "4";
        }               
        if($run_query2 == true){
        echo  "Admin Registration Successful";
        }
        else{
        echo  "Admin Registration Failed!";
        }
        }
        

//verification meme login
    // $result= mysqli_query($mysqli, "SELECT * FROM utilisateurs WHERE login = $_POST[login]");
    //     $count= mysqli_num_rows($result);  

//requete inscription

    // $query = "INSERT into `utilisateurs` (login, prenom, nom, password)
    //         VALUES ('$login', '$prenom', '$nom', '".hash('sha256', $password)."')";
    //     $res = mysqli_query($mysqli, $query);
    // if($count > 0){
    //     echo "Ce login existe déjà";
    // }
    // elseif($res==1){
    //     echo "<div class='sucess'>
    //         <h3>Vous êtes inscrit avec succès.</h3>
    //         <p><a href='connexion.php'>Cliquez ici pour vous connecter</a></p>
    //     </div>";
    // }
    // else{
    // } 
// }
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
                        <?php /*echo $msg_success; 
                                echo $error_msg */?>
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