<?php
  $nick =  empty($_POST['nick']) ? '' : $_POST['nick'] ;
  $email =  empty($_POST['email']) ? '' : $_POST['email'] ;
  $tresc =  empty($_POST['tresc']) ? '' : $_POST['tresc'] ;

  echo $nick, '  ';
  echo $email, '  ';
  echo $tresc, '  ';
  

  $reg = '/^[a-zA-Z0-9.\-_]+@[a-zA-Z0-9\-.]+\.[a-zA-Z]{2,4}$/';

  if(preg_match($reg, $email))
    echo 'Poprawny adres email';
  else
    echo 'Niepoprawny adres email';
?>
