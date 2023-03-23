<?php
session_start();
$comments = array(
  array("img/Adam.png","Adam","super post","img/Grazyna.jpg","Grażyna","Lubie tego bloga !!!"),
  array("img/Lukasz.jpg","Łukasz","Lubie wasze posty"),
  array(),
  array("img/Michal.jpg","Michał","Ciekawy post")
);
$captcha = rand(0,8);
$_SESSION['random'] = $captcha;
$captchaPhoto = array(
"img/blue.jpg",
"img/blue.jpg",
"img/blue.jpg",
"img/blue.jpg",
"img/blue.jpg",
"img/blue.jpg",
"img/blue.jpg",
"img/blue.jpg",
"img/blue.jpg");
$c = 0;
$captchaPhoto[$captcha] = "img/red.jpg";
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


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="google-site-verification" content="qAvOSgVz3agtx09VyuE1Zg7XGC5fMbcV0aSsnvcZ_48" />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://example.com/fontawesome/v6.2.0/js/fontawesome.js"
      data-auto-replace-svg="nest"
    ></script>

    <link rel="stylesheet" href="style/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <script src="script/script.js" defer></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap"
      rel="stylesheet"
    />

    <title>TechBlog - Artur Kompała ISI 1</title>
  </head>
  <body>


  <div class="backdrop">
      <div class="comment-modal">
      <h3 class="namePopOut">Dodowanie Komentarza</h3>
        <form class="formComment" action="addComment.php"  method="post" >
          <input type="hidden" name="postid"/>
          <div class="input-label">
            <label for="nick">Nick:</label>
            <input name="nick" type="text" label="Nick" class="nick"/>
          </div>
          <div class="input-label">
            <label for="email">Email:</label>
            <input name="email" type="email" label="Email"/>
          </div>
          <div class="input-label">
            <label for="email">Treść:</label>
            <textarea name="tresc" label="Tresc"></textarea>
            <button class="comment margin-top-20" type="submit" name="submit" class="submit">Wyslij</button>
          </div>
         
          <button class="comment close-btn margin-top-10">Zamknij</button>
        </form>
      </div>
  </div>

  <div class="register-backdrop">
    <div class="comment-modal">
    <h3 class="namePopOut">Rejestracja</h3>
      <form novalidate action="register.php"  method="post" class="formRegister">
        <div class="input-label">
          <label for="nick">Nick:</label>
          <input name="nick" type="text" label="Nick" class="nick" />
        </div>
        <div class="input-label">
          <label for="email">Email:</label>
          <input name="email" type="email" label="Email" />
        </div>
        <div class="input-label">
          <label for="password">Hasło:</label>
          <input name="password" type="password" label="Password" />
          <label for="captcha">Captcha, podaj numer czerwonego emoji</label>
          <div class="captcha-grid">
          <?php 
            for($c; $c < 9; $c++){
              echo '<img class="captchaPhoto" src="', $captchaPhoto[$c],'" alt="" />';
            } 
            echo '</div>';
            echo '<input name="captcha" type="text" label="Captcha" />';

          ?>
        </div>
        <button class="comment margin-top-20 captchaHide" type="submit">Wyslij</button>
        <button class="comment close-btn margin-top-10">Zamknij</button>
      </form>
    </div>
</div>

  <div class="login-backdrop">
      <div class="comment-modal">
        <h3 class="namePopOut">Logowanie</h3>
        <form novalidate action="login.php"  method="post" class="formRegister">
          <div class="input-label">
            <label for="nick">Nick:</label>
            <input name="nick" type="text" label="Nick" class="nick" />
          </div>
          <div class="input-label">
            <label for="password">Hasło:</label>
            <input name="password" type="password" label="Password" />
          </div>
          <button class="comment margin-top-20 " type="submit">Loguj</button>
          <button class="comment close-btn margin-top-10">Zamknij</button>
        </form>
      </div>
  </div>

  <div class="delete-backdrop">
      <div class="comment-modal">
        <h3 class="namePopOut deleteLabel">Usuwanie posta</h3>
        <form novalidate action="deletePost.php"  method="post" class="formRegister">
          <?php
          ?>
          <button class="comment margin-top-20 " type="submit">Usuń</button>
          <button class="comment close-btn margin-top-10">Zamknij</button>
        </form>
      </div>
  </div>
    
    
    <main class="main">
    <header class="header">
      <img class="card" src="img/card.png" alt="Blog logo" />
      <h1 class="blog-title">TechBlog</h1>
      <a class="login" href="#">Logowanie</a>
      <a class="register" href="#">Rejestracja</a>
      <?php
      if($login == true){
        echo '<a class="register" href="addPost.php">Nowy post</a> ';
        $_SESSION['login'] = $login;
        $_SESSION['loginName'] = $nick;
        $_SESSION['loginID'] = $userID;

      }
      ?>
      <a class="register" href="logout.php">Wyloguj</a> 
      <a class="kontakt" href="kontakt.php">Kontakt</a> 
    </header>
    
      <section class="section">
        <?php
        require("menu.php");
        ?>
        <div class="content">
          <h2>Najnowsze Posty</h2>
          <?php
          include("posts.php");
          ?>
        </div>
       
          
        </div>
      </section>
      <div class="pagination-bar">
        <?php
        for($i = 0; $i < $numberOfPages;$i++){
          echo '<a class="pageButton" href="blog.php?page=',$i,'">',$i+1,'</a>';
        }
        ?>
      </div> 
      <?php
      require("footer.php");
      ?>
    </main>
  </body>
</html>
