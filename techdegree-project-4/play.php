<?php
session_start();
require "inc/Game.php";
require "inc/Phrase.php";


if(isset($_POST['startgame'])){
    unset($_SESSION['selected']);
    unset($_SESSION['phrase']);
    $_SESSION['letters'] = "";
    $_SESSION['selected'] = array();
    $phrase = new Phrase();
    $_SESSION['phrase'] = $phrase->getPhrase();

} 


if (isset($_POST['key'])) {
    $_SESSION['selected'][] = filter_input(INPUT_POST, "key", FILTER_SANITIZE_STRING);
    $phrase = new Phrase($_SESSION['phrase'], $_SESSION['selected']);
}


var_dump($_POST);
var_dump($_SESSION);


 $game = new Game($phrase);
 var_dump($game->checkForLose());
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
    <?php  if($game->gameOver()) {
        echo $game->gameOver(); }
  
        ?>
        <h2 class="header">Phrase Hunter</h2>
        
        <?php echo $phrase->addPhraseToDisplay(); ?>
        <?php echo $game->displayKeyboard($_SESSION['selected']); ?>
        <?php echo $game->displayScore(); ?>
    </div>
   
    <a href="inc/endsession.php">Start Over</a>
</div>


</body>
</html>

<!-- 
This file creates a new instance of the Phrase class which OPTIONALLY accepts the current phrase as a string, and an array of selected letters.
    This file creates a new instance of the Game class which accepts the created instance of the Phrase class.
    The constructor should handle storing the phrase string and selected letters in sessions or another storage mechanism.
    In the body of the page you should play the game. To play the game:
        Use the gameOver method to check if the game has been won or lost and display appropriate messages.
        If the game is still in play, display the game items: displayPhrase(), displayKeyboard(), displayScore() -->
