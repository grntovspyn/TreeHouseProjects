<?php

class Phrase 
{
    private $currentPhrase;
    private $selected = array();
    public $phrases = array(
        "Boldness be my friend",
        "Leave no stone unturned",
        "Broken crayons still color",
        "The adventure begins"
    );

    public function __construct($phrase = "",$letters = array()) {
        /*
         *  $phrase a string, or if empty, get a random phrase
         *  $selected an array of selected letters
         */

        if (!empty($phrase) && !empty($letters)) {
            $this->currentPhrase = $phrase;
            $this->selected = $letters;
            
        }
        if (empty($phrase)) {
            $key = rand(0,count($this->phrases)-1);
            $this->currentPhrase = $this->phrases[$key];
        }

    }
    public function addPhraseToDisplay() {
       
        /*
        * Builds the HTML for the letters of the phrase. 
        * Each letter is presented by an empty box, one list item for each letter. 
        * See the example_html/phrase.txt file for an example of what the render HTML 
        * for a phrase should look like when the game starts. 
        * When the player correctly guesses a letter, the empty box is replaced with the matched letter. 
        * Use the class "hide" to hide a letter and "show" to show a letter. 
        * Make sure the phrase displayed on the screen doesn't include boxes for spaces: see example HTML. 
        */

       $characters = str_split(strtolower($this->currentPhrase));
       var_dump($this->selected);
       //$selected = implode(",", $this->selected);
            $displayString = "<div id=\"phrase\" class=\"section\"><ul>\n";
               
       foreach ($characters as $character) {

           switch($character) {

            case(in_array($character,$this->selected)):
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

   
     //checks to see if a letter matches a letter in the phrase. Accepts a single letter to check against the phrase. Returns true or false.
    public function checkLetter($letter) {
        $characters = array_unique(str_split(str_replace(' ', '',strtolower($this->currentPhrase))));

        if (in_array($letter, $characters)) {
            return true;
        } else {
            return false;
        }

 

       
    }
 
    public function getPhrase() {
        
        return $this->currentPhrase;

    }

       
}// END OF CLASS
    

