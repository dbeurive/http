<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'RequestsResponses.php';

file_put_contents('data.txt', print_r($_SERVER, true));

function handle_put() {
    $entityBody = file_get_contents('php://input');
    print sprintf('%s %s', RequestsResponses::PUT, $entityBody);
}

handle_put();
