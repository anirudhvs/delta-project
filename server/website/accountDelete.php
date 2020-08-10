<?php

session_start();

if(!isset($_SESSION['userId'])){
  header("Location:index.php");
}


if(isset($_POST['goback'])){
  header("Location:userSettings.php");
}
if(isset($_POST['delete'])){

  require("databaseConnection.php");
  $userId=mysqli_real_escape_string($conn,$_SESSION['userId']);

  $sql="SELECT * FROM `url_table` WHERE `url_table`.`user_id` = $userId ";
  $result=mysqli_query($conn,$sql);
  $urlList=mysqli_fetch_all($result,MYSQLI_ASSOC);
  
  foreach($urlList as $url){

    $urlId=$url['url_id'];
    $sql="DELETE FROM `analytics` WHERE `analytics`.`url_id` = '$urlId';";
    mysqli_query($conn,$sql);
  }

  $sql="DELETE FROM `url_table` WHERE `url_table`.`user_id` = '$userId'";

  mysqli_query($conn,$sql);

  $sql="DELETE FROM `user_details` WHERE `user_details`.`user_id`='$userId'";

  mysqli_query($conn,$sql);

  header("Location:logout.php");


}


?>



<?php require("head.php");?>

<body>

  <?php require("topNav.php"); ?>

  <div class="container text-center" style="margin-top:4rem">
    <h5>Are you sure you want to delete your account? This action is not reversible.</h5>
    <div class="row justify-content-center">
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="col my-2">
          <input type="submit" class="btn btn-danger mx-1" id="delete" name="delete" value="Delete">
        </div>
        <div class="col">
          <input type="submit" class="btn btn-success mx-1" id="goback" name="goback" value="Go Back">
        </div>
      </form>

    </div>

  </div>




  <?php require("bootstrapRequirement.php");?>

</body>
