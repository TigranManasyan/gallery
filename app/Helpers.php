<?php

function dd(array | string $data) {
    if(gettype($data) == 'array') {
        echo "<pre>";
            print_r($data);
        echo "</pre>";
    } else {
        echo $data;
    }

    die;
}