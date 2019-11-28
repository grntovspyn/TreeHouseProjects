<?php

class Game
{

    private $phrase;
    private $lives = 5;

    public function __construct($obj) {
        $this->phrase = $obj;
    }

    public function checkForWin() {
        //this method checks to see if the player has selected all of the letters.
    }

    public function checkForLose() {
        //this method checks to see if the player has guessed too many wrong letters.
    }

    public function gameOver() {
        //this method displays one message if the player wins and another message if they lose. It returns false if the game has not been won or lost.
    }

    public function displayKeyboard($correctKey, $incorrectKey){
        $rowOneArray = array("q","w","e","r","t","y","u","i","o","p");
        $rowTwoArray = array("a","s","d","f","g","h","j","k","l");
        $rowThreeArray = array("z","x","c","v","b","n","m");
        $correctKeyArray = str_split(strtolower($correctKey));
        $incorrectKeyArray = str_split(strtolower($incorrectKey));
        /*
        * Create a onscreen keyboard form. See the example_html/keyboard.txt file for an example 
        * of what the render HTML for the keyboard should look like. If the letter has been selected 
        * the button should be disabled. Additionally, the class "correct" or "incorrect" should be 
        * added based on the checkLetter() method of the Phrase object. Return a string of HTML for the keyboard form.
        */

        $keyboard = "<form method=\"post\" action=\"play.php\">\n";
        $keyboard .= "<div id=\"qwerty\" class=\"section\">";
        $keyboard .= "<div class=\"keyrow\">\n";

        

        foreach($rowOneArray as $rowOneLetter) {
            $keyboard .= "<button class=\"key\" name=\"key\" value=\"" . $rowOneLetter . "\" ";
            
            if(stripos($correctKey, $rowOneLetter) !== false){
                $keyboard .= "style=\"background-color: green\" disabled";
            } elseif(stripos($incorrectKey, $rowOneLetter) !== false) {
                $keyboard .= "style=\"background-color: red\" disabled";
            }

            $keyboard .=">" . $rowOneLetter . "</button>\n";
        }
       
        $keyboard .= "</div> \n <div class=\"keyrow\">\n";
        foreach($rowTwoArray as $rowTwoLetter) {
            $keyboard .= "<button class=\"key\" name=\"key\" value=\"" . $rowTwoLetter . "\" ";
            if(stripos($correctKey, $rowTwoLetter) !== false){
                $keyboard .= "style=\"background-color: green\" disabled";
            } elseif(stripos($incorrectKey, $rowTwoLetter) !== false ) {
                $keyboard .= "style=\"background-color: red\" disabled";
            }

            $keyboard .=">" . $rowTwoLetter . "</button>\n";
        }

       
        $keyboard .= "</div> \n <div class=\"keyrow\">\n";

        foreach($rowThreeArray as $rowThreeLetter) {
            $keyboard .= "<button class=\"key\" name=\"key\" value=\"" . $rowThreeLetter . "\" ";
            if(stripos($correctKey, $rowThreeLetter) !== false){
                $keyboard .= "style=\"background-color: green\" disabled";
            } elseif(stripos($incorrectKey, $rowThreeLetter) !== false) {
                $keyboard .= "style=\"background-color: red\" disabled";
            }

            $keyboard .=">" . $rowThreeLetter . "</button>\n";
        }

        $keyboard .= "</div> \n </div> \n </form>\n";

        return $keyboard;

    }

    public function displayScore($incorrectKey) {
        $score = "<div id=\"scoreboard\" class=\"section\">\n<ol>\n";
        /*
        * Display the number of guesses available. See the example_html/scoreboard.txt file for an 
        * example of what the render HTML for a scoreboard should look like. Return string HTML of Scoreboard.
        */
        for ($i = 1; $i <= $this->lives; ++$i) {
            if (strlen($incorrectKey) >= 1 && strlen($incorrectKey) < $this->lives) {
                while ($i <= strlen($incorrectKey)) {
                    $score .= "<li class=\"tries\"><img src=\"images/lostHeart.png\" height=\"35px\" widght=\"30px\"></li>\n";
                    ++$i;
                }
               
            }
            $score .= "<li class=\"tries\"><img src=\"images/liveHeart.png\" height=\"35px\" widght=\"30px\"></li>\n";
        }

        $score .= "</ol>\n</div>";

        return $score;
    }

} //END OF CLASS


    // The class must have at least two properties:
    //     $phrase an instance of the Phrase class to use with the game
    //     $lives an integer for the number of wrong chances to guess the phrase
    // The class should include a constructor which accepts a Phrase object and sets the property

