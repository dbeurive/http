<?php

/**
 * This file implements the representation of an HTTP response.
 */

namespace dbeurive\Http;

/**
 * Class Response
 *
 * This class implements the representation of an HTTP response.
 *
 * @package dbeurive\Rest
 */

class Response
{
    /** @var Header Response header. */
    private $__header;
    /** @var string Response body.  */
    private $__body = null;
    /** @var int HTTP response code. */
    private $__code = null;
    /** @var string|null HTTP content type. */
    private $__contentType = null;
    /** @var int HTTP content length. */
    private $__contentLength = null;

    /**
     * Response constructor.
     * @param HeadersContainer $in_headers_container The header container.
     * @param string $in_body The response body.
     * @param int $in_code The HTTP response code.
     * @param null|string $in_content_type the response content type.
     * @param int $in_content_length HTTP content length.
     */
    public function __construct(HeadersContainer $in_headers_container, $in_body, $in_code, $in_content_type, $in_content_length)
    {
        $this->__header = new Header($in_headers_container->getHeadersAsArray());
        $this->__body = $in_body;
        $this->__code = $in_code;
        $this->__contentType = $in_content_type;
        $this->__contentLength = $in_content_length;
    }

    /**
     * Returns the response header.
     * @return Header The method returns the response header.
     */
    public function getHeader() {
        return $this->__header;
    }

    /**
     * Returns the response content.
     * @return string The method returns the response content.
     */
    public function getBody() {
        return $this->__body;
    }

    /**
     * Returns the last HTTP response code.
     * @return int The last HTTP response code.
     */
    public function getCode() {
        return $this->__code;
    }

    /**
     * Return the response content type.
     * @return string The response content type.
     */
    public function getContentType() {
        return $this->__contentType;
    }

    /**
     * Return the response content length.
     * @return int The response content length.
     */
    public function getContentLength() {
        return $this->__contentLength;
    }
}