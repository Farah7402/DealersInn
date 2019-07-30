<nav class="navbar navbar-expand-lg navbar-dark" id="menu">
  <div class="container">
  <!--a class="navbar-brand" href="#"><span class="icon-uilove icon-uilove-realestate"></span></a-->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu-content" aria-controls="menu-content" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="menu-content">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link " href="adminDashboard.php" role="button" aria-expanded="false">
          DashBoard <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Property
        </a>
        <div class="dropdown-menu">
             
            <a href="adminViewProperties.php" class="dropdown-item">All Properties</a>
        </div>
      </li>
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Agents
        </a>
        <div class="dropdown-menu">
            <a href="admin_agent_list.php" class="dropdown-item">All Agents</a>
        </div>
      </li>
    </ul>
    
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown user-account">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="user-image"></span> Hi Admin
        </a>
        <div class="dropdown-menu">
            <!--a href="update_profile.php" class="dropdown-item">My Profile</a>
            <a href="#" class="dropdown-item">Change Password</a>
            <a href="#" class="dropdown-item">Notifications</a>
            <a href="my_payments.html" class="dropdown-item">Payments</a-->
            <!--a href="#" class="dropdown-item">Account</a-->
            <a href="logout.php" class="dropdown-item">Logout</a>
        </div>
      </li>
      <!--li class="nav-item"><a class="nav-link nav-btn" href="my_listing_add.html"><span><i class="fa fa-plus" aria-hidden="true"></i> Add listing</span></a></li-->
    </ul>
    
  </div>
  </div>
</nav>
