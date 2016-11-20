<?php

function uploadimg($filename, $width, $get_height, $path) {
    if (trim($_FILES["image"]["tmp_name"]) != "") {
        $tmp_images = $_FILES["image"]["tmp_name"];
        // type select
        if ($_FILES['image']['type'] == 'image/jpeg' OR $_FILES['image']['type'] == 'image/jpg' OR $_FILES['image']['type'] == 'image/pjpeg') {
            $images = $filename . ".jpg";
            //upload source image
            $size = getimagesize($tmp_images);
            //check radio widht and height
            $height = round($width * $size[1] / $size[0]);
            if ($height > $get_height) {
                $width = round($get_height * $size[0] / $size[1]);
                $height = $get_height;
            }
            $images_orig = ImageCreateFromJPEG($tmp_images);
            $photoX = ImagesX($images_orig);
            $photoY = ImagesY($images_orig);
            $images_fin = ImageCreateTrueColor($width, $height);
            ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width + 1, $height + 1, $photoX, $photoY);
            ImageJPEG($images_fin, $path . $images);
            ImageDestroy($images_orig);
            ImageDestroy($images_fin);
            return $filename . ".jpg";
        } elseif ($_FILES['image']['type'] == 'image/x-png' OR $_FILES['image']['type'] == 'image/png') {
            $images = $filename . ".png";
            $size = getimagesize($tmp_images);
            //check radio widht and height
            $height = round($width * $size[1] / $size[0]);
            if ($height > $get_height) {
                $width = round($get_height * $size[0] / $size[1]);
                $height = $get_height;
            }
            $images_orig = ImageCreateFromPNG($tmp_images);
            $photoX = ImagesX($images_orig);
            $photoY = ImagesY($images_orig);
            $images_fin = ImageCreateTrueColor($width, $height);
            ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width + 1, $height + 1, $photoX, $photoY);
            Imagepng($images_fin, $path . $images);
            ImageDestroy($images_orig);
            ImageDestroy($images_fin);
            return $filename . ".png";
        } elseif ($_FILES['image']['type'] == 'image/gif') {
            $images = $filename . ".gif";
            $size = getimagesize($tmp_images);
            //check radio widht and height
            $height = round($width * $size[1] / $size[0]);
            if ($height > $get_height) {
                $width = round($get_height * $size[0] / $size[1]);
                $height = $get_height;
            }
            $images_orig = ImageCreateFromgif($tmp_images);
            $photoX = ImagesX($images_orig);
            $photoY = ImagesY($images_orig);
            $images_fin = ImageCreateTrueColor($width, $height);
            ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width + 1, $height + 1, $photoX, $photoY);
            Imagegif($images_fin, $path . $images);
            ImageDestroy($images_orig);
            ImageDestroy($images_fin);
            return $filename . ".gif";
        } else {
            return FALSE;
        }
    }
}

function checkimg() {
    if ($_FILES['image']['type'] == 'image/jpeg' OR $_FILES['image']['type'] == 'image/jpg' OR $_FILES['image']['type'] == 'image/pjpeg' OR $_FILES['image']['type'] == 'image/x-png' OR $_FILES['image']['type'] == 'image/png' OR $_FILES['image']['type'] == 'image/gif') {
        return TRUE;
    } else {
        return FALSE;
    }
}
