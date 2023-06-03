<?php 
    session_start();

    if (!isset($_SESSION['authorized'])) {
        header( 'Location: login.php', true);
        exit;
    }
   
    $im = imagecreatefromjpeg($_POST['file']);

    $filter = IMG_FILTER_EMBOSS;
    if ($_POST['type'] == 1) { $filter = IMG_FILTER_GRAYSCALE; }
    if ($_POST['type'] == 2) { $filter = IMG_FILTER_NEGATE; }
    imagefilter($im, $filter);

    header('content-type: image/jpeg');
    imagejpeg($im);
    imagejpeg($im, 'dir_filtered/image_'.$_POST['type'].'.jpg');

    imagedestroy($im);
?>