<?php
$bdd = new PDO('mysql:host=localhost;dbname=moduleconnexion', 'root', '');

$membres = $bdd->query('SELECT * FROM utilisateurs ORDER BY id DESC LIMIT 0,5'); //requete pour récuperer les informations des membres

?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8" />
   <link rel="stylesheet" type="text/css" href="style.css">
   <title>Administration</title>
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
   <div id="admin_main">   
      <h1 id="h1_inscription">Administration</h1> <br>
         <ul>
            <?php while($m = $membres->fetch()) { ?>
            <li><?= $m['id'] ?>- LOGIN : <?= $m['login'] ?> PRENOM :<?= $m['prenom'] ?> NOM :<?= $m['nom'] ?></a></li>
            <?php } ?>
         </ul><br>
      <a href="deconnexion.php"><input class="box_button" type="button" value="Déconnexion"></a>
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