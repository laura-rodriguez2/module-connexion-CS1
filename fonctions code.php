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

