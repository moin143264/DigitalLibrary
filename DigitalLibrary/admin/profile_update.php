<?php 
include "conn.php";
$id=$_POST["id"];
$name=$_POST["name"];
$email=$_POST["email"];
$uname=$_POST["uname"];
$pass=$_POST["pass"];
$hash = password_hash($pass, PASSWORD_BCRYPT);

$sql="update last set name='$name',email='$email',username='$uname',password='$hash' where id ='$id';";
if (mysqli_query($conn,$sql)) {
    echo header("location:../Main.php");
} else {
    echo"Something Went Wrong";
}



?>