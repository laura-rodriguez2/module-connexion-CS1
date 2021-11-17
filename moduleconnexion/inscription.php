<?php
$bdd = mysqli_connect('localhost','root','','moduleconnexion'); 

if(isset($_POST['forminscription'])){
    if(!empty($_POST['login']) AND !empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])){
        $login = htmlspecialchars($_POST['login']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $nom = htmlspecialchars($_POST['nom']);
        $mdp = sha1($_POST['mdp']);
        $mdp2 = sha1($_POST['mdp2']);

        $loginlen = strlen($login);
        if($loginlen <= 255)
        {
            if($mdp == $mdp2)
            {
                $addmember = $bdd -> prepare("INSERT INTO utilisateurs (login, prenom, nom, mdp, passsword) VALUES (?,?,?)");
                $addmember -> execute(array($login, $prenom, $nom, $password));
                $erreur = "Votre compte à bien été créée.";
            }
            else
            {
                $erreur = "Vos mots de passe ne correspondent pas";
            }
        }
        else
        {
            $erreur= "Votre pseudo ne doit pas comporter plus de 255 charactères";
        }
    }
        else
        {
            $erreur="Vous devez remplir tout les champs";
        }
}
?>

<html>
    <head>
        <title>Inscription</title>
        <meta charset="utf-8">
    </head>
    <body>
        <header>

        </header>
        <main>
            <div align="center">
                <h1>Inscription</h1>
                <br>
                <form method="POST" action="">
                    <table>
                        <tr>
                            <td align="right">
                            <label for="login">Login :</label>
                            </td>
                            <td>
                                <input type="login" placeholder="Votre Login" id="login" name="login">
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                            <label for="prenom">Prénom :</label>
                            </td>
                            <td>
                                <input type="prenom" placeholder="Votre prénom" id="prenom" name="prenom">
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                            <label for="nom">Nom :</label>
                            </td>
                            <td>
                                <input type="nom" placeholder="Votre nom" id="nom" name="nom">
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                            <label for="password">Mot de passe :</label>
                            </td>
                            <td>
                                <input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp">
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                            <label for="password2">Confirmation mot de passe :</label>
                            </td>
                            <td>
                                <input type="password" placeholder="Confirmez votre mot de passe" id="mdp2" name="mdp2">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="forminscription" value="M'inscrire"/>
                            </td>
                        </tr>
                    </table>
                </form>
                <?php
                if(isset($erreur))
                {
                    echo $erreur;
                } 
                ?>
            </div>
        </main>
        <footer>

        </footer>
    </body>
</html>