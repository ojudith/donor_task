<?php
require_once('config/db_connect.php');

if(session_id() == null) {
    session_start();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php $page_title; ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/index.js" defer><</script>
</head>
<body>
        <nav>
            <h1><?php echo $page_title; ?></h1>
            <ul type="none"><li><a href="index.php">Home Page</a></li>
                <li><a href="donor.php">Donate here</a></li>
            </ul>
        </nav>
    <div class="container">
        
    <h2 class="welcome_msg">Hello there, Welcome to Wikimedia Foundation Donors Page</h2>
