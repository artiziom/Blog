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
        <form action="kontakt-data.php" method="post" enctype="multipart/form-data">
            <div class="flex">
            <h3>Formularz kontaktowy</h3>
            <label for="">Nick</label>
            <input type="text" name="Nick">
            <label for="">Email</label>
            <input type="text" name="Email">
            <label for="">Tresc</label>
            <textarea name="Tresc" id="" cols="30" rows="10"></textarea>
            <label  for="">Pliki</label>
            <input type="file" 
                  name="my_image">
            <button type="sumbit">WYŚLIJ</button>
            </div>
            
        </form>
    </div>
    
        
</body>
</html>