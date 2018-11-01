<?php

// Go to the "tests" directory and start PHP as a WEB server:
//
// php -S localhost:8000 -t public
//
// Then you can run this script.

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use dbeurive\Http\Requester;
use dbeurive\Http\ExceptionParameter;
use dbeurive\Http\ExceptionRuntime;
use dbeurive\Http\Code;

// ---------------------------------------------
// GET / DELETE
// ---------------------------------------------

// Create a requester.
// Through the constructor's second parameter, you can provide a setting that will be applied for all requests.
// Here, we set the required header for a basic authentication.
$general_curl_options = array(CURLOPT_USERPWD => 'login:password');
$requester = new Requester($general_curl_options);

$report = null;
try {
    // Send a GET request.
    // Through the method's second parameter, you can provide a setting that will be applied for this request only.
    // The method returns an "execution report". This report contains:
    // - the request that has been sent (the header and the content).
    // - the response that has been received (the header and the body).
    // - information returned by the Curl library (such as the request duration).
    $specific_curl_options = array(CURLOPT_HTTPHEADER => array(
        'header1: a',
        'header2: b',
    ));
    $report = $requester->doGet('http://www.google.com/search?q=php',
        $specific_curl_options); // This parameter is optional.
} catch (ExceptionRuntime $e) {
    printf("FATAL ERROR: %s\n", $e->getMessage());
    exit(1);
} catch (ExceptionParameter $e) {
    printf("FATAL ERROR: %s\n", $e->getMessage());
    exit(1);
} catch (\Exception $e) {
    printf("FATAL ERROR: %s\n", $e->getMessage());
    exit(1);
}

$http_code = $report->getResponse()->getCode();
printf("Last HTTP response code: %d\n", $http_code);
printf("Content length:          %d\n", $report->getResponse()->getContentLength());
printf("Content type:            %s\n\n", is_null($report->getResponse()->getContentType()) ? 'null' : $report->getResponse()->getContentType());

if (Code::HTTP_OK != $http_code) {
    printf("HTTP code: %d (%s)\n\n",
        $http_code,
        Code::getDescription($http_code)
    );
}

// Get the request header. Please note that the request content will be null (as it is for any GET request).
printf("Request header:\n\n%s\n\n",
    $report->getRequest()->getHeader()->getAsString()
);

// Get the response header.
printf("Response header:\n\n%s\n\n",
    $report->getResponse()->getHeader()->getAsString()
);

// Get the response body.
printf("Request body:\n\n%s\n\n",
    $report->getResponse()->getBody()
);

// Get data about the execution.
printf("Request body:\n\n%s\n\n",
    $report->getInformation()->getAsString(true)
);

// ---------------------------------------------
// POST / PUT
// ---------------------------------------------

// Create a requester.
// Note: a requester is not bound to a URL or a method. We could have reused the one you've previously created (for the
//       GET example).
$general_curl_options = array(); // No setting is provided for all requests.
$requester = new Requester($general_curl_options); // Note: the parameter is optional.

define('HOST', 'localhost');
define('PORT', 8000);

$query_string = '/handle_post.php';
$url = sprintf('http://%s:%d%s', HOST, PORT, $query_string);
$content = 'var=value';

$specific_curl_options = array(CURLOPT_HTTPHEADER => array(
    'header1: a',
    'header2: b',
));
$report = null;
try {
    $report = $requester->doPost($url,
        $content,
        'text/html',
        $specific_curl_options); // This parameter is optional.
} catch (ExceptionRuntime $e) {
    printf("FATAL ERROR: %s\n", $e->getMessage());
    exit(1);
} catch (ExceptionParameter $e) {
    printf("FATAL ERROR: %s\n", $e->getMessage());
    exit(1);
} catch (\Exception $e) {
    printf("FATAL ERROR: %s\n", $e->getMessage());
    exit(1);
}

printf("Last HTTP response code: %d\n", $report->getResponse()->getCode());
printf("Content length:          %d\n", $report->getResponse()->getContentLength());
printf("Content type:            %s\n\n", is_null($report->getResponse()->getContentType()) ? 'null' : $report->getResponse()->getContentType());

// Get the request header. Please note that the request content will be null (as it is for any GET request).
printf("Request header:\n\n%s\n\n",
    $report->getRequest()->getHeader()->getAsString()
);

// Get the request content.
printf("Request content:\n\n%s\n\n",
    $report->getRequest()->getContent()
);

// Get the response header.
printf("Response header:\n\n%s\n\n",
    $report->getResponse()->getHeader()->getAsString()
);

// Get the response body.
printf("Request body:\n\n%s\n\n",
    $report->getResponse()->getBody()
);

// Get data about the execution.
printf("Request body:\n\n%s\n\n",
    $report->getInformation()->getAsString(true)
);
