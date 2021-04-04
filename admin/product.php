<?php include 'top.php';
    
    if (!isset($_SESSION['aname'])) {
        header("Location: login.php");
    }
 ?>

<?php 
error_reporting(0);
    $label = "Add";
    $query = "SELECT p_id FROM product_details  ORDER BY p_id DESC LIMIT 1";
    $res = mysqli_query($conn,$query);
    $r = mysqli_fetch_assoc($res);
    $p_id = (int)$r['p_id'] + 1;
    $pname = $price = $stock = $c_id = $b_id = $desc =  "";
    if (isset($_GET['update'])) {
        $label = "Update";
        $id = $_GET['update'];
        $query = "SELECT * FROM product_details as p ,category as c,brands as b where p.c_id = c.c_id and p.b_id = b.b_id and p.p_id =". $id;
        $result = mysqli_query($conn, $query);
        $r = mysqli_fetch_assoc($result);
        $pname = $r['p_name'];
        $price = $r['price'];
        $stock = $r['stock'];
        $c_id = $r['c_id'];
        $b_id = $r['b_id'];
        $category = $r['c_title'];
        $brand = $r['b_name'];
        $desc = $r['description'];
        $keywords = $r['keywords'];
    }
?>

<div>
    <h1 class="text-center my-3"><?= $label ?> Product</h1>
</div>
    
<div class=" d-flex align-items-center m-auto card border-0 my-3">
    <div class="card col-sm-11 col-sm-11 col-md-5 col-xl-5   col-9">
        <form action="" class="p-3 " method="POST" >
            
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Product Name</label>
                <input type="text" class="form-control" name="pname" placeholder="ex. laptop" 
                value ="<?= $pname ?>"  required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Description</label>
                <textarea class="form-control" name="description" placeholder="ex. Lenevo ideaPad" required><?= $desc ?></textarea>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Keywords</label>
                <input type="text" class="form-control" name="keywords" placeholder="ex. Lenevo, ideaPad" value ="<?= $keywords ?>" required>
            </div>
            <div class="mb-3 row">
               <div class="col-6">
                    <label for="exampleFormControlInput1" class="form-label">Category</label>
                    <input type="text" class="form-control" name="category" value="<?= $category ?>" list="categories">
                    
               </div>
               <div class="col-6">
                    <label for="exampleFormControlInput1" class="form-label">Brand :</label>
                    <input type="text" class="form-control" name="brands" value="<?= $brand ?>" list="brands">
                    
                </div>
            </div>
            <div class="mb-3 row">
               <div class="col-6">
                    <label for="exampleFormControlInput1" class="form-label">Price</label>
                    <input type="number" min="0" class="form-control" name="price" placeholder="ex. 65000" value ="<?= $price ?>" required>
               </div>
               <div class="col-6">
                <label for="exampleFormControlInput1" class="form-label">Stock</label>
                <input type="number" min="0" class="form-control" name="stock" placeholder="ex. 10  " value ="<?= $stock ?>"required>
            </div>
            </div>
            
            <div class="col-6 m-auto align-item-center my-3 card">
                <input class="btn btn-outline-primary" type="submit" name="add" value="<?= $label ?> & Next">
            </div>
        </form>   
    </div>
</div>  

<?php

    if (isset($_POST['add'])) {
    
        $pname = ucwords($_POST['pname']);
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        global $brand,$category;
        $desc = htmlspecialchars($_POST['description']);

        
        $keywords = $_POST['keywords'];

        //get keywords from product name
        if (!isset($_GET['update'])) {
            $keyOfProduct = explode(" ",$pname);
            foreach($keyOfProduct as $val){
                $keywords .= ", $val";
            }
        }
        if (!isset($_POST['category'])) {
            $category = 'none';
            $query = "INSERT into category(c_title) values('$category')";
            $res = mysqli_query($conn,$query);
        }
        else{
            //get category id..
            $query = "SELECT * from category where c_title = '".$_POST['category']."'";
            $res = mysqli_query($conn,$query);

            if (mysqli_num_rows($res) == 0) {
                $query = "INSERT into category(c_title) values('".$_POST['category']."')";
                $res = mysqli_query($conn,$query);
            }
            $query = "SELECT * from category where c_title ='".$_POST['category']."'";
            $res = mysqli_query($conn,$query);
            $r = mysqli_fetch_assoc($res);
            $category =(int) $r['c_id'];
        }
        $query = "SELECT * from category where c_title ='".$_POST['category']."'";
        $res = mysqli_query($conn,$query);
        $r = mysqli_fetch_assoc($res);
        $category =(int) $r['c_id'];            
                

        //get brand id...
        $query = "SELECT * from brands  where b_name = '".$_POST['brands']."'";
        $res = mysqli_query($conn,$query);

        if (mysqli_num_rows($res) == 0) {
            $query = "INSERT into brands(b_name) values('".$_POST['brands']."')";
            $res = mysqli_query($conn,$query);
        }
        
        $query = "SELECT * from brands where b_name = '".$_POST['brands']."'";
        $res = mysqli_query($conn,$query);
        $r = mysqli_fetch_assoc($res);
        $brand =(int)$r['b_id'];
          
       
        $insert_query = "INSERT INTO product_details(p_id,p_name,description,keywords,price,stock,c_id,b_id,p_img) values($p_id,'$pname','$desc','$keywords',$price,$stock,$category,$brand,'dummy.png')";
        
        $update_query = "UPDATE product_details SET p_name = '$pname', description = '$desc', keywords = '$keywords',price = $price, stock = $stock,c_id = $category , b_id= $brand  where p_id = $id";
  
        if (isset($_GET['update'])) {
            if (mysqli_query($conn,$update_query)) {
                echo "<script> window.location= './specification.php?pid=".$_GET['update']."&update_product=yes'</script>";
             }else{
                 echo mysqli_error($conn);
             }
        }else{
            if (mysqli_query($conn,$insert_query)) {
                echo "<script> window.location= './specification.php?pid=$p_id'</script>";
             }else{
                echo mysqli_error($conn);
             }
        }
    }
?>
<datalist id="categories" >
                    <?php 
                        include '../db/db.php';
                        $query = "select * from category";

                        $result = mysqli_query($conn,$query);
                        
                        if (mysqli_num_rows($result) > 0) {
                            while($r = mysqli_fetch_assoc($result)){
                                //$s = ($c_id == $r["c_id"]) ? "selected" : "";
                                echo "<option value='". $r["c_title"]."' /> ";
                            }
                        }
                        ?>
</datalist>
<datalist id="brands" >
                    <?php 
                        include '../db/db.php';
                        $query = "select * from brands";

                        $result = mysqli_query($conn,$query);
                        
                        if (mysqli_num_rows($result) > 0) {
                            while($r = mysqli_fetch_assoc($result)){
                                //$s = ($b_id == $r["b_id"]) ? "selected" : "";
                                echo "<option value='". $r["b_name"]."' /> ";
                            }
                        }
                        ?>
                    </datalist>
<?php include '../bottom.php' ?>