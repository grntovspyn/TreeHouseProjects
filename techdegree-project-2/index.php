<?php
session_start();
if(isset($_SESSION['questionCount']) && $_SESSION['count'] > $_SESSION['questionCount']){
   
        session_destroy();
        session_start();
    
}
$quiz = json_decode(file_get_contents("inc/questionBank.json"));

if (empty($count)) {
    $count = 1;
}

?>

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
        <?php  if(empty($_SESSION['questionCount'])) { ?>
            
            <form action="inc/quiz.php" method="post">
                <p class="breadcrumbs">How many questions would you like to answer?</p>
                <input type="submit" class="btn" name="questionCount" value="1" />
                <input type="submit" class="btn" name="questionCount" value="5" />
                <input type="submit" class="btn" name="questionCount" value="10" />
            </form>

            <?php } else {

                    $totalQuestions = $_SESSION['questionCount'];

                ?>

                 <p class="breadcrumbs"><?php echo "Question " . $_SESSION['count'] . " of " . $totalQuestions; ?> </p>
                 <p class="quiz">What is <?php echo $quiz[$_SESSION['count']-1]->x; ?> + <?php echo $quiz[$_SESSION['count']-1]->y; ?>?</p>
                 <form action="inc/quiz.php" method="post">
                    <input type="hidden" name="id" value="0" />

                    <?php

                        /*  
                        *   The options array holds the keys for the switch statement. I shuffle the keys and loops through the switch statement the same 
                        *   amount of times as there are keys. With the array shuffled the order of the switch statements changes everytime but it makes sure to hit 
                        *   each case so all three answers are still displayed. 
                        */

                        $options = array(0,1,2);
                        $x = 1;
                        while ($x <= count($options)) {
                            shuffle($options);
                            foreach ($options as $value) {
                                switch ($value) {
                        case 0:
                            ?> <input type="submit" class="btn" name="correct" value=<?php echo $quiz[$_SESSION['count']-1]->correctAnswer; ?> /> <?php
                            $x++;
                            break;
                        case 1:
                            ?> <input type="submit" class="btn" name="wrong" value=<?php echo $quiz[$_SESSION['count']-1]->firstWrong; ?> /> <?php
                            $x++;
                            break;
                        case 2:
                            ?> <input type="submit" class="btn" name="wrong" value=<?php echo $quiz[$_SESSION['count']-1]->secondWrong; ?> /> <?php
                            $x++;
                            break;
                        default:
                            break;
                                }
                            }
                        }
                    
                    ?>

                    </form>
                    <div class="toast">
                        <?php

                            if (1 != $_SESSION['count']) {
                                if (true == $_SESSION['lastCorrect']) {
                                    echo "<p class='true'>Your last answer of " .  $quiz[$_SESSION['count']-2]->correctAnswer . " was correct!</p>";
                                } else {
                                    echo "<p class='false'>Sorry the last answer was incorrect!</p>";
                                }
                            }

                        ?>
                    </div>
            <?php } ?>
 
        </div>
    </div>
</body>
</html>