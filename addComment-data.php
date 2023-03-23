<?php
        echo $nick =  empty($_POST['Nick']) ? '' : $_POST['Nick'] ;
        echo $postid =  empty($_POST['Postid']) ? '' : $_POST['Postid'] ;
        echo $tresc =  empty($_POST['Tresc']) ? '' : $_POST['Tresc'] ;
        $conn = new mysqli("localhost", "root", "admin123", "blog");
        $comSQL = "INSERT INTO `comments`(`PostsID`, `UserID`,`Content`) VALUES('$postid','$nick','$tresc');";
        $resultUser = mysqli_query($conn, $comSQL) or die("Problemy z odczytem danych!");
        header("Location: http://localhost/Blog/blog.php");
?>
        