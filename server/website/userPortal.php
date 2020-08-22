<?php 
session_start();

if(!isset($_SESSION['userId'])){
  header("Location:index.php");
}

$userName = $_SESSION['username'];
$userId=$_SESSION['userId'];
  //Getting Existing Cards From user
  require("databaseConnection.php");
  $sql="SELECT * FROM `url_table` WHERE `user_id` = $userId";
  $result = mysqli_query($conn,$sql);
  $links = mysqli_fetch_all($result,MYSQLI_ASSOC);
  mysqli_free_result($result);
  mysqli_close($conn);
?>


<?php require("head.php"); ?>

<body>

  <?php require("topNav.php"); ?>

  <!-- Alert Message For Adding Link -->
  <?php if(isset($_SESSION['newLink'])): ?>
  <div class="alert alert-success alert-dismissible " role="alert">
    Successfully Added <?php echo htmlspecialchars($_SESSION['newLink']); ?>
    <button type="button" class="close" data-dismiss="alert">
      <span>&times;</span>
    </button>
  </div>
  <?php unset($_SESSION['newLink']); ?>
  <?php endif; ?>

  <!-- Alert Message For Successfully Deleting Item -->
  <?php if(isset($_SESSION['deleteStatus']) && $_SESSION['deleteStatus'] == true ): ?>
  <div class="alert alert-success alert-dismissible " role="alert">
    Successfully Deleted <?php echo $_SESSION['deleteItem']; ?>
    <button type="button" class="close" data-dismiss="alert">
      <span>&times;</span>
    </button>
  </div>
  <?php 
    unset($_SESSION['deleteStatus']);
    unset($_SESSION['deleteItem']);
  ?>
  <?php endif; ?>

  <!-- Alert Message For Failure in Deleting Item -->
  <?php if(isset($_SESSION['deleteStatus'])  && $_SESSION['deleteStatus'] == false ): ?>
  <div class="alert alert-danger alert-dismissible " role="alert">
    Couldn't delete <?php echo $_SESSION['deleteItem']; ?>
    <button type="button" class="close" data-dismiss="alert">
      <span>&times;</span>
    </button>
  </div>
  <?php 
    unset($_SESSION['deleteStatus']);
    unset($_SESSION['deleteItem']);
  ?>
  <?php endif; ?>

  <!-- Main Content -->
  <div class="container mt-5 text-center">
    <div class="row justify-content-between">
      <h1 class="col-md-3 col-sm-12 ">Links</h1>
      <a href="addLink.php" class="btn btn-success btn-lg col-md-3 col-sm-12" tabindex="-1" role="button">Add new Link
        +</a>
    </div>
    <div class="row mt-5">

      <?php  foreach($links as $link) : ?>

      <div class="card  pl-0 pr-0 mr-2 my-2 text-center" style="width:20rem;">
        <h5 class="card-header"><?php echo htmlspecialchars($link['title']); ?></h5>
        <div class="card-body">
          <p class="card-text lead">URL : <?php echo htmlspecialchars($link['url']); ?> </p>
          <a href="details.php?url_id=<?php echo ($link['url_id']); ?>" class="btn btn-primary btn-md">More</a>
          <a href="delete.php?url_id=<?php echo ($link['url_id']); ?>" class="btn btn-danger btn-md">Delete</a>
        </div>
      </div>

      <?php  endforeach; ?>

    </div>

    <!-- No Links Added -->
    <?php if(empty($links)): ?>
    <div class="row h-25 text-center align-items-center justify-content-center text-muted lead ">
      <div class="col-6 text-center ">
        No links added. Click on add new link to create one.
      </div>
    </div>

    <?php endif; ?>
  </div>
  
  <div class="container">
        <div class="d-flex justify-content-end">
          <button class="btn btn-secondary" id="clipboard">Copy your link</button>
        </div>
  </div>

  <?php require("bootstrapRequirement.php"); ?>
  
  <script type="text/javascript" > let text= '<?php echo "localhost:8000/?u=".$_SESSION['username']; ?>'; </script>
   <script src="copyClipboard.js"></script>
</body>

</html>