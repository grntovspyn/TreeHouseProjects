<?php 

include("functions.php");

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $id = trim(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
    $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
    $date = trim(filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING));
    $time_spent = trim(filter_input(INPUT_POST, 'time_spent', FILTER_SANITIZE_STRING));
    $learned = trim(filter_input(INPUT_POST, 'learned', FILTER_SANITIZE_STRING));
    $resources = trim(filter_input(INPUT_POST, 'resources', FILTER_SANITIZE_STRING));
  
    if (isset($_POST['update'])) {
        if (update_entry_by_id($id, $title, $date, $time_spent, $learned, $resources)) {
            header('location: ../detail.php?id='.$id);
        } else {
            echo 'Something failed';
        }
    } else if (isset($_POST['delete'])) {
    if(delete_entry($id)){
        header("location: ../index.php");
    } else {
        echo "Unable to delete";
    }
    }
}
?>