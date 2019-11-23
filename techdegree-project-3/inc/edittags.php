<?php 

include("functions.php");

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $entryId = trim(filter_input(INPUT_POST, 'entryId', FILTER_SANITIZE_NUMBER_INT));

    if (isset($_POST['tagId'])) {
        foreach ($_POST['tagId'] as $tag) {
            $tagId[] = $tag;  //Create array of tags to be processed by function
        }
    }

    if (isset($_POST['update'])) {
        delete_tag_mapping($entryId);  //Delete the tag mappings so as to not have duplicate mappings to same tag
        if (isset($tagId)) {
            if (create_new_tag_mapping($entryId, $tagId)) {
                header('location: ../detail.php?id='.$entryId);
            } else {
                echo 'Unable to create new mapping';
            }
        }
        header('location: ../detail.php?id='.$entryId);;
    }


    if (isset($_POST['delete'])) {
        foreach ($tagId as $tag) {
            delete_tags($tag);
        }
        header('location: ../edit.php?id='.$entryId);
    }

    if (!empty($_POST['newTag'])) {
        $newTag = trim(filter_input(INPUT_POST, 'newTag', FILTER_SANITIZE_STRING));
        if (create_new_tag($entryId, $newTag)) {
            header('location: ../edit.php?id='.$entryId);
            
        } else {
            echo 'Cannot create new tag';
        }
    }
}

?>