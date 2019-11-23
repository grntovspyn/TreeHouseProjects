<?php 
include ("inc/header.php"); 

if ('GET' == $_SERVER['REQUEST_METHOD']) {
    if (isset($_GET['id'])) {
        $entryId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    } else {
        header('location: index.php');
    }
}

$currentEntry = get_entry_by_id($entryId);

?>

        <section>
            <div class="container">
                <div class="entry-list single">
                    <article>
                        <h1><?php echo $currentEntry['title']; ?></h1>
                        <time datetime="<?php echo $currentEntry['date']; ?>"><?php echo date('F, d, Y', strtotime($currentEntry['date'])); ?></time>
                        <div class="entry">
                            <h3>Time Spent: </h3>
                            <p><?php echo $currentEntry['time_spent']; ?></p>
                        </div>
                        <div class="entry">
                            <h3>What I Learned:</h3>
                            <p><?php echo $currentEntry['learned']; ?></p>
                            
                        </div>
                        <?php
                            if($currentEntry['resources'] != NULL) { ?>
                             <div class="entry">
                           
                            <h3>Resources to Remember:</h3>
                            <ul>
                                <?php 
                                    $resources = explode(",",$currentEntry['resources']);
                                    foreach($resources as $resource){
                                        echo "<li><a href=\"\">". $resource . "</a></li>";
                                    }
                             
                                ?>
                            </ul>
                        </div>
                          <?php  } ?>

                          <?php 
                            $tags = get_tags_by_entry_id($currentEntry['id']);
                            if(!empty($tags)){ ?>
                          <div class="entry">
                          <h3>Tags</h3>
                              <?php

                              if (true == $tags) {
                                  echo '<p>';
                                  $tags = array_column($tags, 'tags');
                                  foreach ($tags as $tag) {
                                      echo "<a class='taglink' href=index.php?tag=".$tag.'>#'.$tag.'</a> ';
                                  }
                                  echo '</p>';
                              }
                            }
                              ?>
                              </div>

                    </article>
                </div>
            </div>
            <div class="edit">
                <p><a href="edit.php?id=<?php echo $entryId; ?>">Edit Entry</a></p>
            </div>
        </section>

<?php include ("inc/footer.php"); ?>