<?php
  session_start();
  if(isset($_POST['login'])){
    //login funtions
    require('databaseConnection.php');
  
    $username=mysqli_real_escape_string($conn,$_POST['username']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    
    
    $sql="SELECT * FROM `user_details` WHERE `username` LIKE '$username'";
  
    $result=mysqli_query($conn,$sql);
    $userDetails= mysqli_fetch_all($result,MYSQLI_ASSOC);
    
    if(empty($userDetails)){
      $noUser=true;
      $loginFail=true;
    }
    
    else{
      $userDetails=$userDetails[0];

      if(password_verify($password,$userDetails['password'])){
        session_start();
        $_SESSION['loggedIn']=true;
        $_SESSION['email']=$userDetails['email'];
        $_SESSION['username']=$userDetails['username'];
        $_SESSION['userId']=$userDetails['user_id'];
        header("Location:userPortal.php");
      }
    
      else {
        $wrongPassword=true;
        $loginFail=true;
      }
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

  <?php if(isset($loginFail)): ?>

  <?php if(isset($noUser)): ?>
  <div class="alert alert-danger alert-dismissible " role="alert">Incorrect username. Please try again.<button
      type="button" class="close" data-dismiss="alert">
      <span>&times;</span>
    </button>
  </div>
  <?php endif; ?>


  <?php if(isset($wrongPassword)): ?>
  <div class="alert alert-danger alert-dismissible " role="alert">Incorrect password. Please try again.<button
      type="button" class="close" data-dismiss="alert">
      <span>&times;</span>
    </button>
  </div>
  <?php endif; ?>
  <?php endif; ?>

  <?php if(isset($_SESSION['signupSuccess'])): ?>
  <div class="alert alert-success alert-dismissible " role="alert">Signup successful. You can login with your
    credentials.<button type="button" class="close" data-dismiss="alert">
      <span>&times;</span>
    </button>
  </div>
  <?php unset($_SESSION['signupSuccess']); ?>
  <?php endif; ?>





  <div class="container text-center my-4">
    <h3>Login</h3>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

      <div class="form-group row my-3">
        <label for="username" class="col-sm-2 col-form-label">Username</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="username" id="username" placeholder="Username"
            value="<?php if(isset($_POST['login'])) echo htmlspecialchars($username); ?>" required>
        </div>
      </div>

      <div class="form-group row my-3">
        <label for="password" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" name="password" id="password" placeholder="Password"
            value="<?php if(isset($_POST['login'])) echo htmlspecialchars($password); ?>" required>
        </div>
      </div>

      <div class="row justify-content-center">
        <input type="submit" class="btn btn-success" name="login" value="Login">
      </div>

    </form>
    <p class=>Don't have an account? <a href="signup.php">Signup Here</a> </p>
  </div>


  <?php require("bootstrapRequirement.php"); ?>


</body>
