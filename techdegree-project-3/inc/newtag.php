<?php 

include("functions.php");

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $entryId = trim(filter_input(INPUT_POST, 'entryId', FILTER_SANITIZE_NUMBER_INT));


    if (!empty($_POST['newTag'])) {
        $newTag = trim(filter_input(INPUT_POST, 'newTag', FILTER_SANITIZE_STRING));
        $newTag = str_replace(' ', '', $newTag); //no spaces in hashtags
        $tagArray = explode(',', $newTag);

        foreach ($tagArray as $newTag) {
            if ('newEntry' == $_POST['entryId']) {
                if (!create_new_unlinked_tag($newTag)) {
                    echo 'Cannot create new tag';
                } else {
                    header('location: ../new.php');
                }
            } elseif (!create_new_tag($entryId, $newTag)) {
                echo 'Cannot create new tag';
            } else {
                header('location: ../edit.php?id='.$entryId);
            }
        }
    }
   


}

?>