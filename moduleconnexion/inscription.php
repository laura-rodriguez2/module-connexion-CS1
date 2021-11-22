<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css" />
</head>
<body>
<?php
require('index.php');
if (isset($_REQUEST['login'], $_REQUEST['prenom'], $_REQUEST['nom'], $_REQUEST['password'])){
  $login = stripslashes($_REQUEST['login']);
  $login = mysqli_real_escape_string($conn, $login); 
  $prenom = stripslashes($_REQUEST['prenom']);
  $prenom = mysqli_real_escape_string($conn, $prenom);
  $nom = stripslashes($_REQUEST['nom']);
  $nom = mysqli_real_escape_string($conn, $nom);
  $password = stripslashes($_REQUEST['password']);
  $password = mysqli_real_escape_string($conn, $password);
    $query = "INSERT into `utilisateurs` (login, prenom, nom, password)
            VALUES ('$login', '$prenom', '$nom', '".hash('sha256', $password)."')";
            // $req="SELECT count(*) FROM utilisateurs WHERE login='".$login."'";  
            $res = mysqli_query($conn, $query);
            // $res=mysqli_query($req);
      if($res==1){
        echo "<div class='sucess'>
            <h3>Vous êtes inscrit avec succès.</h3>
            <p>Cliquez ici pour vous <a href='connexion.php'>connecter</a></p>
        </div>";
      }
      else{

      } 
    
  }
?>
<form class="box" action="" method="post">
    <h1 class="box-title">S'inscrire</h1>
  <input type="text" class="box-input" name="login" placeholder="Login" required />
    <input type="text" class="box-input" name="prenom" placeholder="prenom" required />
    <input type="text" class="box-input" name="nom" placeholder="nom" required />
    <input type="password" class="box-input" name="password" placeholder="Mot de passe" required />
    <input type="password" class="box-input" name="password" placeholder="Confirmez votre mot de passe" required />
    <input type="submit" name="submit" value="S'inscrire" class="box-button" />
    <p class="box-register">Déjà inscrit? <a href="connexion.php">Connectez-vous ici</a></p>
</form>
<?php  ?>
</body>
</html>