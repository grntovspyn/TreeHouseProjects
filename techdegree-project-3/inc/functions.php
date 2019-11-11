<?php
function get_entry(){
    include ("connection.php");

    try {
        $sql = "SELECT * FROM entries";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $results;

    } catch (Exception $e) {
        echo "Unable to query DB" . $e->getMessage();
    }

}









?>