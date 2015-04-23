<nav class="navbar navbar-inverse navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Reserve</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class=""><a href="index.php">Services <span class="sr-only">(current)</span></a></li>
        <?php if ($_SESSION['user']['rights'] == 1): ?>
          <li class=""><a href="admin.php">Admin <span class="sr-only">(current)</span></a></li>
        <?php endif; ?>
        <!-- <li><a href="#">Link</a></li> -->
        <!-- <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li> -->
      </ul>
      <!-- <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form> -->
      <ul class="nav navbar-nav navbar-right">
        <li class=""><a href="contact.php">Contact <span class="sr-only">(current)</span></a></li>
        <?php if ($_auth->checkSession()): ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Account <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="myaccount.php">My account</a></li>
              <li><a href="myreservations.php">My reservations</a></li>
              <li class="divider"></li>
              <li><a href="signout.php">Sign out</a></li>
            </ul>
          </li>
        <?php else: ?>
          <li class=""><a href="signin.php">Sign in <span class="sr-only">(current)</span></a></li>
          <li class=""><a href="signup.php">Sign up <span class="sr-only">(current)</span></a></li>
        <?php endif; ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
