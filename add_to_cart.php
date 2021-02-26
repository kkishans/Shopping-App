<?php
    /*
        TODO: check user logined or note...  
    */
    include "./db/db.php";
    session_start();

    if (isset($_SESSION['useremail'])) {
        $query = "SELECT * FROM product_details where p_id = {$_GET['id']}";
        $res = mysqli_query($conn,$query);
        $data = mysqli_fetch_assoc($res);
    
        $item = array(
            array(
                "id" => $_GET['id'],
                "p_name" => $data['p_name'],
                "p_img" => $data['p_img'],
                "price" => $data['price'],
                "qty" => 1
            )
        );
    
    
    
        //check is product already in cart or not...
        if (isset($_SESSION["cart"])) {
            $flag = 0;
            foreach ( $_SESSION['cart'] as $k => $v ){
               if ( $_SESSION['cart'][$k]['id'] == $_GET['id'] ) {
                    if($_SESSION["cart"][$k]["qty"] >= 0) {
                        $_SESSION["cart"][$k]["qty"] += 1;
                    }
                    $flag = 1;
                    break;
               }
               
            } 
            if ($flag == 0) {
                $_SESSION['cart'] = array_merge($_SESSION["cart"],$item);
            }
        }
        else{
            $_SESSION['cart'] = $item;
        }
        header("location:index.php");
    }
?>
