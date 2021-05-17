<?php
$label = "Add New";
$title = "";
global $id;
if (isset($_GET['update'])) {
    $label = "Update";
    $id = $_GET['update'];
    $query = "SELECT * FROM gallery_categories where id =" . $id;
    $result = mysqli_query($conn, $query);
    $r = mysqli_fetch_assoc($result);
    $title = $r['title'];
}

if (isset($_POST['addCategory'])) {
    $title = $_POST['title'];

    include '../db/db.php';
    $insert_query = "INSERT INTO gallery_categories(title) values('$title')";

    if (isset($_GET['update'])) {
        $update_query = "UPDATE gallery_categories SET title = '$title' WHERE id = $id ";

        if (mysqli_query($conn, $update_query)) {
            echo "<script>window.location = './gallery.php'</script>";
        } else {
            echo mysqli_error($conn);
        }
    } else {
        if (mysqli_query($conn, $insert_query)) {
            echo "<script>window.location = './gallery.php'</script>";
        } else {
            echo mysqli_error($conn);
        }
    }
}
?>

<!-- Gallery -->
<?php

$glabel = "Add";
$caption = "";
$gtitle = "";
if (isset($_GET['gupdate'])) {
    $glabel = "Update";
    $id = $_GET['gupdate'];
    $query = "SELECT * FROM gallery where id =" . $id;
    $result = mysqli_query($conn, $query);
    $r = mysqli_fetch_assoc($result);
    $caption = $r['caption'];
    $gtitle = $r['category_id'];
    $gimg = $r['image'];
}


if (isset($_POST['addGallery'])) {
    $caption = $_POST['caption'];
    $title = $_POST['title'];
    $img = null;
    if (!isset($_GET['gupdate'])) {
        if ($_FILES['Image']['name'] != null) {
            $img = checkimage($_FILES['Image']);
        }
    }
    include '../db/db.php';
    $insert_query = "INSERT INTO gallery(caption,`image`,`category_id`) values('$caption','$img',$title)";

    if (isset($_GET['gupdate'])) {
        if ($_FILES['newImage']['name'] != null) {
            $img = checkimage($_FILES['newImage']);
        } else {
            $img = $gimg;
        }
        $update_query = "UPDATE gallery SET caption = '$caption', `image` = '$img', `category_id` = $title  WHERE id = $id ";

        if (mysqli_query($conn, $update_query)) {
            echo "<script>window.location = './gallery.php'</script>";
        } else {
            echo mysqli_error($conn);
        }
    } else {
        if (mysqli_query($conn, $insert_query)) {
            echo "<script>window.location = './gallery.php'</script>";
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
            if (!move_uploaded_file($file_tmp, "../upload/gallery/" . $file_name)) {
                echo "<script>alert('Error while uploading file')</script>";
            }
        }
    }
    return $file_name;
}


?>