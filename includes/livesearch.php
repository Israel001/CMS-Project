<?php

$q = $_REQUEST["q"];

if(strlen($q) > 0){
    $hint = "";
    for ($i = 0; $i < strlen($q); $i++){
        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$q%'";
        $result = mysqli_query($connection, $query);
        confirm_query($result);
        $count = mysqli_num_rows($result);
        if($hint == ""){
            if($count > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $hint = $row['post_title']
                }
            }
        } else {
            if($count > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $hint .= "<br>".$row['post_title'];
                }
            }
        }
//        if($count == 0){
//            $hint = "no result(s) found";
//        } else {
//            while($row = mysqli_fetch_assoc($result)){
//                $hint = $row['post_title'];
//            }
//        }
    }
}

echo $hint == "" : "no result(s) found" ? $hint;

?>