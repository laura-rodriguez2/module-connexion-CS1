<?php 

$bdd = mysqli_connect('localhost','root','','moduleconnexion');
mysqli_set_charset($bdd,'utf8');
$requete = mysqli_query($bdd,"SELECT * FROM etudiants");
$etudiants = mysqli_fetch_all($requete,MYSQLI_ASSOC);

?>
<html>
<table border="1">
    <thead>
        <tr>
            <th>Login</th>
            <th>Prenom</th>
            <th>Nom</th>
            <th>Password</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        foreach($etudiants as $etudiant){
            echo '<tr>';
            echo '<td>'.$etudiant['login'].' '.'</td>';
            echo '<td>'.$etudiant['prenom'].' '.'</td>';
            echo '<td>'.$etudiant['nom'].' '.'</td>';
            echo '<td>'.$etudiant['password'].' '.'</td>';
            echo '</tr>';
        }
?>
    </tbody>
</table>
</html>

