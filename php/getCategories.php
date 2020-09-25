<?php

require '__connect__Me__To__Database__Please__.php';

    $stmt = $mysqli->prepare("SELECT ID, Title, picture_URL FROM categories");
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $title, $picURL);
    $categories = array();
    
    while($stmt->fetch()){
        $categories[$id][0] = $title; 
        $categories[$id][1] = $picURL; 
    }
?>