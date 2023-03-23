<?php
        $nick =  empty($_POST['Nick']) ? '' : $_POST['Nick'] ;
        $emial =  empty($_POST['Email']) ? '' : $_POST['Email'] ;
        $tresc =  empty($_POST['Tresc']) ? '' : $_POST['Tresc'] ;
        $conn = new mysqli("localhost", "root", "admin123", "blog");
        
        ////////////////
        if ( isset($_FILES['my_image'])) {
        
                $img_name = $_FILES['my_image']['name'];
                $img_size = $_FILES['my_image']['size'];
                $tmp_name = $_FILES['my_image']['tmp_name'];
                $error = $_FILES['my_image']['error'];
        
                if ($error === 0) {
                        if ($img_size > 125000) {
                                $em = "Sorry, your file is too large.";
                            header("Location: index.php?error=$em");
                        }else {
                                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                                $img_ex_lc = strtolower($img_ex);
        
                                $allowed_exs = array("jpg", "jpeg", "png"); 
        
                                if (in_array($img_ex_lc, $allowed_exs)) {
                                        $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                                        $img_upload_path = 'uploads/'.$new_img_name;
                                        move_uploaded_file($tmp_name, $img_upload_path);
        
                                        // Insert into Database
                                        $sql = "INSERT INTO kontak(`nick`, `email`,`Tresc`, `filename`) 
                                                VALUES('$nick','$emial','$tresc','$new_img_name')";
                                        mysqli_query($conn, $sql) or die("Problemy z odczytem danych!");
                                }else {
                                        $em = "You can't upload files of this type";
                                }
                        }
                }
        
        }
        /////////////////
       
        //$postSQL = "INSERT INTO `kontak`(`nick`, `email`,`Tresc`, `filename`) VALUES('$nick','$emial','$tresc','$string');";
        //$resultUser = mysqli_query($conn, $postSQL) or die("Problemy z odczytem danych!");     
        //header("Location: http://localhost/Blog/blog.php");
