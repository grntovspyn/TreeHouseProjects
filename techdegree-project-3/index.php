<?php include ("inc/header.php"); ?>

        <section>
            <div class="container">
                <div class="entry-list">
                    <?php
                    $entries = get_entry();
                    
                    foreach($entries AS $entry) {

                        echo "<article>
                        <h2><a href=\"detail.php?id=". $entry['id'] . "\">" .$entry['title']. "</a></h2>
                        <time datetime=\"" . $entry['date'] . "\">" . date('F, d, Y', strtotime($entry['date'])) . "</time>";
                        $tags = get_tags_by_entry_id($entry['id']);
                        if($tags == true){
                            echo "<p>";
                            $tags = array_column($tags, "tags");
                            foreach($tags as $tag){
                                echo "#" . $tag . " ";
                            }
                            echo "</p>";
                        }
                        
                         echo "</article>";

                    }
                    ?>

                </div>
            </div>
        </section>

<?php include ("inc/footer.php"); ?>
       