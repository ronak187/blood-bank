<?php
require "cloudinary/vendor/autoload.php";
require "cloudinary/config-cloud.php";

function getURL($file)
{
    $cloudUpload = \Cloudinary\Uploader::upload($file);
    $address = $cloudUpload['secure_url'];
    return $address;
}
