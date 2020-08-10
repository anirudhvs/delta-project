<?php

if(isset($_POST['signup'])){
    //new user signing up
    require('databaseConnection.php');

    $username=mysqli_real_escape_string($conn,$_POST['username']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
  
    //checking if username exists already
    $sql="SELECT * FROM `user_details` WHERE `username` LIKE '$username'";
    $result = mysqli_query($conn,$sql);
    $existingUser = mysqli_fetch_all($result,MYSQLI_ASSOC);
    if(empty($existingUser)){
      //create new user
      $hash=password_hash($password,PASSWORD_DEFAULT,array('cost'=>10));
      $sql="INSERT INTO `user_details`(`username`,`email`,`password`) VALUES('$username','$email','$hash') ";
      if(mysqli_query($conn,$sql)){
        session_start();
        $_SESSION['signupSuccess']=true;
        header("Location:login.php");
      }
      else{
        $signupFail=true;
      }
    }
    else {
      $signupFail=true;
      $userAlreadyExist=true;
    }
  
}



?>



<?php require("head.php"); ?>


<body>
  <nav class="navbar navbar-dark bg-dark mt-0 d-flex" id="topnav">
    <a href="index.php" class="navbar-brand mr-auto p-2">
      <img src="images/logo.png" alt="logo" height="100px">
    </a>
    <a href="login.php" class="btn btn-outline-success p-2 mx-1">Login</a>
    <a href="signup.php" class="btn btn-outline-success p-2">SignUp</a>
  </nav>


  <?php if(isset($signupFail)): ?>

  <?php if(isset($userAlreadyExist)): ?>
  <div class="alert alert-danger alert-dismissible " role="alert">Username already exists. Use a different
    username.<button type="button" class="close" data-dismiss="alert">
      <span>&times;</span>
    </button>
  </div>

  <?php else: ?>
  <div class="alert alert-danger alert-dismissible " role="alert">Signup failed. Please try later.<button type="button"
      class="close" data-dismiss="alert">
      <span>&times;</span>
    </button>
  </div>


  <?php endif; ?>
  <?php endif; ?>




  <div class="container text-center my-4">
    <h3>Signup</h3>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <!-- Username -->
      <div class="form-group row my-3">
        <label for="username" class="col-sm-2 col-form-label">Username</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="username" id="username" placeholder="Username"
            value="<?php if(isset($_POST['signup'])) echo htmlspecialchars($username); ?>" required>
        </div>
      </div>
      <!-- Email -->
      <div class="form-group row my-3">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input type="email" class="form-control" name="email" id="email" placeholder="Email"
            value="<?php if(isset($_POST['signup'])) echo htmlspecialchars($email); ?>" required>
        </div>
      </div>
      <!-- Password -->
      <div class="form-group row my-3">
        <label for="password" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
        </div>
      </div>
      <span id="tooShort" class="text-danger"></span>
      <!-- Confirm Password -->
      <div class="form-group row my-3">
        <label for="passwordConfirm" class="col-sm-2 col-form-label">Confirm Password</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" name="passwordConfirm" id="passwordConfirm"
            placeholder="Confirm Password" required>
        </div>
      </div>
      <span id="matches" class="text-danger"></span>

      <!-- Signup button -->
      <div class="row justify-content-center">
        <input type="submit" class="btn btn-success" id="signup" name="signup" value="Sign Up">
      </div>

    </form>
    <p class=>Already have an account? <a href="login.php">Login Here</a> </p>
  </div>


  <?php require("bootstrapRequirement.php"); ?>

  <script src="signupChecks.js"></script>

</body>