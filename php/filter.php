<?php

function filter($cat, $sort){
    require '__connect__Me__To__Database__Please__.php';
    
    $items = array();
    if($sort == "old"){
        if($cat==0){
            $stmt = $mysqli->prepare("SELECT ID, Name FROM items ORDER BY ID ASC");
        } else {
            $stmt = $mysqli->prepare("SELECT ID, Name FROM items WHERE Categories_ID = ? ORDER BY ID ASC");
            $stmt->bind_param("i", $cat);
        }
    } else if($sort == "pop") {
        if($cat==0){
            $stmt = $mysqli->prepare("SELECT I.ID, I.Name FROM (SELECT I2.ID as ID, SUM(O.number) as sum FROM items I2, items_in_orders O WHERE I2.ID = O.Item_ID GROUP BY I2.ID) AS W, items I WHERE W.ID = I.ID ORDER BY W.sum DESC");
        } else {
            $stmt = $mysqli->prepare("SELECT I.ID, I.Name FROM (SELECT I2.ID as ID, SUM(O.number) as sum FROM items I2, items_in_orders O WHERE I2.ID = O.Item_ID GROUP BY I2.ID) AS W, items I WHERE W.ID = I.ID AND I.Categories_ID = ? ORDER BY W.sum DESC");
            $stmt->bind_param("i", $cat);
        }
    } else if($sort == "low") {
        if($cat==0){
            $stmt = $mysqli->prepare("SELECT ID, Name FROM items ORDER BY PriceLL ASC");
        } else {
            $stmt = $mysqli->prepare("SELECT ID, Name FROM items WHERE Categories_ID = ? ORDER BY PriceLL ASC");
            $stmt->bind_param("i", $cat);
        }
    } else if($sort == "high") {
        if($cat==0){
            $stmt = $mysqli->prepare("SELECT ID, Name FROM items ORDER BY PriceLL DESC");
        } else {
            $stmt = $mysqli->prepare("SELECT ID, Name FROM items WHERE Categories_ID = ? ORDER BY PriceLL DESC");
            $stmt->bind_param("i", $cat);
        }
    } else {
        if($cat==0){
            $stmt = $mysqli->prepare("SELECT ID, Name FROM items ORDER BY ID DESC");
        } else {
            $stmt = $mysqli->prepare("SELECT ID, Name FROM items WHERE Categories_ID = ? ORDER BY ID DESC");
            $stmt->bind_param("i", $cat);
        }
    }
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $name);
    while($stmt->fetch()){
        $stmt2 = $mysqli->prepare("SELECT Picture_URL FROM item_pictures WHERE Item_ID = ?");
        $stmt2->bind_param("i", $id);
        $stmt2->execute();
        $stmt2->store_result();
        $stmt2->bind_result($picture);
        $stmt2->fetch();
        
        $stmt2 = $mysqli->prepare("SELECT MAX(PriceLL), MIN(PriceLL), SUM(Stock) FROM item_sizes WHERE Item_ID = ?");
        $stmt2->bind_param("i", $id);
        $stmt2->execute();
        $stmt2->store_result();
        $stmt2->bind_result($max, $min, $stock);
        $stmt2->fetch();
        $price = $max." - ".$min;
        if($min == $max)
            $price = $min;
        $items[$id] = ['name'=>$name, 'price'=>$price, 'stock'=>$stock, 'picture'=>$picture];
    }
    return $items;
}
    
?>