<?php

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
        
    } catch(Exception $e) {
        echo "Unable to update DB" . $e->getMessage();
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
    $sql = "SELECT tags FROM tags WHERE entries_id = :entries_id";
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

function update_tags_by_entry_id($entires_id, $tags){

    include ("connection.php");


    try {
    $sql = "UPDATE tags SET entries_id = :entries_id, tags = :tags ";
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



?>