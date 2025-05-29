<?php 
include "conn.php";
$id=$_POST["id"];
$name=$_POST["name"];
$email=$_POST["email"];
$uname=$_POST["uname"];
$pass=$_POST["pass"];

$sql="update last set name='$name',email='$email',username='$uname',password='$pass' where id ='$id';";
if (mysqli_query($conn,$sql)) {
    echo header("location:userm.php");
} else {
    echo"Something Went Wrong";
}



?>