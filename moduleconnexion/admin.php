<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../style.css" />
</head>
<body>
<?php
require('index.php');


if ($conn==true){
  $query= mysqli_query($conn,"SELECT * FROM utilisateurs");
    echo $query;
}
  // lister les utilisateurs, regarder : https://stackoverflow.com/questions/18866881/how-to-get-the-list-of-all-database-users
?>


</body>
</html>