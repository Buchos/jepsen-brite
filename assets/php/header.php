<?php
if (!isset($page_title)) {
    $page_title = 'Page Title not set!';
}
?>

<!doctype html>

<html lang="en">
    <head>
        <title>JepsenBrite - <?php echo $page_title; ?></title>
        <meta charset="utf-8">
    <!--    <link rel="stylesheet" href="http://becode.local/jepsen-brite/assets/css/index.css">-->
        <link rel="stylesheet" href="<?php echo $stupidroot;?>assets/css/index.css">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Open+Sans:ital,wght@0,300;0,400;0,700;1,400&display=swap" rel="stylesheet"> 
    </head>

    <body>