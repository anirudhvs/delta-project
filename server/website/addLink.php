<?php 
  session_start();

  if(!isset($_SESSION['userId'])){
    header("Location:index.php");
  }

  $userId=$_SESSION['userId'];
  $username=$_SESSION['username'];
  if(isset($_POST['addLink']))
  {
    require("databaseConnection.php");
    $linkTitle=mysqli_real_escape_string($conn,$_POST['linkTitle']);
    $linkURL=mysqli_real_escape_string($conn,$_POST['linkURL']);
    $showLink=mysqli_real_escape_string($conn,$_POST['showLink']);
    $username=mysqli_real_escape_string($conn,$username);
    if($_POST['showLink']=="true"){
      $showLink=1;
    } else {
      $showLink=0;
    }

    $sql="INSERT INTO `url_table`(`user_id`,`username`,`title`,`url`, `visibility`) VALUES('$userId', '$username' ,'$linkTitle','$linkURL','$showLink')";

    if(mysqli_query($conn,$sql)){
      $_SESSION['newLink']=$linkTitle;
      header("Location:userPortal.php");

    } else{
      echo 'query error: '. mysqli_error($conn);
    }


  }

?>


<!-- Head  -->
<?php require("head.php"); ?>

<body>

  <!-- NavBar -->
  <?php require("topNav.php"); ?>

  <div class="container my-2">
    <h2 class="text-success">Enter Link Details</h2>

    <div class="container my-3">
      <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" class="border border-secondary px-3 rounded">

        <!-- Title -->
        <div class="form-group my-2">
          <label for="linkTitle">Title</label>
          <input type="text" class="form-control" name="linkTitle" id="linkTitle" placeholder="An Attractive Title"
            required>
        </div>

        <!-- URL -->
        <div class="form-group my-2">
          <label for="linkURL">URL or Link to Post</label>
          <input type="text" class="form-control" name="linkURL" id="linkURL" placeholder="www.example.com/yourpost"
            required>
        </div>
        <!-- Check Show or Hide -->
        <div class="form-check form-check-inline my-2">
          Show / Hide Link : &nbsp;

          <input type="radio" class="form-check-input" name="showLink" id="linkShow" value="true" checked>
          <label for="linkShow" class="form-check-label">Show &nbsp; </label>

          <input type="radio" class="form-check-input" name="showLink" id="linkHide" value="false">
          <label for="linkHide" class="form-check-label">Hide</label>
        </div>
        <!-- Submit -->
        <div class="form-group text-right">
          <input id="signupButton" type="submit" name="addLink" class="btn btn-success" value="Add">
        </div>
    </div>
    </form>
  </div>


  </div>




  <?php require("bootstrapRequirement.php"); ?>

</body>