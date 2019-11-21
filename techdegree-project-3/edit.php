<?php include ("inc/header.php"); ?>

<?php
$message = "";


if ('GET' == $_SERVER['REQUEST_METHOD']) {
    if (isset($_GET['id'])) {
        $entryId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    } else {
        header('location: index.php');
    }
    $editEntry = get_entry_by_id($entryId);
    $tags = get_tags_by_entry_id($entryId);
    
}

if (isset($editEntry)) {
    $id = htmlspecialchars($editEntry['id']);
    $title = htmlspecialchars($editEntry['title']);
    $date = htmlspecialchars($editEntry['date']);
    $time_spent = htmlspecialchars($editEntry['time_spent']);
    $learned = htmlspecialchars_decode($editEntry['learned']);
    $resources = htmlspecialchars($editEntry['resources']);
        
}



?>
        <section>
            <div class="container">
            
                <div class="edit-entry">
                <div id="mess"><?php echo $message;?></div>
                    <h2>Edit Entry</h2>
                    <form method="post" action="inc/editentry.php?id=<?php echo $entryId;?>">
                        <input type="hidden" name="id" value="<?php echo $entryId;?>">
                        <label for="title"> Title</label>
                        <input id="title" type="text" name="title" value="<?php echo $title;?>"><br>
                        <label for="date">Date</label>
                        <input id="date" type="date" name="date" value="<?php echo $date;?>"><br>
                        <label for="time_spent"> Time Spent</label>
                        <input id="time_spent" type="text" name="time_spent" value="<?php echo $time_spent;?>"><br>
                        <label for="what-i-learned">What I Learned</label>
                        <textarea id="what-i-learned" rows="5" name="learned"><?php echo $learned;?></textarea>
                        <label for="resources-to-remember">Resources to Remember</label>
                        <textarea id="resources-to-remember" rows="5" name="resources"><?php echo $resources;?></textarea>
                        
                        <input type="submit" value="Update Entry" class="button">
                   
                    </form>
                    <br>
                    <form method="post" action="inc/edittags.php">
                        
                    <label for="tags">Select which tags to use</label>
                    <input type="hidden" name="entryId" value="<?php echo $entryId;?>">
                        <fieldset class="checkbox" >
                        
                        <?php foreach($tags as $tag){
                            echo "<input type=\"checkbox\" name=\"tagId[]\" value=" . $tag['id'] . "> " . $tag['tags'] . "<br>";
                        }
                        ?>
                       
                         </fieldset>
                         
                        <label for="newTag">Add a new tag</label>
                        <input type="text" id="newTag" name="newTag">
                        <input type="submit" value="Add New Tag" class="button">
                    </form>
                    <form action="inc/delete_entry.php" method="post" onsubmit="return confirm('Are you sure you want to delete?')">
                    <input type="hidden" name="id" value="<?php echo $entryId; ?>">
                    <input type="submit" value="Delete Entry" class="button2">
                    </form>
                </div>
            </div>
        </section>

<?php include ("inc/footer.php"); ?>