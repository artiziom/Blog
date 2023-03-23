<?php
  session_start();
  $conn = new mysqli("localhost", "root", "admin123", "blog");
  $savedText = "";
  $title = "";
  $edit = isset($_GET['edit']) ? $_GET['edit'] : false;

  if (isset($_SESSION['login'])) {
    $login = $_SESSION['login'];
    $nick = $_SESSION['loginName'];
    $userID = $_SESSION['loginID'];
    echo 'Zalogowany jako: ', $nick,' ID: ',$userID;
  }else{
    echo 'Niezalogowny';
  }
 
  if($edit){
    $postId = $_GET['postId'];
    $sql = "SELECT Title, Content, Images FROM posts WHERE PostsID='$postId'";
    $result = $conn->query($sql) or die("Problemy z odczytem danych!");
    $fetched = mysqli_fetch_row($result);
    $_SESSION["formatPhoto"] = $fetched[2];
    $_SESSION["formatText"] = $fetched[1];
    $_SESSION["title"] = $fetched[0];
    $_SESSION['edit'] = true;
    $_SESSION['postId'] = $postId;
  }

  if(isset($_POST["wstecz"])){
    unset($_SESSION["podglad"]);
    unset( $_SESSION["tresc"]);
    if(isset($_SESSION["formatText"])){
      $savedText = $_SESSION["formatText"];
      $title = $_SESSION["title"];
    }
  }

  if(isset($_POST["submit"]) || isset($_POST["podglad"])){
    $_SESSION["tresc"] = $_POST["tresc"];
  }
  
  function transformText($text){
    $preview = preg_replace("#\[b\](.+)\[/b\]#", "<strong>$1</strong>", $text);
    $preview = preg_replace("#\[i\](.+)\[/i\]#", "<em>$1</em>", $preview);
    $preview = preg_replace("#\[u\](.+)\[/u\]#", "<u>$1</u>", $preview);
    $preview = preg_replace("#\[url\](.+)\[/url\]#", "<a href='$1'>$1</a>", $preview);
    return $preview;
  }

  function showPreview(){
    $conn = new mysqli("localhost", "root", "admin123", "blog");
    if(isset($_POST["tresc"])&& isset($_POST["tytul"])&& isset($_POST["photo"]) && empty($_POST["submit"])){
      echo '<strong>Podgląd:</strong><br />';
      echo '<img width="20%"src="',$_POST["photo"],'">';
       $_SESSION["formatPhoto"] = $_POST["photo"];
      echo '<div class="preview"';
      echo '<h2><strong>',$_POST["tytul"],'</strong></h2>';
      $_SESSION["formatTitle"] = $_POST["tytul"];
      echo transformText($_POST["tresc"]);
      $_SESSION["formatText"] = $_POST["tresc"];
      echo '</div>';
    }
    else if(isset($_POST["tresc"]) && isset($_POST["tytul"])&& isset($_POST["photo"]) && isset($_POST["submit"])){
      $shouldEdit = isset($_SESSION["edit"]) ? $_SESSION["edit"] : false;
    
      echo '<h1>WYSŁANO</h1>';
      if($shouldEdit){
        $sql = "UPDATE posts SET Images='".$_POST["photo"]."', Title='".$_POST["tytul"]."', Content='".$_POST["tresc"]."' WHERE PostsID='".$_SESSION['postId']."'";
        $conn->query($sql) or die("Problemy z odczytem danych!");
        unset( $_SESSION["edit"]);
        header("Location: http://localhost/Blog/blog.php");
      }else{
        $photo = $_POST["photo"];
       $title = $_POST["tytul"];
       $text = $_POST["tresc"];
       $userID = $_SESSION['loginID'];
      $postSQL = "INSERT INTO `posts`(`UserID`, `CategoryID`, `Title`,`Images`, `Content`) VALUES('$userID',1,'$title','$photo','$text');";
      $resultUser = mysqli_query($conn, $postSQL) or die("Problemy z odczytem danych!");
     
    
      header("Location: http://localhost/Blog/blog.php");
      } 
      
      unset( $_SESSION["title"]);
      unset( $_SESSION["photo"]);
      unset( $_SESSION["tresc"]);
    }
    else{
      $defaultValue = isset($_SESSION["formatTitle"]) ? $_SESSION["formatTitle"] : "";
      echo '<div class="input-label">';
      echo '<label for="tresc">Tytuł:</label>';
      echo '<textarea name="tytul" label="Tytul" placeholder="Wpisz tutaj Tytuł posta (Tytuł nie ma wsparcia)" required>',$defaultValue, "",'</textarea>';
      echo '<label for="tresc">Treść:</label>';
      echo '<textarea name="tresc" label="Tresc" placeholder="Wpisz tutaj treść posta" required>',isset($_SESSION["formatText"]) ? $_SESSION["formatText"] : "",'</textarea>';
      echo '<label for="tresc">Link z fotografią:</label>';
      echo '<textarea name="photo" label="Photo" placeholder="Wklej tutaj link" required>',isset($_SESSION["formatPhoto"]) ? $_SESSION["formatPhoto"] : "",'</textarea>';
      echo '</div>';
    }

  }

  function showButtons(){
    if(empty($_POST["podglad"]) && empty($_POST["submit"])){
      echo '<button type="submit" name="podglad" value="podglad" class="btn">Podgląd</button>';
      echo '<button type="submit" name="submit" value="submit" class="btn">Wyslij</button>';
      echo '<a class="btn" href="blog.php">Wstecz</a> ';
    }
    else if(isset($_POST["podglad"])){
      echo '<button type="wstecz" name="wstecz" value="wstecz" class="btn">Wstecz</button>';
    }
  }

  function showGuide(){
    if(empty($_POST['submit'])){
      echo '<div class="container">';
      echo  '<h2>Wsparcie dla znaczyników BB-code</h2>' ; 
      echo  '<p><b>[b] - pogrubienie</b></p>' ;
      echo  '<p>  <i>[i] - kursywa</i></p>';
      echo  '<p> <u>[u] - podkreślenie</u></p>';
      echo  '<a href="">[url] - link</a>';
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj Post - Artur Kompała</title>
    <link rel="stylesheet" href="style/addPostStyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    
      <form action="./addPost.php" method="POST">
        <?php
          showGuide();
          showPreview();
        ?>
        <div class="actions">
          <?php
            showButtons();
          ?>
        </div>
      </form>
    </div>

    
</body>
</html>