<?php

  session_start();

  if(!isset($_SESSION['userId'])){
    header("index.php");
  }
  else {
    $userId=$_SESSION['userId'];
  }



  if(isset($_GET['url_id'])){
    
    

    require("databaseConnection.php");
    $urlId=mysqli_real_escape_string($conn,$_GET['url_id']);
    
    $sql="SELECT * FROM `url_table` WHERE `url_id` = $urlId";
    $result = mysqli_query($conn,$sql);
    $urlDetails = mysqli_fetch_all($result,MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    
    if($userId!=$urlDetails[0]['user_id'] || empty($urlDetails)){
      header("Location:userPortal.php");
    }
  }

  else if(isset($_POST['edit'])){
    require("databaseConnection.php");
    $urlId=mysqli_real_escape_string($conn,$_POST['url_id']);
    $title=mysqli_real_escape_string($conn,$_POST['title']);
    $url=mysqli_real_escape_string($conn,$_POST['url']);
    $visibility=$_POST['showLink']=="true" ? 1 : 0;
    $sql="UPDATE `url_table` SET `title` = '$title', `url` = '$url',`visibility` = $visibility,`last_modified`=CURRENT_TIMESTAMP() WHERE `url_id` = $urlId";
    
    if(mysqli_query($conn,$sql)) {
      $_SESSION['modifySuccess']=true;
    }
    else {
      $_SESSION['modifyFail']=true;
    }
    
    header("Location:details.php?url_id=$urlId");

  }
  else{
    header("Location:userPortal.php");
  }

  


?>

<?php require("head.php"); ?>

<body>

  <?php require("topNav.php"); ?>

  <div class="container my-2 border border-secondary rounded">
    <h1>Stats</h1>
    <div class="row justify-content-center">
      <canvas class="col-sm-12 col-md-9" id="myChart"></canvas>
    </div>
    <div class="row justify-content-center">
      <canvas class="col-sm-12 col-md-9" id="platform"></canvas>
    </div>
    <div class="row justify-content-center">
      <canvas class="col-sm-12 col-md-9" id="views"></canvas>
    </div>
  </div>





  <div class="container my-2 border border-secondary rounded">

    <h1>Modify :</h1>
    <div class="container">
      <form action="details.php" method="POST">
        <input type="text" hidden name="url_id" value="<?php echo $urlId;?>">
        <div class="form-group row my-3">
          <label for="title" class="col-sm-2 col-form-label">Title</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="title" id="title"
              value="<?php echo htmlspecialchars($urlDetails[0]['title']); ?>" readonly>
          </div>
        </div>

        <div class="form-group row">
          <label for="url" class="col-sm-2 col-form-label">URL</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="url" id="url"
              value="<?php echo htmlspecialchars($urlDetails[0]['url']); ?>" readonly>
          </div>
        </div>

        <div class="form-check form-check-inline my-2">
          Show / Hide Link : &nbsp;

          <input type="radio" class="form-check-input" name="showLink" id="linkShow" value="true"
            <?php if($urlDetails[0]['visibility']=="1") echo "checked" ?> disabled>
          <label for="linkShow" class="form-check-label">Show &nbsp; </label>

          <input type="radio" class="form-check-input" name="showLink" id="linkHide" value="false"
            <?php if($urlDetails[0]['visibility']=="0") echo "checked" ?> disabled>
          <label for="linkHide" class="form-check-label">Hide</label>
        </div>

        <div class="row justify-content-end my-2">
          <input type="submit" class="btn btn-primary mx-1" id="edit" name="edit" value="Save" hidden>
          <div class="btn btn-success mx-1" id="enableEdit">Edit</div>
          <a href="delete.php?url_id=<?php echo ($urlDetails[0]['url_id']); ?>" class="btn btn-danger btn-md">Delete</a>
        </div>

      </form>
    </div>
  </div>



  <?php require("bootstrapRequirement.php"); ?>
  <!-- jQuery Full -->
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>
  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  <script>
    let urlId = <?php echo $urlId; ?> ;
  </script>
  <!-- script for chart -->
  <script type="text/javascript" src="serverchart.js"></script>
  <!-- detect edit -->
  <script type="text/javascript" src="edit.js"></script>



</body>