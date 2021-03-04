 <?php
    
    include "./db/db.php";
    
    session_start();

    if (isset($_SESSION['useremail']))  {
        $p_id = $_GET['id'];
        
        //get user id from the session...
        $query = "SELECT u_id FROM users where email = '". $_SESSION['useremail'] ."'";
        $res = mysqli_query($conn,$query);
        $r = mysqli_fetch_assoc($res);
        $u_id = $r['u_id'];
        $is_in_cart = "y"; 

        $sql = "SELECT * from cart_details where p_id = $p_id and u_id = $u_id and is_in_cart = '$is_in_cart'";
        $res = mysqli_query($conn,$sql);

        $r = mysqli_fetch_assoc($res);
        
        if(mysqli_num_rows($res) > 0){
            $query = "UPDATE cart_details SET qty = qty + 1 where u_id = $u_id and p_id = $p_id";
            $res = mysqli_query($conn,$query);

            if ($res) {
                echo "<script>
                    window.location ='./index.php'

                    alert('Item added in cart')
                </script>";
                
            }
        }
        else{
            $query = "INSERT into cart_details(p_id,u_id,qty,is_in_cart) values($p_id,$u_id,1,'$is_in_cart')";
            $res = mysqli_query($conn,$query);

            if ($res) {
                echo "<script>
                    window.location = './index.php'
                    alert('Item added in cart')
                </script>";
            }
        }
    }
    else{
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
        //echo "<script>alert("")</script>";
        //header("location:index.php");
    }
    
?> 


