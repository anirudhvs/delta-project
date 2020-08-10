<?php

  session_start();
  $userId=$_SESSION['userId'];
  
  if(!isset($_SESSION['userId'])){
    header("Location:index.php");
  }


  if(isset($_GET['url_id'])){
    require("databaseConnection.php");
    $urlToDelete=mysqli_real_escape_string($conn,$_GET['url_id']);

    $sql="SELECT * FROM `url_table` WHERE `url_id` = $urlToDelete ";

    $result = mysqli_query($conn,$sql);
    $urlDetails = mysqli_fetch_all($result,MYSQLI_ASSOC);
    mysqli_free_result($result);


    //Validating if user has the permission to delete url
    if($userId==$urlDetails[0]['user_id']){
      $sql="DELETE FROM `url_table` WHERE `url_id` = $urlToDelete";
      if(mysqli_query($conn,$sql)){
        $_SESSION['deleteStatus']=true;
        $_SESSION['deleteItem']=$urlDetails[0]['title'];
        header("Location:userPortal.php");
      } else {
        $_SESSION['deleteStatus']=false;
        $_SESSION['deleteItem']=$urlDetails[0]['title'];
      }


    } else {
      //No permission to delete
      header("Location:index.php");
    }




  } else {
    header("Location:index.php");

  }


?>