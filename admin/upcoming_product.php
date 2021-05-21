<?php include 'top.php';


if (!isset($_SESSION['aname'])) {
    header("Location: login.php");
}

?>

<!-- Upcoming product -->
<?php

$glabel = "Add";
$title = "";
$gtitle = "";
$desc = "";
if (isset($_GET['gupdate'])) {
    $glabel = "Update";
    $id = $_GET['gupdate'];
    $query = "SELECT * FROM upcoming_products where id =" . $id;
    $result = mysqli_query($conn, $query);
    $r = mysqli_fetch_assoc($result);
    $title = $r['title'];
    $gimg = $r['image'];
    $desc = $r['desc'];
}


if (isset($_POST['addGallery'])) {
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $img = null;
    if (!isset($_GET['gupdate'])) {
        if ($_FILES['Image']['name'] != null) {
            $img = checkimage($_FILES['Image']);
        }
    }
    include '../db/db.php';
    $insert_query = "INSERT INTO upcoming_products(title,`image`,`desc`) values('$title','$img','$desc')";

    if (isset($_GET['gupdate'])) {
        if ($_FILES['newImage']['name'] != null) {
            $img = checkimage($_FILES['newImage']);
        } else {
            $img = $gimg;
        }
        $update_query = "UPDATE upcoming_products SET title = '$title', `image` = '$img',`desc` = '$desc' WHERE id = $id ";

        if (mysqli_query($conn, $update_query)) {
            //echo "<script>window.location = './upcoming_product.php'</script>";
        } else {
            echo mysqli_error($conn);
        }
    } else {
        if (mysqli_query($conn, $insert_query)) {
            echo "<script>window.location = './upcoming_product.php'</script>";
        } else {
            echo mysqli_error($conn);
        }
    }
    //header("location:brand.php");

}


function checkimage($file)
{
    if ($file != null || $file['name'] != null) {
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_type = $file['type'];

        $file_type = explode("/", $file_type);
        $file_type = strtolower($file_type[0]);

        if ($file_type != "image") {
            echo "<script>alert('Only Image file allowed.')</script>";
            return;
        } else {
            $new_name = time()."-".rand(1000, 9999)."-".$file_name;
            if (!move_uploaded_file($file_tmp, "../upload/upcoming/" . $new_name)) {
                echo "<script>alert('Error while uploading file')</script>";
            }
        }
    }
    return $new_name;
}


?>





<div class="container-fluid">

    <!-- Upcoming Product  -->
    <div id="CSR-block" class=" col-md-8 col-sm-11 mx-auto mt-4">
        <div>
            <h1 class="text-center my-3"><?= $glabel ?> Upcoming Product</h1>
        </div>

        <div class=" d-flex align-items-center m-auto card border-0 my-3">
            <div class="card col-sm-11 col-sm-11 col-md-12 col-xl-12 ">
                <form action="" class="p-3 row" enctype="multipart/form-data" method="POST">
                    <div class="col-xl-9 col-sm-12  m-auto my-3 ">
                        <input type="text" class="form-control" name="title" placeholder="Title" value="<?= $title ?>" required>
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
                            <th>Title</th>
                            <th>Description</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../db/db.php';
                        $query = "SELECT * from upcoming_products";

                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($r = mysqli_fetch_assoc($result)) {

                        ?>
                                <tr>
                                    <td>
                                        <?php if ($r['image'] != "") { ?>
                                            <img src="<?= "../upload/upcoming/" . $r['image']  ?>" width="50p" height="40px" alt="No gallery Image">
                                        <?php } else { ?>
                                            No gallery Image
                                        <?php } ?>
                                    </td>
                                    <td><?= $r['title'] ?></td>
                                    <td><?= $r['desc'] ?></td>
                                    <td><a href="./upcoming_product.php?gupdate=<?= $r['id'] ?>" class="btn btn-outline-success"> Update</a></td>
                                    <td><a href="./delete.php?deleteupcoming=<?= $r['id'] ?>&img=<?= $r['image'] ?>" class="btn btn-outline-danger">X</a></td>
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



<?php include '../bottom.php' ?>