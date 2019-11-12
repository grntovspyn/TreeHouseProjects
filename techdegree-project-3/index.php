<?php include ("inc/header.php"); ?>

        <section>
            <div class="container">
                <div class="entry-list">
                    <?php
                    foreach(get_entry() AS $entry) {
                        echo "<article>
                        <h2><a href=\"detail.php?id=". $entry['id'] . "\">" .$entry['title']. "</a></h2>
                        <time datetime=\"" . $entry['date'] . "\">" . date('F, d, Y', strtotime($entry['date'])) . "</time>
                         </article>";
                    }
                    ?>

                </div>
            </div>
        </section>

<?php include ("inc/footer.php"); ?>
       