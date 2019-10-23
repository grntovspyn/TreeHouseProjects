<?php
// PHP - Random Quote Generator

// Create the Multidimensional array of quote elements and name it quotes
// Each inner array element should be an associative array

// Quotes obtained from http://www.quotationspage.com/random.php
$quotes = array(
                array("quote" => "We are all here for a spell; get all the good laughs you can.","source" => "Will Rogers", "year" => "1879 - 1935", "category" => "motivational"),
                array("quote" => "There ain't no such thing as wrong food.","source" => "Sean Stewart","citation" => "Perfect Circle","year" =>  "2004", "category" => "food"),
                array("quote" => "You can't build a reputation on what you are going to do.","source" => "Henry Ford","year" => "1863 - 1947", "category" => "reputation"),
                array("quote" => "Everybody has difficult years, but a lot of times the difficult years end up being the greatest years of your whole entire life, if you survive them.","source" => "Seventeen Magazine","year" => "September 2003", "category" => "motivational"),
                array("quote" => "Marvelous Truth, confront us at every turn, in every guise.","source" => "Denise Levertov", "category" => "motivational"),
                array("quote" => "For today and its blessings, I owe the world an attitude of gratitude.","source" => "Clarence E. Hodges", "category" => "motivational")
);


// Create the getRandomQuuote function and name it getRandomQuote
function getRandomQuote($array){
    
    $count = count($array); //Not having to hard code amount of quotes in case more quotes are added
    
    return $array[(rand(1,$count)-1)]; //Select random quote offset by -1 because count() starts counting at 1 and array keys start at 0

}

// Create the printQuote funtion and name it printQuote
function printQuote($array) {

  $rand_quote = getRandomQuote($array);   

  $quote = $rand_quote['quote'];  
  $source = $rand_quote['source']; 
    
    //I prefer escaping the quotes here instead of concatinating the string and variables as it looked cleaner

  $string = "<p class=\"quote\"> $quote </p>";
  $string .= "<p class=\"source\"> $source";

    if(isset($rand_quote['citation'])){   //Check if selected quote has citation
        $citation = $rand_quote['citation'];
        $string .= "<span class=\"citation\"> $citation</span>";
    } 

    if(isset($rand_quote['year'])){  //Check if selected quote has year
        $year = $rand_quote['year'];
        $string .= "<span class=\"year\"> $year</span>";
    } 

    $category = $rand_quote['category']; //Extra category tag
    $string .= "<p class=\"category\"> $category </p>";
    $string .= "</p>";  //Closing tags for html statement

echo $string;  
    
}

?>

