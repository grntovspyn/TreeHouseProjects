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

    public function displayKeyboard(){
        
        /*
        * Create a onscreen keyboard form. See the example_html/keyboard.txt file for an example 
        * of what the render HTML for the keyboard should look like. If the letter has been selected 
        * the button should be disabled. Additionally, the class "correct" or "incorrect" should be 
        * added based on the checkLetter() method of the Phrase object. Return a string of HTML for the keyboard form.
        */

        $keyboard = "<form method=\"post\" action=\"play.php\"";
        $keyboard .= "<div id=\"qwerty\" class=\"section\">";
        $keyboard .= "<div class=\"keyrow\">";
        $keyboard .= "<button class=\"key\" name=\"key\" value=\"q\">q</button>";
        $keyboard .= "<button class=\"key\" name=\"key\" value=\"w\">w</button>";
        $keyboard .= "<button class=\"key\" name=\"key\" value=\"e\">e</button>";
        $keyboard .= "<button class=\"key\" name=\"key\" value=\"r\">r</button>";
        $keyboard .= "<button class=\"key\" name=\"key\" value=\"t\" style=\"background-color: red\" disabled>t</button>";
        $keyboard .= "<button class=\"key\" name=\"key\" value=\"y\">y</button>";
        $keyboard .= "<button class=\"key\" name=\"key\" value=\"u\">u</button>";
        $keyboard .= "<button class=\"key\" name=\"key\" value=\"i\">i</button>";
        $keyboard .= "<button class=\"key\" name=\"key\" value=\"o\">o</button>";
        $keyboard .= "<button class=\"key\" name=\"key\" value=\"p\">p</button>";
        $keyboard .= "</div> \n <div class=\"keyrow\">";
        $keyboard .= "<button class=\"key\" name=\"key\" value=\"a\">a</button>";
        $keyboard .= "<button class=\"key\" name=\"key\" value=\"s\">s</button>";
        $keyboard .= "<button class=\"key\" name=\"key\" value=\"d\">d</button>";
        $keyboard .= "<button class=\"key\" name=\"key\" value=\"f\">f</button>";
        $keyboard .= "<button class=\"key\" name=\"key\" value=\"g\">g</button>";
        $keyboard .= "<button class=\"key\" name=\"key\" value=\"h\">h</button>";
        $keyboard .= "<button class=\"key\" name=\"key\" value=\"j\">j</button>";
        $keyboard .= "<button class=\"key\" name=\"key\" value=\"k\">k</button>";
        $keyboard .= "<button class=\"key\" name=\"key\" value=\"l\">l</button>";
        $keyboard .= "</div> \n <div class=\"keyrow\">";
        $keyboard .= "<button class=\"key\" name=\"key\" value=\"z\">z</button>";
        $keyboard .= "<button class=\"key\" name=\"key\" value=\"x\">x</button>";
        $keyboard .= "<button class=\"key\" name=\"key\" value=\"c\">c</button>";
        $keyboard .= "<button class=\"key\" name=\"key\" value=\"v\">v</button>";
        $keyboard .= "<button class=\"key\" name=\"key\" value=\"b\">b</button>";
        $keyboard .= "<button class=\"key\" name=\"key\" value=\"n\">n</button>";
        $keyboard .= "<button class=\"key\" name=\"key\" value=\"m\">m</button>";
        $keyboard .= "</div> \n </div> \n </form>";

        return $keyboard;

    }

    public function displayScore() {

        /*
        * Display the number of guesses available. See the example_html/scoreboard.txt file for an 
        * example of what the render HTML for a scoreboard should look like. Return string HTML of Scoreboard.
        */
        for($i = 1; $i <=$this->lives; $i++){

            //
        }
        $score = '<div id="scoreboard" class="section">
    <ol>
        <li class="tries"><img src="images/lostHeart.png" height="35px" widght="30px"></li>
        <li class="tries"><img src="images/liveHeart.png" height="35px" widght="30px"></li>
        <li class="tries"><img src="images/liveHeart.png" height="35px" widght="30px"></li>
        <li class="tries"><img src="images/liveHeart.png" height="35px" widght="30px"></li>
        <li class="tries"><img src="images/liveHeart.png" height="35px" widght="30px"></li>
    </ol>
</div>';

        return $score;
    }

} //END OF CLASS


    // The class must have at least two properties:
    //     $phrase an instance of the Phrase class to use with the game
    //     $lives an integer for the number of wrong chances to guess the phrase
    // The class should include a constructor which accepts a Phrase object and sets the property

