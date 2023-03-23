<?php
session_start();
  $nick =  empty($_POST['nick']) ? '' : $_POST['nick'] ;
  $password =  empty($_POST['password']) ? '' : $_POST['password'] ;
  $conn = new mysqli("localhost","root","admin123","blog");
 if(!$nick == null){
    if ($conn -> connect_errno) {
        echo "Failed to connect to MySQL: " . $conn -> connect_error;
        exit();
      }
    $pass = "SELECT password FROM user WHERE Username='$nick'";
    $result = mysqli_query($conn, $pass) or die("Problemy z odczytem danych!");
    $pass = mysqli_fetch_row($result);

      if(password_verify($password, $pass[0])){
        $userSQL = "SELECT userID,roleID FROM user WHERE Username='$nick'";
        $result = mysqli_query($conn, $userSQL) or die("Problemy z odczytem danych!");
        $userID = mysqli_fetch_row($result);
          $login = true;
          $_SESSION['login'] = $login;
          $_SESSION['loginName'] = $nick;
          $_SESSION['loginID'] = $userID[0];
          $_SESSION['roleID'] = $userID[1];
          
          echo "<div onclick=history.go(-1);>Logowanie powiodło się Cofnij do strony głównej</div>";
          header("Location: http://localhost/Blog/blog.php");
      }else{
          $login = false;
      echo 'Nie prawidłowe hasło lub login';
      echo "<div onclick=history.go(-1);>Logowanie nie powiodło się Cofnij do strony głównej</div>";
          
      }
} else {
    $login = false;
    echo 'Nie prawidłowe hasło lub login';
    echo "<div onclick=history.go(-1);>Logowanie nie powiodło się Cofnij do strony głównej</div>";
}
    


  
?>