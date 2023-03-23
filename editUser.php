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
$RoleIDsql =  empty($_POST['roleid']) ? '' : $_POST['roleid'] ;
$usernamesql =  empty($_POST['username']) ? '' : $_POST['username'] ;
$passwordsql =  empty($_POST['password']) ? '' : $_POST['password'] ;
$emailsql =  empty($_POST['email']) ? '' : $_POST['email'] ;
$UserIDsql = $_GET['userid'];


$conn = new mysqli("localhost","root","admin123","blog");
$commentSQL = "UPDATE `user` SET `RoleID`='$RoleIDsql',`Username`='$usernamesql',`Password`='".password_hash($password, PASSWORD_DEFAULT)."',`email`='$emailsql' WHERE `UserID`=$UserIDsql";
$resultComments = mysqli_query($conn, $commentSQL) or die("Problemy z odczytem danych!");

header("Location: http://localhost/Blog/adminPanel.php");

?>