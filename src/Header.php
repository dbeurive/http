<?php

/**
 * This file implements a (request/response) header.
 */

namespace dbeurive\Http;

/**
 * Class Header
 *
 * This class implements a (request/response) header.
 *
 * @package dbeurive\Http
 */
class Header
{
    /** @var null|array Information about the HTTP exchange. */
    private $__headers = null;

    /**
     * ExecutionInformation constructor.
     * @param array $in_headers List of lines that represents the header.
     */
    public function __construct(array $in_headers=array()) {
        $this->__headers = $in_headers;
    }

    /**
     * Return the list of headers.
     * @return array The list of headers.
     */
    public function getAsArray() {
        return $this->__headers;
    }

    /**
     * Return the list of headers as a unique string (as it appears in the HTTP request).
     * @return string The HTTP headers as a unique string.
     */
    public function getAsString() {
        return join("\r\n", $this->__headers);
    }
}