<?php 
include "conn.php";
$name=$_POST["name"];

$image=$_FILES['image']['name'];
$link = $_FILES['link']['name'];
$tar_dir="dash_image/".$image;
$tar_dir_pdf = "../admin/".$link;
if (move_uploaded_file($_FILES['image']['tmp_name'],$tar_dir)&&move_uploaded_file($_FILES['link']['tmp_name'],$tar_dir_pdf)) {
 
$sql="insert into dash values(null,'$name','$image','$link');";
if (mysqli_query($conn,$sql)) {
    header("location:index.php");
} else {
    echo connect_error($conn);
}
}
else {
    echo "Failed To Move";
}

?>