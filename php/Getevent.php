<?php

require '__connect__Me__To__Database__Please__.php';;

    $stmt = $mysqli->prepare("SELECT idEvent,Name,URL,Date,Picture_URL,Event_Description FROM events ");
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $name, $url, $date, $pic , $dec);
    $events = array();
    
    while($stmt->fetch()) {
        $events[$id]['name'] = $name;
        $events[$id]['url'] = $url;
        $events[$id]['date'] = $date;
        $events[$id]['pic'] = $pic;
        $events[$id]['dec'] = $dec;
    }
?>