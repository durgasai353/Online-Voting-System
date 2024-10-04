<html>
   <?php
    session_start();
    if(!isset($_SESSION['user'])){
        header("location:../");
    }
    $user = $_SESSION['user'];
   $groupdata =  $_SESSION['groupdata'];
   if($_SESSION['user']['status']==0){
    $status='<b style="color:red">Not voted</b>';
   }
   else{
    $status='<b style="color:green">voted</b>';
   }
    ?>
<head>
    <title>Online Voting System -Dashboard</title>
    <link rel='stylesheet'  href='../css/stylesheet.css'>
</head>
<body>
    <style>
        #backbtn{
          border-radius: 5px;
          width: 60px;
          height:auto;
          padding: 10px;
          background-color:#1aad03;
          border:1px solid #1aad03;
          color:#ffffff;
          font-weight: 400;
          float:left;
          margin-top: 27px ;
        }
        #logout{
          border-radius: 5px;
          width: 60px;
          height:auto;
          padding: 10px;
          background-color:#fc030b;
          border:1px solid #fc030b;
          color:#ffffff;
          font-weight: 400;
          float:right;
          margin-top: 27px ;
        }
      #profile{
       background-color: #ffffff;
       width:35%;
       float:left;
       padding:20px;
       margin-top:20px;
       border-radius: 5px;
      }
      img{
        height: 100px;
        width: 100px;
        border-radius: 5px;
      }
      #groups{
       background-color: #ffffff;
       width:55%;
       float:right;
       padding:20px;
       margin-top:20px;
       border-radius: 5px;
      }
      #votebtn{
        border-radius: 5px;
          width: 60px;
          height:auto;
          padding: 10px;
          background-color:#1E90ff;
          border:1px solid #1E90ff;
          color:#ffffff;
          font-weight: 400;
      }
      #grpimg{
        float:right;
      }
      #voted{
        background-color: green;
        border-radius: 5px;
          width: 60px;
          height:auto;
          padding: 10px;
          border:1px solid green;
          color:#ffffff;
          font-weight: 400;
      }
    </style>
    <center>
  <div id="mainsc">
   <div id="headersec">
   <a href="../"><button id="backbtn">back</button></a>
    <a href="../api/logout.php"><button id="logout">logout</button></a>
    <h1>Online Voting System</h1>
   </div>
   </center>
        <div id="profile">
          <center>
          <img src="../uploads/<?php echo $user['image']; ?>"><br><br></center>
          <b>Name: </b><?php echo $user["name"]?><br><br>
          <b>Mobile: </b><?php echo $user["Mobile"]?><br><br>
          <b>Address: </b><?php echo $user["Address"]?><br><br>
          <b>Status: </b><?php echo $status?><br><br>
          
        </div>
        <div id="groups">
        <?php
// Check if group data exists in session and is an array
if (isset($_SESSION['groupdata']) && is_array($_SESSION['groupdata'])) {
    // Loop through each group data
    foreach ($_SESSION['groupdata'] as $group) {
        // Only display groups with role equal to 2
        if ($group['role'] == 2) {
            ?>
            <div>
              
                <!-- Display group image -->
                <img src="../uploads/<?php echo htmlspecialchars($group['image']); ?>" alt="Group Image" id="grpimg">
          
                <!-- Display group name -->
                <b>Group Name: </b><?php echo htmlspecialchars($group['name']); ?><br><br>
                
                <!-- Display number of votes -->
                <b>Votes: </b><?php echo htmlspecialchars($group['votes']); ?><br><br>
                
                <!-- Voting form -->
                <form action="../api/vote.php" method="POST">
                    <input type="hidden" name="gvotes" value="<?php echo htmlspecialchars($group['votes']); ?>">
                    <input type="hidden" name="gid" value="<?php echo htmlspecialchars($group['id']); ?>">
                    <?php
                    // Check if user has not voted yet
                    if ($_SESSION['user']['status'] == 0) {
                        ?>
                        <input type="submit" name="votebtn" value="Vote" id="votebtn"><br>
                        <?php
                    } else {
                        ?>
                        <button disabled type="button" name="votebtn" value="Vote" id="voted">Voted</button><br>
                        <?php
                    }
                    ?>
                </form>
                <hr>
            </div>
            <?php
        }
    }
} else {
    echo 'No group data found.';
}
?> 
        </div>
</div>

</body>
</html>