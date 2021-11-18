<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css" />
</head>
<body>
<?php
require('index.php');
session_start();

if (isset($_POST['login'])){
  $login = stripslashes($_REQUEST['login']);
  $login = mysqli_real_escape_string($conn, $login);
  $password = stripslashes($_REQUEST['password']);
  $password = mysqli_real_escape_string($conn, $password);
    $query = "SELECT * FROM `utilisateurs` WHERE login='$login' and password='".hash('sha256', $password)."'";
  $result = mysqli_query($conn,$query);
  $rows = mysqli_num_rows($result);
  if($rows==1){
        $_SESSION['login'] = $login;
        header("Location: profil.php");
  }else{
    $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
  }
}
?>
<form class="box" action="" method="post" name="login">
    <h1 class="box-title">Connexion</h1>
<input type="text" class="box-input" name="login" placeholder="Login">
<input type="password" class="box-input" name="password" placeholder="Mot de passe">
<input type="submit" value="Connexion " name="submit" class="box-button">
<p class="box-register">Vous êtes nouveau ici? <a href="register.php">S'inscrire</a></p>
<?php if (! empty($message)) { ?>
    <p class="errorMessage"><?php echo $message; ?></p>
<?php } ?>
</form>
</body>
</html>