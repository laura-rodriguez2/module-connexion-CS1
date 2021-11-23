<?php 
require("index.php");
session_start();
$requete = mysqli_query($conn,"SELECT * FROM utilisateurs");
$utilisateurs = mysqli_fetch_all($requete,MYSQLI_ASSOC);

// if(($_POST["id"])==1){
    
// }
// else{
//     exit;
// }
// si id nest pas1
// ==1
// sinon si c 1 montrer la page
// exit
?>
<html>
    <header>
        jj
    </header>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Login</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Password</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        foreach($utilisateurs as $utilisateur){
            echo '<tr>';
            echo '<td>'.$utilisateur['id'].' '.'</td>';   
            echo '<td>'.$utilisateur['login'].' '.'</td>';
            echo '<td>'.$utilisateur['prenom'].' '.'</td>';
            echo '<td>'.$utilisateur['nom'].' '.'</td>';
            echo '<td>'.$utilisateur['password'].' '.'</td>';
            echo '</tr>';
        }
?>
    </tbody>
</table>
</html>



