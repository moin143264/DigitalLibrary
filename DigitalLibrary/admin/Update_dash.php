<?php 
include "conn.php";
$id=$_POST["id"];
$name=$_POST["name"];
$image=$_POST["image"];
$link=$_POST["link"];


$sql="update dash set name='$name',image='$image',link='$link' where id ='$id';";
if (mysqli_query($conn,$sql)) {
    echo header("location:dash_mana.php");
} else {
    echo"Something Went Wrong";
}



?>