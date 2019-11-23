<?php include ("inc/header.php"); ?>

<?php
$tags = get_tags();
$message = "";
if('POST' == $_SERVER['REQUEST_METHOD']) {
    if(!empty($_POST['title']) && !empty($_POST['date']) && !empty($_POST['time_spent']) && !empty($_POST['learned'])) {
    
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
    $time_spent = filter_input(INPUT_POST, 'time_spent', FILTER_SANITIZE_STRING);
    $learned = filter_input(INPUT_POST, 'learned', FILTER_SANITIZE_STRING);
    $resources = filter_input(INPUT_POST, 'resources', FILTER_SANITIZE_STRING);
    if (isset($_POST['tagId'])) {
        foreach ($_POST['tagId'] as $tag) {
            $tagId[] = $tag;
        }
    } else {
        $tagId = array();
    }
    if(create_entry($title, $date, $time_spent, $learned, $resources, $tagId)){
        header("location: index.php");
    } else {
        $message = "Unable to post entry";
    
    }

    } else {
        $message = "Please fill out all required fields: Title, Date, Time Spend, and What I learned.";
    }
    
    
    }
    

?>


        <section>
            <div class="container">
                <div class="new-entry">
                <div id="mess"><?php echo $message;?></div>
                    <h2>New Entry</h2>
                    <form method="post" action="new.php">
                        <label for="title" > Title</label>
                        <input id="title" type="text" name="title" required><br>
                        <label for="date">Date</label>
                        <input id="date" type="date" min="1995-01-01" max="<?php echo date("Y-m-d"); ?>" name="date" required><br>
                        <label for="time-spent"> Time Spent</label>
                        <input id="time-spent" type="text" name="time_spent" required><br>
                        <label for="what-i-learned">What I Learned</label>
                        <textarea id="what-i-learned" rows="5" name="learned" required></textarea>
                        <label for="resources-to-remember">Resources to Remember</label>
                        <textarea id="resources-to-remember" rows="5" name="resources" placeholder="Seperate each resource by a comma"></textarea>
                        <label for="tags">Select which tags to use</label>
                        <input type="hidden" name="entryId" value="<?php echo $entryId;?>">
                        <fieldset class="checkbox" >
                        
                        <?php foreach($tags as $tag){
                            echo "<input type=\"checkbox\" name=\"tagId[]\" value=" . $tag['id'] . "> " . $tag['tags'] . "<br>";
                          
                        } 
                        ?>
                       
                         </fieldset>
                        <input type="submit" value="Publish Entry" class="button">
                        
                    </form>
                    <form method="post" action="inc/newtag.php">
                    <input type="hidden" name="entryId" value="newEntry">
                    <label for="newTag">Add a new tag</label>
                        <input type="text" id="newTag" name="newTag" placeholder="Seperate each tag by a comma" required>
                        <input type="submit" value="Add New Tag" class="button">
                    </form>
                </div>
            </div>
        </section>

<?php include ("inc/footer.php"); ?>