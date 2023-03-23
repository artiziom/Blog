<?php
session_start();

$cards = array('2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9, 'T' => 10, 'J' => 2, 'Q' => 3, 'K' => 4, 'A' => 11);
$types = array('T', 'P', 'K', 'A');
$winner = false;

function pullCard()
{
	global $cards;
	global $types;
	
	$tmp['card'] = array_rand($cards);
	$tmp['type'] = $types[array_rand($types)];
	
	while(in_array($tmp['card'].$tmp['type'], $_SESSION['used_cards']))
	{
		$tmp['card'] = array_rand($cards);
		$tmp['type'] = $types[array_rand($types)];
	}
	
	$_SESSION['used_cards'][] = $tmp['card'].$tmp['type'];
	
	return $tmp;
}
function calcCards($hand)
{
	global $cards;
	
	$count = 0;
	$aces = 0;
	
	foreach($hand as $card)
	{
		if($card['card'] != "A")
		{
			$count += $cards[$card['card']];
		}
		else
		{
			$aces++;
		}
	}
	
	for($x=0; $x<$aces; $x++)
	{
		if($count+11 > 21)
		{
			$count += 1;
		}
		else
		{
			$count+= 11;
		}
	}
	
	return $count;
}

function checkWinner($player, $computer)
{	
	global $winner;
	if($winner != true)
	{
		
		if(calcCards($player) == 21 && calcCards($computer) == 21)
		{
			echo '<script>alert("Remis !!!");</script>';
			$winner = true;
		}
		elseif(calcCards($player) > 21 || calcCards($computer) == 21)
		{
			echo '<script> alert("Przegrałeś !!!");</script>';
			$winner = true;
		}
		elseif(calcCards($computer) > 21 || calcCards($player) == 21)
		{
			echo '<script> alert("Wygrałeś !!!");</script>';
			$winner = true;
		}
		else
		{
			return false;
		}
	}
}

if(isset($_POST['reset']))
{
	session_destroy();
	session_start();
}

if(!isset($_SESSION['hand_player']))
{
	$_SESSION['used_cards'] = array();
	
	$hand_player = array();
	$hand_computer = array();
	
	
	array_push($hand_player, pullCard());
	array_push($hand_player, pullCard());
	
	array_push($hand_computer, pullCard());
	array_push($hand_computer, pullCard());
	
	$_SESSION['hand_player'] = $hand_player;
	$_SESSION['hand_computer'] = $hand_computer;
	
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gra w oczko - Artur Kompała</title>
    <link rel="stylesheet" href="style/gameStyle.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="container">
		
        <?php
        if(isset($_POST['hit']) && $winner != true)
        {
            array_push($_SESSION['hand_player'], pullCard());
        }
        elseif(isset($_POST['stand']) && $winner != true)
        {
            while(calcCards($_SESSION['hand_player']) > calcCards($_SESSION['hand_computer']))
            {
                array_push($_SESSION['hand_computer'], pullCard());
                
                if(calcCards($_SESSION['hand_computer']) == 21 && calcCards($_SESSION['hand_player']) == 21)
                {
                    echo '<script>alert("Remis !!!");</script>';
                    $winner = true;
                    continue;
                }
                elseif(calcCards($_SESSION['hand_computer']) > 21)
                {
                    echo '<script> alert("Wygrałeś !!!");</script>';
                    $winner = true;
                    continue;
                }
                elseif((calcCards($_SESSION['hand_player']) < calcCards($_SESSION['hand_computer']) || calcCards($_SESSION['hand_computer']) == 21))
                {
                    echo '<script> alert("Przegrałeś !!!");</script>';
                    $winner = true;
                    continue;
                }
            }
            
            if(calcCards($_SESSION['hand_player']) == calcCards($_SESSION['hand_computer']))
            {
                echo '<script> alert("Remis !!!");</script>';
                $winner = true;
            }
            
            if((calcCards($_SESSION['hand_computer']) > calcCards($_SESSION['hand_player'])) && $winner != true)
            {
                echo '<script> alert("Przegrałeś !!!");</script>';
                $winner = true;
            }
        }
        
        checkWinner($_SESSION['hand_player'], $_SESSION['hand_computer']);
        
        ?>
        
        <div class="player"><h2>Krupier</h2></div>
        <div >
            <div class="cards-container">
            <?php $comp_count = 0; ?>
            <?php foreach($_SESSION['hand_computer'] as $card): ?>
                <div >
                    <?php if($comp_count != 0 || $winner == true): ?>
                    <img src="./imgCards/<?=$card['card'].$card['type']?>.png" /><br>
                    (<?=$cards[$card['card']]?>)
                    <?php else: ?>
                    <img src="./imgCards/closed.png" /><br>
                    (?)
                    <?php endif; ?>
                </div>
                <?php $comp_count++; ?>
            <?php endforeach; ?>
        </div>
            <?php if($winner == true): ?>
            <div class="total">
                <p class="score"colspan="<?=count($_SESSION['hand_computer']) ?>" >Wynik: <?=calcCards($_SESSION['hand_computer'])?></p>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="player"><h2>Gracz</h2></div>
        <form method="post">
            <div >
                <div class="cards-container">
                <?php foreach($_SESSION['hand_player'] as $card): ?>
                    <div >
                        <img src="./imgCards/<?=$card['card'].$card['type']?>.png" /><br>
                        (<?=$cards[$card['card']]?>)
                    </div>
                <?php endforeach; ?>
                </div>
                <div class="total">
                    <p class="score"colspan="<?=count($_SESSION['hand_player']) ?>" >Wynik: <?=calcCards($_SESSION['hand_player'])?></p>
                    </div>
                <div class="buttons">
                    <div colspan="<?=count($_SESSION['hand_player']) ?>" ><input class="btn" type="submit" name="hit" class="btn btn-primary" value="Kolejna karta" /><input class="btn" type="submit" name="stand" class="btn btn-primary" value="Pas" /><input class="btn" type="submit" name="reset" class="btn btn-primary" value="Nowa gra" /><a class="btn marg" href="blog.php">Porwót do Bloga</a></div>
                </div>
                
                </div>
        </form>
    </div>
    
</body>
</html>
<?php
	
if($winner == true)
{
	session_destroy();
}
?>