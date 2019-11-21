<?php


function create_new_tag($entryId, $tag)
{
    include 'connection.php';

    try {
        $sql = 'INSERT INTO tags (tags) VALUES (:tag);';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':tag', $tag, PDO::PARAM_STR);
        $stmt->execute();
        $tag_id = $db->lastInsertId();
        if (1 == $stmt->rowCount()) {
            if (map_entry_to_tags($entryId, $tag_id)) {
                return true;
            }

            return false;
        }
    } catch(Exception $e) {
        echo "Unable to insert" . $e->getMessage();
    }
}

function map_entry_to_tags($entry_id, $tag_id)

{
    include 'connection.php';


    try {
        $sql = 'INSERT INTO entry_tags (entry_id, tag_id) VALUES (:entry_id, :tag_id);';

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':entry_id', $entry_id, PDO::PARAM_INT);
        $stmt->bindParam(':tag_id', $tag_id, PDO::PARAM_INT);
        $stmt->execute();

        if (1 == $stmt->rowCount()) {
            return true;
        }

        return false;
    } catch (Exception $e) {
        echo "Unable to map tags" . $e->getMessage();
    }
}



function get_entry(){
    include ("connection.php");

    try {
        $sql = "SELECT * FROM entries ORDER BY date DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $results;

    } catch (Exception $e) {
        echo "Unable to query DB" . $e->getMessage();
        die();
    }

}

function get_entry_by_id($id){
    include ("connection.php");

    try {
        $sql = "SELECT * FROM entries WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $results;

    } catch (Exception $e) {
        echo "Unable to query DB" . $e->getMessage();
        die();
    }

}


function create_entry($title, $date, $time_spent, $learned, $resources) {
    include ("connection.php");
    
    try {
        $sql = "INSERT INTO entries (title, date, time_spent, learned, resources) VALUES (:title, :date, :time_spent, :learned, :resources)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':title',$title,PDO::PARAM_STR);
        $stmt->bindParam(':date',$date);
        $stmt->bindParam(':time_spent',$time_spent,PDO::PARAM_STR);
        $stmt->bindParam(':learned',$learned,PDO::PARAM_STR);
        $stmt->bindParam(':resources',$resources,PDO::PARAM_STR);
        $stmt->execute();

        if($stmt->rowCount() == 1){
            return true;
            
        } else {
            
            return false;
            
        }
        

    } catch(Exception $e) {
        echo "Unable to update DB" . $e->getMessage();
        die(); 
    }

}

function update_entry_by_id($id, $title, $date, $time_spent, $learned, $resources){
    include ("connection.php");
    

    try {
        $sql = "UPDATE entries SET title = :title, date = :date, time_spent = :time_spent, learned = :learned, resources = :resources WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->bindParam(':title',$title,PDO::PARAM_STR);
        $stmt->bindParam(':date',$date,PDO::PARAM_STR);
        $stmt->bindParam(':time_spent',$time_spent,PDO::PARAM_STR);
        $stmt->bindParam(':learned',$learned,PDO::PARAM_STR);
        $stmt->bindParam(':resources',$resources,PDO::PARAM_STR);
        $stmt->execute();

        if($stmt->rowCount() == 1){
            return true;
            
        } else {
            
            return false;
            
        }

    } catch (Exception $e) {
        echo "Unable to query DB" . $e->getMessage();
        die();
    }


    


}

function delete_entry($id){

    include ("connection.php");
    
    try {
        $sql = "DELETE FROM entries WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->execute();

        
        if($stmt->rowCount() == 1){
            return true;
            
        } else {
            
            return false;
            
        }

    } catch (Exception $e) {
        echo "Unable to query DB" . $e->getMessage();
        die();
    }

}


function get_tags_by_entry_id($entries_id){
    include ("connection.php");


    try {
    $sql = "SELECT tags.id, tags.tags FROM tags JOIN entry_tags ON tags.id = entry_tags.tag_id WHERE entry_tags.entry_id = :entries_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':entries_id',$entries_id,PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(!empty($results)) {
        return $results;
    } else {
        return false;
    }

} catch (Exception $e) {
    echo "Unable to query DB" . $e->getMessage();
    die();
}

}

function create_tags_by_entry_id($entries_id, $tags) {
    include ("connection.php");


    try {
        $sql = "INSERT INTO tags (entries_id, tags) VALUES (:entries_id, :tags) ";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':entries_id',$entries_id,PDO::PARAM_INT);
        $stmt->bindParam(':tags',$tags,PDO::PARAM_STR);
        $stmt->execute();

    if($stmt->rowCount() == 1){
        return true;
        
    } else {
        
        return false;
        
    }

    } catch (Exception $e) {
        echo "Unable to query DB" . $e->getMessage();
        die();
    }

}

function update_tags_by_entry_id($entries_id, $tags){

    include ("connection.php");
    $set = "";
    for($i = 1; $i <= count($tags); $i++) {
        $set .= "tags = :tags" . $i . ", ";
        
    }
    $set = substr($set, 0, -1);
    try {
    $sql = "UPDATE tags SET ";
    $sql .= $set;
    $sql .= " WHERE id = :entries_id";
    echo $sql;
    $stmt = $db->prepare($sql);
    for ($i = 1; $i <= count($tags); ++$i) {
        $stmt->bindParam(':tags' . $i, $tags[$i-1], PDO::PARAM_STR);
    }
    $stmt->bindParam(':entries_id',$entries_id,PDO::PARAM_INT);
    $stmt->execute();

    if($stmt->rowCount() == 1){
        return true;
        
    } else {
        
        return false;
        
    }

} catch (Exception $e) {
    echo "Unable to query DB" . $e->getMessage();
    die();
}


}
    
function delete_tags($tag){

    include ("connection.php");
    
    try {
        $sql = "DELETE FROM tags WHERE tags = :tag";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id',$tag,PDO::PARAM_STR);
        $stmt->execute();

        
        if($stmt->rowCount() == 1){
            return true;
            
        } else {
            
            return false;
            
        }

    } catch (Exception $e) {
        echo "Unable to query DB" . $e->getMessage();
        die();
    }

}


function insert_into_tags($entries_id, $tags){
    include ("connection.php");

    $sql = "INSERT INTO tags (entries_id, tags) VALUES (:entries_id, :tags)";

    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':entries_id', $entries_id, PDO::PARAM_INT);
        $stmt->bindParam(':tags', $tags, PDO::PARAM_STR);
        $stmt->execute();

        if (1 == $stmt->rowCount()) {
            return  true;
        }

        return false;
    } catch(Exception $e) {
        echo "Unable to insert into DB" . $e->getMessage();
    }

}


?>