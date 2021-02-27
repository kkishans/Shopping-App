<?php
    /*
        TODO: check user logined or note...  
    */
    include "./db/db.php";
    session_start();

    if (isset($_SESSION['useremail']))  {
        $query = "SELECT * FROM product_details where p_id = {$_GET['id']}";
        $res = mysqli_query($conn,$query);
        $data = mysqli_fetch_assoc($res);
        $useremail = $_SESSION['useremail'];

        $cart =  json_decode( $_COOKIE['cart'],true );
    
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
        if (isset($_COOKIE["cart"])) {
            $flag = 0;
            foreach ( $cart as $k => $v ){
                if ( $cart[$k]['id'] == $_GET['id'] ) {
                    if($cart[$k]["qty"] >= 0) {
                        $cart[$k]["qty"] += 1;
                    }
                    $flag = 1;
                    break;
                }
               
            } 
            setcookie("cart",json_encode($cart),time()+3600,"/");
            if ($flag == 0) {
                //$_SESSION['cart'] = array_merge($_SESSION["cart"],$item);
                $cart = array_merge($cart,$item);
                setcookie("cart",json_encode($cart),time()+3600,"/");
            }
        }
        else{
            //$_SESSION['cart'] = $item;
            setcookie("cart",json_encode($item),time()+3600,"/");
        }
        header("location:index.php");
        //print_r($cart);
    }else{
        header("location: user/userLogin.php");
    }
?>
