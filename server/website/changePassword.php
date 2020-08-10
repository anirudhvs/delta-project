<?php 

  session_start();

  if(!isset($_SESSION['userId'])){
    header("Location:index.php");
  }

  if(isset($_POST['save'])){
    
    require("databaseConnection.php");
    $userId=mysqli_real_escape_string($conn,$_SESSION['userId']);
    $currentPassword=mysqli_real_escape_string($conn,$_POST['currentPassword']);
    $newPassword=mysqli_real_escape_string($conn,$_POST['password']);
    $sql="SELECT * FROM `user_details` WHERE `user_id` = $userId ";
    $result=mysqli_query($conn,$sql);
    $userDetails=mysqli_fetch_all($result,MYSQLI_ASSOC);
    $userDetails=$userDetails[0];

    if(password_verify($currentPassword,$userDetails['password'])){
      $hash=password_hash($newPassword,PASSWORD_DEFAULT,array('cost'=>10));
      $sql="UPDATE `user_details` SET `password` = '$hash', `last_modified` = CURRENT_TIME() WHERE `user_details`.`user_id` = $userId;";

      if(mysqli_query($conn,$sql)){
        $_SESSION['passwordUpdateSuccess']=true;
        header("Location: userSettings.php");
      }
      else{
        $passwordUpdateFail=true;
      }
    }
    else{
      $wrongCurrentPassword=true;
    }

  }



?>


<?php require("head.php"); ?>

<body>

  <?php require("topNav.php"); ?>

  <!-- Wrong Current Password -->
  <?php if(isset($wrongCurrentPassword)): ?>
  <div class="alert alert-danger alert-dismissible " role="alert">
    Wrong current password. Try again.
    <button type="button" class="close" data-dismiss="alert">
      <span>&times;</span>
    </button>
  </div>
  <?php endif; ?>

  <!-- Password update fail -->

  <?php if(isset($passwordUpdateFail)): ?>
  <div class="alert alert-danger alert-dismissible " role="alert">
    Password update failed. Try again.
    <button type="button" class="close" data-dismiss="alert">
      <span>&times;</span>
    </button>
  </div>
  <?php endif; ?>


  <div class="container text-center my-4">
    <h3>Change Password</h3>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

      <!-- Current Password -->
      <div class="form-group row my-3">
        <label for="currentPassword" class="col-sm-2 col-form-label">Current Password</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" name="currentPassword" id="currentPassword"
            placeholder="Current Password" required>
        </div>
      </div>



      <!-- New Password -->
      <div class="form-group row my-3">
        <label for="password" class="col-sm-2 col-form-label">New Password</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" name="password" id="password" placeholder="New Password" required>
        </div>
      </div>
      <span id="tooShort" class="text-danger"></span>
      <span id="newPassSame" class="text-danger"></span>
      <!-- Confirm New Password -->
      <div class="form-group row my-3">
        <label for="passwordConfirm" class="col-sm-2 col-form-label">Confirm New Password</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" name="passwordConfirm" id="passwordConfirm"
            placeholder="Confirm New Password" required>
        </div>
      </div>
      <span id="matches" class="text-danger"></span>

      <!-- Save button -->
      <div class="row justify-content-center">
        <input type="submit" class="btn btn-success" id="save" name="save" value="Save">
      </div>

    </form>
  </div>

  <?php require("bootstrapRequirement.php"); ?>
  <script src="passwordUpdate.js"></script>


</body>