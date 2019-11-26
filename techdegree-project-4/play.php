<?php
require "inc/Game.php";
require "inc/Phrase.php";

$phrase = new Phrase();
$game = new Game($phrase);

// var_dump($phrase);
// var_dump($game);
var_dump($_POST);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Phrase Hunter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>

<body>
<div class="main-container">
    <div id="banner" class="section">
        <h2 class="header">Phrase Hunter</h2>
        <?php echo $phrase->addPhraseToDisplay(); ?>
        <?php echo $game->displayKeyboard(); ?>
        <?php echo $game->displayScore(); ?>
    </div>
    
    
</div>

</body>
</html>


This file creates a new instance of the Phrase class which OPTIONALLY accepts the current phrase as a string, and an array of selected letters.
    This file creates a new instance of the Game class which accepts the created instance of the Phrase class.
    The constructor should handle storing the phrase string and selected letters in sessions or another storage mechanism.
    In the body of the page you should play the game. To play the game:
        Use the gameOver method to check if the game has been won or lost and display appropriate messages.
        If the game is still in play, display the game items: displayPhrase(), displayKeyboard(), displayScore()
