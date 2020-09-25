<?php

function getItem($id){
    require '__connect__Me__To__Database__Please__.php';
    
    $item = array();
    $stmt = $mysqli->prepare("SELECT Name, Description, Categories_ID, Detail FROM items WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($name, $desc, $cat, $detail);
    if($stmt->fetch()){
        $item = ['name'=>$name,'desc'=>$desc, 'cat'=>$cat, 'detail'=>$detail];
        $pictures = array();
        $stmt2 = $mysqli->prepare("SELECT Picture_URL FROM item_pictures WHERE Item_ID = ?");
        $stmt2->bind_param("i", $id);
        $stmt2->execute();
        $stmt2->store_result();
        $stmt2->bind_result($pic);
        while($stmt2->fetch()){
            $pictures[] = $pic;
        }
        $stmt3 = $mysqli->prepare("SELECT Size_ID, Size, PriceLL, Stock FROM item_sizes WHERE Item_ID = ?");
        $stmt3->bind_param("i", $id);
        $stmt3->execute();
        $stmt3->store_result();
        $sizes = array();
        $stmt3->bind_result($sid, $size, $price, $stock);
        while($stmt3->fetch()){
            $stmt4 = $mysqli->prepare("SELECT SUM(number) FROM items_in_orders WHERE Size_ID = ?");
            $stmt4->bind_param("i", $sid);
            $stmt4->execute();
            $stmt4->store_result();
            $stmt4->bind_result($sum);
            
            $stmt4 = $mysqli->prepare("SELECT SUM(number) FROM baskets WHERE Size_ID = ?");
            $stmt4->bind_param("i", $sid);
            $stmt4->execute();
            $stmt4->store_result();
            $stmt4->bind_result($sum2);
            
            $sizes[$sid] = array("name"=>$size, "price"=>$price, "stock"=>$stock-$sum-$sum2);
        }
        $item['pictures'] = $pictures;
        $item['sizes'] = $sizes;
        return $item;
    } else {
        return null;
    }
}

?>
