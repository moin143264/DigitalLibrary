<?php 
include "conn.php";
$image=$_FILES['image']['name'];
$sql="insert into curo values(null,'$image');";
$tar_dir="dash_curo/".$image;
move_uploaded_file($_FILES['image']['tmp_name'],$tar_dir);
if (mysqli_query($conn,$sql)) {
    header("location:index.php");
} else {
    echo "Something Went Wrong";
}


?>