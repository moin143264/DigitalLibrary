<?php 
session_start();
include "conn.php";
$uname=$_POST["uname"];
$pass=$_POST["pass"];

$sql="select * from admin where username ='$uname' and password= '$pass';";
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result)>0) {
    $_SESSION["logged_in"]=$uname; //dashboard
    $_SESSION["logged"]=$uname; //user_Manage
    $_SESSION["productma"]=$uname; //productMan
    $_SESSION["contact"]=$uname;    //contact_mange
    $_SESSION["addproduct"]=$uname; //addproduct
    $_SESSION["dashsection"]=$uname; //addproduct
    $_SESSION["dashman"]=$uname;    //dash_mana
    $_SESSION["send"]=$uname;    //dash_mana

    echo header("location:index.php");
} else {
    echo "<h1 class='text-center'>Invalid Credentials <a href='Admin_loginn_dash.html' >Try Again</a></h1>";
}



?>
