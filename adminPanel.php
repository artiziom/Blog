<?php
session_start();
$login = false;
if (isset($_SESSION['login'])) {
  $login = $_SESSION['login'];
  $nick = $_SESSION['loginName'];
  $userID = $_SESSION['loginID'];
  $roleID = $_SESSION['roleID'];
   echo 'Zalogowany jako: ', $nick, ' ID: ', $userID ,'Role: ',$roleID;
}else{
  echo 'Niezalogowny';
  $roleID = null;
}





if($roleID == 1){
    $conn = new mysqli("localhost","root","admin123","blog");
    $commentSQL = "SELECT * FROM user ";
    $resultComments = mysqli_query($conn, $commentSQL) or die("Problemy z odczytem danych!");
  $k = 0;
  if (mysqli_num_rows($resultComments) > 0) {
    foreach ($resultComments as $row) {
      $userIDsql[$k] = $row['UserID'];
      $RoleIDsql[$k] = $row['RoleID'];
      $Usernamesql[$k] = $row['Username'];
      $passwordsql[$k] = $row['Password'];
      $emailsql[$k] = $row['email'];
      $k++;
    }
  }
    
  echo'<table>';
    echo'<thead>';
    echo    '<tr>';
    echo        '<th>UserID</th>';
    echo        '<th>RoleID</th>';
    echo        '<th>Username</th>';
    echo        '<th>Password</th>';
    echo        '<th>email</th>';
    echo        '<th>Usuń</th>';
    echo        '<th>Edytuj</th>';
    echo    '</tr>';
    echo '</thead>';
    echo '<tbody>';
    for ($x = 0; $x < COUNT($userIDsql); $x++){
        
        echo'<tr>';
        echo    '<td>',$userIDsql[$x],'</td>';
        echo    '<td>',$RoleIDsql[$x],'</td>';
        echo    '<td>',$Usernamesql[$x],'</td>';
        echo    '<td>',$passwordsql[$x],'</td>';
        echo    '<td>',$emailsql[$x],'</td>';
        echo    '<td><a href="adminPanelDelete.php?userid=',$userIDsql[$x],'">🗑️</a></td>';
        echo    '<td><form></form><a href="adminPanelUsername.php?userid=',$userIDsql[$x],'">Edytuj</a></td>';
        echo     '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '<a href="http://localhost/Blog/blog.php#">COFNIJ</a>'; 
        
        
        
    




  




?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN PANEL</title>
    <link rel="stylesheet" href="style/adminPanel.css">
</head>
<body>

    
    
</body>
</html>
<?php

}
?>