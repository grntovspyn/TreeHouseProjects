<?php 

include("functions.php");

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $entryId = trim(filter_input(INPUT_POST, 'entryId', FILTER_SANITIZE_NUMBER_INT));


    if(!empty($_POST['newTag'])){
        $newTag = trim(filter_input(INPUT_POST, 'newTag', FILTER_SANITIZE_STRING));
        if($_POST['entryId'] == "newEntry"){
            if(!create_new_unlinked_tag($newTag)){
                echo "Cannot create new tag";
            } else {
                header('location: ../new.php');
            }  
        } else if(!create_new_tag($entryId,$newTag)){
            echo "Cannot create new tag";
        } else {
            header('location: ../edit.php?id='. $entryId);
        }
    }
   


}

?>