
<?php

  if(!isset($_GET['user'])){
    header("Location:index.php");
  }

  else {
    
    require("databaseConnection.php");
    $username=mysqli_real_escape_string($conn,$_GET['user']);
    $sql="SELECT * FROM `url_table` WHERE `username`='$username'";
    $result = mysqli_query($conn,$sql);
    $urlList = mysqli_fetch_all($result,MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);  
  }

?>

<?php require("head.php");?>

<body class="linkgradient">

  <div class="container text-center">
    <div class="row justify-content-center m-2">
      <h4 class="p-2 text-light"><strong><?php echo htmlspecialchars($_GET['user']) ?></strong>
      </h4>
    </div>


    <?php foreach($urlList as $item):  ?>
    <?php if($item['visibility']=="1"): ?>


    <form action="redirect.php" method="POST">
      <div class="row justify-content-center">

        <input type="hidden" name="url_id" value="<?php echo htmlspecialchars($item['url_id']); ?>">

        <input type="hidden" name="url" value="<?php echo htmlspecialchars($item['url']); ?>">

        <input type="submit" name="title" value="<?php echo htmlspecialchars($item['title']); ?>"
          class="btn btn-outline-light col-sm-12 col-md-8 mx-5 my-2">
      </div>
    </form>

    <?php endif; ?>
    <?php endforeach; ?>

  </div>

  <?php require("bootstrapRequirement.php");?>
</body>
