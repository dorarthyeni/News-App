<?php

if(isset($_POST['reg_submit'])) {
  include 'functions.php';

  $email = trim($_POST['email']);
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  $password2 = trim($_POST['password2']);
  $errors = array();

  if(empty($email)){
    $errors[] = "enter a email";
  }
  if(empty($password)){
    $errors[] = "enter a password";
  }
  if(empty($password2)){
    $errors[] = "retype a password";
  }
  if(empty($username)){
    $errors[] = "enter a username";
  }
  if($password !== $password2){
    $errors[] = "passwords dont match";
  }
  if($reg->validateUser($username) == true){
    $errors[] = "username has been taken";
  }
  if($reg->validateEmail($email) == true){
    $errors[] = "email has been taken";

  }
  if(empty($errors)){
     $reg->addto($email, $username, $password);
  }
  foreach($reg->getData() as $item){}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="app.css">
    <title>Document</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light px-5">
    <a class="navbar-brand" href="#">News App</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
      aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
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
          <a class="nav-link" href="profile.php">Profile</a>
        </li>
      </ul>
      <div class="cntrl">
        <ul class="navbar-nav">
        
          <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>

          </li>
          
        </ul>
      </div>
    </div>
  </nav>
<main>
    <div class="container" style="margin-top:200px;">
        <div class="row" style="height: 500px;">
            <div class="col-md-6 col-sm-12 col-lg-6 mx-auto">
              <?php if(!empty($errors)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php foreach($errors as $error) : ?>
                  <?php echo "<li>$error</li>" ?>
                  <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <form class="p-5 bg-white" style="border-radius: 20px;" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" name = "email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
                      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="inputUsername">Username</label>
                        <input type="text" name = "username" class="form-control" id="inputUsername" value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>">
                      </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" name = "password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Retype Password</label>
                        <input type="password" name = "password2" class="form-control" id="exampleInputPassword1">
                      </div>
                    <button type="submit" name = "reg_submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
           
        </div>
        
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous">
</script>
</body>

</html>