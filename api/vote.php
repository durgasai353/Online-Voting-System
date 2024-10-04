<?php
session_start();
include("connect.php");
$votes = $_POST['gvotes'];
$total_votes = $votes+1;
$gid = $_POST['gid'];
$uid = $_SESSION['user']['id'];
$update_votes = mysqli_query($connect, "UPDATE voter_lists SET votes='$total_votes' WHERE id='$gid' ");
$update_user_status = mysqli_query($connect, "UPDATE voter_lists SET status= 1 WHERE id='$uid' ");
if($update_votes and $update_user_status){
    $group = mysqli_query($connect,"SELECT * FROM voter_lists WHERE role = 2");
    $groupdata = mysqli_fetch_all($group, MYSQLI_ASSOC);
    $_SESSION['user']['status'] = 1;
    $_SESSION['groupdata'] = $groupdata;
    echo'
    <script>
     alert("voted successfully");
     window.location="../page_transformation/dashboard.php";    
    </script>
    ';
}
else{
    echo'
    <script>
     alert("Something Went Wrong!");
     window.location="../page_transformation/dashboard.php";    
    </script>
    ';
}

?>