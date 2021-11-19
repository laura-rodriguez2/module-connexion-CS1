
<?php
require('index.php');
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
?>
<form class="box" action="" method="post">
    <h1 class="box-title">Modifier mes informations</h1>
  <input type="text" class="box-input" name="login" placeholder="Login" required />
    <input type="text" class="box-input" name="prenom" placeholder="prenom" required />
    <input type="text" class="box-input" name="nom" placeholder="nom" required />
    <input type="password" class="box-input" name="password" placeholder="Mot de passe" required />
    <input type="password" class="box-input" name="password" placeholder="Confirmez votre mot de passe" required />
    <input type="submit" name="submit" value="Enregistrer mes informations" class="box-button" />
    <!-- <p class="box-register">Déjà inscrit? <a href="connexion.php">Connectez-vous ici</a></p> -->
</form>
<?php } ?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css" />
</head>
<body>
<header>
</header>
</body>
</html>