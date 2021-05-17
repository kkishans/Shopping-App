<?php
include './top.php';

$query = "SHOW TABLES FROM shopping";
$res = mysqli_query($conn, $query);
if (mysqli_num_rows($res) == 0) {
  echo "<script>swal('Alert','Something went wrong, Please contact to admin','error')</script>";
  return;
}

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


$query = "SELECT p_img FROM product_details ORDER BY p_id DESC, rand(c_id)  LIMIT 3";
$result = mysqli_query($conn, $query);

$img = array();
while ($r = mysqli_fetch_assoc($result)) {
  array_push($img, $r['p_img']);
}
// $img = array(
//   'carousal-img-1.jpg',
//   'carousal-img-2.jpg',
//   'carousal-img-3.jpg',
//   'carousal-img-4.jpg',
// );
?>


<!-- <div class="row col-11 py-3 m-auto border-0 border rounded">
  <div class="col-xl-5 col-md-5 col-sm-10 col-xm-11">
    <h1 class="text-center my-3"> Our Collection</h1>
  </div>
  <div class="col-xl-7 col-md-7 col-sm-10 col-xm-11 m-auto">
    <form action="#" class="row">
      <div class="col-xl-3 col-md-6 col-sm-6">
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
      <div class="col-xl-3 col-md-6 col-sm-6">
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

      <div class=" col-md-6 col-sm-6 m-auto   p-3 col-xl-2 text-center mt-3 ">
        <button type="submit" name="filter" class="btn btn-outline-success px-4">Filter</button>
      </div>
      <div class=" col-md-6 col-sm-12 p-3 col-xl-4 text-center mt-3">

        <div class="form-outline d-flex">
          <input type="text" id="searchKey" name="searchKey" class="form-control" placeholder="Search.." />
          <button type="submit" name="btnSearch" class="btn btn-outline-success px-4">
            <i class="fa fa-search" aria-hidden="true"></i>
          </button>
        </div>
      </div>
    </form>
  </div>
</div> -->
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
<!-- <div class="items row col-10 m-auto mt-2 mb-5"> -->
<?php
include './db/db.php';

// $query = "SELECT * from product_details LIMIT $offset, $no_of_records_per_page";
$query = "SELECT distinct(c_title),c.c_id from product_details as p,category as c where p.c_id = c.c_id; ";



$result = mysqli_query($conn, $query);

$count_of_data =  mysqli_num_rows($result);

