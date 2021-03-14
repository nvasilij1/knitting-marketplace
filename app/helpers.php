<?php

function get_random_string($valid_chars, $length) {
    $random_string = "";
    $num_valid_chars = strlen($valid_chars);
    for ($i = 0; $i < $length; $i++) {
        $random_pick = mt_rand(1, $num_valid_chars);
        $random_char = $valid_chars[$random_pick-1];
        $random_string .= $random_char;
    }

    return $random_string;
}

function put_file_string($decoded_string, $category_or_product=true){
    // create random image file name
    $upload_dir="category";
    if(!$category_or_product){
        $upload_dir="product";
    }
    if(strlen($decoded_string) > 0) {
        $string = '0123456789';
        $image = get_random_string($string, 32) . "-" . date("Y-m-d") . ".jpeg";
        $pach = date("Y/m/d/H");
        $pach_ch = __DIR__ . '/../upload/' . $upload_dir . '/' . $pach;
        if (!is_dir($pach_ch))
            if (!mkdir($pach_ch, 0777, TRUE) && !is_dir($pach_ch)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $pach_ch));
            }
        // upload new image
        file_put_contents($pach_ch . "/" . $image, $decoded_string);
    } else {
        $pach =  '/images';
        $image = 'empty.png';
    }
    return $pach . "/" . $image;
}




