<?php 

include("functions.php");

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $entryId = trim(filter_input(INPUT_POST, 'entryId', FILTER_SANITIZE_NUMBER_INT));

    if (isset($_POST['tagId'])) {
        foreach ($_POST['tagId'] as $tag) {
            $tagId[] = $tag;
        }
       if(isset($_POST['update'])){
        if(delete_tag_mapping($entryId)){
            if(create_new_tag_mapping($entryId,$tagId)){
                header('location: ../edit.php?id='. $entryId);
            }
        } else {
            echo "Unable to delete from mapping";
        }
    } else if(isset($_POST['delete'])){
        foreach ($tagId as $tag) {
            delete_tags($tag);
        }
            header('location: ../edit.php?id='. $entryId);
        }
    } else {
        echo 'Unable to delete from mapping';
    }
    }


    if(!empty($_POST['newTag'])){
        $newTag = trim(filter_input(INPUT_POST, 'newTag', FILTER_SANITIZE_STRING));
        if(!create_new_tag($entryId,$newTag)){
            echo "Cannot create new tag";
        } else {
            header('location: ../edit.php?id='. $entryId);
        }
    }
   




?>