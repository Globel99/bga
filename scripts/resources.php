<?php
    $sql = "select * from resources where tile = ".$_SESSION["tiles"][$_SESSION["selectedIndex"]];
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $res_arr = array(
        "wheat" => $row["wheat"],
        "wheat_prod" => $row["wheat_prod"],
        "wood" => $row["wood"],
        "wood_prod" => $row["wood_prod"],
        "stone" => $row["stone"],
        "stone_prod" => $row["stone_prod"],
    );
?>