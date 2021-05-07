<?php

if (!empty($_POST)) {

    $path = pathinfo($_POST["image"]);
    $image = imagecreatefrompng($_POST["image"]);

    $type = $_POST["type"];

    switch ($type) {
        case 'IMG_FILTER_NEGATE':
            imagefilter($image, IMG_FILTER_NEGATE);
            break;
        case 'IMG_FILTER_GRAYSCALE':
            imagefilter($image, IMG_FILTER_GRAYSCALE);
            break;
        case 'IMG_FILTER_COLORIZE':
            imagefilter($image, IMG_FILTER_COLORIZE, 50, 0, 0);
            break;
        case 'IMG_FILTER_MEAN_REMOVAL':
            imagefilter($image, IMG_FILTER_MEAN_REMOVAL);
            break;
        case 'IMG_FILTER_EMBOSS':
            imagefilter($image, IMG_FILTER_EMBOSS);
            break;
        default:
            break;
    }

    header('Content-Type: image/png');
    imagepng($image);
}
