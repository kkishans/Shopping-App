<?php
include './top.php';
?>

<?php
$title_query = "SELECT * from csr_categories order by title DESC";
$result = mysqli_query($conn, $title_query);

if (mysqli_num_rows($result) > 0) {
  while ($r = mysqli_fetch_assoc($result)) {

?>

    <div class="w-50  m-auto  mt-5">
      <h2 class="text-center"><?= $r['title'] ?></h2>
      <div class="row  text-center my-5">
        <?php
        $query = "SELECT * from csr where category_id = " . $r['id'];
        $res = mysqli_query($conn, $query);
        if (mysqli_num_rows($res) > 0) {
          while ($row = mysqli_fetch_assoc($res)) {
        ?>

            <div class="col-3 m-2" style="width: 15rem;" onclick="previewImg('<?= $row['caption']?>','<?= $row['image'] ?>','<?= $row['desc'] ?>')">
              <div class="card rounded-lg">
                <img src="./upload/csr/<?= $row['image'] ?>" class="card-img-top rounded-top p-2" alt="...">
                <div class="card-body bg-light">
                  <h5 class="card-title "><?= $row['caption'] ?></h5>

                </div>
              </div>
            </div>
        <?php
          }
        }
        ?>
      </div>
    </div>

<?php
  }
}
?>





<!-- Modal -->
<div class="modal fade" id="preview" tabindex="-1" role="dialog" aria-labelledby="wa-popup" aria-hidden="true" >
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
</script>
<?php include 'bottom.php' ?>