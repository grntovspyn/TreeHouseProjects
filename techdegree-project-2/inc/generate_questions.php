<?php
// Generate random questions
function randomEquation($questionCount)
{
    // Loop for required number of questions
    $i = 1; 
    while ($i <= $questionCount) {
        // Get random numbers to add
        $x = rand(11, 99);
        $y = rand(11, 99);
        // Calculate correct answer
        $correctAnswer = $x + $y;
        // Get incorrect answers within 10 numbers either way of correct answer
        $firstWrong = $correctAnswer + rand(-10, 10);
        $secondWrong = $correctAnswer + rand(-10, 10);

        // Make sure it is a unique answer

        while ($correctAnswer == $firstWrong || $correctAnswer == $secondWrong) {
            $firstWrong = $correctAnswer + rand(-10, 10);
            $secondWrong = $correctAnswer + rand(-10, 10);

            while ($firstWrong == $secondWrong) {  
                $secondWrong = $correctAnswer + rand(-10, 10);
            }
        }
    
        // Add question and answer to questions array
        $formula = array('x' => $x,
                     'y' => $y,
                     'correctAnswer' => $correctAnswer,
                     'firstWrong' => $firstWrong,
                     'secondWrong' => $secondWrong
                );
        
        // Store questions to json file to be retrieved later.

        $file = 'questionBank.json';
        $questionBank[] = $formula;
        
        $json = json_encode($questionBank, JSON_PRETTY_PRINT);
        $fp = fopen($file, 'w'); // This will overwrite all previous questions creating a new quiz every time
        fwrite($fp, $json);
        fclose($fp);
        $i++;
        
    }  
    return $formula;
}

?>