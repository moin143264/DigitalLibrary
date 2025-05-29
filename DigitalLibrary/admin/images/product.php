<?php 
include "conn.php";
$name = $_POST["name"];

$image = $_FILES['image']['name'];
$link = $_FILES['link']['name'];
$tar_dir_img = "images/".$image;
$tar_dir_pdf = "dash_pdf/".$link;
if (move_uploaded_file($_FILES['image']['tmp_name'],$tar_dir_img)&&move_uploaded_file($_FILES['link']['tmp_name'],$tar_dir_pdf)) {
    $sql="insert into card values(null,'$name','$image','$link');";
if (mysqli_query($conn,$sql)) {
    header("location:productm.php");
} else {
    echo mysqli_connect_error($conn);
}
}
else {
    echo "Failed To Move";
}



?>