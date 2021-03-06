<?php 
  include './top.php';
  include './db/db.php'; 
  $id = $_GET['id'];
  $query = "SELECT * FROM product_details where p_id =". $id;
  $result = mysqli_query($conn, $query);
  $r = mysqli_fetch_assoc($result);
  $pname = $r['p_name'];
  $price = $r['price'];
  $stock = $r['stock'];
  $c_id = $r['c_id'];
  $b_id = $r['b_id'];
  $desc = $r['description'];
  $img = 
  array($r['p_img'],
        $r['product_optional_image_1'],
        $r['product_optional_image_2'],
        $r['product_optional_image_3'],
        $r['product_optional_image_4']
      );
?>
<div class="container mt-5">
    <div class="row">
        <div class="card col-md-6 col-xl-6 col-sm -11">
        <div class="slideshow-container">
          <?php
          
            for ($i=0; $i < 5; $i++) { 
             // $s = ($i == 0) ? "" : "hidden" ;
              if($img[$i] == null || $img == ''){
                continue;
              }
                ?>
                <div class="showslide">
                  <img src="<?= "img/". $img[$i]  ?>" class="card-img-top" height="400px" alt="Product Image" style="object-fit: contain;" id="img<?=$i+1?>">
                </div>
                <?php
            }
          ?>
          <!-- <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a> -->
          </div>
          <br>
          <div style="text-align:center">
          <?php
          $k = 0;
          for ($i=0; $i < 5; $i++) { 
           // $s = ($i == 0) ? "" : "hidden" ;
            if($img[$i] == null || $img == ''){
              continue;
            }
              ?>
            <span class="dot" onclick="displaySlides(<?=$k++?>)"></span>
            <?php
            } ?>            
          </div>
           
        </div>
        <div class="col-md-6 col-xl-6 col-sm -11 p-5">
          <div class="row">
            <label class="form-label col-3 fs-5">Product: </label>
            <label class="form-label fs-4 col-8"><?= $pname ?></label>
          </div> 
         
          <div class="row">
            <label class="form-label col-3 fs-5"></label>
            <label class="form-label fs-5 col-8"><?= $desc ?></label>
          </div> 
          <div class="row">
            <label class="form-label col-3 fs-5">Price: </label>
            <label class="form-label fs-4 col-8"><b><?= $price ?> ₹</b></label>
          </div> 
          <div class="row">
            <label class="form-label col-3 fs-5">Category:</label>
            <?php 
                 $query = "SELECT * FROM category where c_id =". $c_id;
                 $result = mysqli_query($conn, $query);
                 $r = mysqli_fetch_assoc($result);
            ?>
            <label class="form-label fs-4 col-8"><?= $r['c_title'] ?></label>
          </div> 
          <div class="row">
            <label class="form-label col-3 fs-5">Brand: </label>
            <?php 
              $query = "SELECT * FROM brands where b_id =". $b_id;
              $result = mysqli_query($conn, $query);
              $r = mysqli_fetch_assoc($result);
            ?>
            <label class="form-label fs-4 col-8"><?= $r['b_name']  ?></label>
          </div> 
          <div class="row">
            <label class="form-label col-3 fs-5">Stock: </label>
            <label class="form-label fs-4 col-8"><?= $stock ?></label>
          </div>    
          
          <div class="col-6"> 
            <a class="btn btn-primary w-100" href="./add_to_cart.php?id=<?= $id  ?>" role="button">Add To Cart</a>
          </div> 
        </div>
    </div>
</div>
<script type="text/javascript">  
  var slide_index = 0;  
  displaySlides(slide_index);  
  function nextSlide(n) {  
      displaySlides(slide_index += n);  
  }  
  function currentSlide(n) {  
      displaySlides(slide_index = n);  
  }  
  function displaySlides(n) { 
      var i;  
      var slides =  document.getElementsByClassName("showslide"); 
     // if (n > slides.length) { slide_index = 1 }  
     // if (n < 1) { slide_index = slides.length }  
      for (i = 0; i < slides.length; i++) {  
          slides[i].style.display = "none";  
      }  
      slides[n].style.display = "block";  
  }  
</script>  