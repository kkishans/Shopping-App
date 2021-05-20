<?php
include './top.php';
?>

<h1 class="text-center mt-3">Upcoming Products</h1>
<div class="w-50  m-auto  mt-3">
  <div class="row  text-center my-5">
    <?php
    $title_query = "SELECT * from upcoming_products";
    $result = mysqli_query($conn, $title_query);


    if (mysqli_num_rows($result) > 0) {
      while ($r = mysqli_fetch_assoc($result)) {

    ?>
        <div class="col-3 m-2" style="width: 15rem;" onclick="window.location = 'upcoming.php?id=<?= $r['id']?>'">
          <div class="card rounded-lg">
            <img src="./upload/upcoming/<?= $r['image'] ?>" class="card-img-top rounded-top p-2" alt="...">
            <div class="card-body bg-light">
              <h5 class="card-title "><?= $r['title'] ?></h5>

            </div>
          </div>
        </div>

    <?php
      }
    }
    ?>

  </div>
</div>





<!-- Modal -->
<!-- <div class="modal fade" id="preview" tabindex="-1" role="dialog" aria-labelledby="wa-popup" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered w-25" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-title"></h5>
        <button type="button" class="close " data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body relative">
        <img id="previewImage" src='' class="card-img-top rounded-top px-5" style="object-fit: contain;"  alt="...">
        <h6 class="card-text mt-5">Description</h6> 
        <p class="card-text mt-2" id="modal-desc"></p>
      </div>
    </div>
  </div>
</div>



<script>
  const previewImg = (title,img,desc) => {
    document.getElementById("modal-title").innerHTML = title
    document.getElementById("previewImage").src = "./upload/csr/"+img
    document.getElementById("modal-desc").innerHTML = desc

    $('#preview').modal('show')
  }
</script> -->
<?php include 'bottom.php' ?>