if (mysqli_num_rows($result) > 0) {
  $i = 1;

  while ($r = mysqli_fetch_assoc($result)) {

    $q = "SELECT p_img from product_details where c_id = " . $r['c_id'] . "  order by rand() limit 1";
    $img = mysqli_query($conn, $q);
    $data = mysqli_fetch_assoc($img);
?>
    <div class="container mt-4 mx-auto w-100">
      <div class="d-flex <?= ($i % 2 == 0) ? "flex-row-reverse" : "flex-row" ?>">
        <div class="col-md-6 ps-5">
          <img src="./img/<?= $data['p_img'] ?>" class="w-50" alt="">
        </div>
        <div class="col-md-6 ps-5">
          <h1 class="py-3">
            <a class="nav-link text-dark px-0" href="./product_list.php?category=<?= $r['c_id'] ?>&brand=&filter=&searchKey=#"><?= $r['c_title'] ?></a>

          </h1>
          <?php
          $q = "SELECT distinct(b_name),b.b_id, b.b_icon from product_details as p, brands as b where p.b_id = b.b_id and p.c_id =" . $r['c_id'];
          $res = mysqli_query($conn, $q);

          if (mysqli_num_rows($res) > 0) {
          ?>
            <div style="display: flex;">
              <?php
              while ($rs = mysqli_fetch_assoc($res)) {

                if ($rs['b_icon'] != "") { ?>
                  <img src="<?= "upload/brand/" . $rs['b_icon']  ?>" alt="No Brand Image" style=" margin: 10px; height: 3rem; min-width: 3.5rem;width:4rem;">
              <?php
                }
              }
              ?>
            </div>
            <ol type="01" class="list-group list-group-flush borderless">

              <?php
              mysqli_data_seek($res, 0);
              while ($rs = mysqli_fetch_assoc($res)) {
              ?>
                <li class="list-group-item py-0 borderless">
                  <a class="nav-link" href="./product_list.php?category=<?= $r['c_id'] ?>&brand=<?= $rs['b_id'] ?>&filter=&searchKey=#"><?= $rs['b_name'] ?></a>
                </li>

            <?php
              }
            } else {
              echo mysqli_error($conn);
            }
            ?>
            </ol>
        </div>
      </div>
    </div>
    </div>



  <?php
    $i++;
  }
} else {
  mysqli_error($conn);
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



<div class="container text-center mt-5">
  <div class="py-4 mb-5">
    <h1>Why Pooja Electricals?</h1>
  </div>
  <div class="row py-2">
    <div class="col-md-3">
      <i class="fas fa-bolt fa-4x text-secondary"></i>
      <p class="py-3">COMPLETE RANGE OF ELECTRICAL SEGMENT</p>
    </div>
    <div class="col-md-3">
      <i class="fas fa-comment-alt fa-4x text-secondary"></i>
      <p class="py-3">INSTANT FEEDBACK</p>
    </div>
    <div class="col-md-3">
      <i class="fas fa-truck fa-4x text-secondary"></i>
      <p class="py-3">PROMPT DELIVERY</p>
    </div>
    <div class="col-md-3">
      <i class="fas fa-parachute-box fa-4x text-secondary"></i>
      <p class="py-3">GENUINE-SUPPLIES</p>
    </div>
  </div>
  <div class="row py-5">
    <div class="col-md-3">
      <i class="fas fa-money-bill-wave fa-4x text-secondary"></i>
      <p class="py-3">COMPETITIVE-PRICING</p>
    </div>
    <div class="col-md-3">
      <i class="fas fa-user-cog fa-4x text-secondary"></i>
      <p class="py-3">EFFICIENT MANAGEMENT SYSTEM</p>
    </div>
    <div class="col-md-3">
      <i class="fas fa-users fa-4x text-secondary"></i>
      <p class="py-3">YOUNG AND DYNAMIC PROFESSIONAL TEAM</p>
    </div>
    <div class="col-md-3">
      <i class="fas fa-check-circle fa-4x text-secondary"></i>
      <p class="py-3">QUALITY ASSURANCE</p>
    </div>
  </div>
</div>


<button type="button" class="btn fixedButton" style="outline: none;" data-toggle="modal" data-target="#wa-popup">
  <div class="roundedFixedBtn" ><i class="fab fa-whatsapp"></i></div>
</button>

<?php
  $query = "SELECT wa_no from admin_details";
  $res = mysqli_query($conn,$query);
  $r = mysqli_fetch_assoc($res);
  $wa_no = $r['wa_no'];
?>

<!-- Modal -->
<div class="modal fade" id="wa-popup" tabindex="-1" role="dialog" aria-labelledby="wa-popup" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Whats App</h5>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text" required></textarea>
          </div>
          <div class="form-group">
            <button type="button" class="form-control btn  btn-success btn-block  my-3" onclick="sendWAMsg(<?= $wa_no ?>)"><i class="fa fa-paper-plane fa-lg" aria-hidden="true"></i></button>

          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<script>
  const sendWAMsg = (number) => {
    // let mobile = document.querySelector("#mobile_no").value
    let msg = document.querySelector("#message-text").value
    //alert(`https://wa.me/${mobile}?text=${msg}`)
    window.location = `https://wa.me/91${number}?text=${msg}`
  }
</script>

<?php

if ($count_of_data < $total_rows) {

?>
  <!-- <nav aria-label="Page navigation example mt-5">
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
  </nav> -->
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
<?php
include './bottom.php';
?>
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