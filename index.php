<?php

include 'functions.php';

if (!isset($_SESSION['username']) && !isset($_SESSION['email'])) {
    header("Location: login.php");
}
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $message = $_POST['message'];
    $userid = $_POST['userid'];
    $errors = array();
    $good = array();
    if (empty($errors) && isset($title) && isset($message)) {
        $news->addto($title, $message, $userid, $_SESSION['username']);
        header("Refresh:0");
    }
}
$posts = $news->getData();
if (isset($_POST['hidesubmit'])) {
    $postid = $_POST['postid'];
    $news->deleteNews("post", $postid);
    header("Refresh:0");
}
if (isset($_POST['logout_button'])) {
    session_unset();
    header("Location: login.php");
}
if (isset($_POST['reportsubmit'])) {
    $postid = $_POST['postid'];
    if($news->reportedNews($postid) == true)
    $good[] = "You have sucessfuly reported this post";

}
// $userposts = $news->getNews($_SESSION['id'], "post");  
// print_r($userposts);
foreach ($prof->getProfile($_SESSION['id']) as $item) {
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8  t</title">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <!------  Include the above in your HEAD tag ---------->

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

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
                <li class="nav-item">
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
                            <button name="logout_button" style="border: none; outline:none; background-color: #F8F9FA;">
                    <li class="nav-item">Logout</li></button>
                    </form>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid gedf-wrapper">

        <div class="row">

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="h5">@<?php echo $_SESSION['username']; ?> </div>
                        <div class="h7 text-muted">Fullname : <?php echo $item['u_firstname'] . " " . $item['u_lastname'] ?></div>
                        <div class="h7">
                            <?php echo $item['u_email'] ?>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="h6 text-muted">Posts</div>
                            <div class="h5"><?php echo count($news->getDataSingle($_SESSION['id'])) ?></div>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="col-md-6 gedf-main">

                <!--- \\\\\\\Post-->
                <?php if (!empty($good)) : ?>
                    <div class="alert alert-success mb-3" role="alert">
                        <?php foreach ($good as $goods) : ?>
                            <li><?php echo $goods ?></li>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <div class="card gedf-card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">Make
                                    a publication</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="images-tab" data-toggle="tab" role="tab" aria-controls="images" aria-selected="false" href="#images">Images</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="title" value="<?php if (isset($_POST['title'])) echo $_POST['title'] ?>" id="title" placeholder="title">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="message">post</label>
                                        <input type="hidden" name="userid" value="<?php echo 1 ?>">
                                        <textarea class="form-control" name="message" value="<?php if (isset($_POST['message'])) echo $_POST['message'] ?>" id="message" rows="3" placeholder="What are you thinking?"></textarea>
                                        <input type="hidden" name="postid" value="<?php $post['p_id']; ?>">

                                    </div>

                            </div>
                            <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                                <div class="form-group">

                                </div>
                                <div class="py-4"></div>
                            </div>
                        </div>
                        <div class="btn-toolbar justify-content-between">
                            <div class="btn-group">
                                <button type="submit" name="submit" class="btn btn-primary">share</button>
                            </div>
                            <div class="btn-group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-globe"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                                    <a class="dropdown-item" href="#"><i class="fa fa-globe"></i> Public</a>
                                    <a class="dropdown-item" href="#"><i class="fa fa-users"></i> Friends</a>
                                    <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Just me</a>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Post /////-->
                <?php foreach ($posts as &$post) : ?>

                    <div class="card gedf-card mb-5" id="postsc">

                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-2">
                                        <img class="rounded-circle" width="45" src="https://img.icons8.com/fluent/48/000000/user-male-circle.png" alt="">
                                    </div>
                                    <div class="ml-2">
                                        <div class="h5 m-0"><?php echo $post['p_poster']; ?></div>
                                        <div class="h7 text-muted">Miracles Lee Cross</div>
                                    </div>
                                </div>
                                <div>
                                    <div class="dropdown">
                                        <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                            <form action="<?php  ?>" method="post">
                                                <div class="h6 dropdown-header">Configuration</div>
                                                <a class="dropdown-item" href="#">Save</a>
                                                <input type="hidden" name="postid" value="<?php echo $post['p_id']; ?>">
                                                <button id="hidebtn" class="dropdown-item" name="hidesubmit">Hide</button>
                                                <button id="hidebtn" class="dropdown-item" name="reportsubmit">Report</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i><?php echo $post['p_time']; ?></div>
                            <a class="card-link" href="#">
                                <h5 class="card-title"><?php echo $post['p_title']; ?></h5>
                            </a>

                            <p class="card-text"><?php echo $post['p_message']; ?></p>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="card-link"><i class="fa fa-gittip"></i> Like</a>
                            <a href="#" class="card-link"><i class="fa fa-comment"></i> Comment</a>
                            <a href="#" class="card-link"><i class="fa fa-mail-forward"></i> Share</a>
                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- Post /////-->






            </div>
            <div class="col-md-3">
                <div class="card gedf-card">
                    <div class="card-body">
                        <h5 class="card-title">Users</h5>
                        <div class="users mt-2">
                            <?php foreach ($reg->getData() as $users) : ?>
                                <li><a style="text-decoration:none; color:black;" href="<?php printf("%s?uid=%s", 'profile.php', $users['u_id']) ?>"><?php echo $users['u_username'] ?></a></li>

                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>