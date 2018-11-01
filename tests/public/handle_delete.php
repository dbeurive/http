<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'RequestsResponses.php';

file_put_contents('data.txt', print_r($_SERVER, true));

function handle_delete() {
    print RequestsResponses::DELETE;
}

handle_delete();


