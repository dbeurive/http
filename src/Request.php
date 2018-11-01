<?php

/**
 * This file implements the representation of an HTTP request.
 */

namespace dbeurive\Http;

/**
 * Class Request
 *
 * This class implements the representation of an HTTP request. The request data is split into:
 * - the request header.
 * - the request body.
 *
 * @package dbeurive\Rest
 */

class Request
{
    /** @var Header Request header. */
    private $__header;
    /** @var null|string Request content.  */
    private $__content = null;

    /**
     * Request constructor.
     * @param HeadersContainer $in_header The header container.
     * @param null|string $in_content The request content.
     *        Set this value to null if the request has no content (as it should be the case for a GET request, for example).
     */
    public function __construct(HeadersContainer $in_header, $in_content)
    {
        $this->__header = new Header($in_header->getHeadersAsArray());
        $this->__content = $in_content;
    }

    /**
     * Returns the request header container.
     * @return Header The method returns the request header container.
     */
    public function getHeader() {
        return $this->__header;
    }

    /**
     * Returns the request content.
     * @return null|string The method returns the request content.
     *         The returned value null means that the request has no content (as it should be the case for a GET request,
     *         for example).
     */
    public function getContent() {
        return $this->__content;
    }
}