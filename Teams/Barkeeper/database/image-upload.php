<?php

function uploadFile($target_file, $post_file) {
    if (move_uploaded_file($post_file["tmp_name"], $target_file)) {
        return true;
    } else {
        return false;
    }
}

function checkFileSize($post_file) {
    if ($post_file["size"] > 5000000) {
        return false;
    } else {
        return true;
    }
}

function fileExists($target_file) {
    return file_exists($target_file);
}

function isImage($target_file) {
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        return false;
    } else {
        return true;
    }
}
