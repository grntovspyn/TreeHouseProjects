<?php

class Phrase 
{
    private $currentPhrase;
    private $selected = array();

    public function __construct($phrase = "",$letters = array()) {
       

        if (!empty($phrase) && !empty($letters)) {
            $this->currentPhrase = $phrase;
            $this->selected = $letters;
            exit();
        }
        if(empty($phrase)) {
            $phrase = "dream big";
        }
       
        $this->currentPhrase = $phrase;
        /*
        *  $phrase a string, or if empty, get a random phrase
        *  $selected an array of selected letters
        */
    }

    public function addPhraseToDisplay() {
       
       $characters = str_split(strtolower($this->currentPhrase));
            $displayString = "<div id=\"phrase\" class=\"section\"><ul>";
               
       foreach ($characters as $character) {
           if (' ' == $character) {
               $displayString .= '<li class="hide space"> </li>';
           } else {
               $displayString .= "<li class=\"hide letter {$character}\">{$character}</li>";
           }
       }
       $displayString .= " </ul></div>";
       return $displayString;
        /*
        * Builds the HTML for the letters of the phrase. 
        * Each letter is presented by an empty box, one list item for each letter. 
        * See the example_html/phrase.txt file for an example of what the render HTML 
        * for a phrase should look like when the game starts. 
        * When the player correctly guesses a letter, the empty box is replaced with the matched letter. 
        * Use the class "hide" to hide a letter and "show" to show a letter. 
        * Make sure the phrase displayed on the screen doesn't include boxes for spaces: see example HTML. 
        */
    }

    public function checkLetter($letter) {
        //checks to see if a letter matches a letter in the phrase. Accepts a single letter to check against the phrase. Returns true or false.
    }

}// END OF CLASS
    

