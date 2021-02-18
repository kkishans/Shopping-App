<?php
    require_once('./db/db.php');

    $query = "select * from product_details";

    $result = mysqli_query($conn,$query);

    if (mysqli_num_rows($result) > 0) {
        while($r = mysqli_fetch_assoc($result)){
            $data[] = $r['p_name'];
        }
    }

    echo json_encode($data);

?>