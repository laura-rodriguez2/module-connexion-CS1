<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=moduleconnexion', 'root', '');
if(isset($_SESSION['id']) && $_SESSION['id'] > 0){
    $requtilisateur = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = ?');
    $requtilisateur->execute(array($_SESSION['id']));
    $infoutilisateur = $requtilisateur->fetch();

    if(isset($_POST['newlogin']) && !empty($_POST['newlogin']) && $_POST['newlogin'] != $infoutilisateur['login']){
        $login= $_POST['newlogin']; 
        $requetelogin = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?"); // Vérifier encore une fois si le login existe déjà 
        $requetelogin->execute(array($login));
        $loginexist = $requetelogin->rowCount(); 

        if($loginexist !== 0){
            $msg = "Le login existe déjà !";
        }
        else { // Créer une nouvelle session avec le nouveau login
        $newlogin = htmlspecialchars($_POST['newlogin']);
        $insertlogin = $bdd->prepare("UPDATE utilisateurs SET login = ? WHERE id = ?");
        $insertlogin->execute(array($newlogin, $_SESSION['id']));
        $_SESSION['login']=$newlogin; 
        header('Location: profil.php');
        }
    }
    if(isset($_POST['newnom']) && !empty($_POST['newnom']) && $_POST['newnom'] != $infoutilisateur['nom'])
    {
        // Créer une nouvelle session avec le nouveau nom
        $newnom = htmlspecialchars($_POST['newnom']);
        $insertnom = $bdd->prepare("UPDATE utilisateurs SET nom = ? WHERE id = ?");
        $insertnom->execute(array($newnom, $_SESSION['id']));
        header('Location: profil.php');
    }
    if(isset($_POST['newprenom']) && !empty($_POST['newprenom']) && $_POST['newprenom'] != $infoutilisateur['prenom'])
    {
        // Créer une nouvelle session avec le nouveau prenom
        $newprenom = htmlspecialchars($_POST['newprenom']);
        $insertprenom = $bdd->prepare("UPDATE utilisateurs SET prenom = ? WHERE id = ?");
        $insertprenom->execute(array($newprenom, $_SESSION['id']));
        header('Location: profil.php');
    }
    if(isset($_POST['newmdp']) && !empty($_POST['newmdp']) && isset($_POST['newmdp2']) && !empty($_POST['newmdp2'])) { //Confirmation des 2 mdp
    $mdp1 = $_POST['newmdp'];
    $mdp2 = $_POST['newmdp2'];
        
        if($mdp1 == $mdp2)
        {
            $hachage = password_hash($mdp1, PASSWORD_BCRYPT);
            $insertmdp = $bdd->prepare("UPDATE utilisateurs SET password = ? WHERE id = ?");
            $insertmdp->execute(array($hachage, $_SESSION['id']));
            header('Location: profil.php');
        }
        else
        {
            $msg = "Vos mots de passes ne correspondent pas !";
        }
    }
    if(isset($_POST['newlogin']) && $_POST['newlogin'] == $infoutilisateur['login'])
    {
        header('Location: profil.php');
    }
?>
<html>
    <head>
    <link rel="stylesheet" href="style.css">
        <title>Edition du profil</title>
        <meta charset="utf-8">
    </head>
    <body>
        <header>
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
        </header>
            <div id="editer">
            <form method="POST" action="">
            <table> 
                <h1>Editer son profil</h1>
                <br />
                <tr>
                    <td align="right">    
                    <label for="login">Login :</label><br /><br />
                    </td>
                    <td>
                    <input type="text" name="newlogin" placeholder="Login" value="<?php echo $infoutilisateur['login']; ?>"> <br /><br />
                    </td>
                    </tr>
                    <td align="right">    
                    <label for="prenom">Prenom :</label><br /><br />
                    </td>
                    <td>
                    <input type="text" name="newnom" placeholder="Nom" value="<?php echo $infoutilisateur['nom']; ?>"> <br /><br />
                    </td>
                    </tr>
                    <td align="right">    
                    <label for="nom">Nom :</label><br /><br />
                    </td>
                    <td>
                    <input type="text" name="newprenom" placeholder="Prenom" value="<?php echo $infoutilisateur ['prenom']; ?>"> <br /><br />
                    </td>
                    </tr>
                    <td align="right">    
                    <label for="newmdp">Password :</label><br /><br />
                    </td>
                    <td>
                    <input type="password" name="newmdp" placeholder="Mot de passe" > <br /><br />
                    </td>
                    </tr>
                    <td align="right">    
                    <label for="newmdp2">Confirmation du password :</label><br /><br />
                    </td>
                    <td>
                    <input type="password" name="newmdp2" placeholder="Confirmation mot de passe" > <br /><br />
                    </td>
                </tr>
            </table>

            <?php 
        if(isset($msg))
        {
        echo '<font color="red">'.$msg.'</font><br /><br />'; 
        }
        ?>
            <a href="profil.php">
            <input type="submit" name="confirmation" value="Confirmer">
            </a>
            <br><br>
            <form method="POST" action="profil.php">
            <input type="submit" name="Retour" value="Retour" >
            </form>
        </div>
    </body>
</html>
<?php
}
else 
{
header("Location: connexion.php");
}

?>