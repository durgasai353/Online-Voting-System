<?php
session_start();
include("connect.php");
$phone = $_POST["phone"];
$password = $_POST["password"];
$role = $_POST["role"];
$check = mysqli_query($connect,"SELECT * FROM voter_lists WHERE Mobile = '$phone' AND password='$password' AND role= '$role'");
if(mysqli_num_rows($check)>0)
{
 $user = mysqli_fetch_array($check);
 $group = mysqli_query($connect,"SELECT * FROM voter_lists WHERE role = 2");
 $groupdata = mysqli_fetch_all($group, MYSQLI_ASSOC);
 $_SESSION['user'] = $user;
 $_SESSION['groupdata'] = $groupdata;
 echo '
    <script> 
     window.location="../page_transformation/dashboard.php";
    </script>
    ';
}
else{
    echo '
    <script> 
     alert("Invalid adhaar and password");
     window.location= "../";
    </script>
    ';
}

?>