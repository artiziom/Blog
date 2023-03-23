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
$UserIDsql = $_GET['userid'];

$conn = new mysqli("localhost","root","admin123","blog");
$commentSQL = "DELETE FROM user WHERE UserID=$UserIDsql;";
$resultComments = mysqli_query($conn, $commentSQL) or die("Problemy z odczytem danych!");

header("Location: http://localhost/Blog/adminPanel.php");
?>