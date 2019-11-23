<?php include ("inc/header.php"); ?>

<?php
$message = "";



    if (isset($_GET['id'])) {
        $entryId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $editEntry = get_entry_by_id($entryId);
        $tags = get_tags();

        //Used to check the boxes of current tags
        $usedTags = get_tags_by_entry_id($entryId); 
        if(is_array($usedTags)) {
            $usedTags = array_column($usedTags, 'id');
        } else {
            $usedTags = array();
        }
    } else {
        header('location: index.php');
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
                        <input id="title" type="text" name="title" value="<?php echo $title;?>" required><br>
                        <label for="date">Date</label>
                        <input id="date" type="date" min="1999-01-01" max="<?php echo date("Y-m-d"); ?>" name="date" value="<?php echo $date;?>" required><br>
                        <label for="time_spent"> Time Spent</label>
                        <input id="time_spent" type="text" name="time_spent" value="<?php echo $time_spent;?>" required><br>
                        <label for="what-i-learned">What I Learned</label>
                        <textarea id="what-i-learned" rows="5" name="learned" required><?php echo $learned;?></textarea>
                        <label for="resources-to-remember">Resources to Remember</label>
                        <textarea id="resources-to-remember" rows="5" name="resources" placeholder="Seperate each resource by a comma"><?php echo $resources;?></textarea>
                        
                        <input type="submit" name="update" value="Update Entry" class="button">
                        <input type="submit" name="delete" value="Delete Entry" class="button2">
                   
                    </form>
                   
                   
                    
                    <form method="post" action="inc/edittags.php">
                        
                    <label for="tags">Select which tags to use</label>
                    <input type="hidden" name="entryId" value="<?php echo $entryId;?>">
                        <fieldset form="delTags" class="checkbox" >
                        
                        <?php foreach($tags as $tag){
                            echo "<input type=\"checkbox\" name=\"tagId[]\" value=" . $tag['id'] . " ";
                            if(in_array($tag['id'], $usedTags)){  //check if tag is used out of all the tags and if so check the box
                                echo "checked";
                            }
                            echo "> " . $tag['tags'] . "\n<br>";
                          
                        } 
                        ?>
                       
                         </fieldset>
                         
                        <input type="submit" name="update" value="Updated Selected Tags" class="button">
                        <input type="submit" name="delete" value="Delete Selected Tags" class="button2">
                    </form>
                   

                   
                    <form method="post" action="inc/newtag.php">
                    <input type="hidden" name="entryId" value="<?php echo $entryId;?>">
                    <label for="newTag">Add a new tag</label>
                        <input type="text" id="newTag" name="newTag" placeholder="Seperate each tag by a comma" required>
                        <input type="submit" value="Add New Tag" class="button">
                    </form>
                </div>
            </div>
        </section>

<?php include ("inc/footer.php"); ?>