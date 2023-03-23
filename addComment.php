<?php
session_start();
$conn = new mysqli("localhost", "root", "admin123", "blog");
if (isset($_SESSION['login'])) {
    $login = $_SESSION['login'];
    $nick = $_SESSION['loginName'];
    $userID = $_SESSION['loginID'];
    echo 'Zalogowany jako: ', $nick,' ID: ',$userID;
  }else{
    $login = false;
    echo 'Niezalogowny';
  }
  $postId = $_GET['postId'];



?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontakt Artur Kompała ISI 1</title>
    <link rel="stylesheet" href="style/kontaktStyle.css">
</head>
<body>
    <div class="box">
        <form action="addComment-data.php" method="post">
            <div class="flex">
            <h3>Komentarz</h3>
            <?php
            if($login == true){
                echo '<input type="hidden" name="Nick" value="',$userID,'">';
                echo '<input type="hidden" name="Postid" value="',$postId,'">';
            }else{
                echo '<input type="hidden" name="Nick" value="3">';
                echo '<input type="hidden" name="Postid" value="',$postId,'">';
            }
            ?>
            <label for="">Tresc</label>
            <textarea name="Tresc" id="" cols="30" rows="10"></textarea>
            <button type="sumbit">WYŚLIJ</button>
            </div>
            
        </form>
    </div>
    
        
</body>
</html>