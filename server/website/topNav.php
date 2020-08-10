  <nav class="nav navbar navbar-dark bg-dark">
    <a href="index.php" class="navbar-brand">
      <img src="images/logo.png" alt="logo" height="100px">
    </a>

    <div class="btn-group">
      <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">Hello,
        <?php echo htmlspecialchars($_SESSION['username']) ?></button>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="userSettings.php">User Settings</a>
        <a class="dropdown-item" href="logout.php">Logout</a>
      </div>
    </div>
  </nav>