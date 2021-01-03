<?php

require 'php/DBController.php';

require 'php/AuthController.php';

require 'php/NewsController.php';

require 'php/ProfileController.php';

$db = new DBController();
$reg = new AuthController($db);
$news = new NewsController($db);
$prof = new ProfileController($db);

?>