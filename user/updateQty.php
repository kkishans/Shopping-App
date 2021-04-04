<?php
     include '../env.php';
     session_start();
   
     include '../db/db.php';
?>

<?php
    if (isset($_GET['qty']) && $_GET['pid']) {
        $p_id = $_GET['pid'];
        $qty = $_GET['qty'];
        $query = "SELECT u_id FROM users  WHERE  email = '".$_SESSION['useremail']."'" ;
        $res = mysqli_query($conn,$query);
        $r = mysqli_fetch_assoc($res);
        $u_id = (int)$r['u_id'];

        if ($qty > 1) {
            if (isset($_SESSION['useremail'])) {
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
            
        }//else echo "<script>swal('Alert','Quatity must be grater than 0','info')</script>"; 
    }
?>