<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Math Quiz: Addition</title>
    <link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="container">
    <div id="quiz-box">
        <p class="quiz">Your final score is <?php echo $_SESSION['numCorrect']; ?> out of <?php echo $_SESSION['questionCount']; ?> </p>
        <a class="btn" href="inc/endsession.php">Start Over</a>
        </div>
        
    </div>
    
</body>
</html>