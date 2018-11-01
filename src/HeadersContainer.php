<?php

/**
 * This file implements the container used to store headers (extracted from requests or responses).
 */

namespace dbeurive\Http;

/**
 * Class HeadersContainer
 *
 * This class implements the container used to store headers (extracted from requests or responses).
 *
 * @package dbeurive\Rest
 */

class HeadersContainer
{
    /** @var array List of recorder header. */
    private $__container = array();

    /**
     * Empty the list of headers.
     */
    public function reset() {
        $this->__container = array();
    }

    /**
     * Add a header to the list of headers.
     * @param string $in_header Header to add.
     */
    public function addHeader($in_header) {
        if (1 === preg_match('/^[\s\n\r]*$/', $in_header)) { return; }
        $this->__container[] = $in_header;
    }

    /**
     * Return the list of headers.
     * @return array The list of headers.
     */
    public function getHeadersAsArray() {
        return $this->__container;
    }

    /**
     * Return the list of headers as a unique string (as it appears in the HTTP request).
     * @return string The HTTP headers as a unique string.
     */
    public function getHeadersAsString() {
        return join("\r\n", $this->__container);
    }
}