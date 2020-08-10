<?php 
session_start();

if(isset($_GET['u'])){
  header("Location:userLinks.php?user=".$_GET['u']);
}

else if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']==true){
  header("Location:userPortal.php");
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

  <div class="container text-center" stlye="margin:auto">


    <h2><br> One Link for all your links. </h2>
    <p class="lead">Just share a single link to all your posts instead of multiple links. Get analytics about
      your posts.</p>


    <img src="images/lineGraph.png" alt="Line Graph Example">


  </div>


  <?php require("bootstrapRequirement.php");?>

</body>

</html>