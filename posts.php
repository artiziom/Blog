<div class="posts">
              <?php 
                function transformText($text){
                  $preview = preg_replace("#\[b\](.+)\[/b\]#", "<strong>$1</strong>", $text);
                  $preview = preg_replace("#\[i\](.+)\[/i\]#", "<em>$1</em>", $preview);
                  $preview = preg_replace("#\[u\](.+)\[/u\]#", "<u>$1</u>", $preview);
                  $preview = preg_replace("#\[url\](.+)\[/url\]#", "<a href='$1'>$1</a>", $preview);
                  return $preview;
                }
              $conn = new mysqli("localhost","root","admin123","blog");

              if ($conn -> connect_errno) {
                echo "Failed to connect to MySQL: " . $conn -> connect_error;
                exit();
              }
              if (isset($_GET['kategoria'])) {
                $_SESSION['kat'] = $_GET['kategoria'];
                if (isset($_SESSION['kat'])) {
                  $kat = $_SESSION['kat'];
                  $idSQL = "SELECT * FROM posts WHERE CategoryID=$kat";
                  $countPostsSQL = "SELECT COUNT(PostsID) FROM posts WHERE CategoryID=$kat";
                }
              }else{
                $idSQL = "SELECT * FROM posts;";
                $countPostsSQL = "SELECT COUNT(PostsID) FROM posts";
              }





              
              $result = mysqli_query($conn, $countPostsSQL) or die("Problemy z odczytem danych!");
              $count = mysqli_fetch_row($result);
              
              $postInPage = 2;
              
              $numberOfPages = ceil($count[0] / $postInPage);
              $lastPage = $count[0]%$postInPage;
              if( isset($_GET['page'])){
                if($_GET['page'] < 0 || $_GET['page'] > $numberOfPages) $page = 0;
                else $page = $_GET['page'];
              }
              else $page = 0;
              $y = $page * $postInPage;

              
              
              
                $resultid = mysqli_query($conn, $idSQL) or die("Problemy z odczytem danych!");
                $i = 0;
                if(mysqli_num_rows($resultid) > 0){
                  foreach($resultid as $row){
                    $postId[$i] = $row['PostsID'];
                    $user[$i] = $row['UserID'];
                    $title[$i] = $row['Title'];
                    $photo[$i] = $row['Images'];
                    $text[$i] = $row['Content'];
                    $i++;
                  }

                  $commentSQL = "SELECT * FROM comments ";
                  $resultComments = mysqli_query($conn, $commentSQL) or die("Problemy z odczytem danych!");
                $k = 0;
                if (mysqli_num_rows($resultComments) > 0) {
                  foreach ($resultComments as $row) {
                    $CommentID[$k] = $row['CommentID'];
                    $CommentPostsID[$k] = $row['PostsID'];
                    $CommentUserID[$k] = $row['UserID'];
                    $creationDate[$k] = $row['CreationDate'];
                    $content[$k] = $row['Content'];
                    $k++;
                  }
                }

                }if($count[0] != 0){
                  for( $x = 0; $x < $postInPage; $x++ ){
                    echo '<div class="post" value="',$x+$y+1,'">';
                    echo '<img class="post-img" src= ', $photo[($x)+$y]  ,' alt="" />';
                    echo '<div class="post-text">';
                    echo '<h3 class="post-title"> ',$title[($x)+$y],' </h3>';
                    echo '<p class="text"> ',transformText($text[($x)+$y]),' </p>';
                    echo '<div class="addComment">';
                    echo '<a class="comment" value="', $x + $y + 1, '" href="addComment.php?postId=',$postId[($x) + $y],'">Dodaj komentarz </a>';
                  if ($login == true) {
                    
                    if ($userID == $user[($x)+$y] || $roleID == 1) {
                      echo '<a class="edit" value="', $postId[($x) + $y], '" href="addPost.php?postId=',$postId[($x) + $y],'&edit=true">Edytuj</a>';
                      echo '<a class="deleteBtn" value="', $postId[($x) + $y], '" href="deletePost.php?postId=', $postId[($x) + $y],'">Usuń</a>';
                    }
                  }
                    echo '</div>';
                    echo '</div>';
                    echo '<h4>Komentarze:</h4>';
                    echo '<div class="comment-show" value="',$x+$y+1,'">';
                 
                    for($o = 0; $o < count($CommentID); $o++){
                      if($postId[($x) + $y] == $CommentPostsID[$o]){
                        $userComSQL = "SELECT Username FROM user WHERE  UserID = $CommentUserID[$o]";
                        $result = mysqli_query($conn, $userComSQL) or die("Problemy z odczytem danych!");
                        $userNick = mysqli_fetch_row($result);
                      echo '<p><strong>',$userNick[0],'</strong></p>';
                      echo '<p>', $content[$o], '</p>';
                      }
                    }
                    
                    echo '</div>';
                    echo '</div>';
                    if($x+$y == $count[0]-1){
                      break;
                  }
                  }
                }
                
              ?>
          </div>