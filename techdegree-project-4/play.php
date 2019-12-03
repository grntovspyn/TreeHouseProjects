<?php
session_start();
require "inc/Game.php";
require "inc/Phrase.php";

//Checks if new game is started otherwise checks if game is in play.  If neither are true then resets the game

if(isset($_POST['startgame'])){
    unset($_SESSION['selected']);
    unset($_SESSION['phrase']);
    $_SESSION['letters'] = "";
    $_SESSION['selected'] = array();
    $phrase = new Phrase();
    $_SESSION['phrase'] = $phrase->getPhrase();

} else if (isset($_POST['key'])) {
    $_SESSION['selected'][] = filter_input(INPUT_POST, "key", FILTER_SANITIZE_STRING);
    $phrase = new Phrase($_SESSION['phrase'], $_SESSION['selected']);
} else {
    unset($_SESSION['selected']);
    unset($_SESSION['phrase']);
    session_destroy();
    header("location: index.html");
}

 $game = new Game($phrase);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Phrase Hunter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <script src="js/scripts.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>

<body>
<div class="main-container">
    
    <div id="banner" class="section">
    <?php  
        if($game->gameOver()) {
            echo $game->gameOver(); 
        } else {

        ?>
        <h2 class="header">Phrase Hunter</h2>
        
        <?php echo $phrase->addPhraseToDisplay(); ?>
        <?php echo $game->displayKeyboard($_SESSION['selected']); ?>
        <?php echo $game->displayScore(); ?>
    </div>
    <a href="inc/endsession.php">Start Over</a>
        <?php } ?>
    
</div>



</body>
</html>
