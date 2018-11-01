<?php

// Go to the "tests" directory and start PHP as a WEB server:
//
// php -S localhost:8000 -t public
//
// Then you can run this script.

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'utils.php';

use dbeurive\Http\Requester;
use dbeurive\Http\Code;

define('HOST', 'localhost');
define('PORT', 8000);

print "# Sending a GET request\n\n";

$requester = new Requester();
$query_string = '/handle_get.php?' . Requester::generateQueryString(array('a' => 1, 'b' => 2));
$url = sprintf('http://%s:%d%s', HOST, PORT, $query_string);
$options = array(CURLOPT_USERPWD => 'admin:admin');

$report = null;
try {
    $report = $requester->doGet($url, $options);
} catch (\Exception $e) {
    printf("%s\n", $e->getMessage());
    exit(1);
}

printf("Request header:\n\n%s\n\n", format_code($report->getRequest()->getHeader()->getAsString()));
printf("Response header:\n\n%s\n\n", format_code($report->getResponse()->getHeader()->getAsString()));
$body = $report->getResponse()->getBody();
if (! is_null($body)) {
    printf("Response body:\n\n%s\n\n", format_code($body));
}
printf("Response HTTP code: %s (%s)\n", $report->getResponse()->getCode(), Code::getDescription($report->getResponse()->getCode()));
printf("Response content type: %s\n", $report->getResponse()->getContentType());
printf("Response content length: %s\n", $report->getResponse()->getContentLength());
print "\n";
