<?php

class Phrase 
{
    private $currentPhrase;
    private $selected = array();

    public function __construct($phrase = "",$letters = array()) {
        /*
         *  $phrase a string, or if empty, get a random phrase
         *  $selected an array of selected letters
         */

        if (!empty($phrase) && !empty($letters)) {
            $this->currentPhrase = $phrase;
            $this->selected = $letters;
            exit();
        }
        if (empty($phrase)) {
            $phrase = 'hello world';
        }

        $this->currentPhrase = $phrase;
    }
    public function addPhraseToDisplay($correctKey) {
       
        /*
        * Builds the HTML for the letters of the phrase. 
        * Each letter is presented by an empty box, one list item for each letter. 
        * See the example_html/phrase.txt file for an example of what the render HTML 
        * for a phrase should look like when the game starts. 
        * When the player correctly guesses a letter, the empty box is replaced with the matched letter. 
        * Use the class "hide" to hide a letter and "show" to show a letter. 
        * Make sure the phrase displayed on the screen doesn't include boxes for spaces: see example HTML. 
        */

       $characters = $this->splitPhrase();
            $displayString = "<div id=\"phrase\" class=\"section\"><ul>\n";
               
       foreach ($characters as $character) {

           switch($character) {

            case(stripos($correctKey, $character) !== false):
                $displayString .= "<li class=\"show letter {$character}\">{$character}</li>\n";
            break;

            case " ":
                $displayString .= "<li class=\"hide space\"> </li>\n";
            break;

            default:
                $displayString .= "<li class=\"hide letter {$character}\">{$character}</li>\n";
            break;

           }
           
       }
       $displayString .= " </ul></div>";
       return $displayString;
       
    }

    public function splitPhrase() {
        return str_split(strtolower($this->currentPhrase));
    }


     //checks to see if a letter matches a letter in the phrase. Accepts a single letter to check against the phrase. Returns true or false.
    public function checkLetter($letter) {
        $characters = $this->splitPhrase();
        foreach($characters as $character) {
            if ($character == $letter) {
                
                return true;
                }
        }
        return false;
    }
        

       
    

}// END OF CLASS
    

