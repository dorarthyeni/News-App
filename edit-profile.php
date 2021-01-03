<?php
include 'functions.php';
$good = [];
if (!isset($_SESSION['username']) && !isset($_SESSION['email'])) {
  header("Location: login.php");
}

if (isset($_POST['logout_button'])) {
  session_unset();
}

if (isset($_POST['save_submit'])) {
  $name = $_POST['name'];
  $lastname = $_POST['lastname'];
  $phonenumber = $_POST['phonenumber'];
  $website = $_POST['website'];
  $profilepic = $_POST['profilepic'];
  $id = $_SESSION['id'];
  if($prof->setupProfile("users", $name, $lastname, $website, $phonenumber,$profilepic, $id) == true){
    $good[] = "you have sucessfuly set up your profile";

  }
}

if(isset($_POST['changepassword'])){
  $oldpassword = $_POST['oldpassword'];
  $newpassword = $_POST['newpassword'];
  $id = $_SESSION['id'];

  if($prof->changePassword($oldpassword,$newpassword,$id) == true){
    $good[] = "you have sucessfuly changed your password";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="app.css">

  <title>Edit profile</title>
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
          <a class="nav-link" href="<?php printf("%s?uid=%s", 'profile.php', $_SESSION['id']) ?>">Profile</a>
        </li>
      </ul>
      <div class="cntrl">
        <ul class="navbar-nav">

          <li class="nav-item">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
              <button name="logout_button" style="border: none; outline:none; background-color: #F8F9FA;">
          <li class="nav-item">Logout</li></button>
          </form>
          </li>

        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-5">
    <?php if(!empty($good)) :?>
  <div class="alert alert-success mb-3" role="alert">
    <?php foreach ($good as $goods):?>
      <li><?php echo $goods?></li>
      <?php endforeach;?>
  <?php endif; ?>
    <div class="row mb-5 p-5" style="background-color:white; border-radius: 10px;">
      <div class="col-md-6 col-sm-12">
        <form class="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
          <h2 class="text-primary mb-5">Setup Profile</h2>


          <div class="form-group">
            <label for="inputUsername">Name</label>
            <input type="text" name="name" class="form-control" id="inputUsername" aria-describedby="inputUsername">
          </div>

          <div class="form-group">
            <label for="inputUsername">Last Name</label>
            <input type="text" name="lastname" class="form-control" id="inputUsername" aria-describedby="inputUsername">
          </div>
          <div class="form-group">
            <label for="exampleFormControlFile1">Profile Picture</label>
            <input type="text" name = "profilepic" class="form-control" id="exampleFormControlFile1">
          </div>
          <button type="submit" name="save_submit" class="btn btn-primary px-5 mt-3">Save</button>
      </div>
      <div class="col-md-6 col-sm-12" style="margin-top: 85px;">
        <div class="form-group">
          <label for="inputUsername">Phone Number</label>
          <input type="text" name="phonenumber" class="form-control" id="inputUsername" aria-describedby="inputUsername">
        </div>
        <div class="form-group">
          <label for="inputUsername">Website</label>
          <input type="text" name="website" class="form-control" id="inputUsername" aria-describedby="inputUsername">
        </div>


        </form>

      </div>
    </div>
    <div class="row mt-5 p-5" style="background-color:white; border-radius: 10px;">
      <div class="col-md-6 col-sm-12">
        <form action="" method="post">
          <h2 class="text-primary mb-5">Change Password</h2>
          <div class="form-group">
            <label for="exampleInputPassword1">Old Password</label>
            <input type="password" name = "oldpassword" class="form-control" id="exampleInputPassword1">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">New Password</label>
            <input type="password" name = "newpassword" class="form-control" id="exampleInputPassword1">
          </div>
          <button class="btn btn-primary mt-3" name = "changepassword" type="submit" name="changepassword">Change Password</button>
        </form>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous">
  </script>
</body>

</html>