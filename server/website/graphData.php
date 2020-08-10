<?php

session_start();

if(isset($_SESSION['userId'])){
  if(isset($_GET['url_id'])){

    require("databaseConnection.php");
    $userId=mysqli_real_escape_string($conn,$_SESSION['userId']);
    $urlId=mysqli_real_escape_string($conn,$_GET['url_id']);
    //checking access
    $sql="SELECT * FROM `url_table` WHERE `url_id` = $urlId";
    $result = mysqli_query($conn,$sql);
    $urlDetails = mysqli_fetch_all($result,MYSQLI_ASSOC);
    mysqli_free_result($result);

    if(empty($urlDetails)){
      echo "URL deleted";
      exit();
    }

    if($userId!=$urlDetails[0]['user_id']){
      echo "URL stats Does not belong to you";
      exit();
    }
    
    
    //providing data
    $sql="SELECT * FROM `analytics` WHERE `url_id` = $urlId ;";
    $result=mysqli_query($conn,$sql);
    $values = mysqli_fetch_all($result,MYSQLI_ASSOC);
    print json_encode($values);
    
  }
  else {
    echo "Invalid Request";
  }
}
else{
  echo "User Not Logged In";
}





?>