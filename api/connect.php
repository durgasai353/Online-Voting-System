<?php

$connect =mysqli_connect("localhost" , "root" , "" ,"vote") or die("connection failed!!");
if($connect){
   echo "connection established";
}
else{
   echo "Not connected";
}
?>