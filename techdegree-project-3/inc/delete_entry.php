<?php
include("functions.php");
if($_SERVER['REQUEST_METHOD'] == "POST") {
   
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    if(delete_entry($id)){
        header("location: ../index.php");
    } else {
        echo "Unable to delete";
    }
    
}




?>