<?php
session_start();
$postId = $_GET['postId'];
$conn = new mysqli("localhost", "root", "admin123", "blog");

if ($conn->connect_errno) {
  echo "Failed to connect to MySQL: " . $conn->connect_error;
  exit();
}
$deletePostSQL = "DELETE FROM posts WHERE PostsID=$postId";
$result = mysqli_query($conn, $deletePostSQL) or die("Problemy z odczytem danych!");
echo 'Usunięto Post';
$conn->query($sql);
header("Location: http://localhost/Blog/blog.php");
?>