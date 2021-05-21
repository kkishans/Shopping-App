<?php
include './top.php';
include './db/db.php';
$id = $_GET['id'];
$query = "SELECT * FROM product_details where p_id =" . $id;
$result = mysqli_query($conn, $query);
$r = mysqli_fetch_assoc($result);
$pname = $r['p_name'];
$price = $r['price'];
$stock = $r['stock'];
$c_id = $r['c_id'];
$b_id = $r['b_id'];
$desc = $r['description'];
$s_price = number_format($r['price'], 2);
$img =
  array(
    $r['p_img'],
    $r['product_optional_image_1'],
    $r['product_optional_image_2'],
    $r['product_optional_image_3'],
    $r['product_optional_image_4']
  );
?>
<div class="container mt-5">
  <div class="row">
    <div class="col-md-6 col-xl-6 col-sm -11">
      <div class="card">
        <div class="slideshow-container">
          <?php
          $k = 0;
          for ($i = 0; $i < 5; $i++) {
            // $s = ($i == 0) ? "" : "hidden" ;
            if ($img[$i] == null || $img == '') {
              continue;
            }
            $k++;
          ?>
            <div class="showslide">
              <img src="<?= "upload/products/" . $img[$i]  ?>" class="card-img-top" height="400px" alt="Product Image" style="object-fit: contain;" id="img<?= $i + 1 ?>">
              <div class="arrow-buttons">
                <a class="left" onclick="displaySlides(<?= $k - 1 ?>)">&#10094;</a>
                <a class="right" onclick="displaySlides(<?= $k + 1 ?>)">&#10095;</a>
              </div>
            </div>
          <?php
          }
          ?>

        </div>
        <br>
        <div style="text-align:center">
          <?php
          $k = 1;
          for ($i = 0; $i < 5; $i++) {
            // $s = ($i == 0) ? "" : "hidden" ;
            if ($img[$i] == null || $img == '') {
              continue;
            }
          ?>
            <span class="dot" onclick="displaySlides(<?= $k++ ?>)"></span>
          <?php
          } ?>
        </div>
      </div>
      <div class="col-8 mt-5 mb-5 d-flex m-auto ">
        <?php if ($r['stock'] > 1) { ?>

          <a class="btn btn-primary w-100" href="./add_to_cart.php?id=<?= $id  ?>" role="button">Add To Cart</a>

        <?php } else { ?>

          <Button class="btn border text-gray w-100" style="border: 2px solid lightgray;color:gray ;font-size:22px;">Out Of Stock</Button>

        <?php } ?>

      </div>

    </div>
    <div class="col-md-6 col-xl-6 col-sm-11 p-5">
      <div class="row">
        <label class="form-label col-4 fs-5">Product: </label>
        <label class="form-label fs-5 col-7 align-baseline"><?= $pname ?></label>
      </div>


      <div class="row">
        <label class="form-label col-4 fs-5">Price: </label>
        <label class="form-label fs-5 col-7 align-baseline"><b>₹ <?= $s_price ?></b></label>
      </div>
      <div class="row">
        <label class="form-label col-4 fs-5">Category:</label>
        <?php
        $query = "SELECT * FROM category where c_id =" . $c_id;
        $result = mysqli_query($conn, $query);
        $r = mysqli_fetch_assoc($result);
        ?>
        <label class="form-label fs-5 col-7 align-baseline"><?= $r['c_title'] ?></label>
      </div>
      <div class="row">
        <label class="form-label col-4 fs-5">Brand: </label>
        <?php
        $query = "SELECT * FROM brands where b_id =" . $b_id;
        $result = mysqli_query($conn, $query);
        $r = mysqli_fetch_assoc($result);
        ?>
        <label class="form-label fs-5 col-7 align-top"><?= $r['b_name']  ?></label>
      </div>
      <?php

      $query = "SELECT * FROM product_description where p_id =" . $id;
      $result = mysqli_query($conn, $query);
      if (mysqli_num_rows($result) > 0) {
      ?>
        <label class="form-label fs-5 my-3"><b>Description:</b></label>
        <div class="xl-col-6 col-md-10 col-sm-11 fs-5">
          <?php

          while ($r = mysqli_fetch_row($result)) {
          ?>

            <div class="row">
              <label class="form-label col-4 fs-5" style="font-weight: 500;"><?= $r[2] ?> : </label>
              <label class="form-label fs-5 col-7 ms-4"><?= $r[3] ?></label>

            </div>

          <?php
          }
          ?>
        </div>
      <?php } else { ?>
        <!-- <div class="row">
              <div class="col-10 my-10">No more details description about the product.</div>
        </div> -->
      <?php } ?>

    </div>

  </div>
</div>


<script>
  var slide_index = 1;
  displaySlides(slide_index);

  function nextSlide(n) {
    displaySlides(slide_index += n);
  }

  function currentSlide(n) {
    displaySlides(slide_index = n);
  }

  function displaySlides(n) {
    console.log('i is' + n);
    var i;
    var slides = document.getElementsByClassName("showslide");
    if (n > slides.length) {
      slide_index = 1
    } else if (n < 1) {
      slide_index = slides.length
    } else slide_index = n
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    slides[slide_index - 1].style.display = "block";
  }
</script>

<?php include 'bottom.php' ?>