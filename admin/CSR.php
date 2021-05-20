<?php include 'top.php';


if (!isset($_SESSION['aname'])) {
    header("Location: login.php");
}

include "./CSR.code.php";
?>





<div class="container-fluid">
    <div class="my-3 text-center">
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" id="btnCategory" onclick="displayCategoryBlock()" class="btn btn-outline-secondary px-5    ">Category</button>
            <button type="button" id="btnCSR" onclick="displayCSRBlock()" class="btn btn-outline-secondary px-5 active">CSR</button>
        </div>
    </div>

    <div id="category-block" class=" d-none  col-md-7 col-sm-11 mx-auto mt-4">
        <div>
            <h1 class="text-center my-3"><?= $label ?> Title</h1>
        </div>

        <div class=" d-flex align-items-center m-auto card border-0 my-3">
            <div class="card col-sm-11 col-sm-11 col-md-10 col-xl-10">
                <form class="p-3 row" enctype="multipart/form-data" method="POST">
                    <div class="col-xl-8 col-sm-12  m-auto my-3">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title name" value="<?= $title ?>" required>
                    </div>
                    <div class=" col-xl-4 col-sm-12  m-auto my-3 text-center">
                        <input class="btn btn-outline-primary" type="submit" name="addCategory" value="<?= $label ?> Title">
                    </div>
                </form>
            </div>
        </div>
        <div class="card col-md-10 col-xl-10 col-sm-11 m-auto">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../db/db.php';
                        $query = "SELECT * from csr_categories";

                        $title_result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($title_result) > 0) {
                            while ($r = mysqli_fetch_assoc($title_result)) {

                        ?>
                                <tr>
                                    <th><?= $r['title'] ?></th>
                                    <th><a href="./CSR.php?update=<?= $r['id'] ?>" class="btn btn-outline-success"> Update</a></th>
                                    <th><a href="./delete.php?deleteTitle=<?= $r['id'] ?>" class="btn btn-outline-danger">X</a></th>
                                </tr>
                        <?php

                            }
                        } else {
                            echo "
                    <tr><p' align='center'> No Data Found.</p></tr>
                ";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Gallery  -->
    <div id="CSR-block" class=" col-md-8 col-sm-11 mx-auto mt-4">
        <div>
            <h1 class="text-center my-3"><?= $glabel ?> CSR</h1>
        </div>

        <div class=" d-flex align-items-center m-auto card border-0 my-3">
            <div class="card col-sm-11 col-sm-11 col-md-12 col-xl-12 ">
                <form action="" class="p-3 row" enctype="multipart/form-data" method="POST">
                    <div class="col-xl-5 col-sm-12  m-auto my-3 ">
                        <input type="text" class="form-control" name="caption" placeholder="Caption" value="<?= $caption ?>" required>
                    </div>
                    <div class="col-xl-4 col-sm-12  m-auto my-3 ">
                        <select name="title" id="" class="form-control">
                            <?php
                            if (mysqli_num_rows($title_result) > 0) {
                                mysqli_data_seek($title_result, 0);
                                while ($r = mysqli_fetch_assoc($title_result)) {
                                    echo $r;
                            ?>
                                    <option value="<?= $r['id'] ?>" <?= ($gtitle == $r['id']) ? 'selected' : "" ?>>
                                        <?= $r['title'] ?>
                                    </option>
                            <?php
                                }
                            }
                            ?>

                        </select>
                    </div>
                    <?php
                    if (isset($_GET['gupdate'])) {
                    ?>
                        <div class="col-xl-3 col-sm-12  m-auto my-3 text-center">
                            <input class="btn btn-outline-primary" type="file" id="newImage" name="newImage" hidden>
                            <label class="btn btn-outline-primary" for="newImage">Select New Image</label>
                        </div>


                    <?php
                    } else {
                    ?>
                        <div class="col-xl-3 col-sm-12  m-auto my-3 text-center">
                            <input class="btn btn-outline-primary" type="file" id="Image" name="Image" hidden>
                            <label class="btn btn-outline-primary" for="Image">Select Image</label>
                        </div>
                    <?php
                    }
                    ?>

                    <div class="col-xl-12 col-sm-12  m-auto my-3 ">
                        <input type="text" class="form-control" name="desc" placeholder="description" value="<?= $desc ?>" required>
                    </div>

                    <div class="col-xl-4 col-sm-12  m-auto my-3 text-center">
                        <input class="btn btn-outline-primary px-5" type="submit" name="addGallery" value="<?= $glabel ?>">
                    </div>
                </form>
            </div>
        </div>
        <div class="card col-md-12 col-xl-12 col-sm-11 m-auto">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Caption</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../db/db.php';
                        $query = "SELECT * from csr_categories as c, csr as g where g.category_id = c.id";

                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($r = mysqli_fetch_assoc($result)) {

                        ?>
                                <tr>
                                    <td>
                                        <?php if ($r['image'] != "") { ?>
                                            <img src="<?= "../upload/csr/" . $r['image']  ?>" width="50p" height="40px" alt="No gallery Image">
                                        <?php } else { ?>
                                            No gallery Image
                                        <?php } ?>
                                    </td>
                                    <td><?= $r['caption'] ?></td>
                                    <td><?= $r['title'] ?></td>
                                    <td><?= $r['desc'] ?></td>
                                    <td><a href="./CSR.php?gupdate=<?= $r['id'] ?>" class="btn btn-outline-success"> Update</a></td>
                                    <td><a href="./delete.php?deleteCSR=<?= $r['id'] ?>" class="btn btn-outline-danger">X</a></td>
                                </tr>
                        <?php

                            }
                        } else {
                            echo "
                    <tr><p' align='center'> No Data Found.</p></tr>
                ";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
    document.getElementById('title').focus();

    function displayCategoryBlock() {
        document.getElementById('category-block').classList.remove('d-none');
        document.getElementById('CSR-block').classList.add('d-none');

        document.getElementById('btnCategory').classList.add('active');
        document.getElementById('btnCSR').classList.remove('active');

    }

    function displayCSRBlock(){
        document.getElementById('category-block').classList.add('d-none');
        document.getElementById('CSR-block').classList.remove('d-none');

        document.getElementById('btnCategory').classList.remove('active');
        document.getElementById('btnCSR').classList.add('active');
    }

</script>
<?php include '../bottom.php' ?>