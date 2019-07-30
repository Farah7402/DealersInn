<nav class="navbar navbar-expand-lg navbar-dark" id="menu">
  <div class="container">
  <!--a class="navbar-brand" href="#"><span class="icon-uilove icon-uilove-realestate"></span></a-->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu-content" aria-controls="menu-content" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="menu-content">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link " href="main.php" role="button" aria-expanded="false">
          Home <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link " href="postadd.php" role="button" aria-expanded="false">
          Post Ad <span class="sr-only"></span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Property
        </a>
        <div class="dropdown-menu">
             <a href="my_listing_add.php" class="dropdown-item">Add Property</a>
            <a href="view_property.php" class="dropdown-item">View Property</a>
            <!--a href="#" class="dropdown-item">Update Property</a>
            <a href="#" class="dropdown-item">Delete Property</a>
            <a href="#" class="dropdown-item">Share Property</a-->
        </div>
      </li>
        
      
      <!--li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Agents
        </a>
        <div class="dropdown-menu">
            <a href="agentlist.php" class="dropdown-item">Agent List</a>
        </div>
      </li-->
    </ul>
    
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown user-account">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="user-image" ></span> Hi, <?=$_SESSION["UserName"];?>
        </a>
        <div class="dropdown-menu">
            <!--a href="update_profile.php" class="dropdown-item">My Profile</a-->
            <!--a href="#" class="dropdown-item">Change Password</a-->
            <a href="agentlist.php" class="dropdown-item">Add Friends</a>
            <a href="notifications.php" class="dropdown-item">Notifications</a>
            <!--a href="my_payments.html" class="dropdown-item">Payments</a-->
            <!--a href="#" class="dropdown-item">Account</a-->
            <a href="logout.php" class="dropdown-item">Logout</a>
        </div>
      </li>
      <!--li class="nav-item"><a class="nav-link nav-btn" href="my_listing_add.html"><span><i class="fa fa-plus" aria-hidden="true"></i> Add listing</span></a></li-->
    </ul>
    
  </div>
  </div>
</nav>
