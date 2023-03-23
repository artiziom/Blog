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


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    echo '<form novalidate action="editUser.php?userid=',$UserIDsql,'" method="post">';
    ?>
    
        <label for="">RoleID</label>
        <input type="number"  name="roleid">
        <label for="">Username</label>
        <input type="text" name="username">
        <label for="">Password</label>
        <input type="text" name="password">
        <label for="">Email</label>
        <input type="text" name="email">
        <button type="submit">Wyslij</button>
    </form>
    <a href="http://localhost/Blog/adminPanel.php">COFNIJ</a>
</body>
</html>