<?php
session_start();
 $random = $_SESSION['random'];

if($_POST['captcha'] == $random+1){
  $nick =  empty($_POST['nick']) ? '' : $_POST['nick'] ;
  $email =  empty($_POST['email']) ? '' : $_POST['email'] ;
  $password =  empty($_POST['password']) ? '' : $_POST['password'] ;

  echo $nick, ' <-- Twój nick potrzebny do logowania_________     ';
  echo $email, ' <-- Twój mail________    ';
  echo $password, ' <-- Twoje hasło_______    ';
  

  $reg = '/^[a-zA-Z0-9.\-_]+@[a-zA-Z0-9\-.]+\.[a-zA-Z]{2,4}$/';

  if(preg_match($reg, $email)){
    $conn = new mysqli("localhost","root","admin123","blog");

    if ($conn -> connect_errno) {
      echo "Failed to connect to MySQL: " . $conn -> connect_error;
      exit();
    }
  $countUserSQL = "SELECT COUNT(UserID) FROM user";
  $result = mysqli_query($conn, $countUserSQL) or die("Problemy z odczytem danych!");
  $count = mysqli_fetch_row($result);
  $userSQL = "INSERT INTO User VALUES($count[0]+1,2,'$nick','".password_hash($password, PASSWORD_DEFAULT)."','$email');";
  $resultUser = mysqli_query($conn, $userSQL) or die("Problemy z odczytem danych!");
  echo "<div onclick=history.go(-1);>Rejestracja powiodła się Cofnij do strony głównej</div>";

}else
    echo 'Niepoprawny adres email';
}
else{
  echo 'Nie prawidłowa captcha';
  
}  
?>