<?php
    
?>

<?php
    if (isset($_GET['qty']) && $_GET['pid']) {
        include '../env.php';
        session_start();
        include '../db/db.php';
        $p_id = $_GET['pid'];
        $qty = $_GET['qty'];
        

        if ($qty > 1) {
            if (isset($_SESSION['useremail'])) {
                $query = "SELECT u_id FROM users  WHERE  email = '".$_SESSION['useremail']."'" ;
                $res = mysqli_query($conn,$query);
                $r = mysqli_fetch_assoc($res);
                $u_id = (int)$r['u_id'];
                $query = "UPDATE cart_details SET qty = $qty where u_id = $u_id and p_id = $p_id and is_in_cart = 'y'";
                $res = mysqli_query($conn,$query);
                //echo "<script> window.location ='./cart.php' </script>";
            }
            else if(isset($_SESSION['cart'])){
                foreach ( $_SESSION['cart'] as $k => $v ){
                    if ($v['id'] == $p_id) {
                        $_SESSION['cart'][$k]['qty'] = $qty;
                        break;
                    }
                 }
                // echo "<script> window.location ='./cart.php' </script>"; 
            }
            echo get_badge_value();
        }//else echo "<script>swal('Alert','Quatity must be grater than 0','info')</script>"; 
    }


    function get_badge_value(){
        include '../env.php';
        include '../db/db.php';
        if (isset($_SESSION['useremail'])) {
            $query = "SELECT qty FROM cart_details as C, users as U where C.u_id = U.u_id and email = '". $_SESSION['useremail']."' and is_in_cart = 'y'";
            $result = mysqli_query($conn,$query);
            $total_cart_items = 0;
            while($row = mysqli_fetch_array($result)){
              $total_cart_items += $row[0];
            }
            echo mysqli_error($conn);
          }
          else if (isset($_SESSION["cart"])) {
            $total_cart_items = 0;
            foreach ( $_SESSION['cart'] as $k => $v ){
               $total_cart_items += $_SESSION['cart'][$k]['qty'];
            } 
          }else{
            $total_cart_items = 0;
          }
          return $total_cart_items;
    }
?>