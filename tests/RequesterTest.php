<?php

// Go to the "tests" directory and start PHP7 as a WEB server:
//
// php -S localhost:8000 -t public
//
// Then you can run the unit tests.

use dbeurive\Http\Requester;
require_once __DIR__ . DIRECTORY_SEPARATOR . 'RequestsResponses.php';



class RequesterTest extends PHPUnit_Framework_TestCase
{
    const HOST='localhost';
    const PORT=8000; // This value depends on the parameter used to start the HTTP server.
    /** @var Requester */
    private $__requester = null;

    public function setUp() {
        $this->__requester = new Requester();
    }

    public function testDoGet() {
        $query_string = '/handle_get.php?a=1&b=2';
        $url = sprintf('http://%s:%d%s', self::HOST, self::PORT, $query_string);
        $options = array(CURLOPT_USERPWD => 'admin:admin');
        $report = $this->__requester->doGet($url, $options);

        // Check the content of the request object.

        $request = $report->getRequest();
        $headers = array();
        foreach ($request->getHeader()->getAsArray() as $_line) {
            $headers[$_line] = null;
        }

        $this->assertArrayHasKey(sprintf('GET %s HTTP/1.1', $query_string), $headers);
        $this->assertArrayHasKey(sprintf('Host: %s:%d', self::HOST, self::PORT), $headers);
        $this->assertArrayHasKey('Accept: */*', $headers);
        $this->assertArrayHasKey('Authorization: Basic YWRtaW46YWRtaW4=', $headers);

        // Check the content of the response object.

        $response = $report->getResponse();
        $this->assertEquals(200, $response->getCode());
        $this->assertEquals(RequestsResponses::GET, $response->getBody());
        $this->assertEquals('text/html; charset=UTF-8', $response->getContentType());
        $this->assertEquals(-1, $response->getContentLength());

        $headers = array();
        foreach ($response->getHeader()->getAsArray() as $_line) {
            $headers[$_line] = null;
        }
        $this->assertArrayHasKey('HTTP/1.1 200 OK', $headers);
    }

    public function testDoPost() {
        $query_string = '/handle_post.php';
        $url = sprintf('http://%s:%d%s', self::HOST, self::PORT, $query_string);
        $content = 'var=value';
        $options = array(CURLOPT_USERPWD => 'admin:admin');
        $report = $this->__requester->doPost($url, $content, 'text/html', $options);

        // Check the content of the request object.

        $request = $report->getRequest();
        $headers = array();
        foreach ($request->getHeader()->getAsArray() as $_line) {
            $headers[$_line] = null;
        }

        $this->assertArrayHasKey(sprintf('POST %s HTTP/1.1', $query_string), $headers);
        $this->assertArrayHasKey(sprintf('Host: %s:%d', self::HOST, self::PORT), $headers);
        $this->assertArrayHasKey('Accept: */*', $headers);
        $this->assertArrayHasKey('Content-Type: text/html', $headers);
        $this->assertArrayHasKey(sprintf('Content-Length: %d', strlen($content)), $headers);
        $this->assertArrayHasKey('Authorization: Basic YWRtaW46YWRtaW4=', $headers);

        // Check the content of the response object.

        $response_body = sprintf('%s %s', RequestsResponses::POST, $content);
        $response = $report->getResponse();
        $this->assertEquals(200, $response->getCode());
        $this->assertEquals($response_body, $response->getBody());
        $this->assertEquals('text/html; charset=UTF-8', $response->getContentType());
        $this->assertEquals(-1, $response->getContentLength());

        $headers = array();
        foreach ($response->getHeader()->getAsArray() as $_line) {
            $headers[$_line] = null;
        }

        $this->assertArrayHasKey('HTTP/1.1 200 OK', $headers);
    }

    public function testDoPut() {
        $query_string = '/handle_put.php';
        $url = sprintf('http://%s:%d%s', self::HOST, self::PORT, $query_string);
        $content = 'var=value';
        $options = array(CURLOPT_USERPWD => 'admin:admin');
        $report = $this->__requester->doPut($url, $content, 'text/html', $options);

        // Check the content of the request object.

        $request = $report->getRequest();
        $headers = array();
        foreach ($request->getHeader()->getAsArray() as $_line) {
            $headers[$_line] = null;
        }

        $this->assertArrayHasKey(sprintf('PUT %s HTTP/1.1', $query_string), $headers);        $this->assertArrayHasKey(sprintf('Host: %s:%d', self::HOST, self::PORT), $headers);
        $this->assertArrayHasKey('Accept: */*', $headers);
        $this->assertArrayHasKey('Content-Type: text/html', $headers);
        $this->assertArrayHasKey(sprintf('Content-Length: %d', strlen($content)), $headers);
        $this->assertArrayHasKey('Authorization: Basic YWRtaW46YWRtaW4=', $headers);

        // Check the content of the response object.

        $response_body = sprintf('%s %s', RequestsResponses::PUT, $content);
        $response = $report->getResponse();
        $this->assertEquals(200, $response->getCode());
        $this->assertEquals($response_body, $response->getBody());
        $this->assertEquals('text/html; charset=UTF-8', $response->getContentType());
        $this->assertEquals(-1, $response->getContentLength());

        $headers = array();
        foreach ($response->getHeader()->getAsArray() as $_line) {
            $headers[$_line] = null;
        }
        $this->assertArrayHasKey('HTTP/1.1 200 OK', $headers);
    }

    public function testDoDelete() {
        $query_string = '/handle_delete.php?a=1&b=2';
        $url = sprintf('http://%s:%d%s', self::HOST, self::PORT, $query_string);
        $options = array(CURLOPT_USERPWD => 'admin:admin');
        $report = $this->__requester->doDelete($url, $options);

        // Check the content of the request object.

        $request = $report->getRequest();
        $headers = array();
        foreach ($request->getHeader()->getAsArray() as $_line) {
            $headers[$_line] = null;
        }
        $this->assertArrayHasKey(sprintf('DELETE %s HTTP/1.1', $query_string), $headers);        $this->assertArrayHasKey(sprintf('Host: %s:%d', self::HOST, self::PORT), $headers);
        $this->assertArrayHasKey(sprintf('Host: %s:%d', self::HOST, self::PORT), $headers);
        $this->assertArrayHasKey('Accept: */*', $headers);
        $this->assertArrayHasKey('Authorization: Basic YWRtaW46YWRtaW4=', $headers);

        // Check the content of the response object.

        $response = $report->getResponse();
        $this->assertEquals(200, $response->getCode());
        $this->assertEquals(RequestsResponses::DELETE, $response->getBody());
        $this->assertEquals('text/html; charset=UTF-8', $response->getContentType());
        $this->assertEquals(-1, $response->getContentLength());

        $headers = array();
        foreach ($response->getHeader()->getAsArray() as $_line) {
            $headers[$_line] = null;
        }
        $this->assertArrayHasKey('HTTP/1.1 200 OK', $headers);
    }

    public function testGenerateQueryString() {
        $params = array(
            'p1' => null,
            'p2' => false,
            'p3' => '',
            'p4' => ' ',
            'p5' => 'This is a parameter',
            'p6' => "%\r\n+"
        );

        $qr = Requester::generateQueryString($params);
        $expected = 'p1=&p2=&p3=&p4=+&p5=This+is+a+parameter&p6=%25%0D%0A%2B';
        $this->assertEquals($expected, $qr);
    }
}