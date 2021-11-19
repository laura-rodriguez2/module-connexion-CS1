<?php
function test(){
    $n1=1;
    $n2=2;
    $result=false; /* definir une variable, lui donner un attribut (true ou false ou autre jsp)*/
    if($n1+$n2){
        $result=true; /* A la place de return= true*/
    }
    else{
        $result=false;  /* A la place de return= false*/
    }
    return $result; /* echo pour l'affichage, return pour la valeur */
}
?>



======


<?php 

$bdd = mysqli_connect('localhost','root','','moduleconnexion');
mysqli_set_charset($bdd,'utf8');
$requete = mysqli_query($bdd,"SELECT * FROM utilisateurs");
$utilisateurs = mysqli_fetch_all($requete,MYSQLI_ASSOC);
?>
<html>
<table border="1">
    <thead>
        <tr>
            <th>Login</th>
            <th>Prenom</th>
            <th>Nom</th>
            <th>Mot de passe</th>
            <th>Confirmation Mot de passe</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        foreach($utilisateurs as $utilisateur){
            echo '<tr>';
            echo '<td>'.$utilisateur['login'].' '.'</td>';
            echo '<td>'.$utilisateur['prenom'].' '.'</td>';
            echo '<td>'.$utilisateur['nom'].' '.'</td>';
            echo '<td>'.$utilisateur['password'].' '.'</td>';
            echo '<td>'.$utilisateur['password'].' '.'</td>';
            echo '</tr>';
        }
?>
    </tbody>
</table>
</html>

============================================

connexion page la mienne probleme msqli query

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
    $query = "SELECT * FROM utilisateurs WHERE login='$login' and password='".hash('sha256', $password)."'";
    $result = mysqli_query($conn,$query) or die(mysqli_error());
    $rows = mysqli_num_rows($result);
    if($rows==1){
        $_SESSION['login'] = $login;
        header("Location: profil.php");
    }
    else{
    $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
    }
}
?>

<form class="box" action="" method="post" name="connexion">
    <h1 class="box-title">Connexion</h1>
<input type="text" class="box-input" name="login" placeholder="Login">
<input type="password" class="box-input" name="password" placeholder="Mot de passe">
<input type="submit" value="Connexion " name="submit" class="box-button">
<p class="box-register">Vous êtes nouveau ici? <a href="inscription.php">S'inscrire</a></p>
<?php if (! empty($message)) { ?>
    <p class="errorMessage"><?php echo $message; ?></p>
<?php } ?>
</form>
</body>
</html>


===================



if (isset($_POST['login'])){
  $login = stripslashes($_REQUEST['login']);
  $login = mysqli_real_escape_string($conn, $login);
  $password = stripslashes($_REQUEST['password']);
  $password = mysqli_real_escape_string($conn, $password);
  $query = "SELECT 'login','password' FROM utilisateurs WHERE 'login'=$login , ('password'= '".hash('sha256', $password)."')";
    
    // "SELECT 'login', 'password' FROM utilisateurs WHERE login='$login' , password='".hash('sha256', $password)."'";
  $result = mysqli_query($conn,$query) or die(mysqli_connect_error());
  $rows = mysqli_num_rows($result);
  if($rows==1){
      $_SESSION['login'] = $login;
      header("Location: index.php");
      exit;
  }else{
    $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
  }
}