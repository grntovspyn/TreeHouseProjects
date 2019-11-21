<?php 

include("functions.php");

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $entryId = trim(filter_input(INPUT_POST, 'entryId', FILTER_SANITIZE_NUMBER_INT));

    if (isset($_POST['tagId'])) {
       
            foreach ($_POST['tagId'] as $tag) {
                $tagId[] = $tag;
            }
        //Delete previous entrytag maps
        //Insert updated entry map tags
    }

    if(!empty($_POST['newTag'])){
        $newTag = trim(filter_input(INPUT_POST, 'newTag', FILTER_SANITIZE_STRING));
        if(!create_new_tag($entryId,$newTag)){
            echo "Cannot create new tag";
        } else {
            header('location: ../edit.php?id='. $entryId);
        }
    }
   


}

?>