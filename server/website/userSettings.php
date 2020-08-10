<?php 

  session_start();

  if(!isset($_SESSION['userId'])){
    header("Location:index.php");
  }

  require("databaseConnection.php");
  $userId=mysqli_real_escape_string($conn,$_SESSION['userId']); 
  $sql="SELECT * FROM `user_details` WHERE `user_id`=$userId";
  $result=mysqli_query($conn,$sql);
  $userDetails=mysqli_fetch_all($result,MYSQLI_ASSOC);
  if(empty($userDetails)){
    echo "No Such User Exist";
    exit();
  }
  $userDetails=$userDetails[0];

  if(isset($_POST['edit'])){

    if($_POST['email']!=$userDetails['email']){
      $newEmail=mysqli_real_escape_string($conn,$_POST['email']);
      $sql="UPDATE `user_details` SET `email` = '$newEmail',`last_modified` = CURRENT_TIME()  WHERE `user_details`.`user_id` = $userId;";
      if(mysqli_query($conn,$sql)){
        $emailUpdationSuccess=1;
        $userDetails['email']=$newEmail;
      }
      else{
        $emailUpdationSuccess=0;
      }

    }


  }




?>

<?php require("head.php"); ?>

<body>
  <?php require("topNav.php");?>

  <?php if(isset($_SESSION['passwordUpdateSuccess'])): ?>
  <div class="alert alert-success alert-dismissible " role="alert">
    Password updated successfully.
    <button type="button" class="close" data-dismiss="alert">
      <span>&times;</span>
    </button>
  </div>
  <?php endif; ?>



  <div class="container my-3">
    <h3>Edit Account Details</h3>

    <div class="container">
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <input type="text" hidden name="user_id" value="<?php echo htmlspecialchars($userDetails['user_id']); ?>">

        <div class="form-group row my-3">
          <label for="username" class="col-sm-2 col-form-label">Username</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="username" id="username"
              value="<?php echo htmlspecialchars($userDetails['username']); ?>" readonly>
          </div>
        </div>

        <div class="form-group row">
          <label for="email" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" name="email" id="email"
              value="<?php echo htmlspecialchars($userDetails['email']); ?>" readonly>
          </div>
        </div>

        <div class="row justify-content-end my-2">
          <input type="submit" class="btn btn-primary mx-1" id="edit" name="edit" value="Save" hidden>
          <div class="btn btn-success mx-1" id="enableEdit">Edit</div>
          <a href="changePassword.php" class="btn btn-primary mx-1">Change Password</a>
          <a href="accountDelete.php" class="btn btn-danger">Delete
            Account</a>
        </div>

      </form>
    </div>

  </div>


  <?php require("bootstrapRequirement.php"); ?>
  <script src="settingsScript.js"></script>

</body>