<?php
include 'functions.php';

if (!isset($_SESSION['id']) && !isset($_SESSION['email'])) {
  header("Location: login.php");
}

if (isset($_GET['uid'])) {
  if(strpos($_GET['uid'], "'")){
    header("Location: index.php");
  }
  foreach ($prof->getProfile($_GET['uid']) as $item) {
  }
}

if (!isset($_GET['uid'])) {
  header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="app.css">

</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light px-5">
    <a class="navbar-brand" href="index.php">News App</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto pl-5">
        <li class="nav-item active">
          <a class="nav-link" href="edit-profile.php">Edit Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php printf("%s?uid=%s", 'profile.php', $item['u_id']) ?>">Profile</a>
        </li>
      </ul>
      <div class="cntrl">
        <ul class="navbar-nav">

          <li class="nav-item">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
              <button name="logout_button" style="border: none; outline:none; background-color: #F8F9FA; cursor:pointer;">
          <li class="nav-item" style="cursor:pointer;">Logout</li></button>
          </form>
          </li>

        </ul>
      </div>
    </div>
  </nav>
  <div class="container emp-profile" style="height: 500px; margin-top: 200px">
    <form method="post">
      <div class="row">
        <div class="col-md-4">
          <div class="profile-img">
            <img src="assets/img/user.png" alt="" />
            
          </div>
        </div>
        <div class="col-md-6">
          <div class="profile-head">
            <h5>
              <?php echo $item['u_username'] ?>
            </h5>
            <h6>
              Member
            </h6>
            <div class="mt-5"></div>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Posts</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-2">
          <a href="edit-profile.php"><input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile" /></a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">

        </div>
        <div class="col-md-8">
          <div class="tab-content profile-tab" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
              <div class="row">
                <div class="col-md-6">
                  <label>User Id</label>
                </div>
                <div class="col-md-6">
                  <p><?php echo $item['u_id'] ?></p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label>Full Name</label>
                </div>
                <div class="col-md-6">
                  <p><?php echo $item['u_firstname'] . " " . $item['u_lastname'] ?? "Not Set" ?></p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label>Email</label>
                </div>
                <div class="col-md-6">
                  <p><?php echo $item['u_email'] ?></p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label>Phone</label>
                </div>
                <div class="col-md-6">
                  <p><?php echo $item['u_phone'] ?? "Not Set" ?></p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label>Website</label>
                </div>
                <div class="col-md-6">
                  <p><?php echo $item['u_website'] ?? "Not Set" ?></p>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              <div class="row">
                <div class="col-md-6">
                  <label>Experience</label>
                </div>
                <div class="col-md-6">
                  <p>Expert</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label>Hourly Rate</label>
                </div>
                <div class="col-md-6">
                  <p>10$/hr</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label>Total Projects</label>
                </div>
                <div class="col-md-6">
                  <p>230</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label>English Level</label>
                </div>
                <div class="col-md-6">
                  <p>Expert</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label>Availability</label>
                </div>
                <div class="col-md-6">
                  <p>6 months</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <label>Your Bio</label><br />
                  <p>Your detail description</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>

</body>

</html>