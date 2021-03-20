<?php
include './top.php';

if (isset($_GET['pageno'])) {
  $pageno = $_GET['pageno'];
} else {
  $pageno = 1;
}

$no_of_records_per_page = 10;
$offset = ($pageno - 1) * $no_of_records_per_page;

$total_pages_sql = "SELECT COUNT(*) FROM product_details";
$result = mysqli_query($conn, $total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

$query = "SELECT p_img FROM product_details ORDER BY p_id DESC LIMIT 3";
  $result = mysqli_query($conn, $query);

  $img = array();
  while($r = mysqli_fetch_assoc($result)){
    array_push($img, $r['p_img']);
  }
// $img = array(
//   'carousal-img-3.png',
//   'carousal-img-1.jpg',
//   'carousal-img-2.jpg'
// );
?>


<div class="row col-11 py-3 m-auto border-0 border rounded">
  <div class="col-xl-5 col-md-5 col-sm-10 col-xm-11">
    <h1 class="text-center my-3"> Our Collection</h1>
  </div>
  <div class="col-xl-7 col-md-7 col-sm-10 col-xm-11">
    <form action="#" class="row">
      <div class="col-xl-3 col-md-3 col-sm-5 ">
        <label class="form-label">Category :</label>
        <select class="form-select" name="category">
          <option value="0">All</option>
          <?php
          include './db/db.php';
          $query = "select * from category";

          $result = mysqli_query($conn, $query);
          $c_id = isset($_GET["category"]) ? $_GET["category"] : 0;
          if (mysqli_num_rows($result) > 0) {
            while ($r = mysqli_fetch_assoc($result)) {
              print_r($r);
              $s = ($c_id == $r["c_id"]) ? "selected" : "";
              echo "<option value='" . $r["c_id"] . "' $s > " . $r["c_title"] . "</option>";
            }
          } else {
            echo "0 record in category";
          }
          ?>
        </select>
      </div>
      <div class="col-xl-3 col-md-3 col-sm-5">
        <label class="form-label">Brand :</label>
        <select class="form-select" name="brand">
          <option value="0">All</option>
          <?php
          //include '../db/db.php';
          $query = "select * from brands";

          $result = mysqli_query($conn, $query);
          $b_id = isset($_GET["brand"]) ? $_GET["brand"] : 0;
          if (mysqli_num_rows($result) > 0) {
            while ($r = mysqli_fetch_assoc($result)) {
              $s = ($b_id == $r["b_id"]) ? "selected" : "";
              echo "<option value='" . $r["b_id"] . "' $s > " . $r["b_name"] . "</option>";
            }
          }
          ?>
        </select>
      </div>

      <div class=" col-md-1 col-sm-5 p-3 col-xl-2 text-center mt-3 ">
        <button type="submit" name="filter" class="btn btn-outline-success px-4">Filter</button>
      </div>
      <div class=" col-md-3 col-sm-12 p-3 col-xl-4 text-center mt-3">

        <div class="form-outline d-flex">
          <input type="text" id="searchKey" name="searchKey" class="form-control" placeholder="Search.." />
          <button type="submit" name="btnSearch" class="btn btn-outline-success px-4">
            <i class="fa fa-search" aria-hidden="true"></i>
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
<hr>
<div class=" col-11 justify-content-center m-auto">
  <div class="slider ">
    <?php
    $k = 0;
    for ($i = 0; $i < sizeof($img); $i++) {
      if ($img[$i] == null || $img == '') {
        continue;
      }
      $k++;
    ?>
      <div class="slide">
        <div class="row">
          <div class="left col-xl-1">
            <a onclick="displaySlides(<?= $k - 1 ?>)">&#10094;</a>
          </div>
          <div class="img col-xl-10">
            <img src="<?= "img/" . $img[$i]  ?>" class="card-img-top" height="400px" alt="Product Image" style="object-fit: contain;" id="img<?= $i + 1 ?>">
          </div>
          <div class="right col-xl-1">
            <a onclick="displaySlides(<?= $k + 1 ?>)">&#10095;</a>
          </div>
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
    for ($i = 0; $i < sizeof($img); $i++) {
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

<hr>
<div class="items row col-11 m-auto mt-2 mb-5">
  <?php
  include './db/db.php';

  $query = "select * from product_details LIMIT $offset, $no_of_records_per_page";

  if (isset($_GET['filter'])) {
    $category = $_GET['category'];
    $brand = $_GET['brand'];

    $query = "select * from product_details " .
      (($category != 0 || $brand != 0) ?
        " where " . (
          ($brand != 0) ?
          "b_id = $brand " : "") .
        (
          ($category != 0 && $brand != 0) ?
          " and " : "") .
        (
          ($category != 0) ?
          " c_id = $category" : "")
        : "") . " LIMIT $offset, $no_of_records_per_page";
  }


  if (isset($_GET['btnSearch'])) {
    $search = $_GET['searchKey'];
    /*$query = "SELECT * from product_details as p,category as c, brands as b where c.c_id = p.c_id and b.b_id = p.b_id  and ( LOWER(p_name) like '%".strtolower($search)."%' or LOWER(c_title) like '%".strtolower($search)."%' or LOWER(b_name) like '%".strtolower($search)."%' or LOWER(`description`) like '%".strtolower($search)."%' )  LIMIT $offset, $no_of_records_per_page";*/
    $query = "SELECT * from product_details where LOWER(`keywords`) like '%" . strtolower($search) . "%' LIMIT $offset, $no_of_records_per_page";
  }


  $result = mysqli_query($conn, $query);

  $count_of_data =  mysqli_num_rows($result);

  if (mysqli_num_rows($result) > 0) {
    while ($r = mysqli_fetch_assoc($result)) {

  ?>
      <div class="card-l col-xl-3 col-sm-11 col-md-6 col-xl-3 mt-3">

        <div class="card p-1" style="height: 23rem;">
          <a href="./product.php?id=<?= $r['p_id']  ?>" class="card-l">
            <img src="<?= "img/" . $r['p_img']  ?>" class="card-img-top" alt="Product Image" style="max-height:15rem;height:15rem;object-fit: contain;">
            <div class="card-body ">
              <div class="d-flex justify-content-between">
                <h6 class="card-title"> <?= $r['p_name'] ?> ( <?= $r['stock'] ?> )</h6>
                <div class="cost-button">
                  <h5>₹ <?= $r['price'] ?></h5>
                </div>
              </div>
              <div class="d-flex justify-content-between mt-2">
                <div class="col-12">

                  <p class="card-title"><?= $r['description'] ?></p>
                </div>

                <div class="col-6">

                  <a class="btn btn-primary w-100" href="./add_to_cart.php?id=<?= $r['p_id']  ?>" role="button">Add To Cart</a>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
    <?php
    }
  } else {
    ?>
    <div class="row justify-content-md-center mt-4">
      <div class="col-md-6">
        <img src="img/no_result.jpg" class="card-img-top" height="200px" alt="No result Image" style="object-fit: contain;">
        <div class="card-body text-center noResult">
          No Result Found
        </div>
      </div>
    </div>
  <?php
  }
  ?>



</div>
<?php
if ($count_of_data < $total_rows) {


?>
  <nav aria-label="Page navigation example mt-5">
    <ul class="pagination justify-content-around">

      <li class="page-item <?php if ($pageno <= 1) {
                              echo 'disabled';
                            } ?>">
        <a class="page-link" href="<?php if ($pageno <= 1) {
                                      echo '#';
                                    } else {
                                      echo "?pageno=" . ($pageno - 1);
                                    } ?>" tabindex="-1">Previous</a>
      </li>
      <li class="page-item <?php if ($pageno >= $total_pages) {
                              echo 'disabled';
                            } ?>">
        <a class="page-link " href="<?php if ($pageno >= $total_pages) {
                                      echo '#';
                                    } else {
                                      echo "?pageno=" . ($pageno + 1);
                                    } ?>">Next</a>
      </li>
    </ul>
  </nav>
<?php
}
?>
<datalist id="searchResult">
  <?php
  $query = "select * from product_details";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    while ($r = mysqli_fetch_assoc($result)) {
      echo "<option value='" . $r["p_name"] . "' >";
    }
  }

  ?>
</datalist>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"></script>
<script type="text/javascript">
  var slide_index = 1;
  var slides = document.getElementsByClassName("slide");

  displaySlides(slide_index);

  function nextSlide(n) {
    displaySlides(slide_index += n, 1);
  }

  function currentSlide(n) {
    displaySlides(slide_index = n, 0);
  }

  function displaySlides(n, f) {
    var i;
    var dot = document.getElementsByClassName("dot");
    dot[0].classList.add("active");
    for (let i = 0; i < dot.length; i++) {
      if (i == n - 1) {
        dot[i].classList.add("active");
      } else {
        dot[i].classList.remove("active");
      }
    }
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
  setInterval(() => {
    nextSlide(1);
  }, 3000);

  const btnFlip = document.querySelector('.card')
  btnFlip.addEventListener("click", () => {
    btnFlip.classList.toggle('flipped');
  })
</script>
</body>

</html>