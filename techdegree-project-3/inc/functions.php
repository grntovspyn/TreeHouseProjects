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

function get_tags() {
    include ("connection.php");

    try {
        $sql = "SELECT * FROM TAGS";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $results;

    } catch (Exception $e) {
        echo "Unable to query DB" . $e->getMessage();
        die();
    }

}

    
function delete_tags($tag){

    include ("connection.php");
    
    try {
        $sql = "DELETE FROM tags WHERE id = :tagId";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("tagId",$tag,PDO::PARAM_INT);
        $stmt->execute();

        if($stmt->rowCount() >= 1){
            return true;
        } else {
            return false;
        }


    } catch (Exception $e) {
        echo "Unable to query DB" . $e->getMessage();
        die();
    }

}


function delete_tag_mapping($entryId){
    include ("connection.php");



    try {
        $sql = 'DELETE FROM entry_tags WHERE entry_id = :entry_id';
        $stmt = $db->prepare($sql);
        $stmt->bindParam('entry_id',$entryId, PDO::PARAM_INT);
        $stmt->execute();

        if($stmt->rowCount() >= 1){
            return true;
        } else {
            return false;
        }

    } catch(Exception $e) {
        "Unable to query DB" . $e->getMessage();
    }


}

function create_new_tag_mapping($entryId,$tagId) {
    include ("connection.php");


    try {
        foreach($tagId as $tId)
        $sql = "INSERT INTO entry_tags (entry_id, tag_id) VALUES (:entryId, :tagId)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("entryId",$entryId,PDO::PARAM_INT);
        $stmt->bindParam("tagId",$tId,PDO::PARAM_INT);
        $stmt->execute();

        if($stmt->rowCount() >= 1){
            return true;
        } else {
            return false;
        }


    } catch (Exception $e) {
        "Unable to query DB" . $e->getMessage();
    }

    }








?>